@extends('layouts.admin')

@section('title', 'Risico/Knelpunt Bewerken - Programma Portaal')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Risico/Knelpunt Bewerken</h2>
        
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="risico">Risico</option>
                            <option value="knelpunt" selected>Knelpunt</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Titel</label>
                        <input type="text" value="Onduidelijkheid over definitieve PSA" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="op-schema">Op schema</option>
                            <option value="loopt-risico">Loopt risico</option>
                            <option value="uit-de-pas" selected>Uit de pas</option>
                            <option value="opgelost">Opgelost</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Prioriteit</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="laag">Laag</option>
                            <option value="gemiddeld">Gemiddeld</option>
                            <option value="hoog" selected>Hoog</option>
                            <option value="kritiek">Kritiek</option>
                        </select>
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Eigenaar</label>
                        <input type="text" value="Saïd Ahamri" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Project</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="woo-voorziening" selected>Project Woo-voorziening</option>
                            <option value="andere">Andere projecten</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Datum</label>
                        <input type="date" value="2025-01-15" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Impact</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="laag">Laag</option>
                            <option value="gemiddeld">Gemiddeld</option>
                            <option value="hoog" selected>Hoog</option>
                            <option value="kritiek">Kritiek</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Beschrijving</label>
                <textarea rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">Onduidelijkheid over definitieve PSA (undefined) - Dit knelpunt vereist onmiddellijke aandacht en opheldering.</textarea>
            </div>
            
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Oplossing</label>
                <textarea rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">Contact opnemen met relevante stakeholders voor opheldering over definitieve PSA.</textarea>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 mt-8">
                <button type="button" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                    Annuleren
                </button>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors duration-200">
                    Opslaan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
