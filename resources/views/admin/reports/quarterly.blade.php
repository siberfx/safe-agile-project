@extends('layouts.admin')

@section('title', 'Quarterly Reports - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Quarterly Reports</h1>
            <p class="text-gray-600 mt-2">Business goals and value realization by quarter</p>
        </div>
        <div class="flex items-center space-x-4">
            <button class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                <i class="fas fa-download mr-2"></i>
                Export Report
            </button>
        </div>
    </div>

    <!-- Quarterly Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-bullseye text-blue-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Goals</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $businessGoals->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Completed Goals</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $businessGoals->where('status', 'completed')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-euro-sign text-yellow-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Budget</p>
                    <p class="text-2xl font-semibold text-gray-900">€{{ number_format($businessGoals->sum('budget'), 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chart-line text-purple-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Value Realized</p>
                    <p class="text-2xl font-semibold text-gray-900">€{{ number_format($businessGoals->sum('prognose'), 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quarterly Goals by Quarter -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @foreach(['Q1', 'Q2', 'Q3', 'Q4'] as $quarter)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">{{ $quarter }} {{ now()->year }}</h2>
            </div>
            <div class="p-6">
                @php
                    $quarterGoals = $businessGoals->where('quarter', $quarter);
                @endphp
                
                @if($quarterGoals->count() > 0)
                    <div class="space-y-4">
                        @foreach($quarterGoals as $goal)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="text-sm font-medium text-gray-900">{{ $goal->title }}</h3>
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    @if($goal->status === 'completed') bg-green-100 text-green-800
                                    @elseif($goal->status === 'in_progress') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($goal->status) }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-600 mb-2">{{ Str::limit($goal->description, 100) }}</p>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>Budget: €{{ number_format($goal->budget, 0, ',', '.') }}</span>
                                <span>Value: €{{ number_format($goal->prognose, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-calendar-alt text-gray-300 text-3xl mb-2"></i>
                        <p class="text-gray-500">No goals for {{ $quarter }}</p>
                    </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
