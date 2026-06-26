<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_disability_compatibility', function (Blueprint $table) {
            $table->id();

            $table->foreignId('job_post_id')
                ->constrained('job_posts')
                ->cascadeOnDelete();

            $table->string('disability_type', 150);
            $table->string('compatibility_level', 50)->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('disability_type');
            $table->index('compatibility_level');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_disability_compatibility');
    }
};