# Data Privacy Act (RA 10173) Compliance

## Personal Information Controller

**Entity:** Persons with Disabilities Affairs Office (PDAD)  
**System:** PDAD Information System  
**Developer Team:** Capstone Group

---

# Personal Information Inventory

## users

Contains personal information.

Sensitive fields:

- name
- email
- password

Legal Basis:

- User Consent
- Terms Acceptance

Retention:

- Active account plus 30 days after deletion.

---

## pwd_registry_reference

Contains sensitive personal information.

Fields include:

- PWD ID Number
- First Name
- Last Name
- Date of Birth
- Sex
- Address
- Disability information

Source:

Official PDAD Registry.

Retention:

Based on agreement with PDAD.

---

## pwd_profiles

Contains applicant profile information.

Fields include:

- contact number
- education
- experience
- resume
- portfolio

Retention:

While account remains active.

---

## employers

Contains company information.

Fields include:

- company name
- contact person
- company email
- business permit

Retention:

Active employer account.

---

## applications

Contains application history.

Includes:

- application status
- employer notes
- applicant message

Retention:

One year after completion.

---

## employment_predictions

Contains AI-generated prediction results.

Retention:

Updated whenever prediction is regenerated.

---

## job_recommendations

Contains recommendation scores.

Retention:

Updated automatically.

---

## admin_audit_logs

Stores administrator activities.

Retention:

Minimum six months.

---

# Data Subject Rights

| Right | Implementation |
|--------|----------------|
| Right to be informed | Terms and Conditions |
| Right to access | Dashboard access |
| Right to rectification | Edit Profile |
| Right to erasure | Soft Delete |
| Right to object | Account deactivation |
| Right to portability | Future export feature |

---

# Technical Security

- Password hashing
- Laravel CSRF Protection
- Prepared Statements
- Blade XSS Protection
- Authentication Middleware
- Database Foreign Keys
- Audit Logging

---

# Administrative Measures

- Database access restricted
- Team confidentiality
- Documentation maintained

---

# Privacy by Design

- Collect only necessary information.
- Protect sensitive PWD records.
- Backup database regularly.
- Use soft deletes for recoverability.
- Limit administrator access.