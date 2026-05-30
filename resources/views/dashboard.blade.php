@extends('layouts.app')

@section('content')
{{-- LOADING OVERLAY (Full Screen dengan Efek Glassmorphism) --}}
<div id="loadingOverlay" class="hidden fixed inset-0 bg-gray-950/40 backdrop-blur-md flex justify-center items-center z-[9999]">
    <div class="bg-white p-6 rounded-[24px] shadow-2xl flex flex-col items-center space-y-3 border border-gray-100">
        {{-- SVG Spinner Animasi --}}
        <svg class="animate-spin h-8 w-8 text-[#4e7281]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span class="text-xs font-semibold text-gray-700 tracking-tight">Loading page...</span>
    </div>
</div>

<div class="space-y-6">

    {{-- HEADER UTAMA DASHBOARD & TOMBOL AKSIDALAM --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Dashboard Overview</h1>
            <p class="text-xs text-gray-400 mt-0.5">Real-time tracking of asset distribution and status.</p>
        </div>
        <a href="{{ route('assets.create') }}" class="load-trigger inline-flex items-center gap-2 px-4 py-2 bg-[#4e7281] hover:bg-[#3f5d6a] text-white rounded-xl text-xs font-semibold tracking-wide shadow-md shadow-[#4e7281]/10 transition duration-150 active:scale-95">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
            </svg>
            Tambah Aset Baru
        </a>
    </div>

    {{-- BLOK NOTIFIKASI SYSTEM / ALERT BACKEND --}}
    @if($lowStocks->count() || $highExpenses->count())
    <div class="space-y-2">
        @if($lowStocks->count())
        <div class="bg-red-50 border border-red-200/60 text-red-700 px-4 py-3 rounded-xl text-xs flex items-center gap-3">
            <span class="text-sm">⚠️</span>
            <div>
                <span class="font-bold">Alert Stok Menipis:</span>
                @foreach($lowStocks as $item){{ $item->nama_aset }} (sisa {{ $item->jumlah }} unit){{ !$loop->last ? ', ' : '' }}@endforeach.
            </div>
        </div>
        @endif
        @if($highExpenses->count())
        <div class="bg-amber-50 border border-amber-200/60 text-amber-800 px-4 py-3 rounded-xl text-xs flex items-center gap-3">
            <span class="text-sm">💸</span>
            <div>
                <span class="font-bold">Biaya Perawatan Tinggi:</span>
                @foreach($highExpenses as $expense){{ $expense->asset->nama_aset }} memakan nominal <span class="font-bold text-red-600">Rp {{ number_format($expense->nominal, 0, ',', '.') }}</span>{{ !$loop->last ? ' | ' : '' }}@endforeach.
            </div>
        </div>
        @endif
    </div>
    @endif

    {{-- KOTAK STATISTIK UTAMA (GRID 4 KOLOM) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        {{-- TOTAL ASSETS --}}
        <div class="bg-white/90 p-5 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between h-32 relative">
            <div class="flex justify-between items-start">
                <div class="p-2 bg-[#EFF6F8] rounded-xl text-[#4e7281]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                @if($totalAsset > 0)
                <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">+2.4%</span>
                @else
                <span class="text-[10px] font-bold text-gray-400 bg-gray-50 px-2 py-0.5 rounded-md">0%</span>
                @endif
            </div>
            <div class="mt-2">
                <h3 class="text-xs font-semibold text-gray-400 tracking-wide">Total Assets</h3>
                <p class="text-2xl font-bold text-gray-900 mt-0.5">{{ number_format($totalAsset, 0, ',', '.') }}</p>
            </div>
        </div>

        {{-- ACTIVE ASSETS --}}
        <div class="bg-white/90 p-5 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between h-32 relative">
            <div class="flex justify-between items-start">
                <div class="p-2 bg-emerald-50 rounded-xl text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-[10px] font-bold text-[#4e7281] bg-slate-50 px-2 py-0.5 rounded-md">
                    {{ $totalAsset > 0 ? round(($totalActive / $totalAsset) * 100) : 0 }}%
                </span>
            </div>
            <div class="mt-2">
                <h3 class="text-xs font-semibold text-gray-400 tracking-wide">Active Assets</h3>
                <p class="text-2xl font-bold text-gray-900 mt-0.5">{{ number_format($totalActive, 0, ',', '.') }}</p>
            </div>
        </div>

        {{-- NON-ACTIVE ASSETS --}}
        <div class="bg-white/90 p-5 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between h-32 relative">
            <div class="flex justify-between items-start">
                <div class="p-2 bg-red-50 rounded-xl text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-[10px] font-bold text-red-600 bg-red-50 px-2 py-0.5 rounded-md">
                    {{ $totalAsset > 0 ? round(($totalInactive / $totalAsset) * 100) : 0 }}%
                </span>
            </div>
            <div class="mt-2">
                <h3 class="text-xs font-semibold text-gray-400 tracking-wide">Non-Active Assets</h3>
                <p class="text-2xl font-bold text-gray-900 mt-0.5">{{ number_format($totalInactive, 0, ',', '.') }}</p>
            </div>
        </div>

        {{-- CATEGORIES --}}
        <div class="bg-white/90 p-5 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between h-32 relative">
            <div class="flex justify-between items-start">
                <div class="p-2 bg-blue-50 rounded-xl text-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md">
                    {{ $totalCategory }} {{ $totalCategory > 1 ? 'types' : 'type' }}
                </span>
            </div>
            <div class="mt-2">
                <h3 class="text-xs font-semibold text-gray-400 tracking-wide">Categories</h3>
                <p class="text-2xl font-bold text-gray-900 mt-0.5">{{ $totalCategory }}</p>
            </div>
        </div>

    </div>

    {{-- GRAFIK RECENT FLOW DAN KONDISI KESEHATAN ASET --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- BAR CHART: RECENT ASSET FLOW --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm lg:col-span-2 flex flex-col justify-between">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-sm font-bold text-gray-900 tracking-tight">Recent Asset Flow</h2>

                {{-- DATA CONVERTED SAFELY TO HTML ATTRIBUTES --}}
                <div class="inline-flex p-0.5 bg-slate-100 rounded-lg text-[10px] font-semibold text-gray-500"
                    id="flowToggleWrapper"
                    data-has-assets="{{ $totalAsset > 0 ? 'true' : 'false' }}"
                    data-daily="{{ json_encode($chartDailyData) }}"
                    data-monthly="{{ json_encode($chartMonthlyData) }}">
                    <button id="btnDaily" class="px-3 py-1 bg-white text-[#4e7281] font-bold rounded-md shadow-2xs transition-all duration-150">Daily</button>
                    <button id="btnMonthly" class="px-3 py-1 hover:text-gray-900 transition-all duration-150">Monthly</button>
                </div>
            </div>
            <div class="relative w-full h-60">
                <canvas id="flowChart"></canvas>
            </div>
        </div>

        {{-- DONUT CHART: CONDITION HEALTH --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex flex-col justify-between">
            <h2 class="text-sm font-bold text-gray-900 tracking-tight mb-2">Condition Health</h2>

            <div class="relative w-full flex justify-center items-center py-4">
                <canvas id="healthChart" data-chart="{{ json_encode([$totalActive, $totalInactive, 0]) }}" style="max-height: 150px; max-width: 150px;"></canvas>
                <div class="absolute flex flex-col justify-center items-center text-center">
                    <span class="text-2xl font-bold text-gray-900 tracking-tighter">
                        {{ $totalAsset > 0 ? round(($totalActive / $totalAsset) * 100) : 0 }}%
                    </span>
                    <span class="text-[9px] font-bold {{ $totalAsset > 0 ? 'text-teal-600' : 'text-gray-400' }} tracking-wider uppercase">
                        {{ $totalAsset > 0 ? 'Optimal' : 'No Data' }}
                    </span>
                </div>
            </div>

            <div class="space-y-1.5 pt-4 border-t border-gray-50 text-[11px] font-medium text-gray-500">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#4e7281]"></span>
                        <span>Excellent (Aktif)</span>
                    </div>
                    <span class="font-bold text-gray-900">{{ $totalActive }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-orange-300"></span>
                        <span>Damaged (Non-Aktif)</span>
                    </div>
                    <span class="font-bold text-gray-900">{{ $totalInactive }}</span>
                </div>
            </div>
        </div>

    </div>

    {{-- TABEL AKTIVITAS TERBARU (LATEST ASSET UPDATES) --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-sm font-bold text-gray-900 tracking-tight">Latest Asset Updates</h2>
            <a href="#" class="load-trigger text-xs font-semibold text-[#4e7281] hover:underline">View All</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-separate border-spacing-y-2">
                <thead>
                    <tr class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                        <th class="pb-1 pl-4">Asset Name</th>
                        <th class="pb-1">Category</th>
                        <th class="pb-1">Status</th>
                        <th class="pb-1">Last Update</th>
                        <th class="pb-1 pr-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="text-xs font-medium text-gray-600">
                    @forelse($recentActivities as $activity)
                    <tr class="bg-slate-50/60 hover:bg-slate-50 transition duration-150">
                        <td class="py-3 pl-4 rounded-l-xl">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-white border border-gray-100 rounded-xl text-[#4e7281] flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <div class="overflow-hidden">
                                    <h4 class="font-bold text-gray-900 truncate">{{ $activity->aktivitas }}</h4>
                                    <p class="text-[10px] text-gray-400 truncate mt-0.5">S/N: {{ $activity->keterangan ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 text-gray-500">Infrastruktur</td>
                        <td class="py-3">
                            <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100 uppercase tracking-wide">
                                Active
                            </span>
                        </td>
                        <td class="py-3 text-gray-400 text-[11px]">{{ $activity->tanggal }}</td>
                        <td class="py-3 pr-4 text-right rounded-r-xl">
                            <button class="p-1 text-gray-400 hover:text-gray-900 hover:bg-white rounded-md border border-transparent hover:border-gray-100 transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-400 font-medium text-xs bg-slate-50/40 rounded-xl">
                            Belum ada aktivitas atau data aset yang terdaftar di dalam sistem.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- JAVASCRIPT --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // --- LOGIKA TRIGGER LOADING PAGE ---
        const loadingOverlay = document.getElementById('loadingOverlay');
        const triggers = document.querySelectorAll('.load-trigger');
        
        triggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                // Pastikan target href bukan tautan kosong atau berkarakter '#'
                const href = this.getAttribute('href');
                if (href && href !== '#') {
                    loadingOverlay.classList.remove('hidden');
                }
            });
        });

        // --- CHART JS MANAGEMENT ---
        if (typeof Chart === 'undefined') {
            console.error('Chart.js belum dimuat.');
            return;
        }

        const toggleWrapper = document.getElementById('flowToggleWrapper');
        if (!toggleWrapper) return;

        const hasAssets = toggleWrapper.getAttribute('data-has-assets') === 'true';
        const btnDaily = document.getElementById('btnDaily');
        const btnMonthly = document.getElementById('btnMonthly');

        const dailyData = JSON.parse(toggleWrapper.getAttribute('data-daily')) || [0, 0, 0, 0, 0, 0, 0];
        const monthlyData = JSON.parse(toggleWrapper.getAttribute('data-monthly')) || new Array(12).fill(0);

        const dailyLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        const monthlyLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // 1. Inisialisasi Chart Flow
        const ctxFlow = document.getElementById('flowChart').getContext('2d');
        const flowChart = new Chart(ctxFlow, {
            type: 'bar',
            data: {
                labels: dailyLabels,
                datasets: [{
                    data: dailyData,
                    backgroundColor: '#82afc2',
                    hoverBackgroundColor: '#4e7281',
                    borderRadius: 6,
                    borderSkipped: false,
                    barThickness: hasAssets ? 38 : 20
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        border: { display: false },
                        ticks: {
                            color: '#94a3b8',
                            font: { size: 10 }
                        }
                    },
                    y: {
                        grid: { color: '#f1f5f9' },
                        border: { display: false },
                        min: 0,
                        ticks: {
                            display: true,
                            color: '#94a3b8',
                            font: { size: 10 },
                            maxTicksLimit: 5,
                            callback: function(value) {
                                if (value % 1 === 0) return value;
                            }
                        }
                    }
                }
            }
        });

        // 2. Navigasi Switcher Filter Grafik
        function updateFlowChart(mode) {
            if (mode === 'daily') {
                btnDaily.className = "px-3 py-1 bg-white text-[#4e7281] font-bold rounded-md shadow-2xs transition-all duration-150";
                btnMonthly.className = "px-3 py-1 hover:text-gray-900 transition-all duration-150";

                flowChart.data.labels = dailyLabels;
                flowChart.data.datasets[0].data = dailyData;
                flowChart.data.datasets[0].barThickness = hasAssets ? 38 : 20;
            } else {
                btnMonthly.className = "px-3 py-1 bg-white text-[#4e7281] font-bold rounded-md shadow-2xs transition-all duration-150";
                btnDaily.className = "px-3 py-1 hover:text-gray-900 transition-all duration-150";

                flowChart.data.labels = monthlyLabels;
                flowChart.data.datasets[0].data = monthlyData;
                flowChart.data.datasets[0].barThickness = hasAssets ? 18 : 10;
            }
            flowChart.update();
        }

        btnDaily.addEventListener('click', () => updateFlowChart('daily'));
        btnMonthly.addEventListener('click', () => updateFlowChart('monthly'));

        // 3. Inisialisasi Chart Lingkaran (Condition Health)
        const canvasHealth = document.getElementById('healthChart');
        if (canvasHealth) {
            let rawHealthData = JSON.parse(canvasHealth.getAttribute('data-chart'));
            if (rawHealthData[0] === 0 && rawHealthData[1] === 0) {
                rawHealthData = [0, 0, 100];
            }

            new Chart(canvasHealth, {
                type: 'doughnut',
                data: {
                    labels: ['Excellent', 'Damaged', 'No Data'],
                    datasets: [{
                        data: rawHealthData,
                        backgroundColor: rawHealthData[2] === 100 ? ['#e2e8f0', '#e2e8f0', '#e2e8f0'] : ['#4e7281', '#fdba74', '#e2e8f0'],
                        borderWidth: 0,
                        weight: 0.5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '80%',
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }
    });
</script>
@endsection