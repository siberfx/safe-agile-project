<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Epic;
use App\Models\BusinessGoal;

class EpicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing business goals
        $businessGoals = BusinessGoal::all();
        
        if ($businessGoals->isEmpty()) {
            $this->command->warn('No business goals found. Please run BusinessGoalSeeder first.');
            return;
        }

        $epics = [
            [
                'title' => 'Customer Portal Enhancement',
                'description' => 'Develop a comprehensive customer portal with self-service capabilities, order tracking, and support ticket management.',
                'priority' => 'high',
                'expected_value' => 75000.00,
                'status' => 'in_progress',
                'story_points' => 89,
                'target_date' => '2025-06-30',
            ],
            [
                'title' => 'Mobile App Development',
                'description' => 'Create a native mobile application for iOS and Android platforms with full feature parity.',
                'priority' => 'critical',
                'expected_value' => 120000.00,
                'status' => 'draft',
                'story_points' => 156,
                'target_date' => '2025-08-31',
            ],
            [
                'title' => 'Data Analytics Platform',
                'description' => 'Implement advanced analytics and reporting capabilities with real-time dashboards.',
                'priority' => 'high',
                'expected_value' => 95000.00,
                'status' => 'in_progress',
                'story_points' => 112,
                'target_date' => '2025-07-15',
            ],
            [
                'title' => 'API Integration Hub',
                'description' => 'Build a centralized API integration platform to connect with third-party services.',
                'priority' => 'medium',
                'expected_value' => 60000.00,
                'status' => 'completed',
                'story_points' => 78,
                'target_date' => '2024-12-31',
            ],
            [
                'title' => 'Security Enhancement',
                'description' => 'Implement comprehensive security measures including 2FA, encryption, and audit logging.',
                'priority' => 'critical',
                'expected_value' => 45000.00,
                'status' => 'in_progress',
                'story_points' => 65,
                'target_date' => '2025-05-31',
            ],
            [
                'title' => 'Performance Optimization',
                'description' => 'Optimize system performance through caching, database tuning, and code refactoring.',
                'priority' => 'medium',
                'expected_value' => 35000.00,
                'status' => 'draft',
                'story_points' => 45,
                'target_date' => '2025-09-30',
            ],
            [
                'title' => 'User Experience Redesign',
                'description' => 'Redesign the entire user interface for better usability and modern design standards.',
                'priority' => 'high',
                'expected_value' => 80000.00,
                'status' => 'cancelled',
                'story_points' => 95,
                'target_date' => '2025-04-30',
            ],
            [
                'title' => 'Automated Testing Suite',
                'description' => 'Develop comprehensive automated testing framework for unit, integration, and E2E tests.',
                'priority' => 'medium',
                'expected_value' => 55000.00,
                'status' => 'in_progress',
                'story_points' => 72,
                'target_date' => '2025-07-31',
            ],
        ];

        foreach ($epics as $epicData) {
            // Assign to a random business goal
            $businessGoal = $businessGoals->random();
            
            Epic::create([
                'title' => $epicData['title'],
                'description' => $epicData['description'],
                'business_goal_id' => $businessGoal->id,
                'priority' => $epicData['priority'],
                'expected_value' => $epicData['expected_value'],
                'status' => $epicData['status'],
                'story_points' => $epicData['story_points'],
                'target_date' => $epicData['target_date'],
            ]);
        }

        $this->command->info('Epics seeded successfully!');
    }
}
