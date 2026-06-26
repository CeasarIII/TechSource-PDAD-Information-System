<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employer_id')
                ->constrained('employers')
                ->cascadeOnDelete();

            $table->string('job_title', 200);
            $table->text('job_description');

            $table->string('required_education', 100)->nullable();
            $table->string('employment_type', 50);
            $table->string('location', 255);

            $table->decimal('salary_min', 10, 2)->nullable();
            $table->decimal('salary_max', 10, 2)->nullable();

            $table->text('disability_friendly_notes')->nullable();

            $table->date('application_deadline')->nullable();

            $table->enum('status', [
                'open',
                'closed'
            ])->default('open');

            $table->timestamps();

            $table->index('employment_type');
            $table->index('status');
            $table->index('location');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};