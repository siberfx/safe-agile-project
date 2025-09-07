<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class TeamManagementController extends Controller
{
    /**
     * Show team management page after successful tenant registration.
     */
    public function manage(Request $request, string $tenantIdentifier)
    {
        $tenant = Tenant::where('identifier', $tenantIdentifier)->firstOrFail();
        $team = $tenant->teams()->first();
        
        if (!$team) {
            return redirect()->route('home')->withErrors(['error' => 'Team not found.']);
        }

        // Get current team members
        $teamMembers = $team->users()->withPivot(['role', 'is_active'])->get();

        return view('landlord.team-management', compact('tenant', 'team', 'teamMembers'));
    }

    /**
     * Add a new team member (project manager).
     */
    public function addMember(Request $request, string $tenantIdentifier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => 'required|in:admin,member',
        ]);

        $tenant = Tenant::where('identifier', $tenantIdentifier)->firstOrFail();
        $team = $tenant->teams()->first();

        if (!$team) {
            return back()->withErrors(['error' => 'Team not found.']);
        }

        // Create user in main database
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'type' => 'user',
            'email_verified_at' => now(),
        ]);

        // Link user to team
        $user->teams()->attach($team->id, [
            'role' => $validated['role'],
            'is_active' => true,
        ]);

        return back()->with('success', 'Team member added successfully!');
    }

    /**
     * Update team member role.
     */
    public function updateMember(Request $request, string $tenantIdentifier, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:landlord,admin,member',
            'is_active' => 'required|boolean',
        ]);

        $tenant = Tenant::where('identifier', $tenantIdentifier)->firstOrFail();
        $team = $tenant->teams()->first();

        if (!$team) {
            return back()->withErrors(['error' => 'Team not found.']);
        }

        // Update user-team relationship
        $user->teams()->updateExistingPivot($team->id, [
            'role' => $validated['role'],
            'is_active' => $validated['is_active'],
        ]);

        return back()->with('success', 'Team member updated successfully!');
    }

    /**
     * Remove team member.
     */
    public function removeMember(Request $request, string $tenantIdentifier, User $user)
    {
        $tenant = Tenant::where('identifier', $tenantIdentifier)->firstOrFail();
        $team = $tenant->teams()->first();

        if (!$team) {
            return back()->withErrors(['error' => 'Team not found.']);
        }

        // Don't allow removing the landlord
        $pivot = $user->teams()->where('team_id', $team->id)->first();
        if ($pivot && $pivot->pivot->role === 'landlord') {
            return back()->withErrors(['error' => 'Cannot remove the landlord from the team.']);
        }

        // Remove user from team
        $user->teams()->detach($team->id);

        return back()->with('success', 'Team member removed successfully!');
    }

    /**
     * Complete setup and redirect to login.
     */
    public function completeSetup(Request $request, string $tenantIdentifier)
    {
        return redirect()->route('admin.login')->with('success', 'Platform setup completed! You can now login to your platform.');
    }
}
