@extends('layouts.app')

@section('content')
<div class="p-6 max-w-7xl mx-auto generic-container">
    
    {{-- HEADER UTAMA --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                {{ request('status') == 'non-aktif' ? 'Aset Non-Aktif' : 'Daftar Aset Aktif' }}
            </h1>
            <p class="text-gray-500 text-sm mt-1">
                {{ request('status') == 'non-aktif' 
                    ? 'Manajemen inventaris yang telah didekomisioning atau tidak aktif.' 
                    : 'Kelola dan pantau semua aset infrastruktur yang sedang beroperasi.' }}
            </p>
        </div>

        <div class="flex items-center gap-3">
            @if(request('status') == 'non-aktif')
                <a href="{{ route('assets.create') }}" class="bg-[#4fa1b1] hover:bg-[#3f8897] text-white px-5 py-2.5 rounded-xl font-semibold shadow-sm flex items-center gap-2 text-sm transition">
                    + Tambah Aset Baru
                </a>
            @else
                <a href="{{ route('assets.create') }}" class="bg-[#469cb0] hover:bg-[#398091] text-white px-5 py-2.5 rounded-lg font-medium shadow-sm flex items-center gap-2 text-sm transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Aset Baru
                </a>
            @endif
        </div>
    </div>

    {{-- TAB FILTER STATUS (AKTIF / NON-AKTIF) --}}
    <div class="flex border-b border-gray-200 mb-6 gap-2 text-sm font-medium">
        <a href="{{ route('assets.index', ['status' => 'aktif']) }}" 
           class="px-5 py-3 border-b-2 transition-all {{ request('status', 'aktif') == 'aktif' ? 'border-[#469cb0] text-[#469cb0] font-bold' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
            Aset Aktif
            <span class="ml-1.5 px-2 py-0.5 text-xs rounded-full bg-slate-100 text-slate-600 font-normal">
                {{ \App\Models\Asset::where('status', 'aktif')->count() }}
            </span>
        </a>
        <a href="{{ route('assets.index', ['status' => 'non-aktif']) }}" 
           class="px-5 py-3 border-b-2 transition-all {{ request('status') == 'non-aktif' ? 'border-[#4fa1b1] text-[#4fa1b1] font-bold' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
            Aset Non-Aktif
            <span class="ml-1.5 px-2 py-0.5 text-xs rounded-full bg-slate-100 text-slate-600 font-normal">
                {{ \App\Models\Asset::where('status', 'non-aktif')->count() }}
            </span>
        </a>
    </div>

    {{-- ============================================================================== --}}
    {{-- BLOK TAMPILAN: JIKA STATUS = NON-AKTIF --}}
    {{-- ============================================================================== --}}
    @if(request('status') == 'non-aktif')
        
        {{-- BARIS RINGKASAN DATA MOCKUP --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="lg:col-span-2 bg-white rounded-3xl p-6 border border-slate-100 flex justify-between items-center relative overflow-hidden shadow-sm">
                <div class="z-10">
                    <h3 class="text-lg font-bold text-[#4fa1b1] mb-1">Ringkasan Kuartal</h3>

                    <div class="flex gap-12">
                        <div>
                            <div class="text-2xl font-black text-slate-800">{{ \App\Models\Asset::where('status', 'non-aktif')->count() }}</div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Aset</div>
                        </div>
                        <div>
                            <div class="text-2xl font-black text-[#4fa1b1]">{{ \App\Models\Asset::where('status', 'non-aktif')->whereMonth('created_at', now()->month)->count() }}</div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Bulan Ini</div>
                        </div>
                    </div>
                </div>
                <div class="w-32 opacity-20">
                    <svg viewBox="0 0 100 100" class="w-full text-slate-400" fill="currentColor">
                        <rect x="10" y="50" width="15" height="50" />
                        <rect x="35" y="20" width="15" height="80" />
                        <rect x="60" y="40" width="15" height="60" />
                        <rect x="85" y="10" width="15" height="90" />
                    </svg>
                </div>
            </div>

            
        </div>

        {{-- BARIS FILTER MINI NON-AKTIF --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4 bg-white p-4 rounded-2xl border border-slate-100 gap-4 shadow-sm">
            <div class="flex flex-wrap items-center gap-3">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-wide">Filter Status:</span>
                <a href="{{ route('assets.index', ['status' => 'non-aktif']) }}" class="px-4 py-1.5 rounded-full text-xs font-bold {{ !request('kondisi') ? 'bg-[#4fa1b1] text-white' : 'bg-slate-50 text-slate-500 hover:bg-slate-100' }}">Semua</a>
                <a href="{{ route('assets.index', ['status' => 'non-aktif', 'kondisi' => 'Rusak Berat']) }}" class="px-4 py-1.5 rounded-full text-xs font-bold {{ request('kondisi') == 'Rusak Berat' ? 'bg-[#4fa1b1] text-white' : 'bg-slate-50 text-slate-500 hover:bg-slate-100' }}">Rusak Berat</a>
                <a href="{{ route('assets.index', ['status' => 'non-aktif', 'kondisi' => 'Masa Pakai Habis']) }}" class="px-4 py-1.5 rounded-full text-xs font-bold {{ request('kondisi') == 'Masa Pakai Habis' ? 'bg-[#4fa1b1] text-white' : 'bg-slate-50 text-slate-500 hover:bg-slate-100' }}">Masa Pakai Habis</a>
            </div>
            <div class="text-xs font-bold text-slate-400 flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25" />
                </svg>
                Urutkan: Terbaru
            </div>
        </div>

        {{-- TABEL DESAIN 2: KUSTOM ASET NON-AKTIF --}}
        <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm p-4">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-y-3">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            <th class="px-6 py-2">Asset ID</th>
                            <th class="px-6 py-2">Nama Aset</th>
                            <th class="px-6 py-2">Alasan Non-Aktif</th>
                            <th class="px-6 py-2">Tanggal</th>
                            <th class="px-6 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700">
                        @forelse($assets as $asset)
                        <tr class="hover:bg-slate-50/80 transition shadow-sm rounded-2xl bg-slate-50/30">
                            <td class="px-6 py-4 font-bold text-[#4fa1b1]">
                                #UB-{{ $asset->tahun_produksi ?? '2023' }}-{{ str_pad($asset->id, 3, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    @if($asset->foto_aset)
                                        <img src="{{ asset('storage/' . $asset->foto_aset) }}" class="w-10 h-10 rounded-xl object-cover border shadow-sm">
                                    @else
                                        <div class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-300 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375 0 11-.75 0 .375 0 01.75 0z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-bold text-slate-800">{{ $asset->nama_aset }}</div>
                                        <div class="text-[10px] text-slate-400 mt-0.5">{{ $asset->merk }} &bull; {{ $asset->category->nama_kategori ?? 'Umum' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-[9px] font-black uppercase tracking-widest rounded-full border bg-blue-50 text-blue-500 border-blue-100">
                                    &bull; {{ $asset->kondisi ?? 'Dekomisioning' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-500 font-medium">
                                {{ $asset->updated_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-3">
                                    <a href="{{ route('assets.show', $asset->id) }}" class="text-slate-400 hover:text-[#4fa1b1] transition" title="Lihat Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" class="inline" onclick="return confirm('Hapus data dekomisi aset ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-slate-400 hover:text-red-500 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-slate-400 bg-gray-50/50 rounded-2xl">Tidak ada data aset non-aktif terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINASI NON-AKTIF KOTAK BULAT --}}
            <div class="flex items-center justify-between mt-6 px-2">
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                    Menampilkan {{ $assets->firstItem() ?? 0 }}-{{ $assets->lastItem() ?? 0 }} dari {{ $assets->total() }} aset
                </div>
                <div class="flex items-center gap-1">
                    <a href="{{ $assets->previousPageUrl() }}" class="p-2 text-slate-400 hover:bg-slate-100 rounded-lg transition">‹</a>
                    @foreach ($assets->getUrlRange(1, $assets->lastPage()) as $page => $url)
                        <a href="{{ $url }}" class="w-7 h-7 flex items-center justify-center text-xs font-bold rounded-lg transition {{ $page == $assets->currentPage() ? 'bg-[#4fa1b1] text-white shadow-sm' : 'text-slate-400 hover:bg-slate-50' }}">
                            {{ $page }}
                        </a>
                    @endforeach
                    <a href="{{ $assets->nextPageUrl() }}" class="p-2 text-slate-400 hover:bg-slate-100 rounded-lg transition">›</a>
                </div>
            </div>
        </div>

    {{-- ============================================================================== --}}
    {{-- BLOK TAMPILAN: JIKA STATUS = AKTIF --}}
    {{-- ============================================================================== --}}
    @else
        
        {{-- BARIS FILTER UTAMA ASET AKTIF --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 mb-6">
            <form method="GET" action="{{ route('assets.index') }}" class="space-y-4">
                <input type="hidden" name="status" value="aktif">

                <div>
                    <span class="text-xs font-semibold text-blue-400 block mb-2 tracking-wide uppercase">Tampilkan:</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-3 items-center">
                        
                        {{-- Input Cari Nama Kombinasi --}}
                        <div class="md:col-span-2">
                            <input type="text" name="search" placeholder="Cari Nama Aset" value="{{ request('search') }}"
                                class="border border-gray-300 rounded-lg p-2 text-sm w-full focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                        </div>

                        {{-- Dropdown Kategori Dinamis --}}
                        <div>
                            <select name="kategori" class="border border-gray-300 text-gray-600 rounded-lg p-2 text-sm w-full bg-white focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected(request('kategori') == $category->id)>{{ $category->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Dropdown Merk Dinamis (Mengambil data unik dari koleksi database) --}}
                        <div>
                            <select name="merk" class="border border-gray-300 text-gray-600 rounded-lg p-2 text-sm w-full bg-white focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                <option value="">Semua Merk</option>
                                @foreach(\App\Models\Asset::whereNotNull('merk')->distinct()->pluck('merk') as $brand)
                                    <option value="{{ $brand }}" @selected(request('merk') == $brand)>{{ $brand }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Dropdown Toko / Distributor Dinamis --}}
                        <div>
                            <select name="toko" class="border border-gray-300 text-gray-600 rounded-lg p-2 text-sm w-full bg-white focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                <option value="">Semua Toko</option>
                                @foreach(\App\Models\Asset::whereNotNull('distributor')->distinct()->pluck('distributor') as $vendor)
                                    <option value="{{ $vendor }}" @selected(request('toko') == $vendor)>{{ $vendor }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Baris Filter Bawah --}}
                <div class="grid grid-cols-1 md:grid-cols-5 gap-3 items-center pt-2">
                    {{-- Dropdown Penanggung Jawab Dinamis (Diambil dari riwayat aktivitas / log inputer unik) --}}
                    <div>
                        <select name="penanggung_jawab" class="border border-gray-300 text-gray-600 rounded-lg p-2 text-sm w-full bg-white focus:outline-none focus:ring-2 focus:ring-cyan-500">
                            <option value="">Semua Penanggung Jawab</option>
                            @foreach(\App\Models\AssetHistory::with('user')->get()->pluck('user.name')->unique() as $username)
                                @if($username)
                                    <option value="{{ $username }}" @selected(request('penanggung_jawab') == $username)>{{ $username }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    {{-- Dropdown Lokasi Dinamis --}}
                    <div>
                        <select name="lokasi" class="border border-gray-300 text-gray-600 rounded-lg p-2 text-sm w-full bg-white focus:outline-none focus:ring-2 focus:ring-cyan-500">
                            <option value="">Semua Lokasi</option>
                            @foreach(\App\Models\Asset::whereNotNull('lokasi')->distinct()->pluck('lokasi') as $loc)
                                <option value="{{ $loc }}" @selected(request('lokasi') == $loc)>{{ $loc }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <button type="submit" class="bg-[#469cb0] hover:bg-[#398091] text-white font-medium px-6 py-2 rounded-lg text-sm transition">
                            GO!
                        </button>
                    </div>
                </div>

                <hr class="border-gray-100 my-2">

                {{-- Urutan Pengurutan Tabel --}}
                <div>
                    <span class="text-xs font-semibold text-blue-400 block mb-2 tracking-wide uppercase">Urutkan Berdasar:</span>
                    <div class="flex flex-wrap gap-3 items-center">
                        <select name="sort_by" class="border border-gray-300 text-gray-600 rounded-lg p-2 text-sm bg-white min-w-[150px] focus:outline-none">
                            <option value="created_at" @selected(request('sort_by') == 'created_at' || !request('sort_by'))>Riwayat Tanggal</option>
                            <option value="nama_aset" @selected(request('sort_by') == 'nama_aset')>Nama Aset</option>
                            <option value="harga_total" @selected(request('sort_by') == 'harga_total')>Nilai Harga Total</option>
                        </select>
                        <select name="sort_order" class="border border-gray-300 text-gray-600 rounded-lg p-2 text-sm bg-white min-w-[120px] focus:outline-none">
                            <option value="desc" @selected(request('sort_order') == 'desc' || !request('sort_order'))>Menurun</option>
                            <option value="asc" @selected(request('sort_order') == 'asc')>Menaik</option>
                        </select>
                        <button type="submit" class="bg-[#469cb0] hover:bg-[#398091] text-white font-medium px-6 py-2 rounded-lg text-sm transition">
                            GO!
                        </button>
                        <a href="{{ route('assets.index', ['status' => 'aktif']) }}" class="text-sm text-gray-400 hover:text-gray-600 ml-2 transition">
                            Reset Filter
                        </a>
                    </div>
                </div>
            </form>
        </div>

        {{-- SUB-BAR INFO TABEL UTAMA --}}
        <div class="flex items-center justify-between mb-3 px-1 text-xs text-gray-500 font-medium">
            <div>
                <span>Menampilkan {{ $assets->firstItem() ?? 0 }}-{{ $assets->lastItem() ?? 0 }} dari {{ $assets->total() }} aset aktif</span>
            </div>
            <a href="{{ route('assets.export.excel') }}" title="Export Excel" class="text-emerald-600 hover:text-emerald-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </a>
        </div>

        {{-- TABEL DESAIN 1: KHUSUS UTAMA ASET AKTIF --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#469cb0] text-white text-[11px] font-bold tracking-wider uppercase">
                            <th class="p-4 w-12 text-center"></th>
                            <th class="p-4">Nama Aset</th>
                            <th class="p-4">Kode</th>
                            <th class="p-4">Merk & Tipe</th>
                            <th class="p-4">Penyusutan</th>
                            <th class="p-4">Riwayat Terakhir</th>
                            <th class="p-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                        @forelse($assets as $asset)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-4 text-center">
                                <div class="w-8 h-8 bg-gray-50 border border-gray-200 rounded flex items-center justify-center text-gray-400 mx-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="flex items-start gap-3">
                                    <div class="p-2 bg-slate-100 rounded-lg text-gray-400 mt-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <a href="{{ route('assets.show', $asset->id) }}" class="font-bold text-gray-800 hover:text-[#469cb0] block">
                                            {{ $asset->nama_aset }}
                                        </a>
                                        <span class="text-xs text-gray-400 block mt-0.5">
                                            {{ $asset->category->nama_kategori ?? 'Tak Berkategori' }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="font-bold text-gray-800 block">{{ $asset->kode_aset ?? '166/INV/2023' }}</span>
                                <span class="text-[10px] text-gray-400 tracking-wider font-mono block mt-0.5 uppercase">
                                    KODE SISTEM: #S-{{ str_pad($asset->id, 4, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            <td class="p-4 text-gray-600 font-medium">
                                {{ $asset->merk }} <span class="text-xs text-gray-400 block font-normal">{{ $asset->tipe ?? '-' }}</span>
                            </td>
                            <td class="p-4 text-xs space-y-0.5">
                                <div class="flex items-center gap-1 text-gray-500">
                                    <span class="text-gray-400 text-[10px]">🛒</span> Rp {{ number_format($asset->harga_total, 0, ',', '.') }}
                                </div>
                                <div class="flex items-center gap-1 text-gray-400">
                                    <span class="text-[10px]">🕒</span> Rp {{ number_format($asset->penyusutan, 0, ',', '.') }}/bln
                                </div>
                                <div class="flex items-center gap-1 text-gray-700 font-semibold">
                                    <span class="text-gray-400 text-[10px]">🔄</span> Rp {{ number_format(($asset->harga_total) - ($asset->penyusutan), 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="p-4 text-xs">
                                <span class="font-bold text-gray-700 block">{{ $asset->updated_at->format('d M Y') }}</span>
                                <span class="text-gray-500 block">Sistem SIKAT</span>
                                <span class="text-gray-400 block text-[11px]">{{ $asset->lokasi ?? 'Gedung Pusat' }}</span>
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex items-center justify-center">
                                    <a href="{{ route('assets.show', $asset->id) }}" class="p-2 border border-cyan-100 rounded-lg text-cyan-500 bg-cyan-50/30 hover:bg-cyan-50 transition" title="Lihat Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center p-8 text-gray-400 bg-gray-50/50">Tidak ada data aset infrastruktur aktif yang sesuai filter.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- FOOTER PAGINASI ASET AKTIF --}}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-4 bg-white p-4 rounded-xl border border-gray-100">
            <div>
            <a href="{{ route('assets.export.excel') }}" title="Export Excel" class="text-emerald-600 hover:text-emerald-700 transition">
                    <svg xmlns="http://www.w3.org/2000/xl" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Export Data (CSV/Excel)
                </a>
            </div>
            <div class="text-sm">
                {{ $assets->appends(request()->query())->links() }}
            </div>
        </div>
    @endif
</div>
@endsection