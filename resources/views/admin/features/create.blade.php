@extends('layouts.admin')

@section('title', 'Create Feature - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Create New Feature</h1>
            <p class="text-gray-600 mt-2">Define a system capability or functionality for your epic</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.access.features.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Features
            </a>
        </div>
    </div>

    <!-- Create Form -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Feature Details</h2>
                    <p class="text-sm text-gray-600 mt-1">Define the feature and its parameters</p>
                </div>
        
        <form action="{{ route('admin.access.features.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            
            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('title') border-red-500 @enderror" placeholder="Feature title" required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Epic *</label>
                    <select name="epic_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('epic_id') border-red-500 @enderror" required>
                        <option value="">Select Epic</option>
                        @foreach($epics as $epic)
                            <option value="{{ $epic->id }}" {{ old('epic_id') == $epic->id ? 'selected' : '' }}>{{ $epic->title }}</option>
                        @endforeach
                    </select>
                    @error('epic_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('description') border-red-500 @enderror" placeholder="Describe the feature's functionality">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- PI and Sprint -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Program Increment (PI)</label>
                    <input type="text" name="pi" value="{{ old('pi') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('pi') border-red-500 @enderror" placeholder="e.g., PI-1">
                    @error('pi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sprint</label>
                    <input type="text" name="sprint" value="{{ old('sprint') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('sprint') border-red-500 @enderror" placeholder="e.g., Sprint 1">
                    @error('sprint')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Story Points and Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Story Points</label>
                    <input type="number" name="story_points" value="{{ old('story_points') }}" min="0" max="1000" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('story_points') border-red-500 @enderror" placeholder="0">
                    @error('story_points')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('status') border-red-500 @enderror" required>
                        <option value="">Select Status</option>
                        <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Target Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Target Date</label>
                <input type="date" name="target_date" value="{{ old('target_date') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('target_date') border-red-500 @enderror">
                @error('target_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.access.features.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                            <i class="fas fa-plus mr-2"></i>
                            Create Feature
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Help -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Creating a Feature</h3>
                <div class="space-y-3 text-sm text-gray-600">
                    <div class="flex items-start">
                        <i class="fas fa-lightbulb text-yellow-500 mt-1 mr-2"></i>
                        <p>Features are system capabilities that provide value to users and support business goals.</p>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-target text-blue-500 mt-1 mr-2"></i>
                        <p>Set realistic story points and target dates to help with sprint planning and resource allocation.</p>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-cogs text-green-500 mt-1 mr-2"></i>
                        <p>PI and Sprint information help track feature delivery across program increments.</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-2">
                    <a href="{{ route('admin.access.features.index') }}" class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 text-center block">
                        <i class="fas fa-list mr-2"></i>
                        View All Features
                    </a>
                    <a href="{{ route('admin.access.epics.index') }}" class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 text-center block">
                        <i class="fas fa-layer-group mr-2"></i>
                        Manage Epics
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
