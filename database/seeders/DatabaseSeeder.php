<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Only seed basic data for the main database (landlord system)
        // Tenant-specific data will be seeded when tenants are created
        $this->call([
            PermissionSeeder::class,
        ]);
    }
}
