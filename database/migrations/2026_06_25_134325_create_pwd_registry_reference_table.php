<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pwd_registry_reference', function (Blueprint $table) {
            $table->id();

            $table->string('id_number', 50)->unique();
            $table->date('date_issued')->nullable();
            $table->date('date_expired')->nullable();

            $table->string('last_name', 100);
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('suffix', 20)->nullable();

            $table->date('date_of_birth')->nullable();
            $table->integer('age')->nullable();
            $table->string('blood_type', 20)->nullable();
            $table->string('place_of_birth', 100)->nullable();
            $table->string('sex', 20)->nullable();
            $table->string('civil_status', 30)->nullable();
            $table->string('religion', 100)->nullable();
            $table->string('nationality', 50)->nullable();

            $table->string('mobile_no', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('barangay', 100)->nullable();
            $table->string('city', 100)->nullable();

            $table->string('disability_type', 100)->nullable();
            $table->string('disability_visibility', 50)->nullable();
            $table->string('cause_of_disability', 100)->nullable();

            $table->string('educational_attainment', 100)->nullable();
            $table->string('employment_status', 50)->nullable();
            $table->string('type_of_employment', 50)->nullable();
            $table->string('occupation_group', 150)->nullable();
            $table->text('skills')->nullable();

            $table->string('organization_affiliation', 150)->nullable();
            $table->string('current_assistive_device', 100)->nullable();
            $table->string('mobility_status', 50)->nullable();

            $table->integer('total_family_members')->nullable();
            $table->string('primary_caregiver', 100)->nullable();

            $table->string('emergency_contact_name', 150)->nullable();
            $table->string('emergency_contact_no', 20)->nullable();
            $table->string('contact_status', 30)->nullable();

            $table->string('pwd_id_status', 30)->nullable();
            $table->date('date_registered')->nullable();
            $table->date('last_updated')->nullable();
            $table->string('verification_status', 50)->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();

            $table->index('id_number');
            $table->index('last_name');
            $table->index('first_name');
            $table->index('barangay');
            $table->index('disability_type');
            $table->index('employment_status');
            $table->index('verification_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pwd_registry_reference');
    }
};