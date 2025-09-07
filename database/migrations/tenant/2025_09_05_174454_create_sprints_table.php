<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sprints', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('sprint_number');
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('planned_story_points')->default(0);
            $table->integer('completed_story_points')->default(0);
            $table->decimal('completion_percentage', 5, 2)->default(0);
            $table->enum('status', ['planning', 'active', 'completed', 'cancelled'])->default('planning');
            $table->text('goals')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sprints');
    }
};
