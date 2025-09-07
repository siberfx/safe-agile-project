<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $projects = Project::all();

        if ($users->isEmpty()) {
            $this->command->warn('No users found. Please run UserSeeder first.');

            return;
        }

        if ($projects->isEmpty()) {
            $this->command->warn('No projects found. Please run ProgramSeeder first.');

            return;
        }

        $tasks = [
            [
                'title' => 'Implement user authentication',
                'description' => 'Create login and registration system with proper validation',
                'kanban_status' => 'todo',
                'priority' => 'high',
                'story_points' => 8,
                'tags' => ['backend', 'security'],
            ],
            [
                'title' => 'Design dashboard layout',
                'description' => 'Create responsive dashboard with modern UI components',
                'kanban_status' => 'in_progress',
                'priority' => 'medium',
                'story_points' => 5,
                'tags' => ['frontend', 'ui'],
            ],
            [
                'title' => 'Setup database migrations',
                'description' => 'Create all necessary database tables and relationships',
                'kanban_status' => 'done',
                'priority' => 'high',
                'story_points' => 3,
                'tags' => ['backend', 'database'],
            ],
            [
                'title' => 'API documentation',
                'description' => 'Write comprehensive API documentation for developers',
                'kanban_status' => 'review',
                'priority' => 'medium',
                'story_points' => 2,
                'tags' => ['documentation', 'api'],
            ],
            [
                'title' => 'Unit tests for models',
                'description' => 'Write unit tests for all Eloquent models',
                'kanban_status' => 'todo',
                'priority' => 'low',
                'story_points' => 4,
                'tags' => ['testing', 'backend'],
            ],
            [
                'title' => 'Email notification system',
                'description' => 'Implement email notifications for task updates',
                'kanban_status' => 'todo',
                'priority' => 'medium',
                'story_points' => 6,
                'tags' => ['backend', 'notifications'],
            ],
            [
                'title' => 'Mobile responsive design',
                'description' => 'Ensure all pages work perfectly on mobile devices',
                'kanban_status' => 'in_progress',
                'priority' => 'high',
                'story_points' => 5,
                'tags' => ['frontend', 'mobile'],
            ],
            [
                'title' => 'Performance optimization',
                'description' => 'Optimize database queries and implement caching',
                'kanban_status' => 'todo',
                'priority' => 'medium',
                'story_points' => 7,
                'tags' => ['performance', 'backend'],
            ],
            [
                'title' => 'User role management',
                'description' => 'Implement role-based access control system',
                'kanban_status' => 'review',
                'priority' => 'high',
                'story_points' => 6,
                'tags' => ['backend', 'security'],
            ],
            [
                'title' => 'File upload functionality',
                'description' => 'Allow users to upload and manage files',
                'kanban_status' => 'done',
                'priority' => 'low',
                'story_points' => 3,
                'tags' => ['frontend', 'backend'],
            ],
        ];

        foreach ($tasks as $index => $taskData) {
            $task = Task::create([
                ...$taskData,
                'project_id' => $projects->random()->id,
                'assigned_to' => $users->random()->id,
                'kanban_order' => $index + 1,
                'due_date' => now()->addDays(rand(1, 30)),
                'started_at' => in_array($taskData['kanban_status'], ['in_progress', 'review', 'done']) ? now()->subDays(rand(1, 10)) : null,
                'completed_at' => $taskData['kanban_status'] === 'done' ? now()->subDays(rand(1, 5)) : null,
            ]);

            $task->notes()->create([
                'body' => 'This is a note for task '.$task->title,
                'user_id' => $users->random()->id,
            ]);
        }

        $this->command->info('Created '.count($tasks).' sample tasks.');
    }
}
