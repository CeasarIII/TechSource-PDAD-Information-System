# ml/scripts/test_recommendations.py
import json
import subprocess
import sys
import os

script_dir = os.path.dirname(os.path.abspath(__file__))
script = os.path.join(script_dir, 'predict_recommendations.py')

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
    'available_jobs': [
        # Paste yung 5 sample jobs from Step 1.1
    ],
    'predicted_employment_type': 'Permanent',
    'top_n': 5
}

result = subprocess.run(
    [sys.executable, script, json.dumps(payload)],
    capture_output=True, text=True
)

print("STDOUT:", result.stdout)
print("STDERR:", result.stderr)
