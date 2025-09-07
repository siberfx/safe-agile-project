<?php

namespace App\Http\Middleware;

use App\Services\TenantService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenantMiddleware
{
    protected TenantService $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = null;

        // For authenticated users, get tenant from session (team-based)
        if (auth()->check() && session()->has('selected_tenant_id')) {
            $tenantId = session('selected_tenant_id');
            $tenant = $this->tenantService->findTenantById($tenantId);
        }

        // Routes that don't require tenant context
        $allowedRoutesWithoutTenant = [
            'home',
            'landlord.register',
            'landlord.success',
            'admin.team.select',
            'admin.team.select.post',
            'admin.login',
            'admin.login.post',
            'admin.register',
            'admin.register.post',
            'admin.two-factor.challenge',
            'admin.two-factor.verify',
            'admin.two-factor.recovery',
            'admin.two-factor.recovery.verify'
        ];

        if (!$tenant && in_array($request->route()?->getName(), $allowedRoutesWithoutTenant)) {
            return $next($request);
        }

        if (!$tenant) {
            // If user is authenticated but has no tenant context, redirect to team selection
            if (auth()->check()) {
                return redirect()->route('admin.team.select');
            }
            
            // Show landing page instead of JSON error for unauthenticated users
            return redirect()->route('home');
        }

        // Set the tenant context
        $this->tenantService->setTenant($tenant);

        // Add tenant to request for easy access
        $request->attributes->set('tenant', $tenant);

        return $next($request);
    }

}
