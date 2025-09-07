<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = Program::all();
        $users = User::all();
        
        if ($programs->isEmpty()) {
            $this->command->warn('No programs found. Please run ProgramSeeder first.');
            return;
        }
        
        if ($users->isEmpty()) {
            $this->command->warn('No users found. Please run AdminSeeder first.');
            return;
        }

        $projects = [
            [
                'name' => 'User Management System',
                'description' => 'Complete user management system with authentication, authorization, and profile management.',
                'status' => 'active',
                'start_date' => '2024-01-15',
                'end_date' => '2024-06-30',
            ],
            [
                'name' => 'Kanban Board Application',
                'description' => 'Agile project management tool with drag-and-drop Kanban board functionality.',
                'status' => 'active',
                'start_date' => '2024-02-01',
                'end_date' => '2024-08-31',
            ],
            [
                'name' => 'API Documentation Portal',
                'description' => 'Interactive API documentation portal with testing capabilities.',
                'status' => 'inactive',
                'start_date' => '2024-03-01',
                'end_date' => '2024-09-30',
            ],
            [
                'name' => 'Mobile App Development',
                'description' => 'Native mobile application for iOS and Android platforms.',
                'status' => 'active',
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
            ],
            [
                'name' => 'Database Optimization',
                'description' => 'Performance optimization and database restructuring project.',
                'status' => 'completed',
                'start_date' => '2023-10-01',
                'end_date' => '2024-01-31',
            ],
            [
                'name' => 'Security Audit & Implementation',
                'description' => 'Comprehensive security audit and implementation of security best practices.',
                'status' => 'active',
                'start_date' => '2024-02-15',
                'end_date' => '2024-07-15',
            ],
        ];

        foreach ($projects as $project) {
            Project::create([
                ...$project,
                'program_id' => $programs->random()->id,
                'created_by' => $users->random()->id,
            ]);
        }

        $this->command->info('Created ' . count($projects) . ' sample projects.');
    }
}
