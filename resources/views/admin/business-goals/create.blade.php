@extends('layouts.admin')

@section('title', 'Create Business Goal - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Create Business Goal</h1>
            <p class="text-gray-600 mt-2">Define a strategic business objective for your program</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.access.business-goals.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Goals
            </a>
        </div>
    </div>

    <!-- Create Form -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Business Goal Details</h2>
                    <p class="text-sm text-gray-600 mt-1">Define the strategic objective and its parameters</p>
                </div>
        
                <form action="{{ route('admin.access.business-goals.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    
                    <!-- Basic Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('title') border-red-500 @enderror" placeholder="Business goal title" required>
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Program *</label>
                            <select name="program_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('program_id') border-red-500 @enderror" required>
                                <option value="">Select Program</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>{{ $program->title }}</option>
                                @endforeach
                            </select>
                            @error('program_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('description') border-red-500 @enderror" placeholder="Describe the business goal">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Quarter and Year -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Quarter</label>
                            <select name="quarter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('quarter') border-red-500 @enderror">
                                <option value="">Select Quarter</option>
                                <option value="Q1" {{ old('quarter') == 'Q1' ? 'selected' : '' }}>Q1</option>
                                <option value="Q2" {{ old('quarter') == 'Q2' ? 'selected' : '' }}>Q2</option>
                                <option value="Q3" {{ old('quarter') == 'Q3' ? 'selected' : '' }}>Q3</option>
                                <option value="Q4" {{ old('quarter') == 'Q4' ? 'selected' : '' }}>Q4</option>
                            </select>
                            @error('quarter')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                            <input type="number" name="year" value="{{ old('year', now()->year) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('year') border-red-500 @enderror">
                            @error('year')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Value and Budget -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Value Score (1-100)</label>
                            <input type="number" name="value_score" value="{{ old('value_score') }}" min="1" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('value_score') border-red-500 @enderror" placeholder="1-100">
                            @error('value_score')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Budget (€)</label>
                            <input type="number" name="budget" value="{{ old('budget') }}" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('budget') border-red-500 @enderror" placeholder="0">
                            @error('budget')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Prognose (€)</label>
                            <input type="number" name="prognose" value="{{ old('prognose') }}" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('prognose') border-red-500 @enderror" placeholder="0">
                            @error('prognose')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Status and Target Date -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('status') border-red-500 @enderror" required>
                                <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Target Date</label>
                            <input type="date" name="target_date" value="{{ old('target_date') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('target_date') border-red-500 @enderror">
                            @error('target_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.access.business-goals.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                            <i class="fas fa-plus mr-2"></i>
                            Create Business Goal
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Help -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Creating a Business Goal</h3>
                <div class="space-y-3 text-sm text-gray-600">
                    <div class="flex items-start">
                        <i class="fas fa-lightbulb text-yellow-500 mt-1 mr-2"></i>
                        <p>Business goals should be specific, measurable, and aligned with your program's strategic objectives.</p>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-target text-blue-500 mt-1 mr-2"></i>
                        <p>Set realistic target dates and value scores to track progress effectively.</p>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-euro-sign text-green-500 mt-1 mr-2"></i>
                        <p>Budget and prognose help with financial planning and resource allocation.</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-2">
                    <a href="{{ route('admin.access.business-goals.index') }}" class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 text-center block">
                        <i class="fas fa-list mr-2"></i>
                        View All Goals
                    </a>
                    <a href="{{ route('admin.access.programs.index') }}" class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 text-center block">
                        <i class="fas fa-building mr-2"></i>
                        Manage Programs
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
