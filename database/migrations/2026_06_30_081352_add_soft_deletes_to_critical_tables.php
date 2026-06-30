<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('pwd_profiles', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('employers', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('job_posts', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('job_posts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('employers', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('pwd_profiles', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};