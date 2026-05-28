@extends('layouts.app')

@section('content')
<div class="p-6 max-w-7xl mx-auto generic-container">

    {{-- SUB-HEADER / BREADCRUMB --}}
    <div class="text-xs font-bold text-slate-400 tracking-wide mb-1 uppercase">
        Details
    </div>

    {{-- BARIS HEADER UTAMA & TOMBOL AKSI --}}
    <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-6 gap-4">
        <div>
            <div class="flex flex-wrap items-center gap-3">
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">
                    {{ $asset->nama_aset }}
                </h1>
                <span class="px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-full flex items-center gap-1.5 border {{ $asset->status == 'aktif' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-rose-50 text-rose-700 border-rose-100' }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $asset->status == 'aktif' ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                    {{ $asset->status }}
                </span>
            </div>
            <p class="text-slate-400 text-xs mt-1 font-bold tracking-wide">
                ID: #{{ $asset->kode_aset ?? '-' }}
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            {{-- Logika Tombol Status (Toggle Aktif/Non-Aktif) --}}
            @if($asset->status == 'aktif')
            <form action="{{ route('assets.update', $asset->id) }}" method="POST" class="inline"
                onsubmit="return confirm('Apakah Anda yakin ingin menonaktifkan aset ini?')">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="non-aktif">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 rounded-xl font-bold text-xs transition tracking-wide shadow-sm">
                    Non Aktifkan Aset
                </button>
            </form>
            @else
            <form action="{{ route('assets.update', $asset->id) }}" method="POST" class="inline"
                onsubmit="return confirm('Apakah Anda yakin ingin mengaktifkan kembali aset ini?')">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="aktif">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl font-bold text-xs transition tracking-wide shadow-sm">
                    Aktifkan Aset
                </button>
            </form>
            @endif

            {{-- Tombol Aksi Lainnya --}}
            <a href="{{ route('assets.export.pdf', $asset->id) }}" class="flex items-center gap-1.5 px-4 py-2.5 border border-slate-200 bg-white rounded-xl text-slate-600 font-bold text-xs hover:bg-slate-50 transition shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Export Data
            </a>
            <a href="{{ route('assets.edit', $asset->id) }}" class="bg-[#1e788a] hover:bg-[#155663] text-white px-4 py-2.5 rounded-xl font-bold text-xs transition tracking-wide shadow-sm flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                </svg>
                Edit Aset
            </a>
        </div>
    </div>

    {{-- KONTEN LAYOUT UTAMA --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        {{-- SISI KIRI: DATA TEKSTUAL (2/3 KOLOM) --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- DATA UTAMA ASET --}}
            <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-xs">
                <span class="text-[10px] font-black text-[#4fa1b1] uppercase tracking-widest block mb-4">
                    Data Aset
                </span>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-sm">
                    <div class="space-y-0.5">
                        <span class="text-xs text-slate-400 block font-medium">Nama Aset</span>
                        <span class="font-bold text-slate-700 block">{{ $asset->nama_aset }}</span>
                    </div>
                    <div class="space-y-0.5">
                        <span class="text-xs text-slate-400 block font-medium">Kode Aset</span>
                        <span class="font-bold text-slate-700 block">#{{ $asset->kode_aset ?? '-' }}</span>
                    </div>
                    <div class="space-y-0.5">
                        <span class="text-xs text-slate-400 block font-medium">Kode Sistem</span>
                        <span class="font-bold text-slate-700 font-mono text-xs block uppercase">
                            #S-{{ str_pad($asset->id, 5, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>
                    <div class="space-y-0.5">
                        <span class="text-xs text-slate-400 block font-medium">Kategori</span>
                        <span class="font-bold text-slate-700 block">
                            {{ $asset->category->nama_kategori ?? 'Umum / Lainnya' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- DETAIL SPESIFIKASI TAMBAHAN (DARI FORM PEMBUATAN) --}}
            <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-xs">
                <span class="text-[10px] font-black text-[#4fa1b1] uppercase tracking-widest block mb-4">
                    Informasi Spesifikasi
                </span>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                    <div class="border-b border-slate-50 pb-2">
                        <span class="text-xs text-slate-400 block font-medium">Merk</span>
                        <span class="font-semibold text-slate-700">{{ $asset->merk ?? '-' }}</span>
                    </div>
                    <div class="border-b border-slate-50 pb-2">
                        <span class="text-xs text-slate-400 block font-medium">Tipe / Model</span>
                        <span class="font-semibold text-slate-700">{{ $asset->tipe ?? '-' }}</span>
                    </div>
                    <div class="border-b border-slate-50 pb-2">
                        <span class="text-xs text-slate-400 block font-medium">Produsen</span>
                        <span class="font-semibold text-slate-700">{{ $asset->produsen ?? '-' }}</span>
                    </div>
                    <div class="border-b border-slate-50 pb-2">
                        <span class="text-xs text-slate-400 block font-medium">No. Seri</span>
                        <span class="font-semibold text-slate-700 font-mono text-xs">{{ $asset->no_seri ?? '-' }}</span>
                    </div>
                    <div class="border-b border-slate-50 pb-2">
                        <span class="text-xs text-slate-400 block font-medium">Tahun Produksi</span>
                        <span class="font-semibold text-slate-700">{{ $asset->tahun_produksi ?? '-' }}</span>
                    </div>
                    <div class="border-b border-slate-50 pb-2">
                        <span class="text-xs text-slate-400 block font-medium">Distributor</span>
                        <span class="font-semibold text-slate-700">{{ $asset->distributor ?? '-' }}</span>
                    </div>
                    <div class="border-b border-slate-50 pb-2">
                        <span class="text-xs text-slate-400 block font-medium">No. Invoice</span>
                        <span class="font-semibold text-slate-700 font-mono text-xs">{{ $asset->no_invoice ?? '-' }}</span>
                    </div>
                    <div class="border-b border-slate-50 pb-2">
                        <span class="text-xs text-slate-400 block font-medium">Tgl Pembelian</span>
                        <span class="font-semibold text-slate-700">
                            {{ $asset->tanggal_pembelian ? \Carbon\Carbon::parse($asset->tanggal_pembelian)->format('d M Y') : '-' }}
                        </span>
                    </div>
                </div>
                @if($asset->deskripsi || $asset->keterangan_tambahan)
                <div class="mt-4 pt-3 border-t border-slate-100 grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                    @if($asset->deskripsi)
                    <div>
                        <span class="font-bold text-slate-400 block mb-1">Deskripsi Teknis:</span>
                        <p class="text-slate-600 bg-slate-50 p-2.5 rounded-lg border border-slate-100 leading-relaxed">{{ $asset->deskripsi }}</p>
                    </div>
                    @endif
                    @if($asset->keterangan_tambahan)
                    <div>
                        <span class="font-bold text-slate-400 block mb-1">Keterangan Tambahan:</span>
                        <p class="text-slate-600 bg-slate-50 p-2.5 rounded-lg border border-slate-100 leading-relaxed">{{ $asset->keterangan_tambahan }}</p>
                    </div>
                    @endif
                </div>
                @endif
            </div>

            {{-- PANEL AKUNTANSI & METRIK PENYUSUTAN KEUANGAN --}}
            <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-xs">
                <span class="text-[10px] font-black text-[#4fa1b1] uppercase tracking-widest block mb-4">
                    Skema Nilai Buku & Penyusutan Akuntansi
                </span>
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                    <div class="bg-slate-50/70 p-3 rounded-xl border border-slate-100/80">
                        <span class="text-[11px] text-slate-400 block font-medium">Harga Satuan</span>
                        <div class="text-base font-black text-slate-700 mt-0.5">Rp {{ number_format($asset->harga_satuan, 0, ',', '.') }}</div>
                    </div>
                    <div class="bg-slate-50/70 p-3 rounded-xl border border-slate-100/80">
                        <span class="text-[11px] text-slate-400 block font-medium">Kuantitas / Jumlah</span>
                        <div class="text-base font-black text-slate-700 mt-0.5">{{ $asset->jumlah ?? 1 }} Unit</div>
                    </div>
                    <div class="bg-slate-50/70 p-3 rounded-xl border border-slate-100/80">
                        <span class="text-[11px] text-slate-400 block font-medium">Total Pengadaan</span>
                        <div class="text-base font-black text-slate-800 mt-0.5">Rp {{ number_format($asset->harga_total, 0, ',', '.') }}</div>
                    </div>
                    <div class="bg-slate-50/70 p-3 rounded-xl border border-slate-100/80">
                        <span class="text-[11px] text-slate-400 block font-medium">Beban Susut / Bulan</span>
                        <div class="text-base font-black text-amber-600 mt-0.5">Rp {{ number_format($asset->penyusutan, 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="mt-4 text-[11px] text-slate-500 flex items-center gap-2 bg-cyan-50/30 border border-cyan-100/70 p-3 rounded-xl">
                    <span>⌛</span>
                    <span>Aset logistik ini dikonfigurasikan memiliki kalkulasi estimasi umur ekonomis operasional selama <strong class="text-slate-700">{{ $asset->umur_ekonomi ?? 5 }} Tahun</strong>.</span>
                </div>
            </div>

            {{-- MINI GRID (RIWAYAT AKTIF & FORM TAMBAH RIWAYAT RIIL) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- DETAIL RIWAYAT OPERASIONAL AKTIF --}}
                <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[10px] font-black text-[#4fa1b1] uppercase tracking-widest">
                                Riwayat Aset
                            </span>
                        </div>

                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between border-b border-slate-50 pb-1.5 items-center">
                                <span class="text-slate-400 text-xs font-medium">Sejak Tanggal</span>
                                <span class="font-bold text-slate-700">
                                    {{ $asset->histories->last() ? $asset->histories->last()->tanggal->format('d M Y') : $asset->created_at->format('d M Y') }}
                                </span>
                            </div>
                            <div class="flex justify-between border-b border-slate-50 pb-1.5 items-center">
                                <span class="text-slate-400 text-xs font-medium">Penanggung Jawab</span>
                                <span class="font-bold text-slate-700 tracking-tight text-right">
                                    {{ $asset->histories->last()->user->name ?? 'Belum Ditugaskan' }}
                                </span>
                            </div>
                            <div class="flex justify-between border-b border-slate-50 pb-1.5 items-center">
                                <span class="text-slate-400 text-xs font-medium">Lokasi</span>
                                <span class="font-bold text-slate-700 text-right">{{ $asset->lokasi ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between border-b border-slate-50 pb-1.5 items-center">
                                <span class="text-slate-400 text-xs font-medium">Kondisi</span>
                                <span class="font-bold text-slate-700">{{ $asset->kondisi ?? 'Baik' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FORMULIR SIMPAN RIWAYAT/MUTASI BARU KE DATABASE --}}
                <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-xs">
                    <span class="text-[10px] font-black text-[#4fa1b1] uppercase tracking-widest block mb-4">
                        + Tambah Riwayat Penugasan
                    </span>
                    <form action="{{ route('assets.histories.store', $asset->id) }}" method="POST" class="space-y-4 text-xs font-medium">
                        @csrf
                        <div>
                            <label class="block text-slate-500 font-bold mb-1">Sejak Tanggal *</label>
                            <input type="date" name="tanggal_mulai" required value="{{ date('Y-m-d') }}" class="w-full border border-slate-200 rounded-lg p-2.5 text-slate-700 focus:outline-none focus:ring-1 focus:ring-cyan-500 bg-slate-50/50 font-semibold">
                        </div>
                        <div>
                            <label class="block text-slate-500 font-bold mb-1">Pilih Penanggung Jawab *</label>
                            <select name="user_id" required class="w-full border border-slate-200 rounded-lg p-2.5 text-slate-700 bg-white focus:outline-none focus:ring-1 focus:ring-cyan-500">
                                <option value="">-- Pilih User --</option>
                                @foreach(\App\Models\User::all() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="w-full mt-2 bg-[#106677] hover:bg-[#0b4b58] text-white font-black py-2.5 rounded-xl transition tracking-wide shadow-xs text-xs">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>

            {{-- MAINTENANCE HISTORY DARI DATA DATABASE AKTIF --}}
            <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-xs">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-base font-black text-[#106677] tracking-tight">
                        Maintenance History
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-600 border-collapse">
                        <thead>
                            <tr class="text-slate-400 font-black border-b border-slate-100 uppercase tracking-wider text-[10px]">
                                <th class="pb-2">Date</th>
                                <th class="pb-2">Type</th>
                                <th class="pb-2">Engineer / PIC</th>
                                <th class="pb-2">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 font-semibold">
                            @forelse($asset->maintenances as $maintenance)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="py-3.5 text-slate-500">
                                    {{ $maintenance->tanggal_perbaikan->format('M d, Y') }}
                                </td>
                                <td class="py-3.5">
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold tracking-wide uppercase {{ $maintenance->jenis_perbaikan == 'Routine' ? 'bg-blue-50 text-blue-500' : 'bg-red-50 text-red-500' }}">
                                        {{ $maintenance->jenis_perbaikan }}
                                    </span>
                                </td>
                                <td class="py-3.5 text-slate-700">{{ $maintenance->nama_teknisi ?? '-' }}</td>
                                <td class="py-3.5 font-bold flex items-center gap-1 {{ $maintenance->status == 'Completed' ? 'text-emerald-600' : 'text-amber-500' }}">
                                    <span>{{ $maintenance->status == 'Completed' ? '✔' : '⏳' }}</span>
                                    {{ $maintenance->status }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-slate-400 bg-slate-50/30 rounded-xl">
                                    Belum ada riwayat pemeliharaan berkala untuk aset ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ============================================================================== --}}
        {{-- SISI KANAN: PANEL VISUAL (QR CODE & MEDIA IMAGE FILE) --}}
        {{-- ============================================================================== --}}
        <div class="space-y-6">

            {{-- SEKTOR QR CODE AKTIF --}}
            <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-xs">
                <span class="text-sm font-black text-[#106677] block mb-4">
                    QR Aset
                </span>
                <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 flex flex-col items-center justify-center">
                    @if($asset->qr_code && file_exists(public_path($asset->qr_code)))
                    <img src="{{ asset($asset->qr_code) }}" class="w-40 h-40 object-contain bg-white p-2 border rounded-xl shadow-xs">
                    @else
                    <div class="w-36 h-36 bg-white p-1.5 border rounded-xl shadow-xs flex items-center justify-center">
                        {!! QrCode::size(130)->generate(route('assets.show', $asset->id)) !!}
                    </div>
                    @endif
                    <div class="text-center mt-4">
                        <div class="font-black text-slate-800 text-sm">
                            #{{ $asset->kode_aset ?? '-' }}
                        </div>
                        <div class="text-[10px] text-slate-400 font-bold mt-0.5">
                            {{ $asset->nama_aset }}
                        </div>
                    </div>
                </div>
                {{-- Link Download QR --}}
                <a href="{{ route('assets.download.qr', $asset->id) }}" class="w-full mt-4 bg-white hover:bg-slate-50 border border-slate-200 text-slate-600 text-xs font-bold py-2.5 rounded-xl transition flex items-center justify-center gap-1.5 shadow-xs">
                    <svg xmlns="http://www.w3.org/2000/xl" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    Download QR
                </a>
            </div>

            {{-- SEKTOR IMAGE DOKUMENTASI --}}
            <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-xs">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-sm font-black text-[#106677]">
                        Foto Aset
                    </span>
                </div>

                <div class="w-full h-48 bg-slate-100 rounded-xl overflow-hidden border border-slate-200 shadow-xs relative">
                    @if($asset->foto_aset && file_exists(storage_path('app/public/' . $asset->foto_aset)))
                    <img src="{{ asset('storage/' . $asset->foto_aset) }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-50 gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375 0 1 1-.75 0 .375 0 0 1 .75 0Z" />
                        </svg>
                        <span class="text-[11px]">Tidak ada berkas gambar</span>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

</div>
@endsection