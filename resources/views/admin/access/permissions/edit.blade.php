@extends('layouts.admin')

@section('title', 'Edit Permission')

@section('content')
    <div class="mb-8">
        {{-- Header with Title and Actions --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Edit Permission</h2>
                <p class="text-gray-600">Update permission information</p>
            </div>
            <div class="flex items-center space-x-4">
                {{-- Back to Permissions Button --}}
                <a href="{{ route('admin.access.permissions.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors flex items-center space-x-2">
                    <i class="fa-solid fa-arrow-left text-white"></i>
                    <span>Back to Permissions</span>
                </a>
            </div>
        </div>

        {{-- Edit Permission Form --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form action="{{ route('admin.access.permissions.update', $permission->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {{-- Permission Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Permission Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $permission->name) }}" required
                               class="block w-full px-3 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                               placeholder="Enter permission name (e.g., users.create, posts.edit)">
                        <p class="mt-1 text-xs text-gray-500">Use dot notation: resource.action (e.g., users.create)</p>
                        @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Guard Name --}}
                    <div>
                        <label for="guard_name" class="block text-sm font-medium text-gray-700 mb-2">Guard Name</label>
                        <select id="guard_name" name="guard_name" required
                                class="block w-full px-3 py-3 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors">
                            <option value="web" {{ old('guard_name', $permission->guard_name) == 'web' ? 'selected' : '' }}>Web</option>
                            <option value="api" {{ old('guard_name', $permission->guard_name) == 'api' ? 'selected' : '' }}>API</option>
                        </select>
                        <p class="mt-1 text-xs text-gray-500">Usually 'web' for web applications</p>
                    </div>
                </div>

                {{-- Examples Section --}}
                <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Common Permission Examples:</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                        <div>
                            <p class="font-medium text-gray-700 mb-2">User Management:</p>
                            <ul class="space-y-1">
                                <li>• users.view</li>
                                <li>• users.create</li>
                                <li>• users.edit</li>
                                <li>• users.delete</li>
                            </ul>
                        </div>
                        <div>
                            <p class="font-medium text-gray-700 mb-2">Content Management:</p>
                            <ul class="space-y-1">
                                <li>• posts.view</li>
                                <li>• posts.create</li>
                                <li>• posts.edit</li>
                                <li>• posts.delete</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end mt-8">
                    <button type="submit" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary/90 transition-colors flex items-center space-x-2">
                        <i class="fa-solid fa-save text-white"></i>
                        <span>Update Permission</span>
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