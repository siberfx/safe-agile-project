@extends('layouts.admin')

@section('title', 'Project Manager Dashboard - Programma Portaal')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Project Manager Dashboard</h1>
            <p class="text-gray-600 mt-2">Sprint board, velocity charts, and operational overview</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="text-sm text-gray-500">
                Last updated: {{ now()->format('d-m-Y H:i') }}
            </div>
        </div>
    </div>

    <!-- Sprint Status Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Active Sprint -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-running text-blue-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Active Sprint</p>
                    <p class="text-2xl font-semibold text-gray-900">
                        @if($activeSprint)
                            Sprint {{ $activeSprint->sprint_number }}
                        @else
                            None
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Total Sprints -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-week text-green-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Sprints</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $sprints->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Completed Sprints -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-purple-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Completed</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $sprints->where('status', 'completed')->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Open Bugs -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-bug text-red-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Open Bugs</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $bugs->whereIn('status', ['new', 'in_progress'])->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Sprint Details -->
    @if($activeSprint)
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Active Sprint: {{ $activeSprint->name }}</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Sprint Info -->
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Sprint Information</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Duration:</span>
                            <span class="text-sm font-medium">{{ $activeSprint->start_date->format('d-m-Y') }} - {{ $activeSprint->end_date->format('d-m-Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Planned Points:</span>
                            <span class="text-sm font-medium">{{ $activeSprint->planned_story_points }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Completed Points:</span>
                            <span class="text-sm font-medium">{{ $activeSprint->completed_story_points }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Progress:</span>
                            <span class="text-sm font-medium">{{ $activeSprint->completion_percentage }}%</span>
                        </div>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Sprint Progress</h3>
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="bg-blue-600 h-4 rounded-full" style="width: {{ $activeSprint->completion_percentage }}%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">{{ $activeSprint->completion_percentage }}% completed</p>
                </div>

                <!-- Sprint Goals -->
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Sprint Goals</h3>
                    <p class="text-sm text-gray-600">{{ $activeSprint->goals ?: 'No goals defined' }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Recent Sprints -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Recent Sprints</h2>
        </div>
        <div class="p-6">
            @if($sprints->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sprint</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Story Points</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($sprints->take(5) as $sprint)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $sprint->name }}</div>
                                    <div class="text-sm text-gray-500">Sprint #{{ $sprint->sprint_number }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full
                                        @if($sprint->status === 'active') bg-blue-100 text-blue-800
                                        @elseif($sprint->status === 'completed') bg-green-100 text-green-800
                                        @elseif($sprint->status === 'planning') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($sprint->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $sprint->start_date->format('d-m-Y') }} - {{ $sprint->end_date->format('d-m-Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $sprint->completed_story_points }} / {{ $sprint->planned_story_points }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $sprint->completion_percentage }}%"></div>
                                        </div>
                                        <span class="text-sm text-gray-600">{{ $sprint->completion_percentage }}%</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-calendar-week text-gray-300 text-4xl mb-4"></i>
                    <p class="text-gray-500">No sprints found</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Bugs Overview -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Recent Bugs</h2>
        </div>
        <div class="p-6">
            @if($bugs->count() > 0)
                <div class="space-y-3">
                    @foreach($bugs->take(5) as $bug)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-900">{{ $bug->title }}</h4>
                            <p class="text-xs text-gray-600 mt-1">{{ Str::limit($bug->description, 80) }}</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                @if($bug->priority === 'critical') bg-red-100 text-red-800
                                @elseif($bug->priority === 'high') bg-orange-100 text-orange-800
                                @elseif($bug->priority === 'medium') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($bug->priority) }}
                            </span>
                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                @if($bug->status === 'new') bg-blue-100 text-blue-800
                                @elseif($bug->status === 'in_progress') bg-yellow-100 text-yellow-800
                                @elseif($bug->status === 'resolved') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($bug->status) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-bug text-gray-300 text-4xl mb-4"></i>
                    <p class="text-gray-500">No bugs found</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
