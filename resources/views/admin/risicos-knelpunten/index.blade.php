@extends('layouts.admin')

@section('title', 'Risico\'s & Knelpunten - Programma Portaal')

@section('content')
<div class="space-y-8">
    <!-- Risico's Section -->
    <div>
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Risico's</h2>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <table id="risicosTable" class="w-full table-fixed divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="w-2/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TITEL</th>
                        <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                        <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">EIGENAAR</th>
                        <th class="w-1/6 px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">ACTIES</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($risicos as $risico)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900 truncate">{{ $risico['titel'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'yellow' => 'bg-yellow-100 text-yellow-800',
                                    'red' => 'bg-red-100 text-red-800',
                                    'orange' => 'bg-orange-100 text-orange-800',
                                    'green' => 'bg-green-100 text-green-800',
                                    'blue' => 'bg-blue-100 text-blue-800'
                                ];
                                $colorClass = $statusColors[$risico['status_color']] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $colorClass }}">
                                {{ $risico['status'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $risico['eigenaar'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <button class="text-gray-400 hover:text-gray-600" title="Bekijken">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-gray-400 hover:text-gray-600" title="Commentaar">
                                    <i class="fas fa-comment"></i>
                                </button>
                                <button class="text-gray-400 hover:text-gray-600" title="Bewerken">
                                    <i class="fas fa-pencil"></i>
                                </button>
                                <button class="text-gray-400 hover:text-red-600" title="Verwijderen">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Knelpunten Section -->
    <div>
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Knelpunten</h2>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <table id="knelpuntenTable" class="w-full table-fixed divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="w-2/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TITEL</th>
                        <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                        <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">EIGENAAR</th>
                        <th class="w-1/6 px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">ACTIES</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($knelpunten as $knelpunt)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900 truncate">{{ $knelpunt['titel'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'yellow' => 'bg-yellow-100 text-yellow-800',
                                    'red' => 'bg-red-100 text-red-800',
                                    'orange' => 'bg-orange-100 text-orange-800',
                                    'green' => 'bg-green-100 text-green-800',
                                    'blue' => 'bg-blue-100 text-blue-800'
                                ];
                                $colorClass = $statusColors[$knelpunt['status_color']] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $colorClass }}">
                                {{ $knelpunt['status'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $knelpunt['eigenaar'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <button class="text-gray-400 hover:text-gray-600" title="Bekijken">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-gray-400 hover:text-gray-600" title="Commentaar">
                                    <i class="fas fa-comment"></i>
                                </button>
                                <button class="text-gray-400 hover:text-gray-600" title="Bewerken">
                                    <i class="fas fa-pencil"></i>
                                </button>
                                <button class="text-gray-400 hover:text-red-600" title="Verwijderen">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable for Risico's
    $('#risicosTable').DataTable({
        "paging": false,
        "searching": false,
        "info": false,
        "ordering": true,
        "columnDefs": [
            { "orderable": false, "targets": 3 } // Disable ordering on ACTIES column
        ],
        "language": {
            "emptyTable": "Geen risico's gevonden",
            "zeroRecords": "Geen overeenkomende risico's gevonden"
        }
    });

    // Initialize DataTable for Knelpunten
    $('#knelpuntenTable').DataTable({
        "paging": false,
        "searching": false,
        "info": false,
        "ordering": true,
        "columnDefs": [
            { "orderable": false, "targets": 3 } // Disable ordering on ACTIES column
        ],
        "language": {
            "emptyTable": "Geen knelpunten gevonden",
            "zeroRecords": "Geen overeenkomende knelpunten gevonden"
        }
    });
});
</script>
@endpush
@endsection
