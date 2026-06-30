<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_posts', function (Blueprint $table) {
            $table->index(['status', 'employment_type'], 'job_posts_status_employment_type_index');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->index(['status', 'applied_at'], 'applications_status_applied_at_index');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropIndex('applications_status_applied_at_index');
        });

        Schema::table('job_posts', function (Blueprint $table) {
            $table->dropIndex('job_posts_status_employment_type_index');
        });
    }
};