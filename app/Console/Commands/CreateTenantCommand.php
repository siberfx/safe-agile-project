<?php

namespace App\Console\Commands;

use App\Services\TenantService;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateTenantCommand extends Command
{
    protected $signature = 'tenant:create 
                            {name : The tenant name}
                            {domain : The tenant domain}
                            {--slug= : The tenant slug (optional)}
                            {--db-name= : Database name (optional)}
                            {--db-host=localhost : Database host}
                            {--db-port=3306 : Database port}
                            {--db-user= : Database username}
                            {--db-pass= : Database password}';

    protected $description = 'Create a new tenant with database';

    public function handle(TenantService $tenantService): int
    {
        $name = $this->argument('name');
        $domain = $this->argument('domain');
        $slug = $this->option('slug') ?: Str::slug($name);
        $dbName = $this->option('db-name') ?: 'agile_' . $slug;
        $dbHost = $this->option('db-host');
        $dbPort = $this->option('db-port');
        $dbUser = $this->option('db-user') ?: config('database.connections.mysql.username');
        $dbPass = $this->option('db-pass') ?: config('database.connections.mysql.password');

        $this->info("Creating tenant: {$name}");
        $this->info("Domain: {$domain}");
        $this->info("Slug: {$slug}");
        $this->info("Database: {$dbName}");

        if (!$this->confirm('Do you want to continue?')) {
            $this->info('Tenant creation cancelled.');
            return 0;
        }

        try {
            $tenant = $tenantService->createTenant([
                'name' => $name,
                'slug' => $slug,
                'domain' => $domain,
                'database_name' => $dbName,
                'database_host' => $dbHost,
                'database_port' => $dbPort,
                'database_username' => $dbUser,
                'database_password' => $dbPass,
                'is_active' => true,
            ]);

            $this->info("Tenant created successfully!");
            $this->info("ID: {$tenant->id}");
            $this->info("Name: {$tenant->name}");
            $this->info("Domain: {$tenant->domain}");
            $this->info("Database: {$tenant->database_name}");

            if ($this->confirm('Do you want to seed the tenant database?')) {
                $this->info('Seeding tenant database...');
                $tenantService->seedTenant($tenant);
                $this->info('Tenant database seeded successfully!');
            }

            return 0;
        } catch (\Exception $e) {
            $this->error("Failed to create tenant: {$e->getMessage()}");
            return 1;
        }
    }
}
