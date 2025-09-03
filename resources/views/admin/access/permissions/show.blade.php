@extends('layouts.admin')

@section('title', 'Permission Details')

@section('content')
    <div class="mb-8">
        {{-- Header with Title and Actions --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Permission Details</h2>
                <p class="text-gray-600">View detailed information about this permission</p>
            </div>
            <div class="flex items-center space-x-4">
                {{-- Edit Permission Button --}}
                <a href="{{ route('admin.access.permissions.edit', $permission->id) }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors flex items-center space-x-2">
                    <i class="fa-solid fa-pen text-white"></i>
                    <span>Edit Permission</span>
                </a>
                {{-- Back to Permissions Button --}}
                <a href="{{ route('admin.access.permissions.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors flex items-center space-x-2">
                    <i class="fa-solid fa-arrow-left text-white"></i>
                    <span>Back to Permissions</span>
                </a>
            </div>
        </div>

        {{-- Permission Information --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Main Permission Details --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center text-white font-semibold text-2xl">
                            <i class="fa-solid fa-key"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-bold text-gray-900">{{ $permission->name }}</h3>
                            <p class="text-gray-600">Permission ID: {{ $permission->id }}</p>
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
                                        {{ $permission->guard_name }}
                                    </span>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Created</span>
                                    <div class="mt-1 text-sm text-gray-900">{{ $permission->created_at->format('F d, Y \a\t g:i A') }}</div>
                                </div>
                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Last Updated</span>
                                    <div class="mt-1 text-sm text-gray-900">{{ $permission->updated_at->format('F d, Y \a\t g:i A') }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Usage Statistics --}}
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-3">Usage Statistics</h4>
                            <div class="space-y-3">
                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Assigned to Roles</span>
                                    <div class="mt-1">
                                        <span class="text-2xl font-bold text-primary">{{ $permission->roles->count() }}</span>
                                        <span class="text-sm text-gray-600 ml-1">roles</span>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total Users</span>
                                    <div class="mt-1">
                                        @php
                                            $totalUsers = 0;
                                            foreach($permission->roles as $role) {
                                                $totalUsers += $role->users->count();
                                            }
                                        @endphp
                                        <span class="text-2xl font-bold text-indigo-600">{{ $totalUsers }}</span>
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
                        <a href="{{ route('admin.access.permissions.edit', $permission->id) }}"
                           class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-pen"></i>
                            <span>Edit Permission</span>
                        </a>
                        @if($permission->roles->count() === 0)
                            <button onclick="deletePermission({{ $permission->id }})"
                                    class="w-full bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors flex items-center justify-center space-x-2">
                                <i class="fa-solid fa-trash"></i>
                                <span>Delete Permission</span>
                            </button>
                        @else
                            <div class="text-center py-2 px-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <p class="text-xs text-yellow-800">Cannot delete - assigned to roles</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Permission Type --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h4 class="text-sm font-medium text-gray-700 mb-4">Permission Type</h4>
                    <div class="text-center">
                        @if(str_contains($permission->name, '.'))
                            @php
                                $parts = explode('.', $permission->name);
                                $resource = $parts[0];
                                $action = $parts[1] ?? '';
                            @endphp
                            <div class="space-y-2">
                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Resource</span>
                                    <div class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        {{ ucfirst($resource) }}
                                    </span>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Action</span>
                                    <div class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ ucfirst($action) }}
                                    </span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-2 px-3 bg-gray-50 border border-gray-200 rounded-lg">
                                <p class="text-xs text-gray-600">Custom permission</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Assigned Roles Section --}}
        <div class="mt-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Assigned Roles</h3>
                    <span class="text-sm text-gray-500">{{ $permission->roles->count() }} role(s)</span>
                </div>

                @if($permission->roles->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($permission->roles as $role)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                            <i class="fa-solid fa-user-tag"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h4 class="text-sm font-medium text-gray-900">{{ $role->name }}</h4>
                                            <p class="text-xs text-gray-500">{{ $role->guard_name }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.access.roles.show', $role->id) }}"
                                       class="text-blue-500 hover:text-blue-700 transition-colors" title="View Role">
                                        <i class="fa-solid fa-external-link text-sm"></i>
                                    </a>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between text-xs">
                                        <span class="text-gray-500">Users:</span>
                                        <span class="font-medium text-gray-900">{{ $role->users->count() }}</span>
                                    </div>
                                    <div class="flex justify-between text-xs">
                                        <span class="text-gray-500">Permissions:</span>
                                        <span class="font-medium text-gray-900">{{ $role->permissions->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fa-solid fa-user-tag text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">This permission is not assigned to any roles</p>
                        <p class="text-sm text-gray-400">Assign it to roles to control access</p>
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
        // Delete permission function
        function deletePermission(permissionId) {
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
                    // Make AJAX call to delete the permission
                    axios.delete(`/system/access/permissions/${permissionId}`)
                        .then(response => {
                            Swal.fire(
                                'Deleted!',
                                'Permission has been deleted.',
                                'success'
                            ).then(() => {
                                // Redirect to permissions index
                                window.location.href = '{{ route("system.access.permissions.index") }}';
                            });
                        })
                        .catch(error => {
                            console.error('Error deleting permission:', error);
                            Swal.fire(
                                'Error!',
                                error.response?.data?.message || 'Failed to delete permission. Please try again.',
                                'error'
                            );
                        });
                }
            });
        }
    </script>
@endpush

