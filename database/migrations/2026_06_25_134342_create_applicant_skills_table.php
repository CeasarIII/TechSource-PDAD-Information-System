<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applicant_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pwd_profile_id')->constrained('pwd_profiles')->cascadeOnDelete();

            $table->string('skill_name', 150);
            $table->string('proficiency_level', 50)->nullable();

            $table->timestamps();

            $table->index('skill_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applicant_skills');
    }
};