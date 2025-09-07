<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Seed the tenant database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            BusinessGoalSeeder::class,
            ProgramSeeder::class,
            ProjectSeeder::class,
            TaskSeeder::class,
            EpicSeeder::class,
            FeatureSeeder::class,
        ]);
    }
}
