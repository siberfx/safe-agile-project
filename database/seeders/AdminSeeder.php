<?php

namespace Database\Seeders;

use App\Helpers\Variable;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::query()->count() > 0) {
            return; // Skip seeding if users already exist
        }

        foreach (Variable::DEFAULT_SA_EMAILS as $data) {
            $user = User::query()->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            // Assign super_admin role
            $user->assignRole(Variable::SUPER_ADMIN_ROLE);
        }
    }
}
