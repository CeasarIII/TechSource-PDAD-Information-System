<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_skills', function (Blueprint $table) {
            $table->id();

            $table->foreignId('job_post_id')
                ->constrained('job_posts')
                ->cascadeOnDelete();

            $table->string('skill_name', 150);
            $table->string('required_level', 50)->nullable();

            $table->timestamps();

            $table->index('skill_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_skills');
    }
};