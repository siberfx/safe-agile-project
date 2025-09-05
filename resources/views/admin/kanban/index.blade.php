@extends('layouts.admin')

@section('title', 'Kanban Board - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Kanban Board</h1>
            <p class="text-gray-600 mt-2">User Stories workflow management</p>
        </div>
        <div class="flex items-center space-x-4">
            <button class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                <i class="fas fa-plus mr-2"></i>
                New Story
            </button>
        </div>
    </div>

    <!-- Kanban Columns -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
        <!-- To Do Column -->
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">To Do</h2>
                <span class="bg-gray-200 text-gray-700 text-xs font-medium px-2 py-1 rounded-full">
                    {{ $toDoStories->count() }}
                </span>
            </div>
            <div class="space-y-3">
                @foreach($toDoStories as $story)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-move">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-sm font-medium text-gray-900">{{ $story->title }}</h3>
                        @if($story->story_points)
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">
                                {{ $story->story_points }} pts
                            </span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-600 mb-3">{{ Str::limit($story->description, 80) }}</p>
                    
                    @if($story->feature)
                        <div class="text-xs text-gray-500 mb-2">
                            <i class="fas fa-puzzle-piece mr-1"></i>
                            {{ $story->feature->title }}
                        </div>
                    @endif
                    
                    @if($story->sprint)
                        <div class="text-xs text-gray-500 mb-2">
                            <i class="fas fa-running mr-1"></i>
                            Sprint {{ $story->sprint->sprint_number }}
                        </div>
                    @endif
                    
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-1">
                            <button class="text-gray-400 hover:text-gray-600" title="Edit">
                                <i class="fas fa-pencil text-xs"></i>
                            </button>
                            <button class="text-gray-400 hover:text-gray-600" title="View">
                                <i class="fas fa-eye text-xs"></i>
                            </button>
                        </div>
                        <button class="text-blue-600 hover:text-blue-800 text-xs font-medium">
                            Start →
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- In Progress Column -->
        <div class="bg-yellow-50 rounded-lg p-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">In Progress</h2>
                <span class="bg-yellow-200 text-yellow-700 text-xs font-medium px-2 py-1 rounded-full">
                    {{ $inProgressStories->count() }}
                </span>
            </div>
            <div class="space-y-3">
                @foreach($inProgressStories as $story)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-move">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-sm font-medium text-gray-900">{{ $story->title }}</h3>
                        @if($story->story_points)
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded-full">
                                {{ $story->story_points }} pts
                            </span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-600 mb-3">{{ Str::limit($story->description, 80) }}</p>
                    
                    @if($story->feature)
                        <div class="text-xs text-gray-500 mb-2">
                            <i class="fas fa-puzzle-piece mr-1"></i>
                            {{ $story->feature->title }}
                        </div>
                    @endif
                    
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-1">
                            <button class="text-gray-400 hover:text-gray-600" title="Edit">
                                <i class="fas fa-pencil text-xs"></i>
                            </button>
                            <button class="text-gray-400 hover:text-gray-600" title="View">
                                <i class="fas fa-eye text-xs"></i>
                            </button>
                        </div>
                        <button class="text-purple-600 hover:text-purple-800 text-xs font-medium">
                            Ready for Test →
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Ready for Test Column -->
        <div class="bg-purple-50 rounded-lg p-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Ready for Test</h2>
                <span class="bg-purple-200 text-purple-700 text-xs font-medium px-2 py-1 rounded-full">
                    {{ $readyForTestStories->count() }}
                </span>
            </div>
            <div class="space-y-3">
                @foreach($readyForTestStories as $story)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-move">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-sm font-medium text-gray-900">{{ $story->title }}</h3>
                        @if($story->story_points)
                            <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2 py-1 rounded-full">
                                {{ $story->story_points }} pts
                            </span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-600 mb-3">{{ Str::limit($story->description, 80) }}</p>
                    
                    @if($story->feature)
                        <div class="text-xs text-gray-500 mb-2">
                            <i class="fas fa-puzzle-piece mr-1"></i>
                            {{ $story->feature->title }}
                        </div>
                    @endif
                    
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-1">
                            <button class="text-gray-400 hover:text-gray-600" title="Edit">
                                <i class="fas fa-pencil text-xs"></i>
                            </button>
                            <button class="text-gray-400 hover:text-gray-600" title="View">
                                <i class="fas fa-eye text-xs"></i>
                            </button>
                        </div>
                        <button class="text-blue-600 hover:text-blue-800 text-xs font-medium">
                            Approve →
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Approved Column -->
        <div class="bg-blue-50 rounded-lg p-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Approved</h2>
                <span class="bg-blue-200 text-blue-700 text-xs font-medium px-2 py-1 rounded-full">
                    {{ $approvedStories->count() }}
                </span>
            </div>
            <div class="space-y-3">
                @foreach($approvedStories as $story)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-move">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-sm font-medium text-gray-900">{{ $story->title }}</h3>
                        @if($story->story_points)
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">
                                {{ $story->story_points }} pts
                            </span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-600 mb-3">{{ Str::limit($story->description, 80) }}</p>
                    
                    @if($story->feature)
                        <div class="text-xs text-gray-500 mb-2">
                            <i class="fas fa-puzzle-piece mr-1"></i>
                            {{ $story->feature->title }}
                        </div>
                    @endif
                    
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-1">
                            <button class="text-gray-400 hover:text-gray-600" title="Edit">
                                <i class="fas fa-pencil text-xs"></i>
                            </button>
                            <button class="text-gray-400 hover:text-gray-600" title="View">
                                <i class="fas fa-eye text-xs"></i>
                            </button>
                        </div>
                        <button class="text-green-600 hover:text-green-800 text-xs font-medium">
                            Done ✓
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Done Column -->
        <div class="bg-green-50 rounded-lg p-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Done</h2>
                <span class="bg-green-200 text-green-700 text-xs font-medium px-2 py-1 rounded-full">
                    {{ $doneStories->count() }}
                </span>
            </div>
            <div class="space-y-3">
                @foreach($doneStories as $story)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-sm font-medium text-gray-900 line-through">{{ $story->title }}</h3>
                        @if($story->story_points)
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">
                                {{ $story->story_points }} pts
                            </span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-600 mb-3">{{ Str::limit($story->description, 80) }}</p>
                    
                    @if($story->feature)
                        <div class="text-xs text-gray-500 mb-2">
                            <i class="fas fa-puzzle-piece mr-1"></i>
                            {{ $story->feature->title }}
                        </div>
                    @endif
                    
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-1">
                            <button class="text-gray-400 hover:text-gray-600" title="View">
                                <i class="fas fa-eye text-xs"></i>
                            </button>
                        </div>
                        <span class="text-green-600 text-xs font-medium">
                            <i class="fas fa-check-circle mr-1"></i>
                            Completed
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Simple drag and drop functionality (basic implementation)
document.addEventListener('DOMContentLoaded', function() {
    // This would be implemented with a proper drag and drop library
    // like Sortable.js or similar for production use
    console.log('Kanban board loaded');
});
</script>
@endpush
@endsection
