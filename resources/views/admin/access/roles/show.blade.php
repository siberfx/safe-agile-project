@extends('layouts.admin')

@section('title', 'Role Details')

@section('content')
    <div class="mb-8">
        {{-- Header with Title and Actions --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Role Details</h2>
                <p class="text-gray-600">View detailed information about this role</p>
            </div>
            <div class="flex items-center space-x-4">
                {{-- Edit Role Button --}}
                <a href="{{ route('admin.access.roles.edit', $role->id) }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors flex items-center space-x-2">
                    <i class="fa-solid fa-pen text-white"></i>
                    <span>Edit Role</span>
                </a>
                {{-- Back to Roles Button --}}
                <a href="{{ route('admin.access.roles.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors flex items-center space-x-2">
                    <i class="fa-solid fa-arrow-left text-white"></i>
                    <span>Back to Roles</span>
                </a>
            </div>
        </div>

        {{-- Role Information --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Main Role Details --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-purple-500 rounded-full flex items-center justify-center text-white font-semibold text-2xl">
                            <i class="fa-solid fa-user-tag"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-bold text-gray-900">{{ $role->name }}</h3>
                            <p class="text-gray-600">Role ID: {{ $role->id }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Basic Information --}}
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-3">Basic Information</h4>
                            <div class="space-y-3">
                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Guard Name</span>
                                    <div class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $role->guard_name }}
                                    </span>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Created</span>
                                    <div class="mt-1 text-sm text-gray-900">{{ $role->created_at->format('F d, Y \a\t g:i A') }}</div>
                                </div>
                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Last Updated</span>
                                    <div class="mt-1 text-sm text-gray-900">{{ $role->updated_at->format('F d, Y \a\t g:i A') }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Usage Statistics --}}
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-3">Usage Statistics</h4>
                            <div class="space-y-3">
                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Assigned Permissions</span>
                                    <div class="mt-1">
                                        <span class="text-2xl font-bold text-primary">{{ $role->permissions->count() }}</span>
                                        <span class="text-sm text-gray-600 ml-1">permissions</span>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total Users</span>
                                    <div class="mt-1">
                                        <span class="text-2xl font-bold text-indigo-600">{{ $role->users->count() }}</span>
                                        <span class="text-sm text-gray-600 ml-1">users</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar Information --}}
            <div class="lg:col-span-1">
                {{-- Quick Actions --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                    <h4 class="text-sm font-medium text-gray-700 mb-4">Quick Actions</h4>
                    <div class="space-y-3">
                        <a href="{{ route('admin.access.roles.edit', $role->id) }}"
                           class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-pen"></i>
                            <span>Edit Role</span>
                        </a>
                        @if($role->users->count() === 0 && !in_array($role->name, ['super_admin', 'admin']))
                            <button onclick="deleteRole({{ $role->id }})"
                                    class="w-full bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors flex items-center justify-center space-x-2">
                                <i class="fa-solid fa-trash"></i>
                                <span>Delete Role</span>
                            </button>
                        @else
                            <div class="text-center py-2 px-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <p class="text-xs text-yellow-800">
                                    @if(in_array($role->name, ['super_admin', 'admin']))
                                        Cannot delete - default role
                                    @else
                                        Cannot delete - assigned to users
                                    @endif
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Role Type --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h4 class="text-sm font-medium text-gray-700 mb-4">Role Type</h4>
                    <div class="text-center">
                        @if(in_array($role->name, ['super_admin', 'admin']))
                            <div class="space-y-2">
                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Type</span>
                                    <div class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Default Role
                                    </span>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Level</span>
                                    <div class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                    </span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-2 px-3 bg-gray-50 border border-gray-200 rounded-lg">
                                <p class="text-xs text-gray-600">Custom role</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Assigned Permissions Section --}}
        <div class="mt-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Assigned Permissions</h3>
                    <span class="text-sm text-gray-500">{{ $role->permissions->count() }} permission(s)</span>
                </div>

                @if($role->permissions->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($role->permissions as $permission)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                            <i class="fa-solid fa-key"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h4 class="text-sm font-medium text-gray-900">{{ $permission->name }}</h4>
                                            <p class="text-xs text-gray-500">{{ $permission->guard_name }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.access.permissions.show', $permission->id) }}"
                                       class="text-blue-500 hover:text-blue-700 transition-colors" title="View Permission">
                                        <i class="fa-solid fa-external-link text-sm"></i>
                                    </a>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between text-xs">
                                        <span class="text-gray-500">Guard:</span>
                                        <span class="font-medium text-gray-900">{{ $permission->guard_name }}</span>
                                    </div>
                                    <div class="flex justify-between text-xs">
                                        <span class="text-gray-500">Created:</span>
                                        <span class="font-medium text-gray-900">{{ $permission->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fa-solid fa-key text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">This role has no permissions assigned</p>
                        <p class="text-sm text-gray-400">Assign permissions to control access</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Assigned Users Section --}}
        <div class="mt-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Assigned Users</h3>
                    <span class="text-sm text-gray-500">{{ $role->users->count() }} user(s)</span>
                </div>

                @if($role->users->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($role->users as $user)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h4 class="text-sm font-medium text-gray-900">{{ $user->name }}</h4>
                                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.access.users.show', $user->id) }}"
                                       class="text-blue-500 hover:text-blue-700 transition-colors" title="View User">
                                        <i class="fa-solid fa-external-link text-sm"></i>
                                    </a>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between text-xs">
                                        <span class="text-gray-500">Joined:</span>
                                        <span class="font-medium text-gray-900">{{ $user->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex justify-between text-xs">
                                        <span class="text-gray-500">Roles:</span>
                                        <span class="font-medium text-gray-900">{{ $user->roles->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fa-solid fa-user text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">No users assigned to this role</p>
                        <p class="text-sm text-gray-400">Assign users to grant them this role</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')

@endpush

@push('scripts')
    <script>
        // Delete role function
        function deleteRole(roleId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Make AJAX call to delete the role
                    axios.delete(`/admin/system/access/roles/${roleId}`)
                        .then(response => {
                            Swal.fire(
                                'Deleted!',
                                'Role has been deleted.',
                                'success'
                            ).then(() => {
                                // Redirect to roles index
                                window.location.href = '{{ route("system.access.roles.index") }}';
                            });
                        })
                        .catch(error => {
                            console.error('Error deleting role:', error);
                            Swal.fire(
                                'Error!',
                                error.response?.data?.message || 'Failed to delete role. Please try again.',
                                'error'
                            );
                        });
                }
            });
        }
    </script>
@endpush