@extends('layouts.admin')

@section('title', 'Program Details - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $program->title }}</h1>
            <p class="text-gray-600 mt-2">{{ $program->description }}</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.access.programs.edit', $program->id) }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                <i class="fas fa-pencil mr-2"></i>
                Edit Program
            </a>
        </div>
    </div>

    <!-- Program Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Program Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Status</label>
                        <p class="text-sm text-gray-900">{{ ucfirst($program->status) }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Owner</label>
                        <p class="text-sm text-gray-900">{{ $program->owner ?: 'Not assigned' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Start Date</label>
                        <p class="text-sm text-gray-900">{{ $program->start_date ? $program->start_date->format('d-m-Y') : 'Not set' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">End Date</label>
                        <p class="text-sm text-gray-900">{{ $program->end_date ? $program->end_date->format('d-m-Y') : 'Not set' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Business Value</label>
                        <p class="text-sm text-gray-900">€{{ number_format($program->business_value, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Strategic Goals -->
            @if($program->strategic_goals)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Strategic Goals</h2>
                <p class="text-sm text-gray-700">{{ $program->strategic_goals }}</p>
            </div>
            @endif

            <!-- Business Goals -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Business Goals</h2>
                @if($program->businessGoals->count() > 0)
                    <div class="space-y-3">
                        @foreach($program->businessGoals as $goal)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">{{ $goal->title }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($goal->description, 100) }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    @if($goal->status === 'completed') bg-green-100 text-green-800
                                    @elseif($goal->status === 'in_progress') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($goal->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No business goals defined for this program.</p>
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
                        <span class="text-sm text-gray-600">Projects</span>
                        <span class="text-sm font-medium text-gray-900">{{ $program->projects->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Business Goals</span>
                        <span class="text-sm font-medium text-gray-900">{{ $program->businessGoals->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Epics</span>
                        <span class="text-sm font-medium text-gray-900">{{ $program->businessGoals->sum(fn($goal) => $goal->epics->count()) }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions</h2>
                <div class="space-y-2">
                    <a href="{{ route('admin.access.business-goals.create') }}" class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 text-center block">
                        <i class="fas fa-plus mr-2"></i>
                        Add Business Goal
                    </a>
                    <a href="{{ route('admin.access.programs.edit', $program->id) }}" class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 text-center block">
                        <i class="fas fa-pencil mr-2"></i>
                        Edit Program
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
