@extends('layouts.admin')

@section('title', 'Taak Details - Programma Portaal')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex items-start justify-between mb-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">Onduidelijkheid over definitieve PSA</h2>
                <p class="text-sm text-gray-600 mt-1">Knelpunt • Project Woo-voorziening</p>
            </div>
            <div class="flex space-x-2">
                <button class="px-4 py-2 text-primary border border-primary rounded-lg hover:bg-primary/5 transition-colors duration-200">
                    <i class="fas fa-pencil mr-2"></i>
                    Bewerken
                </button>
                <button class="px-4 py-2 text-red-600 border border-red-300 rounded-lg hover:bg-red-50 transition-colors duration-200">
                    <i class="fas fa-trash mr-2"></i>
                    Verwijderen
                </button>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left Column -->
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Status</h3>
                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                        Uit de pas
                    </span>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Eigenaar</h3>
                    <p class="text-gray-700">Saïd Ahamri</p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Prioriteit</h3>
                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                        Hoog
                    </span>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Project</h3>
                    <p class="text-gray-700">Project Woo-voorziening</p>
                </div>
            </div>
            
            <!-- Right Column -->
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Deadline</h3>
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span>20-6-2025</span>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Aangemaakt</h3>
                    <p class="text-gray-700">15-1-2025</p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Laatst bijgewerkt</h3>
                    <p class="text-gray-700">10-1-2025</p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Categorie</h3>
                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                        Deze week
                    </span>
                </div>
            </div>
        </div>
        
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Beschrijving</h3>
            <p class="text-gray-700">
                Onduidelijkheid over definitieve PSA (undefined) - Dit knelpunt vereist onmiddellijke aandacht en opheldering.
            </p>
        </div>
    </div>
</div>
@endsection
