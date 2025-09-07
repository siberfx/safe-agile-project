<?php

namespace App\Services;

use App\Models\Tenant;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class TenantService
{
    protected ?Tenant $currentTenant = null;

    /**
     * Set the current tenant.
     */
    public function setTenant(?Tenant $tenant): void
    {
        $this->currentTenant = $tenant;

        if ($tenant) {
            $tenant->configure();
        } else {
            // Reset to default connection
            DB::setDefaultConnection(config('database.default'));
        }
    }

    /**
     * Get the current tenant.
     */
    public function getCurrentTenant(): ?Tenant
    {
        return $this->currentTenant;
    }

    /**
     * Resolve tenant by identifier.
     */
    public function resolveTenantByIdentifier(string $identifier): ?Tenant
    {
        return Tenant::findByIdentifier($identifier);
    }

    /**
     * Find tenant by ID.
     */
    public function findTenantById(int $id): ?Tenant
    {
        return Tenant::where('id', $id)->where('is_active', true)->first();
    }

    /**
     * Create a new tenant with database.
     */
    public function createTenant(array $data): Tenant
    {
        // Use default connection for tenant creation
        DB::setDefaultConnection(config('database.default'));

        $tenant = Tenant::create($data);

        // Create the tenant database
        if (!$tenant->createDatabase()) {
            $tenant->delete();
            throw new \Exception('Failed to create tenant database');
        }

        // Run migrations on the tenant database
        $this->runTenantMigrations($tenant);

        return $tenant;
    }

    /**
     * Delete a tenant and its database.
     */
    public function deleteTenant(Tenant $tenant): bool
    {
        // Use default connection
        DB::setDefaultConnection(config('database.default'));

        $success = $tenant->dropDatabase();
        
        if ($success) {
            $tenant->delete();
        }

        return $success;
    }

    /**
     * Run migrations for a specific tenant.
     */
    public function runTenantMigrations(Tenant $tenant): void
    {
        $tenant->configure();

        Artisan::call('migrate', [
            '--database' => 'tenant',
            '--path' => 'database/migrations/tenant',
            '--force' => true,
        ]);
    }

    /**
     * Seed a tenant database.
     */
    public function seedTenant(Tenant $tenant): void
    {
        $tenant->configure();

        Artisan::call('db:seed', [
            '--database' => 'tenant',
            '--class' => 'TenantDatabaseSeeder',
            '--force' => true,
        ]);
    }

    /**
     * Check if we're in tenant context.
     */
    public function hasTenant(): bool
    {
        return $this->currentTenant !== null;
    }

    /**
     * Execute callback in tenant context.
     */
    public function runInTenant(Tenant $tenant, callable $callback)
    {
        $previousTenant = $this->currentTenant;
        
        try {
            $this->setTenant($tenant);
            return $callback();
        } finally {
            $this->setTenant($previousTenant);
        }
    }
}
