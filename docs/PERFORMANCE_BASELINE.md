# Performance Baseline — PDAD Information System

## Test Environment

- Database: MySQL via XAMPP
- Application: Laravel
- Data volume during test:
  - PDAD registry: 4,850 records
  - Employers: 5 sample employers
  - Job posts: 25 sample jobs
  - Stress test was previously run with 1,000 profiles and 500 additional jobs, then cleaned up.

---

## Query Benchmarks

### 1. PWD Registry Lookup

Purpose: Used by the PWD ID validation endpoint.

```sql
EXPLAIN
SELECT *
FROM pwd_registry_reference
WHERE id_number = '13-7401-000-0000344';
```

Result:

- Index used: `pwd_registry_reference_id_number_unique`
- Query type: `const`
- Rows checked: 1
- Status: Acceptable

---

### 2. Job Listing by Status and Employment Type

Purpose: Used by job listing and recommendation filtering.

```sql
EXPLAIN
SELECT *
FROM job_posts
WHERE status = 'open'
AND employment_type = 'Permanent';
```

Result:

- Index used: `job_posts_employment_type_index`
- Query type: `ref`
- Status: Acceptable

---

### 3. Application Status Filter

Purpose: Used by application tracking and employer review workflow.

```sql
EXPLAIN
SELECT *
FROM applications
WHERE status IN ('applied', 'under_review');
```

Result:

- Available indexes:
  - `applications_status_index`
  - `applications_status_applied_at_index`
- MySQL did not select an index during the test because the table contained very few rows.
- Status: Acceptable during development.

---

### 4. Admin System Overview View

Purpose: Used by admin dashboard summary cards.

```sql
SELECT *
FROM vw_system_overview;
```

Status:

- View successfully created.
- Suitable for admin dashboard summary display.

---

### 5. Employer Activity View

Purpose: Used by admin employer performance monitoring.

```sql
SELECT *
FROM vw_employer_activity;
```

Status:

- View successfully created.
- Uses employers, job posts, and applications tables.

---

## Slow Queries Identified

No major slow queries were identified during development testing.

The application currently runs on a small sample dataset. Additional profiling is recommended once production-scale data is available.

---

## Recommendations

- Keep indexes on frequently searched fields such as `id_number`, `status`, `employment_type`, and foreign keys.
- Use eager loading for Eloquent relationships to avoid N+1 query issues.
- Use reporting views for admin dashboard summaries.
- Avoid directly querying sensitive registry data unless required for validation.
- Continue using EXPLAIN when new dashboard or recommendation queries are added.

---

## Chapter 4 Reference

These results may be used in the System Performance section of Chapter 4.