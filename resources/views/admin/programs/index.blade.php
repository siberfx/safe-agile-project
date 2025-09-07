@extends('layouts.admin')

@section('title', 'Programs - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Programs</h1>
            <p class="text-gray-600 mt-2">Strategic program management</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.access.programs.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                <i class="fas fa-plus mr-2"></i>
                New Program
            </a>
        </div>
    </div>

    <!-- Programs Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($programs ?? [] as $program)
        <a href="{{ route('admin.access.programs.show', $program->id) }}" class="block bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow cursor-pointer">
            <div class="p-6">
                <!-- Program Header -->
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $program->title }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($program->description, 100) }}</p>
                    </div>
                    <span class="px-3 py-1 text-xs font-medium rounded-full
                        @if($program->status === 'active') bg-green-100 text-green-800
                        @elseif($program->status === 'completed') bg-blue-100 text-blue-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($program->status) }}
                    </span>
                </div>

                <!-- Program Details -->
                <div class="space-y-3">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-user mr-2"></i>
                        <span>{{ $program->owner ?: 'No owner assigned' }}</span>
                    </div>
                    
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-calendar mr-2"></i>
                        <span>
                            {{ $program->start_date ? $program->start_date->format('d-m-Y') : 'No start date' }} - 
                            {{ $program->end_date ? $program->end_date->format('d-m-Y') : 'No end date' }}
                        </span>
                    </div>
                    
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-euro-sign mr-2"></i>
                        <span>€{{ number_format($program->business_value, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Strategic Goals -->
                @if($program->strategic_goals)
                <div class="mt-4">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Strategic Goals</h4>
                    <p class="text-sm text-gray-600">{{ Str::limit($program->strategic_goals, 120) }}</p>
                </div>
                @endif

                <!-- Stats -->
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div>
                            <p class="text-2xl font-semibold text-gray-900">{{ $program->projects->count() }}</p>
                            <p class="text-xs text-gray-500">Projects</p>
                        </div>
                        <div>
                            <p class="text-2xl font-semibold text-gray-900">{{ $program->businessGoals->count() }}</p>
                            <p class="text-xs text-gray-500">Business Goals</p>
                        </div>
                    </div>
                </div>

            </div>
        </a>
        @empty
        <div class="col-span-full">
            <div class="text-center py-12">
                <i class="fas fa-building text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No programs found</h3>
                <p class="text-gray-500 mb-6">Get started by creating your first program.</p>
                <a href="{{ route('admin.access.programs.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                    <i class="fas fa-plus mr-2"></i>
                    Create Program
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
