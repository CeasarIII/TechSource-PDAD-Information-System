<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['pwd', 'employer', 'admin'])->default('pwd')->after('password');
            $table->enum('account_status', ['pending', 'active', 'rejected'])->default('pending')->after('role');
            $table->boolean('terms_accepted')->default(false)->after('account_status');
            $table->timestamp('terms_accepted_at')->nullable()->after('terms_accepted');

            $table->index('role');
            $table->index('account_status');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropIndex(['account_status']);

            $table->dropColumn([
                'role',
                'account_status',
                'terms_accepted',
                'terms_accepted_at',
            ]);
        });
    }
};