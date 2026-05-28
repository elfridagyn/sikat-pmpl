@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Tambah Transaksi Keuangan</h1>
        <p class="text-gray-500 mt-1">Masukkan rincian pengeluaran aset baru ke dalam sistem.</p>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <form method="POST" action="{{ route('asset-finances.store') }}">
            @csrf

            {{-- ASSET --}}
            <div class="mb-6">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Pilih Aset</label>
                <select name="asset_id" class="w-full border-gray-200 bg-gray-50 rounded-xl p-4 focus:ring-2 focus:ring-[#4b8e96] outline-none transition" required>
                    @foreach($assets as $asset)
                        <option value="{{ $asset->id }}">{{ $asset->nama_aset }}</option>
                    @endforeach
                </select>
            </div>

            {{-- JENIS --}}
            <div class="mb-6">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Jenis Transaksi</label>
                <select name="jenis_transaksi" class="w-full border-gray-200 bg-gray-50 rounded-xl p-4 focus:ring-2 focus:ring-[#4b8e96] outline-none transition" required>
                    <option value="pembelian">Pembelian</option>
                    <option value="maintenance">Maintenance</option>
                    <option value="perbaikan">Perbaikan</option>
                    <option value="pengeluaran_lain">Pengeluaran Lain</option>
                </select>
            </div>

            {{-- NOMINAL & TANGGAL --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nominal (Rp)</label>
                    <input type="number" name="nominal" placeholder="Contoh: 1500000" class="w-full border-gray-200 bg-gray-50 rounded-xl p-4 focus:ring-2 focus:ring-[#4b8e96] outline-none transition" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Tanggal Transaksi</label>
                    <input type="date" name="tanggal_transaksi" class="w-full border-gray-200 bg-gray-50 rounded-xl p-4 focus:ring-2 focus:ring-[#4b8e96] outline-none transition" required>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="{{ url()->previous() }}" class="px-6 py-4 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition">Batal</a>
                <button type="submit" class="flex-1 bg-[#4b8e96] hover:bg-[#3d7a82] text-white py-4 rounded-xl font-bold shadow-lg shadow-[#4b8e96]/20 transition">
                    Simpan Transaksi
                </button>
            </div>

        </form>
    </div>

</div>
@endsection