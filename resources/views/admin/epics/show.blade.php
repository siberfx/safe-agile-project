@extends('layouts.admin')

@section('title', 'Epic Details - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $epic->title }}</h1>
            <p class="text-gray-600 mt-2">{{ $epic->description }}</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.access.epics.edit', $epic->id) }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                <i class="fas fa-pencil mr-2"></i>
                Edit Epic
            </a>
        </div>
    </div>

    <!-- Epic Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Epic Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Status</label>
                        <p class="text-sm text-gray-900">{{ ucfirst($epic->status) }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Priority</label>
                        <p class="text-sm text-gray-900">{{ ucfirst($epic->priority) }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Story Points</label>
                        <p class="text-sm text-gray-900">{{ $epic->story_points ?: 'Not set' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Expected Value</label>
                        <p class="text-sm text-gray-900">{{ $epic->expected_value ? '€' . number_format($epic->expected_value, 0, ',', '.') : 'Not set' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Target Date</label>
                        <p class="text-sm text-gray-900">{{ $epic->target_date ? $epic->target_date->format('d-m-Y') : 'Not set' }}</p>
                    </div>
                </div>
            </div>

            <!-- Business Goal -->
            @if($epic->businessGoal)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Business Goal</h2>
                <div>
                    <h3 class="text-sm font-medium text-gray-900">{{ $epic->businessGoal->title }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($epic->businessGoal->description, 150) }}</p>
                    <a href="{{ route('admin.access.business-goals.show', $epic->businessGoal->id) }}" class="text-primary hover:text-primary/80 text-sm font-medium mt-2 inline-block">
                        View Business Goal →
                    </a>
                </div>
            </div>
            @endif

            <!-- Features -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Features</h2>
                @if($epic->features->count() > 0)
                    <div class="space-y-3">
                        @foreach($epic->features as $feature)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">{{ $feature->title }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($feature->description, 100) }}</p>
                                    <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                                        @if($feature->pi)
                                            <span>PI: {{ $feature->pi }}</span>
                                        @endif
                                        @if($feature->sprint)
                                            <span>Sprint: {{ $feature->sprint }}</span>
                                        @endif
                                        @if($feature->story_points)
                                            <span>{{ $feature->story_points }} Story Points</span>
                                        @endif
                                    </div>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    @if($feature->status === 'completed') bg-green-100 text-green-800
                                    @elseif($feature->status === 'in_progress') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($feature->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No features defined for this epic.</p>
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
                        <span class="text-sm text-gray-600">Features</span>
                        <span class="text-sm font-medium text-gray-900">{{ $epic->features->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">User Stories</span>
                        <span class="text-sm font-medium text-gray-900">{{ $epic->userStories->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Total Story Points</span>
                        <span class="text-sm font-medium text-gray-900">{{ $epic->features->sum('story_points') }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions</h2>
                <div class="space-y-2">
                    <a href="{{ route('admin.access.features.create') }}" class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 text-center block">
                        <i class="fas fa-plus mr-2"></i>
                        Add Feature
                    </a>
                    <a href="{{ route('admin.access.epics.edit', $epic->id) }}" class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 text-center block">
                        <i class="fas fa-pencil mr-2"></i>
                        Edit Epic
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
