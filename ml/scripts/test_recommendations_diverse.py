"""
test_recommendations_diverse.py

Tests predict_recommendations.py with MANUALLY-CRAFTED DIVERSE jobs.

Purpose: Validate that the recommender can differentiate when jobs have
varied descriptions, skills, and accommodations (unlike the templated
seeder data which produced identical TF-IDF vectors).

This serves as before/after evidence:
- test_recommendations_real.py: shows behavior with templated data
- test_recommendations_diverse.py: shows behavior with realistic varied data
"""

import json
import subprocess
import sys
import os

script_dir = os.path.dirname(os.path.abspath(__file__))
script = os.path.join(script_dir, 'predict_recommendations.py')

# Manually-crafted DIVERSE jobs — each with unique description, skills, notes
diverse_jobs = [
    {
        'id': 101,
        'job_title': 'Data Encoder',
        'job_description': 'Encode customer information into the system database. Maintain accurate records of client transactions and demographic information.',
        'required_skills': 'Computer data encoding, Records management, Microsoft Excel, Attention to detail',
        'employment_type': 'Permanent',
        'required_education': 'High School Graduate',
        'disability_friendly_notes': 'Screen reader compatible computers. Adjustable monitor heights. Flexible work hours.',
        'compatible_disabilities': ['Visual Disability', 'Orthopedic Disability', 'Mobility']
    },
    {
        'id': 102,
        'job_title': 'Administrative Records Officer',
        'job_description': 'Manage office records, filing systems, and document archives. Coordinate with various departments for documentation needs.',
        'required_skills': 'Records management, Filing systems, Office administration, Microsoft Office',
        'employment_type': 'Permanent',
        'required_education': 'College Graduate',
        'disability_friendly_notes': 'Well-lit workspace. Ergonomic furniture. Quiet office environment for focused work.',
        'compatible_disabilities': ['Visual Disability', 'Hearing Disability', 'Mobility']
    },
    {
        'id': 103,
        'job_title': 'Library Cataloger',
        'job_description': 'Catalog books and resources using library classification systems. Update digital library records and assist with research queries.',
        'required_skills': 'Records management, Library science, Database management, Research',
        'employment_type': 'Permanent',
        'required_education': 'College Graduate',
        'disability_friendly_notes': 'Quiet library environment. Wheelchair accessible. Screen magnification software available.',
        'compatible_disabilities': ['Visual Disability', 'Mobility', 'Orthopedic Disability']
    },
    {
        'id': 104,
        'job_title': 'Customer Service Chat Agent',
        'job_description': 'Handle customer inquiries via online chat and email. Resolve concerns professionally without phone interaction.',
        'required_skills': 'Customer service, Written communication, Problem solving, Typing speed',
        'employment_type': 'Contractual',
        'required_education': 'High School Graduate',
        'disability_friendly_notes': 'Chat-based work only, no phone calls. Sign language interpreter for team meetings.',
        'compatible_disabilities': ['Deaf or Hard of Hearing', 'Speech and Language Impairment', 'Mobility']
    },
    {
        'id': 105,
        'job_title': 'Office Clerk',
        'job_description': 'General office tasks including filing, photocopying, and basic administrative support. Assist staff with daily operations.',
        'required_skills': 'Filing, Office administration, Photocopying, General office tasks',
        'employment_type': 'Permanent',
        'required_education': 'High School Graduate',
        'disability_friendly_notes': 'Adjustable workstation. Accessible restrooms. Light physical work only.',
        'compatible_disabilities': ['Visual Disability', 'Mobility', 'Learning Disability']
    },
    {
        'id': 106,
        'job_title': 'Data Analyst Trainee',
        'job_description': 'Analyze sales data and prepare reports for management. Use spreadsheets and basic statistical tools.',
        'required_skills': 'Data analysis, Microsoft Excel, Statistical analysis, Report writing',
        'employment_type': 'Permanent',
        'required_education': 'College Graduate',
        'disability_friendly_notes': 'Quiet workspace. High-resolution monitors. Screen reader compatible software.',
        'compatible_disabilities': ['Visual Disability', 'Hearing Disability', 'Psychosocial Disability']
    },
    {
        'id': 107,
        'job_title': 'Warehouse Inventory Assistant',
        'job_description': 'Track inventory levels and assist with stock management. Light to moderate physical work required.',
        'required_skills': 'Inventory management, Stock counting, Physical stamina',
        'employment_type': 'Permanent',
        'required_education': 'High School Graduate',
        'disability_friendly_notes': 'Some standing and walking required. Mostly in warehouse environment.',
        'compatible_disabilities': ['Hearing Disability', 'Speech and Language Impairment', 'Learning Disability']
    },
    {
        'id': 108,
        'job_title': 'Field Sales Representative',
        'job_description': 'Drive to client locations across the city. Conduct face-to-face sales presentations and visual product demonstrations.',
        'required_skills': 'Sales, Driving, Public speaking, Visual presentation',
        'employment_type': 'Permanent',
        'required_education': 'College Graduate',
        'disability_friendly_notes': '',
        'compatible_disabilities': []
    },
    {
        'id': 109,
        'job_title': 'Bookkeeper',
        'job_description': 'Maintain financial records, process invoices, and prepare basic financial reports.',
        'required_skills': 'Bookkeeping, Records management, Microsoft Excel, Attention to detail',
        'employment_type': 'Permanent',
        'required_education': 'College Graduate',
        'disability_friendly_notes': 'Quiet office. Flexible hours. Calculator with large display available.',
        'compatible_disabilities': ['Visual Disability', 'Hearing Disability', 'Mobility']
    },
    {
        'id': 110,
        'job_title': 'Receptionist',
        'job_description': 'Greet visitors, answer phone calls, and direct inquiries to appropriate staff. Manage front desk operations.',
        'required_skills': 'Customer service, Phone handling, Verbal communication, Multitasking',
        'employment_type': 'Permanent',
        'required_education': 'High School Graduate',
        'disability_friendly_notes': 'Wheelchair accessible front desk. Visual phone alerts.',
        'compatible_disabilities': ['Mobility', 'Orthopedic Disability']
    },
    {
        'id': 111,
        'job_title': 'Document Encoder',
        'job_description': 'Type and digitize physical documents. Convert paper records into searchable digital files.',
        'required_skills': 'Computer data encoding, Typing speed, Document scanning, Attention to detail',
        'employment_type': 'Permanent',
        'required_education': 'High School Graduate',
        'disability_friendly_notes': 'Adjustable monitor. Screen magnification software. Ergonomic keyboard.',
        'compatible_disabilities': ['Visual Disability', 'Orthopedic Disability', 'Mobility']
    },
    {
        'id': 112,
        'job_title': 'Online Tutor',
        'job_description': 'Provide online tutoring services for elementary subjects. Conduct video classes and prepare lessons.',
        'required_skills': 'Teaching, Public speaking, Lesson planning, Patience',
        'employment_type': 'Contractual',
        'required_education': 'College Graduate',
        'disability_friendly_notes': 'Work from home option. Flexible schedule.',
        'compatible_disabilities': ['Mobility', 'Orthopedic Disability', 'Visual Disability']
    },
    {
        'id': 113,
        'job_title': 'Quality Inspector',
        'job_description': 'Inspect products for defects through visual examination and color matching.',
        'required_skills': 'Visual inspection, Quality control, Attention to detail, Color matching',
        'employment_type': 'Permanent',
        'required_education': 'High School Graduate',
        'disability_friendly_notes': '',
        'compatible_disabilities': ['Hearing Disability', 'Mobility']
    },
    {
        'id': 114,
        'job_title': 'Filing Clerk',
        'job_description': 'Organize and maintain physical and digital filing systems. Retrieve documents on request.',
        'required_skills': 'Filing, Records management, Organization, Office administration',
        'employment_type': 'Permanent',
        'required_education': 'High School Graduate',
        'disability_friendly_notes': 'Adjustable shelving. Mobile filing carts available. Ergonomic furniture.',
        'compatible_disabilities': ['Visual Disability', 'Mobility', 'Learning Disability']
    },
    {
        'id': 115,
        'job_title': 'Translation Assistant',
        'job_description': 'Translate documents between Filipino and English. Proofread translated materials.',
        'required_skills': 'Written communication, Translation, Proofreading, Records management',
        'employment_type': 'Permanent',
        'required_education': 'College Graduate',
        'disability_friendly_notes': 'Work from home option. Screen reader compatible documents.',
        'compatible_disabilities': ['Visual Disability', 'Mobility', 'Hearing Disability']
    }
]

print("=" * 70)
print("TESTING WITH DIVERSE MANUALLY-CRAFTED JOBS")
print("=" * 70)
print(f"\nLoaded {len(diverse_jobs)} diverse jobs (manually crafted)")
print(f"Employment types: {set(j['employment_type'] for j in diverse_jobs)}")

# Same applicant as test_recommendations_real.py for comparison
payload = {
    'applicant_data': {
        'disability_type': 'Visual Disability',
        'mobility_status': 'Independent',
        'current_assistive_device': 'Eyeglasses',
        'skills': 'Computer data encoding, Records management',
        'preferred_employment_type': 'Permanent',
        'preferred_job_category': 'Clerical',
        'educational_attainment': 'College Graduate',
        'occupation_group': 'Clerical Support Workers'
    },
    'available_jobs': diverse_jobs,
    'predicted_employment_type': 'Permanent',
    'top_n': 5
}

print(f"\nApplicant: Visual Disability, College Graduate")
print(f"Skills: Computer data encoding, Records management")
print(f"Predicted type: Permanent")

result = subprocess.run(
    [sys.executable, script, json.dumps(payload)],
    capture_output=True,
    text=True
)

print("\n" + "=" * 70)
print("RESULT")
print("=" * 70)

if result.returncode != 0:
    print(f"ERROR (exit code {result.returncode}):")
    print(result.stderr)
    sys.exit(1)

try:
    output = json.loads(result.stdout)

    if 'error' in output:
        print(f"Recommender error: {output['error']}")
        sys.exit(1)

    print(f"\nFiltering pipeline:")
    print(f"  Total jobs:           {output['metadata']['total_jobs_input']}")
    print(f"  After type filter:    {output['metadata']['after_type_filter']}")
    print(f"  Recommendations:      {output['metadata']['returned_count']}")

    print(f"\nTop {len(output['recommendations'])} Recommendations:")
    print(f"  {'Rank':<6}{'Job ID':<8}{'Score':<10}{'Job Title'}")
    print(f"  {'-' * 6}{'-' * 8}{'-' * 10}{'-' * 40}")

    for rec in output['recommendations']:
        print(f"  {rec['rank_position']:<6}{rec['job_id']:<8}{rec['similarity_score']:<10.4f}{rec['job_title']}")

except json.JSONDecodeError as e:
    print(f"Failed to parse output: {e}")
    print(f"Raw output: {result.stdout}")
    sys.exit(1)

print("\n" + "=" * 70)
print("Test complete. Score distribution should now show differentiation.")
print("=" * 70)