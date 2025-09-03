<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Helpers\Variable;

class RoleController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->orderBy('created_at', 'desc')->get();
        return view('admin.access.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.access.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        // Debug: Log the permissions array
        \Log::info('Role create - permissions array:', [
            'role_id' => $role->id,
            'role_name' => $role->name,
            'permissions' => $request->permissions,
            'permissions_type' => gettype($request->permissions),
            'permissions_count' => count($request->permissions)
        ]);

        // Get permission names from IDs
        $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();

        // Assign permissions with error handling
        try {
            $role->syncPermissions($permissionNames);
            \Log::info('Permissions synced successfully for role: ' . $role->id);
        } catch (\Exception $e) {
            \Log::error('Error syncing permissions for role: ' . $role->id, [
                'error' => $e->getMessage(),
                'permissions' => $request->permissions,
                'permission_names' => $permissionNames
            ]);
            throw $e;
        }

        return redirect()->route('admin.access.roles.index')
            ->with('success', 'Role created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $role->load('permissions');
        return view('admin.access.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $role->load('permissions');
        return view('admin.access.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'exists:permissions,id'
        ]);

        // Prevent editing default roles unless super admin
        if (array_key_exists($role->name, Variable::DEFAULT_ROLES) && !auth()->user()->hasRole('super_admin')) {
            return redirect()->route('admin.access.roles.index')
                ->with('error', 'Default roles cannot be modified!');
        }

        $role->update([
            'name' => $request->name
        ]);

        // Debug: Log the permissions array
        \Log::info('Role update - permissions array:', [
            'role_id' => $role->id,
            'role_name' => $role->name,
            'permissions' => $request->permissions,
            'permissions_type' => gettype($request->permissions),
            'permissions_count' => count($request->permissions)
        ]);

        // Get permission names from IDs
        $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();

        // Sync permissions with error handling
        try {
            $role->syncPermissions($permissionNames);
            \Log::info('Permissions synced successfully for role: ' . $role->id);
        } catch (\Exception $e) {
            \Log::error('Error syncing permissions for role: ' . $role->id, [
                'error' => $e->getMessage(),
                'permissions' => $request->permissions,
                'permission_names' => $permissionNames
            ]);
            throw $e;
        }

        return redirect()->route('admin.access.roles.index')
            ->with('success', 'Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // Prevent deleting default roles
        if (array_key_exists($role->name, Variable::DEFAULT_ROLES)) {
            return response()->json([
                'success' => false,
                'message' => 'Default roles cannot be deleted!'
            ], 400);
        }

        // Prevent deleting roles that are in use
        if ($role->users()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete role that is assigned to users!'
            ], 400);
        }

        $role->delete();

        return response()->json([
            'success' => true,
            'message' => 'Role deleted successfully!'
        ]);
    }
}
