@extends('layouts.admin')

@section('title', 'Features - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Features</h1>
            <p class="text-gray-600 mt-2">System capabilities and functionality</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.access.features.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                <i class="fas fa-plus mr-2"></i>
                New Feature
            </a>
        </div>
    </div>

    <!-- Features Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($features ?? [] as $feature)
        <a href="{{ route('admin.access.features.show', $feature->id) }}" class="block bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow cursor-pointer">
            <div class="p-6">
                <!-- Feature Header -->
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $feature->title }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($feature->description, 100) }}</p>
                    </div>
                    <span class="px-3 py-1 text-xs font-medium rounded-full
                        @if($feature->status === 'completed') bg-green-100 text-green-800
                        @elseif($feature->status === 'in_progress') bg-yellow-100 text-yellow-800
                        @elseif($feature->status === 'draft') bg-gray-100 text-gray-800
                        @else bg-red-100 text-red-800 @endif">
                        @if($feature->status === 'in_progress')
                            In Progress
                        @else
                            {{ ucfirst($feature->status) }}
                        @endif
                    </span>
                </div>

                <!-- Feature Details -->
                <div class="space-y-3">
                    @if($feature->epic)
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-layer-group mr-2"></i>
                        <span>{{ $feature->epic->title }}</span>
                    </div>
                    @endif
                    
                    @if($feature->pi)
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-calendar mr-2"></i>
                        <span>PI: {{ $feature->pi }}</span>
                    </div>
                    @endif
                    
                    @if($feature->sprint)
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-running mr-2"></i>
                        <span>Sprint: {{ $feature->sprint }}</span>
                    </div>
                    @endif
                    
                    @if($feature->story_points)
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-weight-hanging mr-2"></i>
                        <span>{{ $feature->story_points }} Story Points</span>
                    </div>
                    @endif
                </div>

                <!-- User Stories Count -->
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-tasks mr-2"></i>
                        <span>{{ $feature->userStories->count() }} User Stories</span>
                    </div>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-full">
            <div class="text-center py-12">
                <i class="fas fa-puzzle-piece text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No features found</h3>
                <p class="text-gray-500 mb-6">Create your first feature to get started.</p>
                <a href="{{ route('admin.access.features.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                    <i class="fas fa-plus mr-2"></i>
                    Create Feature
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
