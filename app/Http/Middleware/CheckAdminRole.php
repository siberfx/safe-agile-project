<?php

namespace App\Http\Middleware;

use App\Helpers\Variable;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        // Check if user has admin or super_admin role
        if (!Auth::user()->hasAnyRole([Variable::SUPER_ADMIN_ROLE, Variable::ADMIN_ROLE])) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
