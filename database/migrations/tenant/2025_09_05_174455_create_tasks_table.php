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
            
            // Basic task fields
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->date('due_date')->nullable();
            
            // Project and assignment
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null');
            $table->unsignedBigInteger('assigned_to')->nullable();
            
            // Agile fields
            $table->foreignId('sprint_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('feature_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('epic_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('business_goal_id')->nullable()->constrained()->onDelete('set null');
            
            // Story points and acceptance criteria
            $table->integer('story_points')->nullable();
            $table->text('acceptance_criteria')->nullable();
            $table->text('definition_of_done')->nullable();
            
            // Kanban specific fields
            $table->enum('kanban_status', ['todo', 'in_progress', 'review', 'done'])->default('todo');
            $table->integer('kanban_order')->default(0);
            $table->json('tags')->nullable();
            $table->text('notes')->nullable();
            
            // Timestamps
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['kanban_status', 'kanban_order']);
            $table->index(['assigned_to', 'kanban_status']);
            $table->index(['project_id', 'kanban_status']);
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