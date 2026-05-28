@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Riwayat Pergerakan Aset</h1>
        <p class="text-gray-500 mt-1">Pantau siklus hidup dan perubahan status inventaris secara real-time.</p>
    </div>

    {{-- FILTER --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 mb-8">
        <form method="GET" class="flex flex-col md:flex-row gap-4">
            <input type="text" name="search" placeholder="Cari aktivitas..." value="{{ request('search') }}"
                   class="w-full border-gray-200 bg-gray-50 rounded-2xl p-4 focus:ring-2 focus:ring-[#4b8e96] outline-none transition">
            
            <select name="aktivitas" class="border-gray-200 bg-gray-50 rounded-2xl p-4 focus:ring-2 focus:ring-[#4b8e96] outline-none transition min-w-[200px]">
                <option value="">Semua Aktivitas</option>
                <option value="Menambahkan Asset" @selected(request('aktivitas') == 'Menambahkan Asset')>Menambahkan Asset</option>
                <option value="Update Asset" @selected(request('aktivitas') == 'Update Asset')>Update Asset</option>
                <option value="Hapus Asset" @selected(request('aktivitas') == 'Hapus Asset')>Hapus Asset</option>
            </select>

            <button class="bg-[#4b8e96] hover:bg-[#3d7a82] text-white px-8 rounded-2xl font-bold transition shadow-lg shadow-[#4b8e96]/20">
                Filter
            </button>
        </form>
    </div>

    {{-- HISTORY LIST --}}
    <div class="space-y-6">
        @foreach($histories as $history)
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                <div class="flex justify-between items-start gap-4">
                    <div>
                        {{-- AKTIVITAS --}}
                        <h2 class="text-lg font-bold text-[#4b8e96]">
                            {{ $history->aktivitas }}
                        </h2>

                        {{-- ASSET & USER INFO --}}
                        <div class="mt-2 text-sm text-gray-600">
                            <span class="font-bold text-gray-800">{{ $history->asset->nama_aset ?? 'Aset Tidak Ditemukan' }}</span>
                            <span class="mx-2">•</span>
                            <span class="text-gray-500">Oleh: {{ $history->user->name ?? 'Sistem' }}</span>
                        </div>

                        {{-- KETERANGAN --}}
                        <p class="mt-4 text-gray-600 text-sm bg-gray-50 p-4 rounded-xl">
                            {{ $history->keterangan }}
                        </p>
                    </div>

                    {{-- TANGGAL --}}
                    <div class="text-xs font-bold text-gray-400 bg-gray-50 px-3 py-1 rounded-full whitespace-nowrap">
                        {{ \Carbon\Carbon::parse($history->tanggal)->format('d M Y, H:i') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- PAGINATION --}}
    <div class="mt-8">
        {{ $histories->links() }}
    </div>

</div>
@endsection