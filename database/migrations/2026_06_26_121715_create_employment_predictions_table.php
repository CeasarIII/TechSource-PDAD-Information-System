<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_recommendations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pwd_profile_id')
                ->constrained('pwd_profiles')
                ->cascadeOnDelete();

            $table->foreignId('job_post_id')
                ->constrained('job_posts')
                ->cascadeOnDelete();

            $table->decimal('similarity_score', 5, 4);
            $table->unsignedTinyInteger('rank_position');
            $table->string('recommendation_reason', 255)->nullable();
            $table->timestamp('generated_at');

            $table->timestamps();

            $table->index(['pwd_profile_id', 'rank_position']);
            $table->index('generated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_recommendations');
    }
};