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
        Schema::create('test_cases', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('expected_result');
            $table->text('actual_result')->nullable();
            $table->enum('status', ['pass', 'fail', 'pending', 'blocked'])->default('pending');
            $table->foreignId('business_goal_id')->nullable()->constrained('business_goals')->onDelete('set null');
            $table->foreignId('feature_id')->nullable()->constrained('features')->onDelete('set null');
            $table->foreignId('user_story_id')->nullable()->constrained('tasks')->onDelete('set null');
            $table->unsignedBigInteger('tester_id')->nullable();
            $table->timestamp('test_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_cases');
    }
};
