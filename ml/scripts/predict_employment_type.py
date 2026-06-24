"""
predict_employment_type.py

Standalone prediction script for the PDAD Employment Matching System.
Called by Laravel via shell exec with JSON input.

Usage:
    python predict_employment_type.py '{"age": 35, "sex": "Male", ...}'

Output (stdout):
    JSON with predicted_type, confidence, and all class probabilities.

Author: Prince (ML Lead)
"""
import warnings
warnings.filterwarnings('ignore', category=UserWarning)
warnings.filterwarnings('ignore', category=FutureWarning)
import sys
import json
import os
import warnings

# Suppress sklearn version warnings — model trained on 1.6.1, runtime on 1.9.0
# This is documented as a known limitation in the thesis methodology section
warnings.filterwarnings('ignore', category=UserWarning)
warnings.filterwarnings('ignore', category=FutureWarning)

import joblib
import pandas as pd


# Resolve paths relative to this script's location
SCRIPT_DIR = os.path.dirname(os.path.abspath(__file__))
MODELS_DIR = os.path.join(SCRIPT_DIR, '..', 'models')

MODEL_PATH = os.path.join(MODELS_DIR, 'rf_model_v1.joblib')
FEATURES_PATH = os.path.join(MODELS_DIR, 'rf_feature_columns.joblib')
CLASSES_PATH = os.path.join(MODELS_DIR, 'rf_classes.joblib')


def predict(profile_dict):
    """
    Predicts employment type from an applicant profile dictionary.

    Args:
        profile_dict (dict): Applicant features. Required keys:
            age, sex, civil_status, disability_type, disability_visibility,
            cause_of_disability, educational_attainment, skills,
            mobility_status, current_assistive_device, occupation_group

    Returns:
        dict: {
            'predicted_type': str,
            'confidence': float,
            'all_probabilities': dict
        }
    """
    # Load saved artifacts
    model = joblib.load(MODEL_PATH)
    feature_cols = joblib.load(FEATURES_PATH)

    # Convert profile to DataFrame
    df = pd.DataFrame([profile_dict])

    # Map snake_case keys to the column names used during training (Title_Case)
    column_mapping = {
        'age': 'Age',
        'sex': 'Sex',
        'civil_status': 'Civil_Status',
        'disability_type': 'Disability_Type',
        'disability_visibility': 'Disability_Visibility',
        'cause_of_disability': 'Cause_of_Disability',
        'educational_attainment': 'Educational_Attainment',
        'skills': 'Skills',
        'mobility_status': 'Mobility_Status',
        'current_assistive_device': 'Current_Assistive_Device',
        'occupation_group': 'Occupation_Group'
    }
    df = df.rename(columns=column_mapping)

    # One-hot encode (must match training preprocessing)
    categorical_cols = [c for c in df.columns if c != 'Age']
    df_encoded = pd.get_dummies(df, columns=categorical_cols, drop_first=False)

    # Align columns to match training feature set
    # Missing columns are filled with 0 (the applicant doesn't have that category)
    df_aligned = df_encoded.reindex(columns=feature_cols, fill_value=0)

    # Predict
    prediction = model.predict(df_aligned)[0]
    probabilities = model.predict_proba(df_aligned)[0]
    confidence = float(max(probabilities))

    # Build probability map: {'Permanent': 0.45, 'Contractual': 0.20, ...}
    all_probs = {
        str(cls): round(float(p), 4)
        for cls, p in zip(model.classes_, probabilities)
    }

    return {
        'predicted_type': str(prediction),
        'confidence': round(confidence, 4),
        'all_probabilities': all_probs
    }


def main():
    if len(sys.argv) < 2:
        error = {
            'error': 'No input provided',
            'usage': 'python predict_employment_type.py \'{"age": 35, ...}\''
        }
        print(json.dumps(error))
        sys.exit(1)

    try:
        profile_json = sys.argv[1]
        profile = json.loads(profile_json)
        result = predict(profile)
        print(json.dumps(result))
    except json.JSONDecodeError as e:
        print(json.dumps({'error': f'Invalid JSON input: {str(e)}'}))
        sys.exit(1)
    except FileNotFoundError as e:
        print(json.dumps({'error': f'Model file not found: {str(e)}'}))
        sys.exit(1)
    except Exception as e:
        print(json.dumps({'error': f'Prediction failed: {str(e)}'}))
        sys.exit(1)


if __name__ == '__main__':
    main()