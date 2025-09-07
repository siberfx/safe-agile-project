<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class LandlordRegistrationController extends Controller
{
    protected TenantService $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    /**
     * Show the landing page with login options.
     */
    public function showLandingPage()
    {
        return view('landlord.register');
    }

    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('landlord.create-platform');
    }

    /**
     * Handle landlord registration.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::defaults()],
            'phone' => 'nullable|string|max:20',
            'company_address' => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();

        try {
            // Generate unique tenant identifier
            $identifier = Str::random(12);
            
            // Ensure unique identifier
            while (Tenant::where('identifier', $identifier)->exists()) {
                $identifier = Str::random(12);
            }

            // Generate database name
            $dbName = 'agile_' . $identifier;

            // Create tenant
            $tenant = $this->tenantService->createTenant([
                'name' => $validated['company_name'],
                'identifier' => $identifier,
                'database_name' => $dbName,
                'database_host' => config('database.connections.mysql.host'),
                'database_port' => config('database.connections.mysql.port'),
                'database_username' => config('database.connections.mysql.username'),
                'database_password' => config('database.connections.mysql.password'),
                'is_active' => true,
                'admin_email' => $validated['admin_email'],
                'settings' => [
                    'phone' => $validated['phone'] ?? null,
                    'company_address' => $validated['company_address'] ?? null,
                ],
            ]);

            // Create admin user in main database
            $adminUser = \App\Models\User::create([
                'name' => $validated['admin_name'],
                'email' => $validated['admin_email'],
                'password' => Hash::make($validated['password']),
                'type' => 'admin',
                'email_verified_at' => now(),
            ]);

            // Create team in main database and link to tenant
            $team = \App\Models\Team::create([
                'name' => $validated['company_name'] . ' Team',
                'description' => 'Default team for ' . $validated['company_name'],
                'tenant_id' => $tenant->id,
                'is_active' => true,
            ]);

            // Link admin user to team as landlord
            $adminUser->teams()->attach($team->id, [
                'role' => 'landlord',
                'is_active' => true,
            ]);

            // No need to create anything in tenant database for users
            // Tenant database only contains project data, not users

            DB::commit();

            return redirect()->route('landlord.team.manage', ['tenant' => $tenant->identifier])
                ->with('success', 'Your agile platform has been created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withErrors([
                'error' => 'Failed to create your platform: ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Show success page after registration.
     */
    public function success(Tenant $tenant)
    {
        return view('landlord.success', compact('tenant'));
    }
}
