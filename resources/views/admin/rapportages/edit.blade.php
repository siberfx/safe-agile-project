@extends('layouts.admin')

@section('title', 'Rapportage Bewerken - Programma Portaal')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Rapportage Bewerken</h2>
        
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rapportage Type</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="maandelijks" selected>Maandelijkse Voortgangsrapportage</option>
                            <option value="kwartaal">Kwartaalrapportage</option>
                            <option value="jaarlijks">Jaarrapportage</option>
                            <option value="ad-hoc">Ad-hoc Rapportage</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Project</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="woo-voorziening" selected>Project Woo-voorziening</option>
                            <option value="andere">Andere projecten</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="juni-2025" selected>Juni 2025</option>
                            <option value="mei-2025">Mei 2025</option>
                            <option value="april-2025">April 2025</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Auteur</label>
                        <input type="text" value="Saïd Ahamri" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="concept">Concept</option>
                            <option value="in-review" selected>In Review</option>
                            <option value="goedgekeurd">Goedgekeurd</option>
                            <option value="gepubliceerd">Gepubliceerd</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deadline</label>
                        <input type="date" value="2025-07-01" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Template</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="standaard" selected>Standaard Template</option>
                            <option value="uitgebreid">Uitgebreide Template</option>
                            <option value="samenvatting">Samenvatting Template</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ontvangers</label>
                        <input type="text" value="team@woo-voorziening.nl, management@woo-voorziening.nl" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                </div>
            </div>
            
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Opmerkingen</label>
                <textarea rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">Rapportage voor juni 2025 - Project Woo-voorziening voortgangsrapportage.</textarea>
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
