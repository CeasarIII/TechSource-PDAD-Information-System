"""
predict_recommendations.py

TF-IDF + Cosine Similarity job recommendation engine.
Called by Laravel via shell exec.

Returns top N jobs ranked by similarity to applicant profile,
filtered by predicted employment type and disability compatibility.

Author: Member 2 (ML Lead)
"""

import sys
import json
import warnings

# Suppress sklearn warnings (same approach as predict_employment_type.py)
warnings.filterwarnings('ignore', category=UserWarning)
warnings.filterwarnings('ignore', category=FutureWarning)

from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity


# =====================================================================
# Main entry point
# =====================================================================

def get_recommendations(applicant_data, available_jobs, predicted_type, top_n=5):
    """
    Returns top N recommended jobs ranked by similarity to applicant profile.

    Args:
        applicant_data (dict): Applicant profile fields
        available_jobs (list): List of job dicts
        predicted_type (str): Employment type predicted by Random Forest
        top_n (int): Number of recommendations to return

    Returns:
        list of dicts with job_id, job_title, similarity_score, rank_position
    """
    # STEP 1: Hard filter by employment type
    jobs = filter_by_employment_type(available_jobs, predicted_type)
    if not jobs:
        return []

    # STEP 2: Three-layer disability compatibility filter
    jobs = apply_disability_compatibility(jobs, applicant_data)
    if not jobs:
        return []

    # STEP 3: Compose text documents
    applicant_doc = compose_applicant_document(applicant_data)
    job_docs = [compose_job_document(j) for j in jobs]

    # STEP 4: TF-IDF vectorization
    vectorizer = TfidfVectorizer(
        lowercase=True,
        stop_words='english',
        ngram_range=(1, 2),
        min_df=1,
        max_df=0.95
    )
    corpus = [applicant_doc] + job_docs
    tfidf_matrix = vectorizer.fit_transform(corpus)

    # STEP 5: Cosine similarity
    applicant_vector = tfidf_matrix[0:1]
    job_vectors = tfidf_matrix[1:]
    similarities = cosine_similarity(applicant_vector, job_vectors).flatten()

    # STEP 6: Rank and select top N
    ranked = sorted(
        zip(jobs, similarities),
        key=lambda x: x[1],
        reverse=True
    )

    return [
        {
            'job_id': job.get('id'),
            'job_title': job.get('job_title', ''),
            'similarity_score': round(float(sim), 4),
            'rank_position': i + 1
        }
        for i, (job, sim) in enumerate(ranked[:top_n])
    ]


# =====================================================================
# Layer 1 — Hard filter by employment type
# =====================================================================

def filter_by_employment_type(jobs, employment_type):
    """Only jobs matching predicted type pass through."""
    return [j for j in jobs if j.get('employment_type') == employment_type]


# =====================================================================
# Layer 2 — Three-layer disability compatibility
# =====================================================================

def apply_disability_compatibility(jobs, applicant):
    """
    Three-layer compatibility filtering:
    Sub-layer A: Employer-declared compatibility (compatible_disabilities list)
    Sub-layer B: Heuristic exclusion rules based on disability + assistive device
    Sub-layer C: TF-IDF on disability_friendly_notes (handled in main TF-IDF stage)
    """
    applicant_disability = applicant.get('disability_type', '')
    assistive_device = applicant.get('current_assistive_device', 'None')

    # Sub-layer A: Employer-declared compatibility
    jobs_compatible = []
    for job in jobs:
        compat_list = job.get('compatible_disabilities', [])
        # If employer didn't specify, default to inclusive (no restriction)
        if not compat_list or applicant_disability in compat_list:
            jobs_compatible.append(job)

    # Sub-layer B: Heuristic exclusion rules
    exclusion_keywords = get_exclusion_keywords(applicant_disability, assistive_device)

    if not exclusion_keywords:
        return jobs_compatible

    jobs_safe = []
    for job in jobs_compatible:
        if not is_excluded_by_heuristic(job, exclusion_keywords):
            jobs_safe.append(job)

    return jobs_safe


def get_exclusion_keywords(disability_type, assistive_device):
    """
    Returns a list of keywords to exclude based on disability type.
    These represent jobs that are physically/functionally incompatible
    despite what an employer may declare.
    """
    rules = {
        'Visual Disability': [
            'driving', 'visual inspection', 'color matching', 'forklift operation'
        ],
        'Deaf or Hard of Hearing': [
            'phone-based customer service', 'audio transcription', 'sales calling'
        ],
        'Mobility': [
            'field work', 'climbing', 'construction site', 'standing 8 hours'
        ],
        'Orthopedic Disability': [
            'heavy lifting', 'standing 8 hours', 'construction site'
        ],
        'Speech and Language Impairment': [
            'public speaking', 'voice acting', 'sales calling'
        ],
    }

    keywords = rules.get(disability_type, [])

    # Relax some rules if applicant has assistive device that mitigates the disability
    if disability_type == 'Visual Disability' and assistive_device in ['Eyeglasses', 'Contact Lenses']:
        # Eyeglass/contact users can still do visual work (just not extreme cases)
        keywords = [k for k in keywords if k not in ['visual inspection', 'color matching']]

    return keywords


def is_excluded_by_heuristic(job, exclusion_keywords):
    """Returns True if job description contains any exclusion keyword."""
    text = (
        job.get('job_description', '') + ' ' +
        job.get('required_skills', '')
    ).lower()
    return any(kw.lower() in text for kw in exclusion_keywords)


# =====================================================================
# Document composition for TF-IDF
# =====================================================================

def compose_applicant_document(applicant):
    """
    Combines applicant profile fields into a single text document
    for TF-IDF vectorization.
    """
    parts = [
        applicant.get('skills', ''),
        applicant.get('preferred_employment_type', ''),
        applicant.get('preferred_job_category', ''),
        applicant.get('educational_attainment', ''),
        applicant.get('occupation_group', ''),
        derive_disability_keywords(
            applicant.get('disability_type', ''),
            applicant.get('mobility_status', ''),
            applicant.get('current_assistive_device', 'None')
        )
    ]
    return ' '.join(filter(None, parts))


def compose_job_document(job):
    """
    Combines job posting fields into a single text document
    for TF-IDF vectorization.
    """
    parts = [
        job.get('job_title', ''),
        job.get('job_description', ''),
        job.get('required_skills', ''),
        job.get('employment_type', ''),
        job.get('required_education', ''),
        job.get('disability_friendly_notes', '')
    ]
    return ' '.join(filter(None, parts))


def derive_disability_keywords(disability_type, mobility_status, assistive_device):
    """
    Derives accommodation-related keywords from applicant disability profile.
    These match against employer's disability_friendly_notes via TF-IDF.
    """
    keywords = []

    if disability_type == 'Visual Disability':
        keywords += ['screen reader compatible', 'well-lit office']
    elif disability_type == 'Deaf or Hard of Hearing':
        keywords += ['sign language interpreter', 'chat-based', 'written communication']
    elif disability_type == 'Mobility':
        keywords += ['wheelchair accessible', 'remote work option']
    elif disability_type == 'Orthopedic Disability':
        keywords += ['ergonomic workstation', 'flexible hours']
    elif disability_type == 'Speech and Language Impairment':
        keywords += ['written communication', 'chat-based']

    if mobility_status == 'Assisted':
        keywords += ['wheelchair accessible', 'ramp access']

    if assistive_device == 'Wheelchair':
        keywords += ['wheelchair accessible', 'ramp access', 'accessible restroom']
    elif assistive_device == 'Hearing Aid':
        keywords += ['quiet office environment']

    return ' '.join(keywords)


# =====================================================================
# CLI entry point — called by Laravel via shell exec
# =====================================================================

def main():
    if len(sys.argv) < 2:
        print(json.dumps({'error': 'No input provided'}))
        sys.exit(1)

    try:
        payload = json.loads(sys.argv[1])

        recommendations = get_recommendations(
            applicant_data=payload['applicant_data'],
            available_jobs=payload['available_jobs'],
            predicted_type=payload['predicted_employment_type'],
            top_n=payload.get('top_n', 5)
        )

        # Compute metadata for transparency
        total_jobs = len(payload['available_jobs'])
        after_type = len([
            j for j in payload['available_jobs']
            if j.get('employment_type') == payload['predicted_employment_type']
        ])

        output = {
            'recommendations': recommendations,
            'metadata': {
                'total_jobs_input': total_jobs,
                'after_type_filter': after_type,
                'returned_count': len(recommendations)
            }
        }

        print(json.dumps(output))

    except json.JSONDecodeError as e:
        print(json.dumps({'error': f'Invalid JSON input: {str(e)}'}))
        sys.exit(1)
    except KeyError as e:
        print(json.dumps({'error': f'Missing required field: {str(e)}'}))
        sys.exit(1)
    except Exception as e:
        print(json.dumps({'error': f'Recommendation failed: {str(e)}'}))
        sys.exit(1)


if __name__ == '__main__':
    main()