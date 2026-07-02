# UAT Test Cases — Database Side

## DB-TC-001 — PWD Registration and Registry Validation

**Feature:** PWD Registration with Registry Validation  
**Precondition:** PDAD registry contains valid PWD records.  

**Test Steps:**
1. Search for an existing PWD registry record.
2. Create a user account with role `pwd`.
3. Create a `pwd_profiles` record linked to the registry reference.
4. Verify the user, profile, and registry record are linked.

**Expected Result:**  
The system returns one linked user-profile-registry record.

**Actual Result:**  
To be filled during UAT.

**Status:**  
PASS / FAIL / BLOCKED

---

## DB-TC-002 — Employment Prediction Save

**Feature:** Employment Prediction Persistence  
**Precondition:** PWD profile exists.  

**Test Steps:**
1. Trigger employment prediction.
2. Check `employment_predictions`.
3. Verify `predicted_type`, `confidence`, and `all_probabilities`.

**Expected Result:**  
Prediction is saved under the correct `pwd_profile_id`.

**Actual Result:**  
To be filled during UAT.

**Status:**  
PASS / FAIL / BLOCKED

---

## DB-TC-003 — Job Recommendation Save

**Feature:** TF-IDF Recommendation Persistence  
**Precondition:** Open job posts exist.  

**Test Steps:**
1. Trigger recommendation generation.
2. Check `job_recommendations`.
3. Sort by `rank_position`.

**Expected Result:**  
Recommendations are saved with valid `job_post_id`, similarity score, and ranking.

**Actual Result:**  
To be filled during UAT.

**Status:**  
PASS / FAIL / BLOCKED

---

## DB-TC-004 — Application Submission

**Feature:** PWD Job Application  
**Precondition:** PWD profile and open job post exist.  

**Test Steps:**
1. Insert or submit application.
2. Verify record in `applications`.
3. Join with `job_posts` and `employers`.

**Expected Result:**  
Application is stored and linked to correct job and employer.

**Actual Result:**  
To be filled during UAT.

**Status:**  
PASS / FAIL / BLOCKED

---

## DB-TC-005 — Application Status Update

**Feature:** Employer Application Review  
**Precondition:** Application exists.  

**Test Steps:**
1. Update application status to `shortlisted`.
2. Verify `status_updated_at`.

**Expected Result:**  
Application status updates correctly.

**Actual Result:**  
To be filled during UAT.

**Status:**  
PASS / FAIL / BLOCKED

---

## DB-TC-006 — Duplicate Application Prevention

**Feature:** Unique Application Constraint  
**Precondition:** Existing application already exists for same PWD profile and job post.  

**Test Steps:**
1. Try to create another application with same `pwd_profile_id` and `job_post_id`.

**Expected Result:**  
Database prevents duplicate application.

**Actual Result:**  
To be filled during UAT.

**Status:**  
PASS / FAIL / BLOCKED

---

## DB-TC-007 — Employer Verification Workflow

**Feature:** Employer Verification  
**Precondition:** Employer account exists with `pending` status.  

**Test Steps:**
1. Update employer `verification_status` from `pending` to `verified`.
2. Verify employer status.

**Expected Result:**  
Employer status updates successfully.

**Actual Result:**  
To be filled during UAT.

**Status:**  
PASS / FAIL / BLOCKED

---

## DB-TC-008 — Admin Audit Log Entry

**Feature:** Admin Audit Logging  
**Precondition:** Admin user exists.  

**Test Steps:**
1. Perform or simulate admin action.
2. Insert audit log entry in `admin_audit_logs`.
3. Verify action, target type, and admin user.

**Expected Result:**  
Audit log records the admin action.

**Actual Result:**  
To be filled during UAT.

**Status:**  
PASS / FAIL / BLOCKED

---

## DB-TC-009 — Saved Job

**Feature:** Saved Jobs  
**Precondition:** PWD profile and job post exist.  

**Test Steps:**
1. Insert saved job.
2. Verify record in `saved_jobs`.
3. Try duplicate save.

**Expected Result:**  
Saved job is stored once only.

**Actual Result:**  
To be filled during UAT.

**Status:**  
PASS / FAIL / BLOCKED

---

## DB-TC-010 — Notification Creation

**Feature:** User Notifications  
**Precondition:** User exists.  

**Test Steps:**
1. Insert notification for user.
2. Verify notification appears as unread.
3. Update `read_at`.

**Expected Result:**  
Notification is created and can be marked as read.

**Actual Result:**  
To be filled during UAT.

**Status:**  
PASS / FAIL / BLOCKED