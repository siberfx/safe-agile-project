<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Tenant Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains configuration options for the multi-tenant system.
    |
    */

    'default_connection' => env('DB_CONNECTION', 'mysql'),

    'tenant_connection' => 'tenant',

    'migrations_path' => 'database/migrations/tenant',

    'seeder_class' => 'Database\Seeders\TenantDatabaseSeeder',

    /*
    |--------------------------------------------------------------------------
    | Tenant Resolution
    |--------------------------------------------------------------------------
    |
    | Configure how tenants are resolved from incoming requests.
    |
    */

    'resolution' => [
        'domain' => true,      // Resolve by full domain
        'subdomain' => true,   // Resolve by subdomain
        'path' => true,        // Resolve by URL path segment
    ],

    /*
    |--------------------------------------------------------------------------
    | Database Settings
    |--------------------------------------------------------------------------
    |
    | Default database settings for new tenants.
    |
    */

    'database' => [
        'host' => env('DB_HOST', 'localhost'),
        'port' => env('DB_PORT', '3306'),
        'username' => env('DB_USERNAME', 'root'),
        'password' => env('DB_PASSWORD', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => true,
        'engine' => null,
    ],
];
