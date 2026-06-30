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