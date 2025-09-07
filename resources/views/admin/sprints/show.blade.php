@extends('layouts.admin')

@section('title', 'Sprint Details - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $sprint->name }}</h1>
            <p class="text-gray-600 mt-2">Sprint #{{ $sprint->sprint_number }}</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.access.sprints.edit', $sprint->id) }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                <i class="fas fa-pencil mr-2"></i>
                Edit Sprint
            </a>
        </div>
    </div>

    <!-- Sprint Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Sprint Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Status</label>
                        <p class="text-sm text-gray-900">{{ ucfirst($sprint->status) }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Project</label>
                        <p class="text-sm text-gray-900">{{ $sprint->project ? $sprint->project->name : 'Not assigned' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Start Date</label>
                        <p class="text-sm text-gray-900">{{ $sprint->start_date ? $sprint->start_date->format('d-m-Y') : 'Not set' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">End Date</label>
                        <p class="text-sm text-gray-900">{{ $sprint->end_date ? $sprint->end_date->format('d-m-Y') : 'Not set' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Duration</label>
                        <p class="text-sm text-gray-900">
                            @if($sprint->start_date && $sprint->end_date)
                                {{ $sprint->start_date->diffInDays($sprint->end_date) }} days
                            @else
                                Not set
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sprint Goals -->
            @if($sprint->goals)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Sprint Goals</h2>
                <p class="text-sm text-gray-700">{{ $sprint->goals }}</p>
            </div>
            @endif

            <!-- Story Points Progress -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Story Points Progress</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div class="text-center">
                        <div class="text-2xl font-semibold text-gray-900">{{ $sprint->planned_story_points }}</div>
                        <div class="text-xs text-gray-500">Planned</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-semibold text-gray-900">{{ $sprint->completed_story_points }}</div>
                        <div class="text-xs text-gray-500">Completed</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-semibold text-gray-900">{{ $sprint->completion_percentage }}%</div>
                        <div class="text-xs text-gray-500">Complete</div>
                    </div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-primary h-2.5 rounded-full" style="width: {{ $sprint->completion_percentage }}%"></div>
                </div>
            </div>

            <!-- User Stories -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">User Stories</h2>
                @if($sprint->userStories->count() > 0)
                    <div class="space-y-3">
                        @foreach($sprint->userStories as $story)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">{{ $story->title }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($story->description, 100) }}</p>
                                    <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                                        @if($story->story_points)
                                            <span>{{ $story->story_points }} Story Points</span>
                                        @endif
                                        @if($story->feature)
                                            <span>Feature: {{ $story->feature->title }}</span>
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
                    <p class="text-gray-500">No user stories assigned to this sprint.</p>
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
                        <span class="text-sm font-medium text-gray-900">{{ $sprint->userStories->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Bugs</span>
                        <span class="text-sm font-medium text-gray-900">{{ $sprint->bugs->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Velocity</span>
                        <span class="text-sm font-medium text-gray-900">{{ $sprint->completed_story_points }}</span>
                    </div>
                </div>
            </div>

            <!-- Project Info -->
            @if($sprint->project)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Project</h2>
                <div>
                    <h3 class="text-sm font-medium text-gray-900">{{ $sprint->project->name }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($sprint->project->description, 80) }}</p>
                    <a href="{{ route('admin.access.projects.show', $sprint->project->id) }}" class="text-primary hover:text-primary/80 text-sm font-medium mt-2 inline-block">
                        View Project →
                    </a>
                </div>
            </div>
            @endif

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions</h2>
                <div class="space-y-2">
                    <a href="{{ route('admin.access.user-stories.create') }}" class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 text-center block">
                        <i class="fas fa-plus mr-2"></i>
                        Add User Story
                    </a>
                    <a href="{{ route('admin.access.sprints.edit', $sprint->id) }}" class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 text-center block">
                        <i class="fas fa-pencil mr-2"></i>
                        Edit Sprint
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
