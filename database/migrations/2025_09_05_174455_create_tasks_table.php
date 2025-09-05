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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->date('due_date')->nullable();
            $table->integer('priority')->default(1); // 1=low, 2=medium, 3=high, 4=critical
            
            // Agile fields for User Stories
            $table->foreignId('sprint_id')->nullable()->constrained('sprints')->onDelete('set null');
            $table->integer('story_points')->nullable();
            $table->text('acceptance_criteria')->nullable();
            $table->enum('agile_status', ['to_do', 'in_progress', 'ready_for_test', 'approved', 'done'])->default('to_do');
            $table->foreignId('feature_id')->nullable()->constrained('features')->onDelete('set null');
            $table->foreignId('epic_id')->nullable()->constrained('epics')->onDelete('set null');
            $table->foreignId('business_goal_id')->nullable()->constrained('business_goals')->onDelete('set null');
            $table->integer('priority_order')->nullable();
            $table->text('definition_of_done')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
