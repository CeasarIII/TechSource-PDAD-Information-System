<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE VIEW vw_daily_registrations AS
            SELECT
                DATE(created_at) AS registration_date,
                role,
                COUNT(*) AS total_count
            FROM users
            WHERE deleted_at IS NULL
            GROUP BY DATE(created_at), role
        ");

        DB::statement("
            CREATE VIEW vw_employer_activity AS
            SELECT
                e.id AS employer_id,
                e.company_name,
                e.verification_status,
                COUNT(DISTINCT j.id) AS total_jobs_posted,
                COUNT(DISTINCT CASE WHEN j.status = 'open' THEN j.id END) AS open_jobs,
                COUNT(DISTINCT a.id) AS total_applications_received,
                COUNT(DISTINCT CASE WHEN a.status = 'accepted' THEN a.pwd_profile_id END) AS pwds_hired,
                MAX(j.created_at) AS last_job_posted_at
            FROM employers e
            LEFT JOIN job_posts j ON j.employer_id = e.id AND j.deleted_at IS NULL
            LEFT JOIN applications a ON a.job_post_id = j.id
            WHERE e.deleted_at IS NULL
            GROUP BY e.id, e.company_name, e.verification_status
        ");

        DB::statement("
            CREATE VIEW vw_system_overview AS
            SELECT
                (SELECT COUNT(*) FROM users WHERE role = 'pwd' AND deleted_at IS NULL) AS total_pwd_users,
                (SELECT COUNT(*) FROM users WHERE role = 'employer' AND deleted_at IS NULL) AS total_employer_users,
                (SELECT COUNT(*) FROM employers WHERE verification_status = 'pending' AND deleted_at IS NULL) AS pending_verifications,
                (SELECT COUNT(*) FROM job_posts WHERE status = 'open' AND deleted_at IS NULL) AS open_jobs,
                (SELECT COUNT(*) FROM applications WHERE deleted_at IS NULL) AS total_applications,
                (SELECT COUNT(*) FROM employment_predictions) AS predictions_generated,
                (SELECT COUNT(*) FROM job_recommendations) AS recommendations_generated,
                (SELECT COUNT(*) FROM saved_jobs) AS saved_jobs_count,
                (SELECT COUNT(*) FROM notifications WHERE read_at IS NULL) AS unread_notifications
        ");

        DB::statement("
            CREATE VIEW vw_job_post_summary AS
            SELECT
                j.id AS job_post_id,
                j.job_title,
                j.employment_type,
                j.status,
                j.location,
                e.company_name,
                COUNT(DISTINCT js.id) AS required_skills_count,
                COUNT(DISTINCT jdc.id) AS compatible_disability_count,
                COUNT(DISTINCT a.id) AS total_applications
            FROM job_posts j
            LEFT JOIN employers e ON e.id = j.employer_id
            LEFT JOIN job_skills js ON js.job_post_id = j.id
            LEFT JOIN job_disability_compatibility jdc ON jdc.job_post_id = j.id
            LEFT JOIN applications a ON a.job_post_id = j.id
            WHERE j.deleted_at IS NULL
            GROUP BY
                j.id,
                j.job_title,
                j.employment_type,
                j.status,
                j.location,
                e.company_name
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_job_post_summary');
        DB::statement('DROP VIEW IF EXISTS vw_system_overview');
        DB::statement('DROP VIEW IF EXISTS vw_employer_activity');
        DB::statement('DROP VIEW IF EXISTS vw_daily_registrations');
    }
};