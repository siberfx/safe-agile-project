<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Log;
use Spatie\Permission\Models\Role;

class UserController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->orderBy('created_at', 'desc')->get();
        return view('admin.access.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.access.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Debug: Log the roles array
        Log::info('User create - roles array:', [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'roles' => $request->roles,
            'roles_type' => gettype($request->roles),
            'roles_count' => count($request->roles)
        ]);

        // Get role names from IDs
        $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();

        // Assign roles with error handling
        try {
            $user->assignRole($roleNames);
            Log::info('Roles assigned successfully for user: ' . $user->id);
        } catch (Exception $e) {
            Log::error('Error assigning roles for user: ' . $user->id, [
                'error' => $e->getMessage(),
                'roles' => $request->roles,
                'role_names' => $roleNames
            ]);
            throw $e;
        }

        return redirect()->route('admin.access.users.index')
            ->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('roles');
        return view('admin.access.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $user->load('roles');
        return view('admin.access.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Update password only if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Debug: Log the roles array
        Log::info('User update - roles array:', [
            'user_id' => $user->id,
            'roles' => $request->roles,
            'roles_type' => gettype($request->roles),
            'roles_count' => count($request->roles)
        ]);

        // Get role names from IDs
        $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();

        // Sync roles with error handling
        try {
            $user->syncRoles($roleNames);
            Log::info('Roles synced successfully for user: ' . $user->id);
        } catch (Exception $e) {
            Log::error('Error syncing roles for user: ' . $user->id, [
                'error' => $e->getMessage(),
                'roles' => $request->roles,
                'role_names' => $roleNames
            ]);
            throw $e;
        }

        return redirect()->route('admin.access.users.index')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deleting own account
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot delete your own account!'
            ], 400);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully!'
        ]);
    }

    /**
     * Toggle user status (active/inactive).
     */
    public function toggleStatus(User $user)
    {
        // Prevent deactivating own account
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot deactivate your own account!'
            ], 400);
        }

        $user->update([
            'is_active' => !$user->is_active
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $user->is_active,
            'message' => 'User status updated successfully!'
        ]);
    }
}
