<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pwd_profile_id')
                ->constrained('pwd_profiles')
                ->cascadeOnDelete();

            $table->foreignId('job_post_id')
                ->constrained('job_posts')
                ->cascadeOnDelete();

            $table->enum('status', [
                'applied',
                'under_review',
                'shortlisted',
                'interview',
                'accepted',
                'rejected',
                'withdrawn',
            ])->default('applied');

            $table->text('applicant_message')->nullable();
            $table->text('employer_notes')->nullable();

            $table->timestamp('applied_at')->useCurrent();
            $table->timestamp('status_updated_at')->nullable();

            $table->timestamps();

            $table->unique(['pwd_profile_id', 'job_post_id']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};