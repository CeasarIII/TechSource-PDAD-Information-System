# Chapter 3 – Database Design

## 3.X Database Design Overview

The TechSource PDAD Information System uses MySQL as its primary relational database management system. The database is designed to support user management, PWD profiling, employer management, job posting, employment prediction, recommendation generation, application tracking, reporting, and administrative monitoring.

The database follows relational database principles with normalized tables, primary keys, foreign keys, indexing strategies, SQL views, and soft delete support to maintain data integrity while improving system performance.

---

# 3.X.1 Entity Relationship Model

The database consists of several major entity groups:

### User Management

- users
- pwd_profiles
- employers
- admin_audit_logs

These tables manage authentication, authorization, user profiles, employer records, and administrator activities.

### Reference Data

- pwd_registry_reference

This serves as the official source of truth for validating registered PWD records before allowing account creation.

### Job Marketplace

- job_posts
- job_skills
- job_disability_compatibility
- applications
- saved_jobs

These tables manage employment opportunities, required skills, disability compatibility, applications, and bookmarked jobs.

### Machine Learning Outputs

- employment_predictions
- job_recommendations
- skill_gap_results

These tables store generated prediction results, recommendation rankings, and skill gap analyses.

### Training Module

- trainings
- training_skills

These tables manage available training programs and the skills provided by each training.

### Reporting and Administration

- daily_system_stats
- employer_metrics
- admin_audit_logs
- SQL Reporting Views

These objects support dashboard analytics and administrative monitoring.

---

# 3.X.2 Database Design Decisions

The database follows Laravel's standard foreign key naming convention using the **table_singular_id** format. This improves compatibility with Eloquent ORM and minimizes relationship configuration.

The official PDAD registry is separated from applicant profiles. The `pwd_registry_reference` table stores immutable registry records supplied by PDAD, while the `pwd_profiles` table stores user-editable profile information. This separation protects reference data while allowing applicants to update their own profiles.

Soft delete functionality is implemented on critical tables such as users, pwd_profiles, employers, job_posts, and applications. This allows record recovery while supporting retention requirements and minimizing accidental data loss.

SQL reporting views are used to simplify complex administrative reports. Instead of repeating aggregation queries inside controllers, reusable SQL views provide summarized information for dashboards and analytics.

---

# 3.X.3 Data Integrity

The database enforces referential integrity through foreign key constraints.

Key integrity mechanisms include:

- Primary Keys
- Foreign Keys
- Unique Constraints
- Indexed Search Columns
- Cascade Deletes
- Soft Deletes

These constraints ensure that orphan records are prevented and related data remains synchronized across all modules.

---

# 3.X.4 Performance Optimization

Performance optimization techniques include:

- Indexes on frequently searched columns
- Indexed foreign keys
- Composite indexes for common filters
- SQL reporting views
- Laravel Eloquent eager loading
- Prepared statements through Laravel Query Builder

These optimizations improve response time while reducing unnecessary database operations.

---

# 3.X.5 Data Privacy

The database design follows the principles of the Data Privacy Act of 2012.

Sensitive information is stored only when necessary.

Security measures include:

- Password hashing
- Authentication middleware
- CSRF protection
- SQL parameter binding
- Audit logging
- Soft deletes
- Role-based access control

---

# 3.X.6 Summary

The database architecture supports the functional requirements of the TechSource PDAD Information System while maintaining scalability, maintainability, security, and data integrity. The combination of normalized tables, optimized indexing, reporting views, and privacy-aware design provides a reliable foundation for the employment matching platform.