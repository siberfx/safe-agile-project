@extends('layouts.admin')

@section('title', 'Businessdoelen - Programma Portaal')

@section('content')
<div class="space-y-6">
    <!-- Business Goals Cards -->
    <div class="space-y-4">
        <!-- Card 1: Aanleverloket en API -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
            <div class="p-6">
                <!-- Header Row -->
                <div class="flex items-start justify-between mb-4">
                    <!-- Project Title & Description -->
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Aanleverloket en API</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">
                            Departementen zijn in staat eind Q1 2025 via een aanleverloket (handmatig) en/of automatisch via een aanlever-API links naar documenten in een testomgeving van de Woo-index aan te leveren.
                        </p>
                    </div>
                    
                    <!-- Status & Actions -->
                    <div class="flex items-center space-x-4 ml-6">
                        <!-- Status Badge -->
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800 flex items-center whitespace-nowrap">
                            <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>
                            Loopt risico
                        </span>
                        
                        <!-- Action Buttons -->
                        <div class="flex items-center space-x-1">
                            <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200" title="Commentaar toevoegen">
                                <i class="fas fa-comment text-sm"></i>
                            </button>
                            <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200" title="Bewerken">
                                <i class="fas fa-pencil text-sm"></i>
                            </button>
                            <button class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200" title="Verwijderen">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Details Table -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="grid grid-cols-4 gap-6">
                        <!-- Start Date -->
                        <div class="text-left">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-calendar-alt text-gray-400 mr-2"></i>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Startdatum</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-900">1-1-2025</div>
                        </div>
                        
                        <!-- End Date -->
                        <div class="text-left">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-calendar-check text-gray-400 mr-2"></i>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Einddatum</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-900">31-3-2025</div>
                        </div>
                        
                        <!-- Budget -->
                        <div class="text-left">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-euro-sign text-gray-400 mr-2"></i>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Budget</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-900">€ 500.000</div>
                        </div>
                        
                        <!-- Prognose -->
                        <div class="text-left">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-chart-line text-gray-400 mr-2"></i>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Prognose</span>
                            </div>
                            <div class="text-sm font-semibold text-green-600">€ 520.000</div>
                            <div class="text-xs text-green-500 mt-1">+€ 20.000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Decentrale overheden -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
            <div class="p-6">
                <!-- Header Row -->
                <div class="flex items-start justify-between mb-4">
                    <!-- Project Title & Description -->
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Decentrale overheden</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">
                            De decentrale overheden kunnen eind 2025 de links naar documenten van KB2 via twee alternatieve methoden aanleveren.
                        </p>
                    </div>
                    
                    <!-- Status & Actions -->
                    <div class="flex items-center space-x-4 ml-6">
                        <!-- Status Badge -->
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 flex items-center whitespace-nowrap">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Op schema
                        </span>
                        
                        <!-- Action Buttons -->
                        <div class="flex items-center space-x-1">
                            <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200" title="Commentaar toevoegen">
                                <i class="fas fa-comment text-sm"></i>
                            </button>
                            <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200" title="Bewerken">
                                <i class="fas fa-pencil text-sm"></i>
                            </button>
                            <button class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200" title="Verwijderen">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Details Table -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="grid grid-cols-4 gap-6">
                        <!-- Start Date -->
                        <div class="text-left">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-calendar-alt text-gray-400 mr-2"></i>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Startdatum</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-900">1-2-2025</div>
                        </div>
                        
                        <!-- End Date -->
                        <div class="text-left">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-calendar-check text-gray-400 mr-2"></i>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Einddatum</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-900">31-12-2025</div>
                        </div>
                        
                        <!-- Budget -->
                        <div class="text-left">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-euro-sign text-gray-400 mr-2"></i>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Budget</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-900">€ 750.000</div>
                        </div>
                        
                        <!-- Prognose -->
                        <div class="text-left">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-chart-line text-gray-400 mr-2"></i>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Prognose</span>
                            </div>
                            <div class="text-sm font-semibold text-green-600">€ 750.000</div>
                            <div class="text-xs text-green-500 mt-1">€ 0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Monitoring -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-200">
            <div class="p-6">
                <!-- Header Row -->
                <div class="flex items-start justify-between mb-4">
                    <!-- Project Title & Description -->
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Monitoring</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">
                            Inzicht geven van de voortgang per bestuursorgaan van de vulling van de Woo-index.
                        </p>
                    </div>
                    
                    <!-- Status & Actions -->
                    <div class="flex items-center space-x-4 ml-6">
                        <!-- Status Badge -->
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 flex items-center whitespace-nowrap">
                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                            Voltooid
                        </span>
                        
                        <!-- Action Buttons -->
                        <div class="flex items-center space-x-1">
                            <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200" title="Commentaar toevoegen">
                                <i class="fas fa-comment text-sm"></i>
                            </button>
                            <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200" title="Bewerken">
                                <i class="fas fa-pencil text-sm"></i>
                            </button>
                            <button class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200" title="Verwijderen">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Details Table -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="grid grid-cols-4 gap-6">
                        <!-- Start Date -->
                        <div class="text-left">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-calendar-alt text-gray-400 mr-2"></i>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Startdatum</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-900">15-1-2025</div>
                        </div>
                        
                        <!-- End Date -->
                        <div class="text-left">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-calendar-check text-gray-400 mr-2"></i>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Einddatum</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-900">20-3-2025</div>
                        </div>
                        
                        <!-- Budget -->
                        <div class="text-left">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-euro-sign text-gray-400 mr-2"></i>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Budget</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-900">€ 150.000</div>
                        </div>
                        
                        <!-- Prognose -->
                        <div class="text-left">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-chart-line text-gray-400 mr-2"></i>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Prognose</span>
                            </div>
                            <div class="text-sm font-semibold text-green-600">€ 145.000</div>
                            <div class="text-xs text-red-500 mt-1">-€ 5.000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
