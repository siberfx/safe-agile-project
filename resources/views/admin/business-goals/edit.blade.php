@extends('layouts.admin')

@section('title', 'Edit Business Goal - Programma Portaal')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-900">Edit Business Goal</h1>
            <p class="text-gray-600 mt-1">Update business goal information</p>
        </div>
        
        <form class="p-6 space-y-6">
            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" value="{{ $businessGoal->title ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Business goal title">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Program *</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Select Program</option>
                        <!-- Programs will be populated here -->
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                <textarea rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Describe the business goal">{{ $businessGoal->description ?? '' }}</textarea>
            </div>

            <!-- Quarter and Year -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Quarter</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="Q1" {{ ($businessGoal->quarter ?? '') === 'Q1' ? 'selected' : '' }}>Q1</option>
                        <option value="Q2" {{ ($businessGoal->quarter ?? '') === 'Q2' ? 'selected' : '' }}>Q2</option>
                        <option value="Q3" {{ ($businessGoal->quarter ?? '') === 'Q3' ? 'selected' : '' }}>Q3</option>
                        <option value="Q4" {{ ($businessGoal->quarter ?? '') === 'Q4' ? 'selected' : '' }}>Q4</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                    <input type="number" value="{{ $businessGoal->year ?? now()->year }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
            </div>

            <!-- Value and Budget -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Value Score</label>
                    <input type="number" value="{{ $businessGoal->value_score ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="1-10">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Budget (€)</label>
                    <input type="number" value="{{ $businessGoal->budget ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="0">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Prognose (€)</label>
                    <input type="number" value="{{ $businessGoal->prognose ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="0">
                </div>
            </div>

            <!-- Status and Target Date -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="draft" {{ ($businessGoal->status ?? '') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="in_progress" {{ ($businessGoal->status ?? '') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ ($businessGoal->status ?? '') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ ($businessGoal->status ?? '') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Target Date</label>
                    <input type="date" value="{{ $businessGoal->target_date ? $businessGoal->target_date->format('Y-m-d') : '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.access.business-goals.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                    Update Business Goal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
