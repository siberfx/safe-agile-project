<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;

class ListTenantsCommand extends Command
{
    protected $signature = 'tenant:list {--active : Show only active tenants}';

    protected $description = 'List all tenants';

    public function handle(): int
    {
        $query = Tenant::query();

        if ($this->option('active')) {
            $query->where('is_active', true);
        }

        $tenants = $query->orderBy('created_at', 'desc')->get();

        if ($tenants->isEmpty()) {
            $this->info('No tenants found.');
            return 0;
        }

        $headers = ['ID', 'Name', 'Slug', 'Domain', 'Database', 'Status', 'Created'];
        $rows = [];

        foreach ($tenants as $tenant) {
            $rows[] = [
                $tenant->id,
                $tenant->name,
                $tenant->slug,
                $tenant->domain,
                $tenant->database_name,
                $tenant->is_active ? 'Active' : 'Inactive',
                $tenant->created_at->format('Y-m-d H:i:s'),
            ];
        }

        $this->table($headers, $rows);

        return 0;
    }
}
