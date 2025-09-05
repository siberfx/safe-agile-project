@extends('layouts.admin')

@section('title', 'Edit User Story - Programma Portaal')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-900">Edit User Story</h1>
            <p class="text-gray-600 mt-1">Update user story information</p>
        </div>
        
        <form class="p-6 space-y-6">
            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" value="{{ $userStory->title ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="User story title">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Feature</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Select Feature</option>
                        @foreach($features as $feature)
                            <option value="{{ $feature->id }}" {{ ($userStory->feature_id ?? '') == $feature->id ? 'selected' : '' }}>{{ $feature->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                <textarea rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="As a [user], I want [functionality] so that [benefit]">{{ $userStory->description ?? '' }}</textarea>
            </div>

            <!-- Sprint and Assignment -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sprint</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Select Sprint</option>
                        @foreach($sprints as $sprint)
                            <option value="{{ $sprint->id }}" {{ ($userStory->sprint_id ?? '') == $sprint->id ? 'selected' : '' }}>{{ $sprint->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Assigned To</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Select User</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ ($userStory->assigned_to ?? '') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Story Points and Status -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Story Points</label>
                    <input type="number" value="{{ $userStory->story_points ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="0">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="low" {{ ($userStory->priority ?? '') === 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ ($userStory->priority ?? '') === 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ ($userStory->priority ?? '') === 'high' ? 'selected' : '' }}>High</option>
                        <option value="critical" {{ ($userStory->priority ?? '') === 'critical' ? 'selected' : '' }}>Critical</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Agile Status</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="to_do" {{ ($userStory->agile_status ?? '') === 'to_do' ? 'selected' : '' }}>To Do</option>
                        <option value="in_progress" {{ ($userStory->agile_status ?? '') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="ready_for_test" {{ ($userStory->agile_status ?? '') === 'ready_for_test' ? 'selected' : '' }}>Ready for Test</option>
                        <option value="approved" {{ ($userStory->agile_status ?? '') === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="done" {{ ($userStory->agile_status ?? '') === 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                </div>
            </div>

            <!-- Acceptance Criteria -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Acceptance Criteria</label>
                <textarea rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Define the acceptance criteria for this user story">{{ $userStory->acceptance_criteria ?? '' }}</textarea>
            </div>

            <!-- Due Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Due Date</label>
                <input type="date" value="{{ $userStory->due_date ? $userStory->due_date->format('Y-m-d') : '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.access.user-stories.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                    Update User Story
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
