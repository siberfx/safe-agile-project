@extends('layouts.admin')

@section('title', 'Projects - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Projects</h1>
            <p class="text-gray-600 mt-2">Project management and tracking</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.access.projects.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                <i class="fas fa-plus mr-2"></i>
                New Project
            </a>
        </div>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($projects ?? [] as $project)
        <a href="{{ route('admin.access.projects.show', $project->id) }}" class="block bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow cursor-pointer">
            <div class="p-6">
                <!-- Project Header -->
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $project->name }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($project->description, 100) }}</p>
                    </div>
                    <span class="px-3 py-1 text-xs font-medium rounded-full
                        @if($project->status === 'active') bg-green-100 text-green-800
                        @elseif($project->status === 'completed') bg-blue-100 text-blue-800
                        @elseif($project->status === 'inactive') bg-yellow-100 text-yellow-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($project->status) }}
                    </span>
                </div>

                <!-- Project Details -->
                <div class="space-y-3">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-user mr-2"></i>
                        <span>{{ $project->createdBy->name ?? 'No creator assigned' }}</span>
                    </div>
                    
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-calendar mr-2"></i>
                        <span>
                            {{ $project->start_date ? $project->start_date->format('d-m-Y') : 'No start date' }} - 
                            {{ $project->end_date ? $project->end_date->format('d-m-Y') : 'No end date' }}
                        </span>
                    </div>
                    
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-folder mr-2"></i>
                        <span>{{ $project->program->name ?? 'Independent Project' }}</span>
                    </div>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-full">
            <div class="text-center py-12">
                <i class="fas fa-folder-open text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No projects found</h3>
                <p class="text-gray-600 mb-6">Get started by creating your first project.</p>
                <a href="{{ route('admin.access.projects.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                    <i class="fas fa-plus mr-2"></i>
                    Create Project
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection