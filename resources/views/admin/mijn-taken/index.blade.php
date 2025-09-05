@extends('layouts.admin')

@section('title', 'Mijn Taken - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Deze week Section -->
    <div>
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Deze week</h2>
        <div class="space-y-4">
            <!-- Task Card 1 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-2">
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                Uit de pas
                            </span>
                            <span class="text-sm text-gray-500">Knelpunt • Project Woo-voorziening</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Onduidelijkheid over definitieve PSA</h3>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span>Deadline: 20-6-2025</span>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <button class="p-2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-pencil"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Later Section -->
    <div>
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Later</h2>
        <div class="space-y-4">
            <!-- Task Card 1 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-2">
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                Loopt risico
                            </span>
                            <span class="text-sm text-gray-500">Risico • Project Woo-voorziening</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Personele wisselingen bij BZK</h3>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span>Deadline: 1-7-2025</span>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <button class="p-2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-pencil"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Task Card 2 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-2">
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                Op schema
                            </span>
                            <span class="text-sm text-gray-500">Businessdoel • Project Woo-voorziening</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Decentrale overheden</h3>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span>Deadline: 31-12-2025</span>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <button class="p-2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-pencil"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
