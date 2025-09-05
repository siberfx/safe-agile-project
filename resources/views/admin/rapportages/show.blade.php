@extends('layouts.admin')

@section('title', 'Rapportage Details - Programma Portaal')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex items-start justify-between mb-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">Maandelijkse Voortgangsrapportage</h2>
                <p class="text-sm text-gray-600 mt-1">Project Woo-voorziening • Juni 2025</p>
            </div>
            <div class="flex space-x-2">
                <button class="px-4 py-2 text-primary border border-primary rounded-lg hover:bg-primary/5 transition-colors duration-200">
                    <i class="fas fa-pencil mr-2"></i>
                    Bewerken
                </button>
                <button class="px-4 py-2 text-red-600 border border-red-300 rounded-lg hover:bg-red-50 transition-colors duration-200">
                    <i class="fas fa-download mr-2"></i>
                    Download PDF
                </button>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left Column -->
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Status</h3>
                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                        In Review
                    </span>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Auteur</h3>
                    <p class="text-gray-700">Saïd Ahamri</p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Project</h3>
                    <p class="text-gray-700">Project Woo-voorziening</p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Periode</h3>
                    <p class="text-gray-700">Juni 2025</p>
                </div>
            </div>
            
            <!-- Right Column -->
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Deadline</h3>
                    <p class="text-gray-700">1 juli 2025</p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Aangemaakt</h3>
                    <p class="text-gray-700">15 juni 2025</p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Laatst bijgewerkt</h3>
                    <p class="text-gray-700">20 juni 2025</p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Template</h3>
                    <p class="text-gray-700">Standaard Template</p>
                </div>
            </div>
        </div>
        
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Management Samenvatting</h3>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-gray-700">
                    In juni 2025 heeft het Project Woo-voorziening goede voortgang geboekt. De belangrijkste mijlpalen zijn behaald, hoewel er enkele uitdagingen zijn geïdentificeerd die aandacht vereisen.
                </p>
            </div>
        </div>
        
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Knelpunten Overzicht</h3>
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ITEM</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">EIGENAAR</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Aanleverloket en API</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                    Loopt risico
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">KOOP</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Onduidelijkheid over definitieve PSA</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                    Uit de pas
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Saïd Ahamri</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
