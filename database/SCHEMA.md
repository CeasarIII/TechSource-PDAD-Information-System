# Database Schema Documentation

## Overview

This document describes the database schema used by the TechSource PDAD Employment Matching System.

---

## users

Stores all system users including PWDs, employers, and administrators.

| Column | Description |
|---------|-------------|
| id | Primary key |
| name | Full name |
| email | User login email |
| password | Encrypted password |
| role | pwd, employer, admin |
| account_status | Account status |
| terms_accepted | Terms accepted flag |
| terms_accepted_at | Acceptance timestamp |
| deleted_at | Soft delete column |

---

## pwd_registry_reference

Official PDAD Registry imported from CSV (4,850 records).

Purpose:
- Validate PWD IDs
- Reference data only
- Read-only table

---

## pwd_profiles

Extended information of registered PWD users.

Purpose:
- Stores profile information
- Used by recommendation engine
- Connected to applicant skills

---

## applicant_skills

Stores skills declared by PWD applicants.

Purpose:
- Matching
- Skill Gap Analysis
- Recommendation Engine

---

## employers

Stores employer/company information.

Purpose:
- Employer registration
- Company verification
- Job posting

---

## job_posts

Stores all job vacancies.

Purpose:
- Job Recommendation
- Employer Dashboard
- Candidate Matching

---

## job_skills

Skills required by every job post.

Purpose:
- TF-IDF
- Skill Matching

---

## job_disability_compatibility

Disability compatibility per job.

Purpose:
- Accessibility filtering
- Recommendation filtering

---

## applications

Stores submitted job applications.

Purpose:
- Application tracking
- Hiring workflow

---

## employment_predictions

Stores Random Forest prediction results.

Purpose:
- Employment prediction
- Analytics

---

## job_recommendations

Stores TF-IDF recommendation results.

Purpose:
- Recommended jobs
- Ranking
- Similarity scores

---

## skill_gap_results

Stores skill gap analysis.

Purpose:
- Missing skills
- Training recommendation

---

## trainings

Training opportunities for PWD users.

Purpose:
- Upskilling
- Learning recommendations

---

## training_skills

Skills covered by every training.

Purpose:
- Match training with missing skills

---

## admin_audit_logs

Stores every administrator action.

Examples:
- Employer verification
- Job approval
- User suspension

Purpose:
- Audit trail
- Accountability
- Security logging

---

## daily_system_stats

Stores daily statistics.

Includes:

- New PWD registrations
- Employer registrations
- Job posts
- Applications
- Predictions
- Recommendations

Purpose:
- Dashboard analytics

---

## employer_metrics

Stores employer performance statistics.

Includes:

- Total jobs posted
- Total applications received
- Total PWDs hired
- Average response time

Purpose:
- Employer analytics
- Dashboard reporting

---

## Database Summary

Current database contains:

- User Management
- PWD Registry
- Employer Management
- Job Posting
- Job Recommendation
- Employment Prediction
- Skill Gap Analysis
- Training Management
- Reporting
- Audit Logging


---

# Relationships

## User Management

- One User → One PWD Profile
- One User → One Employer
- One Admin → Many Audit Logs
- One User → Many Notifications

## Job Marketplace

- One Employer → Many Job Posts
- One Job Post → Many Job Skills
- One Job Post → Many Disability Compatibility Records

## Applications

- One PWD Profile → Many Applications
- One Job Post → Many Applications

## Recommendations

- One PWD Profile → Many Job Recommendations
- One PWD Profile → Many Employment Predictions
- One PWD Profile → Many Skill Gap Results

## Training

- One Training → Many Training Skills

## Saved Jobs

- One PWD Profile → Many Saved Jobs
- One Job Post → Many Saved Jobs

---

# Foreign Key Summary

| Child Table | Parent Table |
|-------------|--------------|
| pwd_profiles | users |
| pwd_profiles | pwd_registry_reference |
| applicant_skills | pwd_profiles |
| employers | users |
| job_posts | employers |
| job_skills | job_posts |
| job_disability_compatibility | job_posts |
| applications | pwd_profiles |
| applications | job_posts |
| job_recommendations | pwd_profiles |
| job_recommendations | job_posts |
| skill_gap_results | pwd_profiles |
| skill_gap_results | job_posts |
| training_skills | trainings |
| notifications | users |
| saved_jobs | pwd_profiles |
| saved_jobs | job_posts |
| employer_metrics | employers |
| admin_audit_logs | users |

---

# Index Summary

Indexes were added to improve query performance.

Frequently indexed fields include:

- id_number
- status
- employment_type
- location
- recommendation ranking
- created_at
- read_at
- saved_at

---

# Soft Delete Behavior

The following tables support soft deletes:

- users
- pwd_profiles
- employers
- job_posts
- applications

Records are not immediately removed from the database and may be restored if needed.

---

# Data Privacy

Personally Identifiable Information (PII) is stored only in authorized tables.

Sensitive tables include:

- users
- pwd_registry_reference
- pwd_profiles
- employers

Recommendations:

- Restrict administrator access.
- Backup regularly.
- Never expose PWD registry information publicly.
- Store passwords using Laravel Hash.