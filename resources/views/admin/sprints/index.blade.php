@extends('layouts.admin')

@section('title', 'Sprints - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Sprints</h1>
            <p class="text-gray-600 mt-2">Agile sprint management and planning</p>
        </div>
        <div class="flex items-center space-x-4">
            <button class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                <i class="fas fa-plus mr-2"></i>
                New Sprint
            </button>
        </div>
    </div>

    <!-- Sprints List -->
    <div class="space-y-4">
        @forelse($sprints ?? [] as $sprint)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="p-6">
                <!-- Sprint Header -->
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $sprint->name }} (Sprint #{{ $sprint->sprint_number }})</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($sprint->goals, 150) }}</p>
                    </div>
                    <span class="px-3 py-1 text-xs font-medium rounded-full
                        @if($sprint->status === 'completed') bg-green-100 text-green-800
                        @elseif($sprint->status === 'active') bg-yellow-100 text-yellow-800
                        @elseif($sprint->status === 'planned') bg-blue-100 text-blue-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($sprint->status) }}
                    </span>
                </div>

                <!-- Sprint Details -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-4">
                    <div class="text-center">
                        <div class="text-2xl font-semibold text-gray-900">{{ $sprint->start_date ? $sprint->start_date->format('d/m') : 'N/A' }}</div>
                        <div class="text-xs text-gray-500">Start Date</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-semibold text-gray-900">{{ $sprint->end_date ? $sprint->end_date->format('d/m') : 'N/A' }}</div>
                        <div class="text-xs text-gray-500">End Date</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-semibold text-gray-900">{{ $sprint->completed_story_points }}/{{ $sprint->planned_story_points }}</div>
                        <div class="text-xs text-gray-500">Story Points</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-semibold text-gray-900">{{ $sprint->completion_percentage }}%</div>
                        <div class="text-xs text-gray-500">Complete</div>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                    <div class="bg-primary h-2.5 rounded-full" style="width: {{ $sprint->completion_percentage }}%"></div>
                </div>

                <!-- User Stories Count -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-tasks mr-2"></i>
                        <span>{{ $sprint->userStories->count() }} User Stories</span>
                    </div>
                    <a href="{{ route('admin.access.sprints.show', $sprint->id) }}" class="text-primary hover:text-primary/80 text-sm font-medium">
                        View Details →
                    </a>
                </div>

                <!-- Actions -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex space-x-2">
                        <button class="text-gray-400 hover:text-gray-600" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="text-gray-400 hover:text-gray-600" title="Edit">
                            <i class="fas fa-pencil"></i>
                        </button>
                        <button class="text-gray-400 hover:text-red-600" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-12">
            <i class="fas fa-running text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No sprints found</h3>
            <p class="text-gray-500 mb-6">Create your first sprint to get started.</p>
            <button class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                <i class="fas fa-plus mr-2"></i>
                Create Sprint
            </button>
        </div>
        @endforelse
    </div>
</div>
@endsection
