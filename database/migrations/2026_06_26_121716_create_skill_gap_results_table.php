<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skill_gap_results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pwd_profile_id')
                ->constrained('pwd_profiles')
                ->cascadeOnDelete();

            $table->foreignId('job_post_id')
                ->constrained('job_posts')
                ->cascadeOnDelete();

            $table->json('matched_skills')->nullable();
            $table->json('missing_skills')->nullable();

            $table->decimal('match_percentage', 5, 2)->default(0);

            $table->timestamp('analyzed_at');

            $table->timestamps();

            $table->index(['pwd_profile_id', 'analyzed_at']);
            $table->index('job_post_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skill_gap_results');
    }
};