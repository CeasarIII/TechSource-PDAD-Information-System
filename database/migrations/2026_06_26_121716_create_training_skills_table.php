<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('training_skills', function (Blueprint $table) {
            $table->id();

            $table->foreignId('training_id')
                ->constrained('trainings')
                ->cascadeOnDelete();

            $table->string('skill_name', 100);

            $table->timestamps();

            $table->unique(['training_id', 'skill_name']);
            $table->index('skill_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_skills');
    }
};