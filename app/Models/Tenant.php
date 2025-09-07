<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

/**
 * @mixin IdeHelperTenant
 */
class Tenant extends Model
{
    protected $fillable = [
        'name',
        'identifier',
        'database_name',
        'database_host',
        'database_port',
        'database_username',
        'database_password',
        'is_active',
        'admin_email',
        'settings',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'settings' => 'array',
    ];

    /**
     * Configure the database connection for this tenant.
     */
    public function configure(): void
    {
        Config::set('database.connections.tenant', [
            'driver' => 'mysql',
            'host' => $this->database_host,
            'port' => $this->database_port,
            'database' => $this->database_name,
            'username' => $this->database_username,
            'password' => $this->database_password,
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ]);

        DB::setDefaultConnection('tenant');
    }

    /**
     * Create the tenant database.
     */
    public function createDatabase(): bool
    {
        try {
            $connection = DB::connection('mysql');
            $connection->statement("CREATE DATABASE IF NOT EXISTS `{$this->database_name}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Drop the tenant database.
     */
    public function dropDatabase(): bool
    {
        try {
            $connection = DB::connection('mysql');
            $connection->statement("DROP DATABASE IF EXISTS `{$this->database_name}`");
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Check if tenant database exists.
     */
    public function databaseExists(): bool
    {
        try {
            $connection = DB::connection('mysql');
            $result = $connection->select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?", [$this->database_name]);
            return !empty($result);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get tenant by identifier.
     */
    public static function findByIdentifier(string $identifier): ?self
    {
        return static::where('identifier', $identifier)->where('is_active', true)->first();
    }

    /**
     * Teams belonging to this tenant.
     */
    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    /**
     * Active teams belonging to this tenant.
     */
    public function activeTeams()
    {
        return $this->hasMany(Team::class)->where('is_active', true);
    }
}
