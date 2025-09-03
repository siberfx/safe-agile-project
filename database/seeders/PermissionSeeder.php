<?php

namespace Database\Seeders;

use App\Helpers\Variable;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default permissions
        $permissions = [
            // User management
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Role management
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',

            // Permission management
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',

            // Content management
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',
            'publish posts',

            'view pages',
            'create pages',
            'edit pages',
            'delete pages',
            'publish pages',

            'view topics',
            'create topics',
            'edit topics',
            'delete topics',
            'publish topics',

            'view themes',
            'create themes',
            'edit themes',
            'delete themes',

            'view faqs',
            'create faqs',
            'edit faqs',
            'delete faqs',

            // Settings
            'view settings',
            'edit settings',

            // Admin
            'access system',
            'manage system',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => Variable::GUARD_NAME
            ]);
        }

        // Create default roles
        foreach (Variable::DEFAULT_ROLES as $roleName => $roleDisplayName) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => Variable::GUARD_NAME
            ]);

            // Assign all permissions to super_admin
            if ($roleName === Variable::SUPER_ADMIN_ROLE) {
                $role->syncPermissions(Permission::all());
            }
            // Assign limited permissions to admin
            elseif ($roleName === Variable::ADMIN_ROLE) {
                $adminPermissions = [
                    'view users', 'create users', 'edit users',
                    'view roles', 'view permissions',
                    'view posts', 'create posts', 'edit posts', 'publish posts',
                    'view pages', 'create pages', 'edit pages', 'publish pages',
                    'view topics', 'create topics', 'edit topics', 'publish topics',
                    'view themes', 'create themes', 'edit themes',
                    'view faqs', 'create faqs', 'edit faqs',
                    'view settings', 'edit settings',
                    'access system'
                ];
                $role->syncPermissions($adminPermissions);
            }
        }

        // Assign super_admin role to existing admin users
        $adminUsers = \App\Models\User::whereIn('email', array_column(Variable::DEFAULT_SA_EMAILS, 'email'))->get();
        foreach ($adminUsers as $user) {
            if (!$user->hasRole(Variable::SUPER_ADMIN_ROLE)) {
                $user->assignRole(Variable::SUPER_ADMIN_ROLE);
            }
        }
    }
}
