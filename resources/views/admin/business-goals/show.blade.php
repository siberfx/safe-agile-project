@extends('layouts.admin')

@section('title', 'Business Goal Details - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $businessGoal->title }}</h1>
            <p class="text-gray-600 mt-2">{{ $businessGoal->description }}</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.access.business-goals.edit', $businessGoal->id) }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                <i class="fas fa-pencil mr-2"></i>
                Edit Goal
            </a>
        </div>
    </div>

    <!-- Business Goal Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Goal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Status</label>
                        <p class="text-sm text-gray-900">{{ ucfirst($businessGoal->status) }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Quarter</label>
                        <p class="text-sm text-gray-900">{{ $businessGoal->quarter ?: 'Not set' }} {{ $businessGoal->year ?: now()->year }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Value Score</label>
                        <p class="text-sm text-gray-900">{{ $businessGoal->value_score ?: 'Not set' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Target Date</label>
                        <p class="text-sm text-gray-900">{{ $businessGoal->target_date ? $businessGoal->target_date->format('d-m-Y') : 'Not set' }}</p>
                    </div>
                </div>
            </div>

            <!-- Budget and Value -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Budget & Value</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Budget</label>
                        <p class="text-lg font-semibold text-gray-900">€{{ number_format($businessGoal->budget, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Prognose</label>
                        <p class="text-lg font-semibold text-gray-900">€{{ number_format($businessGoal->prognose, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Difference</label>
                        @php
                            $difference = $businessGoal->prognose - $businessGoal->budget;
                            $percentage = $businessGoal->budget > 0 ? ($difference / $businessGoal->budget) * 100 : 0;
                        @endphp
                        <p class="text-lg font-semibold {{ $difference >= 0 ? 'text-red-600' : 'text-green-600' }}">
                            {{ $difference >= 0 ? '+' : '' }}€{{ number_format($difference, 0, ',', '.') }}
                            ({{ $percentage >= 0 ? '+' : '' }}{{ number_format($percentage, 1) }}%)
                        </p>
                    </div>
                </div>
            </div>

            <!-- Epics -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Epics</h2>
                @if($businessGoal->epics->count() > 0)
                    <div class="space-y-3">
                        @foreach($businessGoal->epics as $epic)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">{{ $epic->title }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($epic->description, 100) }}</p>
                                    <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                                        <span>Priority: {{ ucfirst($epic->priority) }}</span>
                                        @if($epic->story_points)
                                            <span>{{ $epic->story_points }} Story Points</span>
                                        @endif
                                        @if($epic->expected_value)
                                            <span>Value: €{{ number_format($epic->expected_value, 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    @if($epic->status === 'completed') bg-green-100 text-green-800
                                    @elseif($epic->status === 'in_progress') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($epic->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No epics defined for this business goal.</p>
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
                        <span class="text-sm text-gray-600">Epics</span>
                        <span class="text-sm font-medium text-gray-900">{{ $businessGoal->epics->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Features</span>
                        <span class="text-sm font-medium text-gray-900">{{ $businessGoal->epics->sum(fn($epic) => $epic->features->count()) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">User Stories</span>
                        <span class="text-sm font-medium text-gray-900">{{ $businessGoal->epics->sum(fn($epic) => $epic->features->sum(fn($feature) => $feature->userStories->count())) }}</span>
                    </div>
                </div>
            </div>

            <!-- Program Info -->
            @if($businessGoal->program)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Program</h2>
                <div>
                    <h3 class="text-sm font-medium text-gray-900">{{ $businessGoal->program->title }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($businessGoal->program->description, 80) }}</p>
                    <a href="{{ route('admin.access.programs.show', $businessGoal->program->id) }}" class="text-primary hover:text-primary/80 text-sm font-medium mt-2 inline-block">
                        View Program →
                    </a>
                </div>
            </div>
            @endif

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions</h2>
                <div class="space-y-2">
                    <a href="{{ route('admin.access.epics.create') }}" class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 text-center block">
                        <i class="fas fa-plus mr-2"></i>
                        Add Epic
                    </a>
                    <a href="{{ route('admin.access.business-goals.edit', $businessGoal->id) }}" class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 text-center block">
                        <i class="fas fa-pencil mr-2"></i>
                        Edit Goal
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
