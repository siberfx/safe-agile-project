<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feature;
use App\Models\Epic;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing epics
        $epics = Epic::all();
        
        if ($epics->isEmpty()) {
            $this->command->warn('No epics found. Please run EpicSeeder first.');
            return;
        }

        $features = [
            [
                'title' => 'User Authentication System',
                'description' => 'Implement secure user authentication with login, registration, password reset, and session management.',
                'pi' => 'PI-1',
                'sprint' => 'Sprint 1',
                'status' => 'completed',
                'story_points' => 13,
                'target_date' => '2024-12-15',
            ],
            [
                'title' => 'Dashboard Analytics',
                'description' => 'Create comprehensive dashboard with real-time analytics, charts, and KPI monitoring.',
                'pi' => 'PI-1',
                'sprint' => 'Sprint 2',
                'status' => 'in_progress',
                'story_points' => 21,
                'target_date' => '2025-01-30',
            ],
            [
                'title' => 'File Upload & Management',
                'description' => 'Implement secure file upload system with drag-and-drop interface and file organization.',
                'pi' => 'PI-1',
                'sprint' => 'Sprint 3',
                'status' => 'draft',
                'story_points' => 8,
                'target_date' => '2025-02-15',
            ],
            [
                'title' => 'Real-time Notifications',
                'description' => 'Build real-time notification system using WebSockets for instant user updates.',
                'pi' => 'PI-2',
                'sprint' => 'Sprint 1',
                'status' => 'in_progress',
                'story_points' => 17,
                'target_date' => '2025-03-01',
            ],
            [
                'title' => 'Advanced Search & Filtering',
                'description' => 'Implement advanced search functionality with filters, sorting, and full-text search.',
                'pi' => 'PI-2',
                'sprint' => 'Sprint 2',
                'status' => 'draft',
                'story_points' => 12,
                'target_date' => '2025-03-15',
            ],
            [
                'title' => 'API Rate Limiting',
                'description' => 'Implement API rate limiting and throttling to prevent abuse and ensure fair usage.',
                'pi' => 'PI-2',
                'sprint' => 'Sprint 3',
                'status' => 'completed',
                'story_points' => 5,
                'target_date' => '2024-11-30',
            ],
            [
                'title' => 'Multi-language Support',
                'description' => 'Add internationalization support with multiple language options and RTL support.',
                'pi' => 'PI-3',
                'sprint' => 'Sprint 1',
                'status' => 'cancelled',
                'story_points' => 25,
                'target_date' => '2025-04-30',
            ],
            [
                'title' => 'Advanced Reporting',
                'description' => 'Create comprehensive reporting system with custom report builder and export options.',
                'pi' => 'PI-3',
                'sprint' => 'Sprint 2',
                'status' => 'draft',
                'story_points' => 19,
                'target_date' => '2025-05-15',
            ],
            [
                'title' => 'Mobile Responsive Design',
                'description' => 'Optimize the entire application for mobile devices with responsive design patterns.',
                'pi' => 'PI-3',
                'sprint' => 'Sprint 3',
                'status' => 'in_progress',
                'story_points' => 15,
                'target_date' => '2025-06-01',
            ],
            [
                'title' => 'Data Backup & Recovery',
                'description' => 'Implement automated backup system with point-in-time recovery capabilities.',
                'pi' => 'PI-4',
                'sprint' => 'Sprint 1',
                'status' => 'completed',
                'story_points' => 11,
                'target_date' => '2024-10-15',
            ],
        ];

        foreach ($features as $featureData) {
            // Assign to a random epic
            $epic = $epics->random();
            
            Feature::create([
                'title' => $featureData['title'],
                'description' => $featureData['description'],
                'epic_id' => $epic->id,
                'pi' => $featureData['pi'],
                'sprint' => $featureData['sprint'],
                'status' => $featureData['status'],
                'story_points' => $featureData['story_points'],
                'target_date' => $featureData['target_date'],
            ]);
        }

        $this->command->info('Features seeded successfully!');
    }
}
