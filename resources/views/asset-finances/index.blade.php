@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    
    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Keuangan Aset</h1>
            <p class="text-gray-500 mt-1">Ringkasan pengeluaran dan arus kas pemeliharaan aset.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('asset-finances.create') }}" class="bg-[#4b8e96] hover:bg-[#3d7a82] text-white px-6 py-3 rounded-xl font-bold transition shadow-lg shadow-[#4b8e96]/20">
                + Tambah Transaksi
            </a>
        </div>
    </div>

    {{-- STATS CARD --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Total Pengeluaran</p>
            <h3 class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalFinance, 0, ',', '.') }}</h3>
        </div>
        {{-- Anda bisa menambahkan card statistik lainnya di sini --}}
    </div>

    {{-- GRAFIK --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Statistik Pengeluaran</h2>
        <canvas id="financeChart" class="max-h-[300px]"
                data-labels="{{ json_encode($chart->pluck('jenis_transaksi')) }}" 
                data-values="{{ json_encode($chart->pluck('total')) }}">
        </canvas>
    </div>

    {{-- FILTER & EXPORT --}}
    <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
        <form method="GET" class="flex gap-2">
            <select name="bulan" class="border-gray-200 bg-gray-50 rounded-xl p-3 text-sm focus:ring-2 focus:ring-[#4b8e96]">
                <option value="">Semua Bulan</option>
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" @selected(request('bulan') == $i)>Bulan {{ $i }}</option>
                @endfor
            </select>
            <button class="bg-gray-800 text-white px-6 rounded-xl font-bold text-sm">Filter</button>
        </form>
        
        <div class="flex gap-2">
            <a href="{{ route('asset-finances.export.excel') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-3 rounded-xl text-sm font-bold transition">Excel</a>
            <a href="{{ route('asset-finances.export.pdf') }}" class="bg-rose-600 hover:bg-rose-700 text-white px-5 py-3 rounded-xl text-sm font-bold transition">PDF</a>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-400 text-xs uppercase tracking-widest">
                <tr>
                    <th class="p-6">Asset</th>
                    <th class="p-6">Jenis</th>
                    <th class="p-6">Nominal</th>
                    <th class="p-6">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($finances as $finance)
                <tr class="hover:bg-gray-50/50">
                    <td class="p-6 font-bold text-gray-700">{{ $finance->asset->nama_aset }}</td>
                    <td class="p-6 text-sm text-gray-600">{{ $finance->jenis_transaksi }}</td>
                    <td class="p-6 font-bold text-[#4b8e96]">Rp {{ number_format($finance->nominal, 0, ',', '.') }}</td>
                    <td class="p-6 text-sm text-gray-500">{{ $finance->tanggal_transaksi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-6 border-t border-gray-50">
            {{ $finances->links() }}
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const financeCtx = document.getElementById('financeChart');
    const labelData = JSON.parse(financeCtx.getAttribute('data-labels'));
    const valueData = JSON.parse(financeCtx.getAttribute('data-values'));

    new Chart(financeCtx, {
        type: 'bar',
        data: {
            labels: labelData,
            datasets: [{
                label: 'Nominal Transaksi',
                data: valueData,
                backgroundColor: '#4b8e96',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, grid: { display: false } }, x: { grid: { display: false } } }
        }
    });
</script>
@endsection