<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pwd_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->foreignId('registry_reference_id')->nullable()->constrained('pwd_registry_reference')->nullOnDelete();

            $table->string('contact_number', 20)->nullable();
            $table->string('education', 150)->nullable();
            $table->text('experience')->nullable();
            $table->string('resume_path')->nullable();
            $table->string('portfolio_path')->nullable();
            $table->boolean('profile_completed')->default(false);

            $table->timestamps();

            $table->index('registry_reference_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pwd_profiles');
    }
};