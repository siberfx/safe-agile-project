@extends('layouts.admin')

@section('title', 'Edit Program - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Edit Program</h1>
            <p class="text-gray-600 mt-2">Update program information and settings</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.access.programs.show', $program->id) }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fas fa-eye mr-2"></i>
                View Program
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Program Details</h2>
                    <p class="text-sm text-gray-600 mt-1">Basic information about the program</p>
                </div>
        
                <form method="POST" action="{{ route('admin.access.programs.update', $program->id) }}" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Basic Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                            <input type="text" name="title" value="{{ old('title', $program->title) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('title') border-red-500 @enderror" placeholder="Program title" required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Owner</label>
                            <input type="text" name="owner" value="{{ old('owner', $program->owner) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('owner') border-red-500 @enderror" placeholder="Program owner">
                            @error('owner')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                        <textarea name="description" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('description') border-red-500 @enderror" placeholder="Describe the program's purpose and scope" required>{{ old('description', $program->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Strategic Goals -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Strategic Goals</label>
                        <textarea name="strategic_goals" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('strategic_goals') border-red-500 @enderror" placeholder="Define the strategic goals for this program">{{ old('strategic_goals', $program->strategic_goals) }}</textarea>
                        @error('strategic_goals')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Business Value and Status -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Business Value (€)</label>
                            <input type="number" name="business_value" value="{{ old('business_value', $program->business_value) }}" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('business_value') border-red-500 @enderror" placeholder="0">
                            @error('business_value')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('status') border-red-500 @enderror" required>
                                <option value="">Select Status</option>
                                <option value="planning" {{ old('status', $program->status) === 'planning' ? 'selected' : '' }}>Planning</option>
                                <option value="active" {{ old('status', $program->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="completed" {{ old('status', $program->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status', $program->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Dates -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                            <input type="date" name="start_date" value="{{ old('start_date', $program->start_date ? $program->start_date->format('Y-m-d') : '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('start_date') border-red-500 @enderror">
                            @error('start_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                            <input type="date" name="end_date" value="{{ old('end_date', $program->end_date ? $program->end_date->format('Y-m-d') : '') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('end_date') border-red-500 @enderror">
                            @error('end_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.access.programs.show', $program->id) }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                            <i class="fas fa-save mr-2"></i>
                            Update Program
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Program Info -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Program Information</h3>
                <div class="space-y-3">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Created</label>
                        <p class="text-sm text-gray-900">{{ $program->created_at->format('d-m-Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Last Updated</label>
                        <p class="text-sm text-gray-900">{{ $program->updated_at->format('d-m-Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Business Goals</label>
                        <p class="text-sm text-gray-900">{{ $program->businessGoals->count() }} goals</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Projects</label>
                        <p class="text-sm text-gray-900">{{ $program->projects->count() }} projects</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-2">
                    <a href="{{ route('admin.access.programs.show', $program->id) }}" class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 text-center block">
                        <i class="fas fa-eye mr-2"></i>
                        View Program
                    </a>
                    <a href="{{ route('admin.access.business-goals.create') }}" class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 text-center block">
                        <i class="fas fa-plus mr-2"></i>
                        Add Business Goal
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
