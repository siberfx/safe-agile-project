<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // If user is not authenticated, let auth middleware handle it
        if (!$user) {
            return $next($request);
        }

        // If user has 2FA enabled but hasn't completed 2FA challenge
        if ($user->two_factor_confirmed_at && !$request->session()->get('two_factor_authenticated')) {
            // Check if this is a 2FA related route
            $allowedRoutes = [
                'two-factor.login',
                'logout'
            ];

            if (!in_array($request->route()->getName(), $allowedRoutes)) {
                return response()->json([
                    'message' => 'Two factor authentication required',
                    'two_factor_required' => true
                ], 423);
            }
        }

        return $next($request);
    }
}
