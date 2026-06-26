<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->enum('role', ['pwd', 'employer', 'admin'])
                    ->default('pwd')
                    ->after('password');
            });
        }

        if (!Schema::hasColumn('users', 'account_status')) {
            Schema::table('users', function (Blueprint $table) {
                $table->enum('account_status', ['pending', 'active', 'rejected'])
                    ->default('pending')
                    ->after('role');
            });
        }

        if (!Schema::hasColumn('users', 'terms_accepted')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('terms_accepted')
                    ->default(false)
                    ->after('account_status');
            });
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'terms_accepted')) {
                $table->dropColumn('terms_accepted');
            }

            if (Schema::hasColumn('users', 'account_status')) {
                $table->dropColumn('account_status');
            }

            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
};