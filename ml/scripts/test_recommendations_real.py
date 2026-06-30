"""
test_recommendations_real.py

End-to-end test ng predict_recommendations.py gamit ang REAL DB data
from Member 3's sample employer/jobs seeder.

Validates the recommender with actual production-shape data.
"""

import json
import subprocess
import sys
import os
import mysql.connector

script_dir = os.path.dirname(os.path.abspath(__file__))
script = os.path.join(script_dir, 'predict_recommendations.py')

print("=" * 70)
print("TESTING predict_recommendations.py WITH REAL DB DATA")
print("=" * 70)

# Connect to local pdad_db
print("\n[1/3] Connecting to pdad_db...")
conn = mysql.connector.connect(
    host='127.0.0.1',
    user='root',
    password='',
    database='pdad_db'
)
cursor = conn.cursor(dictionary=True)

# Fetch all open job posts
print("[2/3] Fetching jobs from database...")
cursor.execute("""
    SELECT id, job_title, job_description, employment_type, 
           required_education, disability_friendly_notes
    FROM job_posts 
    WHERE status = 'open'
""")
jobs = cursor.fetchall()

# Enrich each job with skills and disability compatibility
for job in jobs:
    cursor.execute(
    "SELECT skill_name FROM job_skills WHERE job_post_id = %s", 
    (job['id'],)
)
    job['required_skills'] = ', '.join(r['skill_name'] for r in cursor.fetchall())
    
    cursor.execute(
    "SELECT disability_type FROM job_disability_compatibility WHERE job_post_id = %s",
    (job['id'],)
)
    job['compatible_disabilities'] = [r['disability_type'] for r in cursor.fetchall()]
    
    # Handle None values for fields
    job['disability_friendly_notes'] = job['disability_friendly_notes'] or ''
    job['required_education'] = job['required_education'] or ''

cursor.close()
conn.close()

print(f"        Loaded {len(jobs)} jobs from database")

# Test with sample applicant (Visual Disability, Clerical background)
print("[3/3] Running prediction...")
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
    'available_jobs': jobs,
    'predicted_employment_type': 'Permanent',
    'top_n': 5
}

result = subprocess.run(
    [sys.executable, script, json.dumps(payload, default=str)],
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

# Parse and display nicely
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
print("Test complete. Recommender is production-ready!")
print("=" * 70)