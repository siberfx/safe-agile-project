<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Console\Command;

class DeleteTenantCommand extends Command
{
    protected $signature = 'tenant:delete 
                            {tenant : The tenant ID or slug}
                            {--force : Force deletion without confirmation}';

    protected $description = 'Delete a tenant and its database';

    public function handle(TenantService $tenantService): int
    {
        $tenantIdentifier = $this->argument('tenant');
        
        // Try to find tenant by ID first, then by slug
        $tenant = is_numeric($tenantIdentifier) 
            ? Tenant::find($tenantIdentifier)
            : Tenant::where('slug', $tenantIdentifier)->first();

        if (!$tenant) {
            $this->error("Tenant not found: {$tenantIdentifier}");
            return 1;
        }

        $this->info("Tenant Details:");
        $this->info("ID: {$tenant->id}");
        $this->info("Name: {$tenant->name}");
        $this->info("Domain: {$tenant->domain}");
        $this->info("Database: {$tenant->database_name}");

        if (!$this->option('force')) {
            $this->warn('This will permanently delete the tenant and ALL its data!');
            if (!$this->confirm('Are you sure you want to continue?')) {
                $this->info('Tenant deletion cancelled.');
                return 0;
            }
        }

        try {
            if ($tenantService->deleteTenant($tenant)) {
                $this->info('Tenant deleted successfully!');
                return 0;
            } else {
                $this->error('Failed to delete tenant database.');
                return 1;
            }
        } catch (\Exception $e) {
            $this->error("Failed to delete tenant: {$e->getMessage()}");
            return 1;
        }
    }
}
