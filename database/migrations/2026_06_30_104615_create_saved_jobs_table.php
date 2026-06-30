<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saved_jobs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pwd_profile_id')
                ->constrained('pwd_profiles')
                ->cascadeOnDelete();

            $table->foreignId('job_post_id')
                ->constrained('job_posts')
                ->cascadeOnDelete();

            $table->timestamp('saved_at')->useCurrent();

            $table->timestamps();

            $table->unique(['pwd_profile_id', 'job_post_id']);
            $table->index('saved_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saved_jobs');
    }
};