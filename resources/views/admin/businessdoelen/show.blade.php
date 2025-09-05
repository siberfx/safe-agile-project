@extends('layouts.admin')

@section('title', 'Businessdoel Details - Programma Portaal')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex items-start justify-between mb-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">Aanleverloket en API</h2>
                <p class="text-sm text-gray-600 mt-1">Businessdoel Details</p>
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
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Beschrijving</h3>
                    <p class="text-gray-700">
                        Departementen zijn in staat eind Q1 2025 via een aanleverloket (handmatig) en/of automatisch via een aanlever-API links naar documenten in een testomgeving van de Woo-index aan te leveren.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Status</h3>
                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                        • Loopt risico
                    </span>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Eigenaar</h3>
                    <p class="text-gray-700">Saïd Ahamri</p>
                </div>
            </div>
            
            <!-- Right Column -->
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Tijdlijn</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Startdatum:</span>
                            <span class="font-medium">1-1-2025</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Einddatum:</span>
                            <span class="font-medium">31-3-2025</span>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Financiën</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Budget:</span>
                            <span class="font-medium">€ 500.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Prognose:</span>
                            <span class="font-medium">€ 520.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Verschil:</span>
                            <span class="font-medium text-red-600">+€ 20.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
