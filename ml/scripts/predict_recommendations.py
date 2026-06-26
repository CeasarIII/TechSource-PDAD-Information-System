"""
predict_recommendations.py

TF-IDF + Cosine Similarity job recommendation engine.
Called by Laravel via shell exec.

Status: SKELETON ONLY — full implementation in Week 3.

Author: Member 2 (ML Lead)
"""

import sys
import json
import os


def get_recommendations(applicant_data, available_jobs, predicted_type, top_n=5):
    """
    Returns top N recommended jobs ranked by similarity to applicant profile.

    Args:
        applicant_data (dict): Applicant profile fields
        available_jobs (list): List of job dicts with id, title, description, etc.
        predicted_type (str): Employment type predicted by Random Forest
        top_n (int): Number of recommendations to return

    Returns:
        list of dicts with job_id, similarity_score, rank_position
    """
    # STEP 1: Filter by predicted type (hard filter)
    jobs_filtered = filter_by_employment_type(available_jobs, predicted_type)

    # STEP 2: Disability compatibility filter (3 layers)
    jobs_filtered = apply_disability_compatibility(jobs_filtered, applicant_data)

    if not jobs_filtered:
        return []

    # STEP 3: Compose text documents
    applicant_doc = compose_applicant_document(applicant_data)
    job_docs = [compose_job_document(j) for j in jobs_filtered]

    # STEP 4: TF-IDF vectorize
    # tfidf_matrix = vectorize([applicant_doc] + job_docs)

    # STEP 5: Cosine similarity
    # similarities = compute_cosine_similarity(tfidf_matrix)

    # STEP 6: Rank and return top N
    # ranked = rank_jobs(jobs_filtered, similarities, top_n)

    # return ranked

    return []  # placeholder


def filter_by_employment_type(jobs, employment_type):
    """Hard filter: only jobs matching predicted type pass."""
    return [j for j in jobs if j.get('employment_type') == employment_type]


def apply_disability_compatibility(jobs, applicant):
    """
    Three-layer compatibility filter:
    Layer 1: Employer-declared compatibility (job.compatible_disabilities list)
    Layer 2: TF-IDF on disability_friendly_notes (handled in main pipeline)
    Layer 3: Hard heuristic exclusion rules
    """
    # TODO: Implement in Week 3
    return jobs


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
        job.get('disability_friendly_notes', ''),
    ]
    return ' '.join(filter(None, parts))


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
        print(json.dumps({'recommendations': recommendations}))
    except Exception as e:
        print(json.dumps({'error': str(e)}))
        sys.exit(1)


if __name__ == '__main__':
    main()
