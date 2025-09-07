<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();

            // Check if user has 2FA enabled
            if ($user->two_factor_confirmed_at) {
                // Store user info in session for 2FA challenge
                $request->session()->put([
                    'login.id' => $user->id,
                    'login.remember' => $request->filled('remember'),
                ]);

                // Logout the user temporarily
                $this->guard()->logout();

                return redirect()->route('admin.two-factor.challenge');
            }

            // Check if user has multiple teams to choose from
            $userTeams = $user->teams()->get();
            
            if ($userTeams->count() > 1) {
                // Store user info in session for team selection
                $request->session()->put([
                    'team_selection.user_id' => $user->id,
                    'team_selection.remember' => $request->filled('remember'),
                ]);

                // Logout the user temporarily
                $this->guard()->logout();

                return redirect()->route('admin.team.select');
            } elseif ($userTeams->count() === 1) {
                // Auto-select the single team
                $team = $userTeams->first();
                $request->session()->put('selected_team_id', $team->id);
                $request->session()->put('selected_tenant_id', $team->tenant_id);
            } else {
                // User has no teams - this shouldn't happen in normal flow
                $this->guard()->logout();
                return redirect()->route('admin.login')->withErrors(['email' => 'You are not assigned to any teams. Please contact your administrator.']);
            }

            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
