# Multi-Tenant Agile Project Management System

This Laravel application now supports multi-tenancy with separate databases for each tenant. Each tenant has their own isolated database containing all their project data.

## Features

- **Database-per-tenant architecture**: Each tenant gets their own MySQL database
- **Tenant resolution**: Supports domain, subdomain, and path-based tenant resolution
- **Automatic database management**: Creates and manages tenant databases automatically
- **Tenant-aware models**: All models automatically use the correct tenant database
- **Management commands**: CLI tools for tenant management
- **Isolated data**: Complete data separation between tenants

## Setup

### 1. Run Migrations

First, run the main application migrations to create the tenants table:

```bash
php artisan migrate
```

### 2. Create a Tenant

Use the tenant creation command:

```bash
php artisan tenant:create "Company Name" "company.example.com" --slug=company --db-name=agile_company
```

This will:
- Create a tenant record
- Create a new database for the tenant
- Run all tenant migrations
- Optionally seed the tenant database

### 3. Configure Routes

Apply the tenant middleware to your routes in `routes/web.php`:

```php
Route::middleware(['tenant'])->group(function () {
    // Your tenant-specific routes here
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('projects', ProjectController::class);
    // ... other routes
});
```

## Tenant Resolution

The system supports three methods of tenant resolution:

### 1. Domain-based
- `tenant1.com` → Tenant with domain "tenant1.com"
- `tenant2.com` → Tenant with domain "tenant2.com"

### 2. Subdomain-based
- `company1.yourdomain.com` → Tenant with slug "company1"
- `company2.yourdomain.com` → Tenant with slug "company2"

### 3. Path-based
- `yourdomain.com/company1/dashboard` → Tenant with slug "company1"
- `yourdomain.com/company2/projects` → Tenant with slug "company2"

## Management Commands

### List Tenants
```bash
php artisan tenant:list
php artisan tenant:list --active
```

### Create Tenant
```bash
php artisan tenant:create "Tenant Name" "domain.com" --slug=tenant-slug
```

### Delete Tenant
```bash
php artisan tenant:delete {tenant-id-or-slug}
php artisan tenant:delete company1 --force
```

### Run Migrations
```bash
# For all tenants
php artisan tenant:migrate

# For specific tenant
php artisan tenant:migrate company1

# Fresh migration with seeding
php artisan tenant:migrate company1 --fresh --seed
```

## Models

All existing models have been updated to use the `TenantAware` trait:

- `Program`
- `Project`
- `Epic`
- `Sprint`
- `Task`
- `Note`
- `User`
- `Bug`
- `TestCase`
- `Feature`
- `BusinessGoal`

This ensures they automatically use the tenant database connection.

## Database Structure

### Main Database
- `tenants` - Stores tenant information and database credentials

### Tenant Databases
Each tenant database contains:
- `users` - Tenant-specific users
- `programs` - Programs for the tenant
- `projects` - Projects for the tenant
- `tasks` - Tasks for the tenant
- `notes` - Notes for the tenant
- All other agile-related tables

## Configuration

Tenant configuration is stored in `config/tenant.php`:

```php
return [
    'default_connection' => 'mysql',
    'tenant_connection' => 'tenant',
    'migrations_path' => 'database/migrations/tenant',
    'seeder_class' => 'Database\Seeders\TenantDatabaseSeeder',
    // ... other settings
];
```

## Usage in Controllers

```php
use App\Services\TenantService;

class ProjectController extends Controller
{
    public function index(TenantService $tenantService)
    {
        $currentTenant = $tenantService->getCurrentTenant();
        
        // All model queries automatically use tenant database
        $projects = Project::all();
        
        return view('projects.index', compact('projects', 'currentTenant'));
    }
}
```

## Security Notes

- Each tenant's data is completely isolated in separate databases
- Database credentials are stored securely in the main database
- Tenant resolution happens before any data access
- No cross-tenant data leakage is possible

## Troubleshooting

### Database Connection Issues
- Ensure tenant database exists: Check with `tenant:list`
- Verify database credentials in tenant record
- Check MySQL user permissions

### Migration Issues
- Run `tenant:migrate` to ensure all tenant databases are up to date
- Use `--fresh` flag to rebuild tenant databases if needed

### Tenant Not Found
- Verify domain/slug configuration
- Check tenant is active (`is_active = true`)
- Ensure middleware is applied to routes
