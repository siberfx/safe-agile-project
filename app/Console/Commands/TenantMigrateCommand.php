<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Console\Command;

class TenantMigrateCommand extends Command
{
    protected $signature = 'tenant:migrate 
                            {tenant? : The tenant ID or slug (optional - runs for all if not specified)}
                            {--fresh : Drop all tables and re-run all migrations}
                            {--seed : Seed the database after migration}';

    protected $description = 'Run migrations for tenant(s)';

    public function handle(TenantService $tenantService): int
    {
        $tenantIdentifier = $this->argument('tenant');

        if ($tenantIdentifier) {
            // Run for specific tenant
            $tenant = is_numeric($tenantIdentifier) 
                ? Tenant::find($tenantIdentifier)
                : Tenant::where('slug', $tenantIdentifier)->first();

            if (!$tenant) {
                $this->error("Tenant not found: {$tenantIdentifier}");
                return 1;
            }

            return $this->migrateTenant($tenantService, $tenant);
        } else {
            // Run for all active tenants
            $tenants = Tenant::where('is_active', true)->get();
            
            if ($tenants->isEmpty()) {
                $this->info('No active tenants found.');
                return 0;
            }

            $this->info("Running migrations for {$tenants->count()} tenant(s)...");

            foreach ($tenants as $tenant) {
                $this->info("Migrating tenant: {$tenant->name} ({$tenant->slug})");
                $this->migrateTenant($tenantService, $tenant);
            }

            $this->info('All tenant migrations completed!');
            return 0;
        }
    }

    private function migrateTenant(TenantService $tenantService, Tenant $tenant): int
    {
        try {
            $tenant->configure();

            if ($this->option('fresh')) {
                $this->call('migrate:fresh', [
                    '--database' => 'tenant',
                    '--force' => true,
                ]);
            } else {
                $this->call('migrate', [
                    '--database' => 'tenant',
                    '--force' => true,
                ]);
            }

            if ($this->option('seed')) {
                $this->info('Seeding tenant database...');
                $tenantService->seedTenant($tenant);
            }

            $this->info("Migration completed for tenant: {$tenant->name}");
            return 0;
        } catch (\Exception $e) {
            $this->error("Migration failed for tenant {$tenant->name}: {$e->getMessage()}");
            return 1;
        }
    }
}
