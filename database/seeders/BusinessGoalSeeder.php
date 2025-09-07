<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BusinessGoal;
use App\Models\Program;

class BusinessGoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing programs
        $programs = Program::all();
        
        if ($programs->isEmpty()) {
            $this->command->warn('No programs found. Please run ProgramSeeder first.');
            return;
        }

        $businessGoals = [
            [
                'title' => 'Increase Customer Satisfaction',
                'description' => 'Improve customer satisfaction scores by implementing better support processes and user experience enhancements.',
                'value_score' => 85,
                'quarter' => 'Q1',
                'year' => 2025,
                'status' => 'in_progress',
                'target_date' => '2025-03-31',
                'budget' => 50000.00,
                'prognose' => 48000.00,
            ],
            [
                'title' => 'Digital Transformation Initiative',
                'description' => 'Complete the digital transformation of core business processes to improve efficiency and reduce costs.',
                'value_score' => 92,
                'quarter' => 'Q2',
                'year' => 2025,
                'status' => 'draft',
                'target_date' => '2025-06-30',
                'budget' => 150000.00,
                'prognose' => 145000.00,
            ],
            [
                'title' => 'Market Expansion Strategy',
                'description' => 'Expand into new geographical markets to increase revenue and market share.',
                'value_score' => 78,
                'quarter' => 'Q3',
                'year' => 2025,
                'status' => 'draft',
                'target_date' => '2025-09-30',
                'budget' => 200000.00,
                'prognose' => 210000.00,
            ],
            [
                'title' => 'Product Innovation Program',
                'description' => 'Develop and launch innovative products to stay competitive in the market.',
                'value_score' => 88,
                'quarter' => 'Q4',
                'year' => 2025,
                'status' => 'completed',
                'target_date' => '2024-12-31',
                'budget' => 100000.00,
                'prognose' => 95000.00,
            ],
            [
                'title' => 'Operational Excellence',
                'description' => 'Implement lean methodologies and automation to improve operational efficiency.',
                'value_score' => 75,
                'quarter' => 'Q1',
                'year' => 2025,
                'status' => 'in_progress',
                'target_date' => '2025-03-31',
                'budget' => 75000.00,
                'prognose' => 78000.00,
            ],
            [
                'title' => 'Sustainability Initiative',
                'description' => 'Reduce carbon footprint and implement sustainable business practices.',
                'value_score' => 82,
                'quarter' => 'Q2',
                'year' => 2025,
                'status' => 'draft',
                'target_date' => '2025-06-30',
                'budget' => 120000.00,
                'prognose' => 115000.00,
            ],
            [
                'title' => 'Employee Engagement Program',
                'description' => 'Improve employee satisfaction and retention through better workplace practices.',
                'value_score' => 70,
                'quarter' => 'Q3',
                'year' => 2025,
                'status' => 'cancelled',
                'target_date' => '2025-09-30',
                'budget' => 60000.00,
                'prognose' => 65000.00,
            ],
            [
                'title' => 'Data Analytics Implementation',
                'description' => 'Implement advanced data analytics to improve decision-making and business insights.',
                'value_score' => 90,
                'quarter' => 'Q4',
                'year' => 2025,
                'status' => 'in_progress',
                'target_date' => '2025-12-31',
                'budget' => 180000.00,
                'prognose' => 175000.00,
            ],
        ];

        foreach ($businessGoals as $goalData) {
            // Assign to a random program
            $program = $programs->random();
            
            BusinessGoal::create([
                'title' => $goalData['title'],
                'description' => $goalData['description'],
                'value_score' => $goalData['value_score'],
                'quarter' => $goalData['quarter'],
                'year' => $goalData['year'],
                'status' => $goalData['status'],
                'program_id' => $program->id,
                'target_date' => $goalData['target_date'],
                'budget' => $goalData['budget'],
                'prognose' => $goalData['prognose'],
            ]);
        }

        $this->command->info('Business Goals seeded successfully!');
    }
}
