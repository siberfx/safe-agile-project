<?php

namespace App\Models\Traits;

use App\Services\TenantService;

trait TenantAware
{
    /**
     * Boot the tenant aware trait.
     */
    protected static function bootTenantAware(): void
    {
        // Set the connection to tenant for all operations
        static::creating(function ($model) {
            $model->setConnection('tenant');
        });

        static::updating(function ($model) {
            $model->setConnection('tenant');
        });

        static::deleting(function ($model) {
            $model->setConnection('tenant');
        });
    }

    /**
     * Initialize the tenant aware trait.
     */
    public function initializeTenantAware(): void
    {
        $this->connection = 'tenant';
    }

    /**
     * Get the current tenant.
     */
    public function getCurrentTenant()
    {
        return app(TenantService::class)->getCurrentTenant();
    }

    /**
     * Scope queries to ensure they use tenant connection.
     */
    public function newQuery()
    {
        $query = parent::newQuery();
        $query->getQuery()->connection = $this->getConnection();
        return $query;
    }

    /**
     * Get the database connection for the model.
     */
    public function getConnectionName()
    {
        return 'tenant';
    }
}
