@extends('layouts.admin')

@section('title', 'Feature Details - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $feature->title }}</h1>
            <p class="text-gray-600 mt-2">{{ $feature->description }}</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.access.features.edit', $feature->id) }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                <i class="fas fa-pencil mr-2"></i>
                Edit Feature
            </a>
        </div>
    </div>

    <!-- Feature Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Feature Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Status</label>
                        <p class="text-sm text-gray-900">{{ ucfirst($feature->status) }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Story Points</label>
                        <p class="text-sm text-gray-900">{{ $feature->story_points ?: 'Not set' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Program Increment</label>
                        <p class="text-sm text-gray-900">{{ $feature->pi ?: 'Not set' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Sprint</label>
                        <p class="text-sm text-gray-900">{{ $feature->sprint ?: 'Not set' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Target Date</label>
                        <p class="text-sm text-gray-900">{{ $feature->target_date ? $feature->target_date->format('d-m-Y') : 'Not set' }}</p>
                    </div>
                </div>
            </div>

            <!-- Epic -->
            @if($feature->epic)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Epic</h2>
                <div>
                    <h3 class="text-sm font-medium text-gray-900">{{ $feature->epic->title }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($feature->epic->description, 150) }}</p>
                    <a href="{{ route('admin.access.epics.show', $feature->epic->id) }}" class="text-primary hover:text-primary/80 text-sm font-medium mt-2 inline-block">
                        View Epic →
                    </a>
                </div>
            </div>
            @endif

            <!-- User Stories -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">User Stories</h2>
                @if($feature->userStories->count() > 0)
                    <div class="space-y-3">
                        @foreach($feature->userStories as $story)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">{{ $story->title }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($story->description, 100) }}</p>
                                    <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                                        @if($story->story_points)
                                            <span>{{ $story->story_points }} Story Points</span>
                                        @endif
                                        @if($story->sprint)
                                            <span>Sprint: {{ $story->sprint->name }}</span>
                                        @endif
                                        @if($story->assignedTo)
                                            <span>Assigned to: {{ $story->assignedTo->name }}</span>
                                        @endif
                                    </div>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    @if($story->kanban_status === 'done') bg-green-100 text-green-800
                                    @elseif($story->kanban_status === 'in_progress') bg-yellow-100 text-yellow-800
                                    @elseif($story->kanban_status === 'review') bg-purple-100 text-purple-800
                                    @elseif($story->kanban_status === 'todo') bg-gray-100 text-gray-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $story->kanban_status)) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No user stories defined for this feature.</p>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Stats -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Stats</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">User Stories</span>
                        <span class="text-sm font-medium text-gray-900">{{ $feature->userStories->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Test Cases</span>
                        <span class="text-sm font-medium text-gray-900">{{ $feature->testCases->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Bugs</span>
                        <span class="text-sm font-medium text-gray-900">{{ $feature->bugs->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions</h2>
                <div class="space-y-2">
                    <a href="{{ route('admin.access.user-stories.create') }}" class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 text-center block">
                        <i class="fas fa-plus mr-2"></i>
                        Add User Story
                    </a>
                    <a href="{{ route('admin.access.features.edit', $feature->id) }}" class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 text-center block">
                        <i class="fas fa-pencil mr-2"></i>
                        Edit Feature
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
