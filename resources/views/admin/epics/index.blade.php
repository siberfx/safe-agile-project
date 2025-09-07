@extends('layouts.admin')

@section('title', 'Epics - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Epics</h1>
            <p class="text-gray-600 mt-2">Large-scale initiatives and capabilities</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.access.epics.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                <i class="fas fa-plus mr-2"></i>
                New Epic
            </a>
        </div>
    </div>

    <!-- Epics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($epics ?? [] as $epic)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="p-6">
                <!-- Epic Header -->
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $epic->title }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($epic->description, 100) }}</p>
                    </div>
                    <span class="px-3 py-1 text-xs font-medium rounded-full
                        @if($epic->status === 'completed') bg-green-100 text-green-800
                        @elseif($epic->status === 'in_progress') bg-yellow-100 text-yellow-800
                        @elseif($epic->status === 'draft') bg-gray-100 text-gray-800
                        @else bg-red-100 text-red-800 @endif">
                        @if($epic->status === 'in_progress')
                            In Progress
                        @else
                            {{ ucfirst($epic->status) }}
                        @endif
                    </span>
                </div>

                <!-- Epic Details -->
                <div class="space-y-3">
                    @if($epic->businessGoal)
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-bullseye mr-2"></i>
                        <span>{{ $epic->businessGoal->title }}</span>
                    </div>
                    @endif
                    
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-star mr-2"></i>
                        <span>Priority: {{ ucfirst($epic->priority) }}</span>
                    </div>
                    
                    @if($epic->expected_value)
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-euro-sign mr-2"></i>
                        <span>Value: €{{ number_format($epic->expected_value, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    
                    @if($epic->story_points)
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-weight-hanging mr-2"></i>
                        <span>{{ $epic->story_points }} Story Points</span>
                    </div>
                    @endif
                </div>

                <!-- Features Count -->
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-puzzle-piece mr-2"></i>
                            <span>{{ $epic->features->count() }} Features</span>
                        </div>
                        <a href="{{ route('admin.access.epics.show', $epic->id) }}" class="text-primary hover:text-primary/80 text-sm font-medium">
                            View Details →
                        </a>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.access.epics.show', $epic->id) }}" class="text-gray-400 hover:text-gray-600" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.access.epics.edit', $epic->id) }}" class="text-gray-400 hover:text-gray-600" title="Edit">
                            <i class="fas fa-pencil"></i>
                        </a>
                        <form action="{{ route('admin.access.epics.destroy', $epic->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this epic?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-600" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full">
            <div class="text-center py-12">
                <i class="fas fa-layer-group text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No epics found</h3>
                <p class="text-gray-500 mb-6">Create your first epic to get started.</p>
                <a href="{{ route('admin.access.epics.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                    <i class="fas fa-plus mr-2"></i>
                    Create Epic
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
