<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employer_metrics', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employer_id')
                ->constrained('employers')
                ->cascadeOnDelete();

            $table->unsignedInteger('total_jobs_posted')->default(0);
            $table->unsignedInteger('total_applications_received')->default(0);
            $table->unsignedInteger('total_pwds_hired')->default(0);

            $table->decimal('avg_response_time_hours', 8, 2)->nullable();

            $table->timestamp('last_updated_at')->nullable();

            $table->timestamps();

            $table->unique('employer_id');
            $table->index('total_pwds_hired');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employer_metrics');
    }
};