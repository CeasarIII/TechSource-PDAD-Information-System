<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employment_predictions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pwd_profile_id')
                ->unique()
                ->constrained('pwd_profiles')
                ->cascadeOnDelete();

            $table->string('predicted_type', 50);

            $table->decimal('confidence', 5, 4);

            $table->json('all_probabilities');

            $table->timestamp('generated_at');

            $table->timestamps();

            $table->index('generated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employment_predictions');
    }
};