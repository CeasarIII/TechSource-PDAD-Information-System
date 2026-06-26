<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();

            $table->string('training_name', 200);
            $table->text('description');

            $table->string('provider', 150)->nullable();
            $table->string('location', 255)->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->unsignedInteger('duration_hours')->nullable();

            $table->enum('mode', [
                'in_person',
                'online',
                'hybrid',
            ])->default('in_person');

            $table->boolean('is_free')->default(true);
            $table->decimal('cost', 10, 2)->nullable();

            $table->json('target_disability_types')->nullable();

            $table->enum('status', [
                'active',
                'completed',
                'cancelled',
            ])->default('active');

            $table->timestamps();

            $table->index('status');
            $table->index('start_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};