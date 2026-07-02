\# ML-Laravel Integration Contract

\## predict_employment_type.py

\### Input (command-line argument)

JSON string with these required keys:

\- age (int)

\- sex (string: Male, Female)

\- civil_status (string)

\- disability_type (string)

\- disability_visibility (string: Apparent, Non-apparent)

\- cause_of_disability (string)

\- educational_attainment (string)

\- skills (string)

\- mobility_status (string)

\- current_assistive_device (string, use "None" if no device)

\- occupation_group (string)

\### Output (stdout)

JSON with:

\- predicted_type (string)

\- confidence (float, 0.0-1.0)

\- all_probabilities (object, class_name -> probability)

\### Error responses

````json

{

&#x20; "error": "<error message>"

}

---

## predict_recommendations.py (Recommender)

### Purpose
Ranks available job posts for a specific PWD applicant based on TF-IDF vectorization + Cosine Similarity, filtered through a 3-layer disability compatibility pipeline.

### Verified Performance (End-to-end tested 2026-07-02)
- Total execution time: ~2-3 seconds for 25 jobs
- Filtering pipeline: 25 jobs → 10 (after type filter) → 5 (returned)
- Sample verification: Visual Disability applicant with Clerical background, predicted "Permanent" employment type, received 5 Data Encoder recommendations

### Input (command-line argument, JSON string)

```json
{
  "applicant_data": {
    "disability_type": "Visual Disability",
    "mobility_status": "Ambulatory",
    "current_assistive_device": "Eyeglasses",
    "skills": "Computer data encoding, Records management",
    "preferred_employment_type": "Permanent",
    "preferred_job_category": "Clerical",
    "educational_attainment": "College Graduate",
    "occupation_group": "Clerical Support Workers"
  },
  "available_jobs": [
    {
      "id": 1,
      "job_title": "Data Encoder",
      "job_description": "...",
      "required_skills": "skill1, skill2",
      "employment_type": "Permanent",
      "required_education": "High School Graduate",
      "disability_friendly_notes": "Screen reader compatible workstation",
      "compatible_disabilities": ["Visual Disability", "Mobility"]
    }
  ],
  "predicted_employment_type": "Permanent",
  "top_n": 5
}
````

### Output (stdout, JSON)

```json
{
    "recommendations": [
        {
            "job_id": 1,
            "job_title": "Data Encoder",
            "similarity_score": 0.1097,
            "rank_position": 1
        }
    ],
    "metadata": {
        "total_jobs_input": 25,
        "after_type_filter": 10,
        "returned_count": 5
    }
}
```

### Error responses

```json
{ "error": "descriptive message" }
```

### Filtering Pipeline (3 Layers)

1. **Hard filter by employment type** — Only jobs matching `predicted_employment_type`
2. **Employer-declared compatibility** — Uses `compatible_disabilities` from JobDisabilityCompatibility table
3. **Heuristic exclusion** — Disability-specific exclusion keywords (e.g., "driving" excluded for Visual Disability)
4. **TF-IDF + Cosine Similarity ranking** on filtered jobs

### Laravel Integration (RecommendationService.php)

The service class calls this script via `proc_open` with a JSON payload constructed from:

- `PwdProfile` linked to `PwdRegistryReference` (for demographics)
- `EmploymentPrediction` (for predicted type)
- `JobPost` with eager-loaded `skills` and `disabilityCompatibility` relations

Results are cached to `job_recommendations` table with `updateOrCreate` pattern (old recommendations deleted before new ones inserted).

### Sample Data Behavior Note

When tested with the sample seeder data (25 jobs templated across 5 employers), TF-IDF produces **identical similarity scores** for jobs with the same text. This is mathematically correct behavior — same input text produces same TF-IDF vector, and same vectors produce same cosine similarity. In production deployment with heterogeneous employer-generated job posts, scores will differentiate based on unique job content.

Verified via `test_recommendations_diverse.py` (15 manually-crafted diverse jobs): scores range 0.09-0.20 with differentiation based on skill match relevance.

### Schema Reference

The Python script expects the JSON payload to match the schema defined in Member 3's migrations. Column reference:

- `employment_predictions`: `predicted_type`, `confidence`, `all_probabilities`
- `job_recommendations`: `pwd_profile_id`, `job_post_id`, `similarity_score`, `rank_position`, `recommendation_reason`, `generated_at`
- `job_posts`: includes `required_education`, `disability_friendly_notes`, `location`
- `job_disability_compatibility`: uses `job_post_id` (not `job_id`)
