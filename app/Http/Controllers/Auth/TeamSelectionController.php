<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamSelectionController extends Controller
{
    /**
     * Show the team selection form.
     */
    public function show()
    {
        $userId = session('team_selection.user_id');
        
        if (!$userId) {
            return redirect()->route('admin.login');
        }

        $user = User::find($userId);
        
        if (!$user) {
            return redirect()->route('admin.login');
        }

        $teams = $user->teams()->with('tenant')->get();

        if ($teams->isEmpty()) {
            return redirect()->route('admin.login')
                ->withErrors(['email' => 'You are not assigned to any teams. Please contact your administrator.']);
        }

        return view('admin.auth.team-select', compact('teams', 'user'));
    }

    /**
     * Handle team selection.
     */
    public function select(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id'
        ]);

        $userId = session('team_selection.user_id');
        $remember = session('team_selection.remember', false);
        
        if (!$userId) {
            return redirect()->route('admin.login');
        }

        $user = User::find($userId);
        
        if (!$user) {
            return redirect()->route('admin.login');
        }

        // Verify user belongs to selected team
        $team = $user->teams()->where('teams.id', $request->team_id)->with('tenant')->first();
        
        if (!$team) {
            return redirect()->route('admin.team.select')
                ->withErrors(['team_id' => 'Invalid team selection.']);
        }

        // Log the user in
        Auth::login($user, $remember);

        // Store selected team and tenant in session
        $request->session()->put('selected_team_id', $team->id);
        $request->session()->put('selected_tenant_id', $team->tenant_id);

        // Clear team selection session data
        $request->session()->forget(['team_selection.user_id', 'team_selection.remember']);

        // Redirect to intended page or dashboard
        return redirect()->intended(route('admin.dashboard'));
    }

    /**
     * Switch to a different team (for already authenticated users).
     */
    public function switch(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id'
        ]);

        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('admin.login');
        }

        // Verify user belongs to selected team
        $team = $user->teams()->where('teams.id', $request->team_id)->with('tenant')->first();
        
        if (!$team) {
            return response()->json(['error' => 'Invalid team selection.'], 403);
        }

        // Update selected team and tenant in session
        $request->session()->put('selected_team_id', $team->id);
        $request->session()->put('selected_tenant_id', $team->tenant_id);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'team' => $team->name, 'tenant' => $team->tenant->name]);
        }

        return redirect()->back()->with('success', "Switched to team: {$team->name}");
    }
}
