@extends('layouts.admin')

@section('title', 'Team Dashboard - Programma Portaal')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Team Dashboard</h1>
            <p class="text-gray-600 mt-2">Kanban board, my tasks, and test cases</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="text-sm text-gray-500">
                Welcome back, {{ auth()->user()->name }}
            </div>
        </div>
    </div>

    <!-- My Tasks Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- My Tasks -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-tasks text-blue-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">My Tasks</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $myTasks->count() }}</p>
                </div>
            </div>
        </div>

        <!-- In Progress -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-play text-yellow-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">In Progress</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $myTasks->where('kanban_status', 'in_progress')->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Ready for Test -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-vial text-purple-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Ready for Test</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $myTasks->where('kanban_status', 'review')->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Test Cases -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">My Test Cases</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $testCases->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- My Tasks -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">My Tasks</h2>
        </div>
        <div class="p-6">
            @if($myTasks->count() > 0)
                <div class="space-y-4">
                    @foreach($myTasks as $task)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $task->title }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($task->description, 100) }}</p>
                                <div class="flex items-center space-x-4 mt-2">
                                    @if($task->story_points)
                                        <span class="text-sm text-gray-500">
                                            <i class="fas fa-weight-hanging mr-1"></i>
                                            {{ $task->story_points }} pts
                                        </span>
                                    @endif
                                    @if($task->feature)
                                        <span class="text-sm text-gray-500">
                                            <i class="fas fa-puzzle-piece mr-1"></i>
                                            {{ $task->feature->title }}
                                        </span>
                                    @endif
                                    @if($task->sprint)
                                        <span class="text-sm text-gray-500">
                                            <i class="fas fa-running mr-1"></i>
                                            Sprint {{ $task->sprint->sprint_number }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="ml-4">
                                <span class="px-3 py-1 text-xs font-medium rounded-full
                                    @if($task->kanban_status === 'todo') bg-gray-100 text-gray-800
                                    @elseif($task->kanban_status === 'in_progress') bg-yellow-100 text-yellow-800
                                    @elseif($task->kanban_status === 'review') bg-purple-100 text-purple-800
                                    @elseif($task->kanban_status === 'done') bg-green-100 text-green-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $task->kanban_status)) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-tasks text-gray-300 text-4xl mb-4"></i>
                    <p class="text-gray-500">No tasks assigned to you</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Test Cases -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">My Test Cases</h2>
        </div>
        <div class="p-6">
            @if($testCases->count() > 0)
                <div class="space-y-4">
                    @foreach($testCases as $testCase)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $testCase->title }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($testCase->description, 100) }}</p>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-700"><strong>Expected:</strong> {{ Str::limit($testCase->expected_result, 80) }}</p>
                                    @if($testCase->actual_result)
                                        <p class="text-sm text-gray-700 mt-1"><strong>Actual:</strong> {{ Str::limit($testCase->actual_result, 80) }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="ml-4">
                                <span class="px-3 py-1 text-xs font-medium rounded-full
                                    @if($testCase->status === 'pass') bg-green-100 text-green-800
                                    @elseif($testCase->status === 'fail') bg-red-100 text-red-800
                                    @elseif($testCase->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($testCase->status === 'blocked') bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($testCase->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-vial text-gray-300 text-4xl mb-4"></i>
                    <p class="text-gray-500">No test cases assigned to you</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
