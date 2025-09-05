@extends('layouts.admin')

@section('title', 'Rapportages - Programma Portaal')

@section('content')
<div class="space-y-8">
    <!-- Genereer Rapportage Section -->
    <div>
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Genereer Rapportage</h2>
        <div class="flex space-x-4">
            <button class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary/90 flex items-center">
                <i class="fas fa-file-alt mr-2"></i>
                Maandelijkse Voortgangsrapportage
            </button>
            <button class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 flex items-center">
                <i class="fas fa-file-alt mr-2"></i>
                Kwartaalrapportage
            </button>
        </div>
    </div>

    <!-- Maandelijkse Voortgangsrapportage Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-gray-900">Maandelijkse Voortgangsrapportage</h3>
            <div class="text-sm text-gray-600">
                <span class="font-medium">Project Woo-voorziening</span> • juni 2025
            </div>
        </div>
        
        <!-- Management Samenvatting -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-lg font-semibold text-gray-900">Management Samenvatting</h4>
                <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 flex items-center">
                    <i class="fas fa-sparkles mr-2"></i>
                    Genereer Samenvatting
                </button>
            </div>
            <textarea rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Klik op 'Genereer Samenvatting' of typ hier handmatig..."></textarea>
        </div>
        
        <!-- Knelpunten Table -->
        <div class="mb-8">
            <h4 class="text-lg font-semibold text-gray-900 mb-4">Knelpunten (Loopt risico / Uit de pas)</h4>
            <div class="overflow-hidden border border-gray-200 rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ITEM</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TYPE</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">EIGENAAR</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Aanleverloket en API</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">undefined</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                    Loopt risico
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">KOOP</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Personele wisselingen bij BZK</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">undefined</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                    Loopt risico
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Saïd Ahamri</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Onduidelijkheid over definitieve PSA</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">undefined</td>
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
        
        <!-- Notulen Voortgangsoverleg -->
        <div>
            <h4 class="text-lg font-semibold text-gray-900 mb-4">Notulen Voortgangsoverleg</h4>
            <textarea rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Typ hier de notulen en actiepunten van het overleg..."></textarea>
        </div>
    </div>
</div>
@endsection
