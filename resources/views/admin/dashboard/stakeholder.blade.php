@extends('layouts.admin')

@section('title', 'Stakeholder Dashboard - Programma Portaal')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Stakeholder Dashboard</h1>
            <p class="text-gray-600 mt-2">High-level KPIs and roadmap overview</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="text-sm text-gray-500">
                Last updated: {{ now()->format('d-m-Y H:i') }}
            </div>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Programs -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-building text-blue-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Programs</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $programs->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Active Business Goals -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-bullseye text-green-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Active Business Goals</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $businessGoals->where('status', 'in_progress')->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Completed Goals -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-purple-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Completed Goals</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $businessGoals->where('status', 'completed')->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Business Value -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-euro-sign text-yellow-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Business Value</p>
                    <p class="text-2xl font-semibold text-gray-900">€{{ number_format($programs->sum('business_value'), 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Programs Overview -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Programs Overview</h2>
        </div>
        <div class="p-6">
            @if($programs->count() > 0)
                <div class="space-y-4">
                    @foreach($programs as $program)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $program->title }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $program->description }}</p>
                                <div class="flex items-center space-x-4 mt-2">
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-calendar mr-1"></i>
                                        {{ $program->start_date ? $program->start_date->format('d-m-Y') : 'N/A' }} - 
                                        {{ $program->end_date ? $program->end_date->format('d-m-Y') : 'N/A' }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-euro-sign mr-1"></i>
                                        €{{ number_format($program->business_value, 0, ',', '.') }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-user mr-1"></i>
                                        {{ $program->owner }}
                                    </span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <span class="px-3 py-1 text-xs font-medium rounded-full 
                                    @if($program->status === 'active') bg-green-100 text-green-800
                                    @elseif($program->status === 'completed') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($program->status) }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Business Goals for this Program -->
                        <div class="mt-4">
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Business Goals ({{ $program->businessGoals->count() }})</h4>
                            @if($program->businessGoals->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach($program->businessGoals->take(4) as $goal)
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <div class="flex items-center justify-between">
                                            <h5 class="text-sm font-medium text-gray-900 truncate">{{ $goal->title }}</h5>
                                            <span class="text-xs px-2 py-1 rounded-full
                                                @if($goal->status === 'completed') bg-green-100 text-green-800
                                                @elseif($goal->status === 'in_progress') bg-yellow-100 text-yellow-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($goal->status) }}
                                            </span>
                                        </div>
                                        <p class="text-xs text-gray-600 mt-1">{{ Str::limit($goal->description, 60) }}</p>
                                    </div>
                                    @endforeach
                                </div>
                                @if($program->businessGoals->count() > 4)
                                    <p class="text-xs text-gray-500 mt-2">+{{ $program->businessGoals->count() - 4 }} more goals</p>
                                @endif
                            @else
                                <p class="text-sm text-gray-500">No business goals defined</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-building text-gray-300 text-4xl mb-4"></i>
                    <p class="text-gray-500">No programs found</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Business Value Realization Chart -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Business Value Realization</h2>
        </div>
        <div class="p-6">
            <div class="h-64 flex items-center justify-center">
                <div class="text-center">
                    <i class="fas fa-chart-line text-gray-300 text-4xl mb-4"></i>
                    <p class="text-gray-500">Chart will be implemented with Chart.js</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
