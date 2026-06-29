<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SampleEmployerAndJobsSeeder extends Seeder
{
    public function run(): void
    {
        $employers = [
            ['company_name' => 'Mandaluyong Tech Solutions', 'email' => 'employer1@test.com'],
            ['company_name' => 'GreenLeaf Manufacturing Inc.', 'email' => 'employer2@test.com'],
            ['company_name' => 'Sunrise Call Center', 'email' => 'employer3@test.com'],
            ['company_name' => 'CityCare Foods', 'email' => 'employer4@test.com'],
            ['company_name' => 'Mandaluyong Public Library System', 'email' => 'employer5@test.com'],
        ];

        foreach ($employers as $index => $employerData) {
            $userId = DB::table('users')->insertGetId([
                'name' => $employerData['company_name'] . ' Admin',
                'email' => $employerData['email'],
                'password' => Hash::make('password'),
                'role' => 'employer',
                'account_status' => 'active',
                'terms_accepted' => true,
                'terms_accepted_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $employerId = DB::table('employers')->insertGetId([
                'user_id' => $userId,
                'company_name' => $employerData['company_name'],
                'contact_person' => 'HR Manager',
                'company_email' => $employerData['email'],
                'company_phone' => '0917000000' . ($index + 1),
                'company_address' => 'Mandaluyong City',
                'verification_status' => 'verified',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->createJobs($employerId);
        }

        $this->command->info('Sample employers and jobs seeded successfully.');
    }

    private function createJobs(int $employerId): void
    {
        $jobs = [
            [
                'title' => 'Data Encoder',
                'description' => 'Encode customer information into the system database and maintain accurate records.',
                'skills' => ['Computer data encoding', 'Records management', 'Excel'],
                'type' => 'Permanent',
                'compatible' => ['Visual Disability', 'Mobility Disability', 'Orthopedic Disability'],
                'notes' => 'Wheelchair accessible office and flexible work arrangement available.',
            ],
            [
                'title' => 'Customer Service Representative',
                'description' => 'Handle customer inquiries through chat and email support channels.',
                'skills' => ['Customer service', 'Written communication', 'Problem solving'],
                'type' => 'Contractual',
                'compatible' => ['Mobility Disability', 'Deaf or Hard of Hearing'],
                'notes' => 'Chat-based support work with minimal phone communication.',
            ],
            [
                'title' => 'Office Clerk',
                'description' => 'Assist in document filing, encoding, and basic administrative tasks.',
                'skills' => ['Filing', 'Records management', 'Microsoft Office'],
                'type' => 'Permanent',
                'compatible' => ['Orthopedic Disability', 'Visual Disability'],
                'notes' => 'Accessible office environment with clerical task adjustments.',
            ],
            [
                'title' => 'Inventory Assistant',
                'description' => 'Monitor inventory records and assist with stock documentation.',
                'skills' => ['Inventory management', 'Documentation', 'Basic computer skills'],
                'type' => 'Job Order',
                'compatible' => ['Mobility Disability', 'Orthopedic Disability'],
                'notes' => 'Physical lifting is limited and assistance is available.',
            ],
            [
                'title' => 'Library Assistant',
                'description' => 'Assist users in locating materials, organizing records, and maintaining catalog data.',
                'skills' => ['Organization', 'Records management', 'Customer assistance'],
                'type' => 'Casual',
                'compatible' => ['Visual Disability', 'Mobility Disability', 'Orthopedic Disability'],
                'notes' => 'Quiet work environment with accessible facilities.',
            ],
        ];

        foreach ($jobs as $jobData) {
            $jobPostId = DB::table('job_posts')->insertGetId([
                'employer_id' => $employerId,
                'job_title' => $jobData['title'],
                'job_description' => $jobData['description'],
                'required_education' => 'High School Graduate',
                'employment_type' => $jobData['type'],
                'location' => 'Mandaluyong City',
                'salary_min' => 15000,
                'salary_max' => 22000,
                'disability_friendly_notes' => $jobData['notes'],
                'status' => 'open',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($jobData['skills'] as $skill) {
                DB::table('job_skills')->insert([
                    'job_post_id' => $jobPostId,
                    'skill_name' => $skill,
                    'required_level' => 'basic',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach ($jobData['compatible'] as $disability) {
                DB::table('job_disability_compatibility')->insert([
                    'job_post_id' => $jobPostId,
                    'disability_type' => $disability,
                    'compatibility_level' => 'compatible',
                    'notes' => 'Declared as compatible for sample testing.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}