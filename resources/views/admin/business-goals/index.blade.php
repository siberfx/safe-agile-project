@extends('layouts.admin')

@section('title', 'Business Goals - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Business Goals</h1>
            <p class="text-gray-600 mt-2">Strategic business objectives and value realization</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.access.business-goals.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                <i class="fas fa-plus mr-2"></i>
                New Business Goal
            </a>
        </div>
    </div>

    <!-- Business Goals Cards -->
    <div class="space-y-4">
        @forelse($businessGoals ?? [] as $goal)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="p-6">
                <!-- Header Row -->
                <div class="flex items-start justify-between mb-4">
                    <!-- Goal Title & Description -->
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $goal->title }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">
                            {{ Str::limit($goal->description, 200) }}
                        </p>
                    </div>
                    
                    <!-- Status & Actions -->
                    <div class="flex items-center space-x-4 ml-6">
                        <!-- Status Badge -->
                        <span class="px-3 py-1 text-xs font-medium rounded-full
                            @if($goal->status === 'completed') bg-green-100 text-green-800
                            @elseif($goal->status === 'in_progress') bg-yellow-100 text-yellow-800
                            @elseif($goal->status === 'draft') bg-gray-100 text-gray-800
                            @else bg-red-100 text-red-800 @endif flex items-center whitespace-nowrap">
                            <span class="w-2 h-2 rounded-full mr-2
                                @if($goal->status === 'completed') bg-green-500
                                @elseif($goal->status === 'in_progress') bg-yellow-500
                                @elseif($goal->status === 'draft') bg-gray-500
                                @else bg-red-500 @endif"></span>
                            @if($goal->status === 'in_progress')
                                In Progress
                            @else
                                {{ ucfirst($goal->status) }}
                            @endif
                        </span>
                        
                        <!-- Action Buttons -->
                        <div class="flex items-center space-x-1">
                            <a href="{{ route('admin.access.business-goals.show', $goal->id) }}" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200" title="View Details">
                                <i class="fas fa-eye text-sm"></i>
                            </a>
                            <a href="{{ route('admin.access.business-goals.edit', $goal->id) }}" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200" title="Edit">
                                <i class="fas fa-pencil text-sm"></i>
                            </a>
                            <form action="{{ route('admin.access.business-goals.destroy', $goal->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this business goal?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200" title="Delete">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Details Table -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="grid grid-cols-4 gap-6">
                        <!-- Quarter -->
                        <div class="text-left">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-calendar-alt text-gray-400 mr-2"></i>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Quarter</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-900">
                                {{ $goal->quarter ?: 'Q' . ceil(now()->month / 3) }} {{ $goal->year ?: now()->year }}
                            </div>
                        </div>
                        
                        <!-- Value Score -->
                        <div class="text-left">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-star text-gray-400 mr-2"></i>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Value Score</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-900">{{ $goal->value_score ?: 'N/A' }}</div>
                        </div>
                        
                        <!-- Budget -->
                        <div class="text-left">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-euro-sign text-gray-400 mr-2"></i>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Budget</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-900">
                                {{ $goal->budget ? '€' . number_format($goal->budget, 0, ',', '.') : 'N/A' }}
                            </div>
                        </div>
                        
                        <!-- Prognose -->
                        <div class="text-left">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-chart-line text-gray-400 mr-2"></i>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Prognose</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-900">
                                {{ $goal->prognose ? '€' . number_format($goal->prognose, 0, ',', '.') : 'N/A' }}
                            </div>
                            @if($goal->budget && $goal->prognose)
                                @php
                                    $difference = $goal->prognose - $goal->budget;
                                    $percentage = $goal->budget > 0 ? ($difference / $goal->budget) * 100 : 0;
                                @endphp
                                <div class="text-xs mt-1 {{ $difference >= 0 ? 'text-red-500' : 'text-green-500' }}">
                                    {{ $difference >= 0 ? '+' : '' }}€{{ number_format($difference, 0, ',', '.') }}
                                    ({{ $percentage >= 0 ? '+' : '' }}{{ number_format($percentage, 1) }}%)
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Epics Count -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-layer-group mr-2"></i>
                        <span>{{ $goal->epics->count() }} Epics</span>
                    </div>
                    <a href="{{ route('admin.access.business-goals.show', $goal->id) }}" class="text-primary hover:text-primary/80 text-sm font-medium">
                        View Details →
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-12">
            <i class="fas fa-bullseye text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No business goals found</h3>
            <p class="text-gray-500 mb-6">Create your first business goal to get started.</p>
            <a href="{{ route('admin.access.business-goals.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90">
                <i class="fas fa-plus mr-2"></i>
                Create Business Goal
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
