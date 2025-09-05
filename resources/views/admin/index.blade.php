@extends('layouts.admin')

@section('title', 'Dashboard - Programma Portaal')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
<div class="space-y-6">
    @php
        $users = \App\Models\User::with('roles')->get();
        $totalUsers = $users->count();
        $adminUsers = $users->where('roles', '!=', null)->count();
        $activeUsers = $users->where('email_verified_at', '!=', null)->count();
        $inactiveUsers = $totalUsers - $activeUsers;
    @endphp

    <!-- Top Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- TOTAAL BUDGET Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">TOTAAL BUDGET</h3>
                <div class="flex items-center text-green-600">
                    <i class="fas fa-arrow-up text-xs mr-1"></i>
                    <span class="text-sm font-medium">8%</span>
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-900 mb-2">€ {{ number_format(1400000, 0, ',', '.') }}</div>
            <div class="h-16">
                <canvas id="budgetChart"></canvas>
            </div>
        </div>

        <!-- BUSINESSDOELEN Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">BUSINESSDOELEN</h3>
                <div class="flex items-center text-red-600">
                    <i class="fas fa-arrow-down text-xs mr-1"></i>
                    <span class="text-sm font-medium">2%</span>
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-900 mb-2">3</div>
            <div class="h-16">
                <canvas id="goalsChart"></canvas>
            </div>
        </div>

        <!-- ACTIEVE RISICO'S Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">ACTIEVE RISICO'S</h3>
                <div class="flex items-center text-green-600">
                    <i class="fas fa-arrow-up text-xs mr-1"></i>
                    <span class="text-sm font-medium">15%</span>
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-900 mb-2">1</div>
            <div class="h-16">
                <canvas id="risksChart"></canvas>
            </div>
        </div>

        <!-- OPEN KNELPUNTEN Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">OPEN KNELPUNTEN</h3>
                <div class="flex items-center text-green-600">
                    <i class="fas fa-arrow-up text-xs mr-1"></i>
                    <span class="text-sm font-medium">0%</span>
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-900 mb-2">1</div>
            <div class="h-16">
                <canvas id="bottlenecksChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Alert Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Items die aandacht nodig hebben (Uit de pas)</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between p-3 bg-red-50 border border-red-200 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                    <span class="text-red-700 font-medium">Onduidelijkheid over definitieve PSA (undefined)</span>
                </div>
                <div class="text-sm text-gray-600">
                    Eigenaar: {{ auth()->user()->name ?? 'Saïd Ahamri' }}
                </div>
            </div>
        </div>
    </div>

    <!-- User Statistics (Hidden but data available) -->
    <div class="hidden">
        <div class="text-sm text-gray-500">
            Total Users: {{ $totalUsers }} | 
            Admin Users: {{ $adminUsers }} | 
            Active Users: {{ $activeUsers }} | 
            Inactive Users: {{ $inactiveUsers }}
        </div>
    </div>
</div>

<!-- Floating Action Button -->
<div class="fixed bottom-6 right-6">
    <button class="w-12 h-12 bg-gray-800 text-white rounded-full shadow-lg hover:bg-gray-700 flex items-center justify-center">
        <i class="fas fa-cog"></i>
    </button>
</div>
@endsection

@push('scripts')
<script>
    // Chart.js configurations for the mini charts
    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: { enabled: false }
        },
        scales: {
            x: { display: false },
            y: { display: false }
        },
        elements: {
            point: { radius: 0 },
            line: { tension: 0.4, borderWidth: 2 }
        }
    };

    // Budget Chart (Upward trend)
    const budgetCtx = document.getElementById('budgetChart').getContext('2d');
    new Chart(budgetCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                data: [1200000, 1250000, 1300000, 1320000, 1350000, 1400000],
                borderColor: '#154273',
                backgroundColor: 'rgba(21, 66, 115, 0.1)',
                fill: true
            }]
        },
        options: chartOptions
    });

    // Goals Chart (Downward trend)
    const goalsCtx = document.getElementById('goalsChart').getContext('2d');
    new Chart(goalsCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                data: [5, 4, 4, 3, 3, 3],
                borderColor: '#154273',
                backgroundColor: 'rgba(21, 66, 115, 0.1)',
                fill: true
            }]
        },
        options: chartOptions
    });

    // Risks Chart (Upward with fluctuations)
    const risksCtx = document.getElementById('risksChart').getContext('2d');
    new Chart(risksCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                data: [0, 0, 1, 0, 1, 1],
                borderColor: '#154273',
                backgroundColor: 'rgba(21, 66, 115, 0.1)',
                fill: true
            }]
        },
        options: chartOptions
    });

    // Bottlenecks Chart (Fluctuating)
    const bottlenecksCtx = document.getElementById('bottlenecksChart').getContext('2d');
    new Chart(bottlenecksCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                data: [2, 1, 1, 2, 1, 1],
                borderColor: '#154273',
                backgroundColor: 'rgba(21, 66, 115, 0.1)',
                fill: true
            }]
        },
        options: chartOptions
    });
</script>
@endpush