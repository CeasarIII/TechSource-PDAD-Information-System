<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class StressTestSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $educationLevels = [
            'High School Graduate',
            'College Level',
            'College Graduate',
            'Vocational',
            'TESDA Certificate',
        ];

        $employmentTypes = [
            'Permanent',
            'Contractual',
            'Casual',
            'Job Order',
            'Probationary',
        ];

        $skills = [
            'Computer data encoding',
            'Records management',
            'Excel',
            'Customer service',
            'Written communication',
            'Inventory management',
            'Filing',
            'Microsoft Office',
            'Problem solving',
            'Documentation',
        ];

        echo "Creating 1000 stress PWD users + profiles...\n";

        DB::beginTransaction();

        try {
            for ($i = 1; $i <= 1000; $i++) {
                $userId = DB::table('users')->insertGetId([
                    'name' => $faker->name,
                    'email' => 'stress_pwd_' . $i . '@test.com',
                    'password' => Hash::make('password'),
                    'role' => 'pwd',
                    'account_status' => 'active',
                    'terms_accepted' => true,
                    'terms_accepted_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $profileId = DB::table('pwd_profiles')->insertGetId([
                    'user_id' => $userId,
                    'registry_reference_id' => null,
                    'contact_number' => '09' . $faker->numerify('#########'),
                    'education' => $faker->randomElement($educationLevels),
                    'experience' => $faker->paragraph(),
                    'resume_path' => null,
                    'portfolio_path' => null,
                    'profile_completed' => $faker->boolean(80),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                for ($s = 0; $s < 3; $s++) {
                    DB::table('applicant_skills')->insert([
                        'pwd_profile_id' => $profileId,
                        'skill_name' => $faker->randomElement($skills),
                        'proficiency_level' => $faker->randomElement(['basic', 'intermediate', 'advanced']),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                if ($i % 100 === 0) {
                    echo " - {$i} profiles done\n";
                }
            }

            echo "Creating 500 stress job posts...\n";

            $employerIds = DB::table('employers')->pluck('id')->toArray();

            if (empty($employerIds)) {
                throw new \Exception('No employers found. Run SampleEmployerAndJobsSeeder first.');
            }

            for ($i = 1; $i <= 500; $i++) {
                $jobPostId = DB::table('job_posts')->insertGetId([
                    'employer_id' => $faker->randomElement($employerIds),
                    'job_title' => 'Stress Test ' . $faker->jobTitle,
                    'job_description' => $faker->paragraph(3),
                    'required_education' => $faker->randomElement($educationLevels),
                    'employment_type' => $faker->randomElement($employmentTypes),
                    'location' => 'Mandaluyong City',
                    'salary_min' => $faker->numberBetween(12000, 18000),
                    'salary_max' => $faker->numberBetween(19000, 30000),
                    'disability_friendly_notes' => $faker->sentence(),
                    'application_deadline' => now()->addDays($faker->numberBetween(15, 90))->toDateString(),
                    'status' => 'open',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                for ($s = 0; $s < 3; $s++) {
                    DB::table('job_skills')->insert([
                        'job_post_id' => $jobPostId,
                        'skill_name' => $faker->randomElement($skills),
                        'required_level' => $faker->randomElement(['basic', 'intermediate', 'advanced']),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            DB::commit();

            echo "\nStress data seeded successfully.\n";
            echo "Users: " . DB::table('users')->count() . "\n";
            echo "PWD profiles: " . DB::table('pwd_profiles')->count() . "\n";
            echo "Job posts: " . DB::table('job_posts')->count() . "\n";
        } catch (\Exception $e) {
            DB::rollBack();
            echo "Failed: " . $e->getMessage() . "\n";
        }
    }
}