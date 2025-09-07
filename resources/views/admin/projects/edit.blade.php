@extends('layouts.admin')

@section('title', 'Edit Project - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Edit Project</h1>
            <p class="text-gray-600 mt-2">Update project information and settings</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.access.projects.show', $project->id) }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fas fa-eye mr-2"></i>
                View Project
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Project Details</h2>
                    <p class="text-sm text-gray-600 mt-1">Update the project information</p>
                </div>
        
                <form action="{{ route('admin.access.projects.update', $project->id) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Project Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Project Name *</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $project->name) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-red-500 @enderror"
                               placeholder="Enter project name" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea id="description" name="description" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('description') border-red-500 @enderror"
                                  placeholder="Describe the project objectives and scope">{{ old('description', $project->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select id="status" name="status" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('status') border-red-500 @enderror" required>
                            <option value="">Select status</option>
                            <option value="active" {{ old('status', $project->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $project->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status', $project->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Program -->
                    <div>
                        <label for="program_id" class="block text-sm font-medium text-gray-700 mb-2">Program</label>
                        <select id="program_id" name="program_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('program_id') border-red-500 @enderror">
                            <option value="">Independent Project</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" {{ old('program_id', $project->program_id) == $program->id ? 'selected' : '' }}>
                                    {{ $program->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('program_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Created By -->
                    <div>
                        <label for="created_by" class="block text-sm font-medium text-gray-700 mb-2">Created By *</label>
                        <select id="created_by" name="created_by" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('created_by') border-red-500 @enderror" required>
                            <option value="">Select creator</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('created_by', $project->created_by) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('created_by')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date Range -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                            <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('start_date') border-red-500 @enderror">
                            @error('start_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                            <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('end_date') border-red-500 @enderror">
                            @error('end_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.access.projects.show', $project->id) }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                            <i class="fas fa-save mr-2"></i>
                            Update Project
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Project Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Project Information</h2>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Created:</span>
                        <span class="text-gray-900">{{ $project->created_at->format('d-m-Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Last Updated:</span>
                        <span class="text-gray-900">{{ $project->updated_at->format('d-m-Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Current Program:</span>
                        <span class="text-gray-900">{{ $project->program->name ?? 'Independent' }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h2>
                <div class="space-y-2">
                    <a href="{{ route('admin.access.projects.show', $project->id) }}" class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 text-center block">
                        <i class="fas fa-eye mr-2"></i>View Project
                    </a>
                    @if($project->program)
                    <a href="{{ route('admin.access.programs.show', $project->program->id) }}" class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 text-center block">
                        <i class="fas fa-folder mr-2"></i>View Program
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection