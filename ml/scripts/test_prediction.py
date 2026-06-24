# Test harness for predict_employment_type.py
# Run: python ml\scripts\test_prediction.py

import json
import subprocess
import sys
import os

test_profiles = [
    {
        "name": "Test 1 - Visual Disability, College Grad, Clerical",
        "profile": {
            "age": 35,
            "sex": "Male",
            "civil_status": "Single",
            "disability_type": "Visual Disability",
            "disability_visibility": "Apparent",
            "cause_of_disability": "Congenital/Inborn",
            "educational_attainment": "College Graduate",
            "skills": "Computer data encoding",
            "mobility_status": "Independent",
            "current_assistive_device": "Eyeglasses",
            "occupation_group": "Clerical Support Workers"
        }
    },
    {
        "name": "Test 2 - Mobility Disability, Vocational Trade",
        "profile": {
            "age": 42,
            "sex": "Female",
            "civil_status": "Married",
            "disability_type": "Orthopedic Disability",
            "disability_visibility": "Apparent",
            "cause_of_disability": "Acquired",
            "educational_attainment": "Vocational Graduate",
            "skills": "Handicrafts",
            "mobility_status": "Assisted",
            "current_assistive_device": "Wheelchair",
            "occupation_group": "Craft and Related Trades Workers"
        }
    },
    {
        "name": "Test 3 - Hard of Hearing, Service Sector",
        "profile": {
            "age": 28,
            "sex": "Female",
            "civil_status": "Single",
            "disability_type": "Deaf or Hard of Hearing",
            "disability_visibility": "Non-apparent",
            "cause_of_disability": "Congenital/Inborn",
            "educational_attainment": "High School Graduate",
            "skills": "Food preparation",
            "mobility_status": "Independent",
            "current_assistive_device": "Hearing Aid",
            "occupation_group": "Service and Sales Workers"
        }
    }
]

script_dir = os.path.dirname(os.path.abspath(__file__))
predict_script = os.path.join(script_dir, "predict_employment_type.py")

print("=" * 70)
print("TESTING predict_employment_type.py")
print("=" * 70)

for test in test_profiles:
    print(f"\n--- {test['name']} ---")

    profile_json = json.dumps(test['profile'])

    result = subprocess.run(
        [sys.executable, predict_script, profile_json],
        capture_output=True,
        text=True
    )

    if result.returncode != 0:
        print(f"ERROR (exit code {result.returncode}):")
        print(result.stderr)
        continue

    try:
        output = json.loads(result.stdout)
        if 'error' in output:
            print(f"Script returned error: {output['error']}")
        else:
            print(f"Predicted Type: {output['predicted_type']}")
            print(f"Confidence:     {output['confidence']:.2%}")
            print(f"All probabilities (sorted):")
            sorted_probs = sorted(
                output['all_probabilities'].items(),
                key=lambda x: x[1],
                reverse=True
            )
            for cls, prob in sorted_probs:
                bar = "#" * int(prob * 30)
                print(f"  {cls:20s} {prob:.4f}  {bar}")
    except json.JSONDecodeError:
        print(f"Could not parse output: {result.stdout}")

print("\n" + "=" * 70)
print("Testing complete.")
print("=" * 70)