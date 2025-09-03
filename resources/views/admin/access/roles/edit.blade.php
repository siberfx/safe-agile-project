@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')
    <div class="mb-8">
        {{-- Header with Title and Actions --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Edit Role</h2>
                <p class="text-gray-600">Update role information and permissions</p>
            </div>
            <div class="flex items-center space-x-4">
                {{-- Back to Roles Button --}}
                <a href="{{ route('admin.access.roles.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors flex items-center space-x-2">
                    <i class="fa-solid fa-arrow-left text-white"></i>
                    <span>Back to Roles</span>
                </a>
            </div>
        </div>

        {{-- Edit Role Form --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form action="{{ route('admin.access.roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {{-- Role Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Role Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $role->name) }}" required
                               class="block w-full px-3 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                               placeholder="Enter role name (e.g., editor, moderator)">
                        @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Guard Name --}}
                    <div>
                        <label for="guard_name" class="block text-sm font-medium text-gray-700 mb-2">Guard Name</label>
                        <select id="guard_name" name="guard_name" required
                                class="block w-full px-3 py-3 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors">
                            <option value="web" {{ old('guard_name', $role->guard_name) == 'web' ? 'selected' : '' }}>Web</option>
                            <option value="api" {{ old('guard_name', $role->guard_name) == 'api' ? 'selected' : '' }}>API</option>
                        </select>
                        <p class="mt-1 text-xs text-gray-500">Usually 'web' for web applications</p>
                    </div>

                    {{-- Permissions --}}
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Permissions</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 max-h-96 overflow-y-auto border border-gray-200 rounded-lg p-4">
                            @forelse($permissions as $permission)
                                <label class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                           class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary/20 focus:ring-2"
                                            {{ in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    <div>
                                        <span class="text-sm font-medium text-gray-900">{{ $permission->name }}</span>
                                        <div class="text-xs text-gray-500">{{ $permission->guard_name }}</div>
                                    </div>
                                </label>
                            @empty
                                <div class="col-span-full text-center py-8 text-gray-500">
                                    <i class="fa-solid fa-key text-4xl text-gray-300 mb-3"></i>
                                    <p>No permissions available</p>
                                    <p class="text-sm text-gray-400">Create permissions first</p>
                                </div>
                            @endforelse
                        </div>
                        @error('permissions')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end mt-8">
                    <button type="submit" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary/90 transition-colors flex items-center space-x-2">
                        <i class="fa-solid fa-save text-white"></i>
                        <span>Update Role</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush