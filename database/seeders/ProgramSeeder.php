<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [
                'title' => 'Digital Transformation Initiative',
                'description' => 'Comprehensive digital transformation program to modernize our technology infrastructure and improve customer experience.',
                'strategic_goals' => 'Improve operational efficiency by 30%, enhance customer satisfaction, and reduce costs through automation.',
                'business_value' => 2500000.00,
                'owner' => 'John Smith',
                'status' => 'active',
                'start_date' => '2024-01-01',
                'end_date' => '2025-12-31',
            ],
            [
                'title' => 'Customer Experience Enhancement',
                'description' => 'Program focused on improving customer touchpoints and satisfaction across all channels.',
                'strategic_goals' => 'Increase customer satisfaction scores by 25%, reduce support tickets by 40%, and improve retention rates.',
                'business_value' => 1800000.00,
                'owner' => 'Sarah Johnson',
                'status' => 'planning',
                'start_date' => '2024-06-01',
                'end_date' => '2025-06-30',
            ],
            [
                'title' => 'Data Analytics & Intelligence',
                'description' => 'Implement advanced analytics capabilities to drive data-driven decision making across the organization.',
                'strategic_goals' => 'Enable real-time analytics, improve forecasting accuracy, and support strategic decision making.',
                'business_value' => 1200000.00,
                'owner' => 'Mike Chen',
                'status' => 'completed',
                'start_date' => '2023-09-01',
                'end_date' => '2024-08-31',
            ],
            [
                'title' => 'Security & Compliance Program',
                'description' => 'Comprehensive security program to ensure compliance with industry standards and protect sensitive data.',
                'strategic_goals' => 'Achieve SOC 2 compliance, implement zero-trust architecture, and reduce security incidents by 90%.',
                'business_value' => 800000.00,
                'owner' => 'Lisa Rodriguez',
                'status' => 'active',
                'start_date' => '2024-03-01',
                'end_date' => '2025-02-28',
            ],
            [
                'title' => 'Mobile-First Strategy',
                'description' => 'Develop and implement mobile-first approach for all customer-facing applications and internal tools.',
                'strategic_goals' => 'Increase mobile engagement by 50%, improve app store ratings, and reduce mobile support issues.',
                'business_value' => 1500000.00,
                'owner' => 'David Wilson',
                'status' => 'planning',
                'start_date' => '2024-09-01',
                'end_date' => '2025-08-31',
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}