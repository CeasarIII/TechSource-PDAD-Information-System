<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DemoScenarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $employer1 = $this->createEmployer(
                'TechAccess Solutions',
                'admin@techaccess.example.com',
                'verified'
            );

            $this->createJob($employer1, [
                'title' => 'Data Encoder',
                'description' => 'Encode customer data into secure systems and maintain accurate records.',
                'employment_type' => 'Permanent',
                'education' => 'High School Graduate',
                'notes' => 'Screen reader compatible workstation and quiet work area available.',
                'skills' => ['Computer data encoding', 'Records management', 'Microsoft Excel'],
                'compatible' => ['Visual Disability', 'Orthopedic Disability'],
            ]);

            $this->createJob($employer1, [
                'title' => 'Software Developer Trainee',
                'description' => 'Assist senior developers with coding tasks, documentation, and testing.',
                'employment_type' => 'Contractual',
                'education' => 'College Graduate',
                'notes' => 'Remote work and written communication available.',
                'skills' => ['Programming', 'Written communication', 'Problem solving'],
                'compatible' => ['Deaf or Hard of Hearing', 'Speech and Language Impairment', 'Mobility Disability'],
            ]);

            $this->createJob($employer1, [
                'title' => 'Field Technician',
                'description' => 'Repair equipment on client premises. Driving across Metro Manila is required.',
                'employment_type' => 'Permanent',
                'education' => 'College Graduate',
                'notes' => null,
                'skills' => ['Equipment repair', 'Driving', 'Customer service'],
                'compatible' => [],
            ]);

            $employer2 = $this->createEmployer(
                'Mandaluyong Community Records',
                'hr@mcr.example.com',
                'verified'
            );

            $this->createJob($employer2, [
                'title' => 'Records Assistant',
                'description' => 'Maintain and organize community records, files, and digital documents.',
                'employment_type' => 'Permanent',
                'education' => 'High School Graduate',
                'notes' => 'Wheelchair accessible office and adjustable furniture.',
                'skills' => ['Records management', 'Filing', 'Microsoft Office'],
                'compatible' => ['Visual Disability', 'Mobility Disability', 'Orthopedic Disability'],
            ]);

            $this->createJob($employer2, [
                'title' => 'Community Outreach Coordinator',
                'description' => 'Coordinate outreach programs, public speaking activities, and visual presentations.',
                'employment_type' => 'Contractual',
                'education' => 'College Graduate',
                'notes' => null,
                'skills' => ['Public speaking', 'Event planning', 'Visual presentation'],
                'compatible' => [],
            ]);

            $this->createEmployer(
                'PendingCo Retail Services',
                'signup@pendingco.example.com',
                'pending'
            );
        });

        $this->command->info('Demo scenario seeded successfully.');
    }

    private function createEmployer(string $companyName, string $email, string $status): int
    {
        $userId = DB::table('users')->insertGetId([
            'name' => $companyName . ' Admin',
            'email' => $email,
            'password' => Hash::make('password'),
            'role' => 'employer',
            'account_status' => 'active',
            'terms_accepted' => true,
            'terms_accepted_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return DB::table('employers')->insertGetId([
            'user_id' => $userId,
            'company_name' => $companyName,
            'contact_person' => 'Demo Contact',
            'company_email' => $email,
            'company_phone' => '09170000999',
            'company_address' => 'Mandaluyong City',
            'business_permit_path' => null,
            'verification_status' => $status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function createJob(int $employerId, array $data): void
    {
        $jobId = DB::table('job_posts')->insertGetId([
            'employer_id' => $employerId,
            'job_title' => $data['title'],
            'job_description' => $data['description'],
            'required_education' => $data['education'],
            'employment_type' => $data['employment_type'],
            'location' => 'Mandaluyong City',
            'salary_min' => 15000,
            'salary_max' => 25000,
            'disability_friendly_notes' => $data['notes'],
            'application_deadline' => now()->addDays(30)->toDateString(),
            'status' => 'open',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ($data['skills'] as $skill) {
            DB::table('job_skills')->insert([
                'job_post_id' => $jobId,
                'skill_name' => $skill,
                'required_level' => 'basic',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        foreach ($data['compatible'] as $disability) {
            DB::table('job_disability_compatibility')->insert([
                'job_post_id' => $jobId,
                'disability_type' => $disability,
                'compatibility_level' => 'compatible',
                'notes' => 'Demo compatibility record.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}