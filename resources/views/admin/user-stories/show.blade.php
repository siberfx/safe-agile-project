@extends('layouts.admin')

@section('title', 'User Story Details - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $userStory->title }}</h1>
            <p class="text-gray-600 mt-2">{{ $userStory->description }}</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.access.user-stories.edit', $userStory->id) }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                <i class="fas fa-pencil mr-2"></i>
                Edit User Story
            </a>
        </div>
    </div>

    <!-- User Story Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">User Story Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Agile Status</label>
                        <p class="text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $userStory->agile_status)) }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Priority</label>
                        <p class="text-sm text-gray-900">{{ ucfirst($userStory->priority) }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Story Points</label>
                        <p class="text-sm text-gray-900">{{ $userStory->story_points ?: 'Not set' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Assigned To</label>
                        <p class="text-sm text-gray-900">{{ $userStory->assignedTo ? $userStory->assignedTo->name : 'Unassigned' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Due Date</label>
                        <p class="text-sm text-gray-900">{{ $userStory->due_date ? $userStory->due_date->format('d-m-Y') : 'Not set' }}</p>
                    </div>
                </div>
            </div>

            <!-- Feature -->
            @if($userStory->feature)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Feature</h2>
                <div>
                    <h3 class="text-sm font-medium text-gray-900">{{ $userStory->feature->title }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($userStory->feature->description, 150) }}</p>
                    <a href="{{ route('admin.access.features.show', $userStory->feature->id) }}" class="text-primary hover:text-primary/80 text-sm font-medium mt-2 inline-block">
                        View Feature →
                    </a>
                </div>
            </div>
            @endif

            <!-- Sprint -->
            @if($userStory->sprint)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Sprint</h2>
                <div>
                    <h3 class="text-sm font-medium text-gray-900">{{ $userStory->sprint->name }}</h3>
                    <p class="text-sm text-gray-600 mt-1">Sprint #{{ $userStory->sprint->sprint_number }}</p>
                    <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                        <span>Start: {{ $userStory->sprint->start_date ? $userStory->sprint->start_date->format('d-m-Y') : 'N/A' }}</span>
                        <span>End: {{ $userStory->sprint->end_date ? $userStory->sprint->end_date->format('d-m-Y') : 'N/A' }}</span>
                    </div>
                    <a href="{{ route('admin.access.sprints.show', $userStory->sprint->id) }}" class="text-primary hover:text-primary/80 text-sm font-medium mt-2 inline-block">
                        View Sprint →
                    </a>
                </div>
            </div>
            @endif

            <!-- Acceptance Criteria -->
            @if($userStory->acceptance_criteria)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Acceptance Criteria</h2>
                <p class="text-sm text-gray-700">{{ $userStory->acceptance_criteria }}</p>
            </div>
            @endif

            <!-- Test Cases -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Test Cases</h2>
                @if($userStory->testCases->count() > 0)
                    <div class="space-y-3">
                        @foreach($userStory->testCases as $testCase)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">{{ $testCase->title }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($testCase->description, 100) }}</p>
                                    <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                                        @if($testCase->tester)
                                            <span>Tester: {{ $testCase->tester->name }}</span>
                                        @endif
                                        @if($testCase->test_date)
                                            <span>Test Date: {{ $testCase->test_date->format('d-m-Y') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    @if($testCase->status === 'pass') bg-green-100 text-green-800
                                    @elseif($testCase->status === 'fail') bg-red-100 text-red-800
                                    @elseif($testCase->status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($testCase->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No test cases defined for this user story.</p>
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
                        <span class="text-sm text-gray-600">Test Cases</span>
                        <span class="text-sm font-medium text-gray-900">{{ $userStory->testCases->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Bugs</span>
                        <span class="text-sm font-medium text-gray-900">{{ $userStory->bugs->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions</h2>
                <div class="space-y-2">
                    <a href="{{ route('admin.access.testing.create') }}" class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 text-center block">
                        <i class="fas fa-plus mr-2"></i>
                        Add Test Case
                    </a>
                    <a href="{{ route('admin.access.user-stories.edit', $userStory->id) }}" class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 text-center block">
                        <i class="fas fa-pencil mr-2"></i>
                        Edit User Story
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
