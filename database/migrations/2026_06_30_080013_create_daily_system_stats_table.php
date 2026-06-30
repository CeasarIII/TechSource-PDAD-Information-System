<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_system_stats', function (Blueprint $table) {
            $table->id();

            $table->date('stat_date')->unique();

            $table->unsignedInteger('new_pwd_registrations')->default(0);
            $table->unsignedInteger('new_employer_registrations')->default(0);
            $table->unsignedInteger('new_job_posts')->default(0);
            $table->unsignedInteger('new_applications')->default(0);
            $table->unsignedInteger('predictions_generated')->default(0);
            $table->unsignedInteger('recommendations_generated')->default(0);

            $table->timestamps();

            $table->index('stat_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_system_stats');
    }
};