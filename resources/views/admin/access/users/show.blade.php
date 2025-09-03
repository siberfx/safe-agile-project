@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
    <div class="mb-8">
        {{-- Header with Title and Actions --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">User Details</h2>
                <p class="text-gray-600">View user information and permissions</p>
            </div>
            <div class="flex items-center space-x-4">
                {{-- Edit User Button --}}
                <a href="{{ route('admin.access.users.edit', $user->id) }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors flex items-center space-x-2">
                    <i class="fa-solid fa-pen text-white"></i>
                    <span>Edit User</span>
                </a>
                {{-- Back to Users Button --}}
                <a href="{{ route('admin.access.users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors flex items-center space-x-2">
                    <i class="fa-solid fa-arrow-left text-white"></i>
                    <span>Back to Users</span>
                </a>
            </div>
        </div>

        {{-- User Information --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Main User Info --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>

                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white font-semibold text-2xl">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h4>
                                <p class="text-gray-600">{{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->is_active ?? true ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $user->is_active ?? true ? 'Active' : 'Inactive' }}
                            </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Member Since</label>
                                <p class="text-sm text-gray-900">{{ $user->created_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Last Updated</label>
                                <p class="text-sm text-gray-900">{{ $user->updated_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">User ID</label>
                                <p class="text-sm text-gray-900 font-mono">{{ $user->id }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- User Roles --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Roles & Permissions</h3>

                    @if($user->roles->count() > 0)
                        <div class="space-y-3">
                            @foreach($user->roles as $role)
                                <div class="p-3 bg-blue-50 rounded-lg border border-blue-200">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-blue-900">{{ $role->name }}</span>
                                        <span class="text-xs text-blue-600 bg-blue-100 px-2 py-1 rounded-full">Role</span>
                                    </div>
                                    @if($role->permissions->count() > 0)
                                        <div class="mt-2">
                                            <p class="text-xs text-blue-700 mb-1">Permissions:</p>
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($role->permissions->take(3) as $permission)
                                                    <span class="text-xs bg-blue-200 text-blue-800 px-2 py-1 rounded">{{ $permission->name }}</span>
                                                @endforeach
                                                @if($role->permissions->count() > 3)
                                                    <span class="text-xs bg-blue-200 text-blue-800 px-2 py-1 rounded">+{{ $role->permissions->count() - 3 }} more</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fa-solid fa-user-slash text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500">No roles assigned</p>
                            <p class="text-sm text-gray-400 mt-1">This user has no permissions</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Activity Section --}}
        <div class="mt-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>

                <div class="text-center py-8">
                    <i class="fa-solid fa-chart-line text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">No recent activity</p>
                    <p class="text-sm text-gray-400 mt-1">User activity will appear here</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush