@extends('layouts.app')

@section('content')
<div class="p-6 max-w-7xl mx-auto generic-container">
    
    {{-- HEADER HALAMAN --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Edit Aset</h1>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ url()->previous() }}" class="flex items-center gap-1 text-sm font-medium text-slate-600 hover:text-slate-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    {{-- MAIN FORM --}}
    <form method="POST" action="{{ route('assets.update', $asset->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            {{-- KOLOM KIRI --}}
            <div class="lg:col-span-7 space-y-6">
                
                {{-- CARD: UMUM --}}
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100">
                    <h2 class="text-xs font-bold text-teal-600 tracking-wider uppercase mb-4">Umum</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Aset <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_aset" value="{{ old('nama_aset', $asset->nama_aset) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-teal-500 transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kode Aset</label>
                            <input type="text" name="kode_aset" value="{{ $asset->kode_aset }}" readonly class="w-full bg-slate-100 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-gray-500 cursor-not-allowed">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kategori</label>
                            <select name="kategori_id" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-teal-500 transition-colors appearance-none bg-no-repeat bg-right pr-10" style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke=%22%2364748b%22 stroke-width=%222%22><path stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22m19.5 8.25-7.5 7.5-7.5-7.5%22/></svg>'); background-size: 1.25rem;">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected($asset->kategori_id == $category->id)>{{ $category->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- CARD: DETIL ASET --}}
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100">
                    <h2 class="text-xs font-bold text-teal-600 tracking-wider uppercase mb-4">Detil Aset</h2>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div><label class="block text-xs font-semibold text-slate-700 mb-1.5">Merk <span class="text-red-500">*</span></label><input type="text" name="merk" value="{{ old('merk', $asset->merk) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm"></div>
                            <div><label class="block text-xs font-semibold text-slate-700 mb-1.5">Tipe</label><input type="text" name="tipe" value="{{ old('tipe', $asset->tipe) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm"></div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div><label class="block text-xs font-semibold text-slate-700 mb-1.5">Lokasi <span class="text-red-500">*</span></label><input type="text" name="lokasi" value="{{ old('lokasi', $asset->lokasi) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm"></div>
                            <div><label class="block text-xs font-semibold text-slate-700 mb-1.5">Kondisi <span class="text-red-500">*</span></label><input type="text" name="kondisi" value="{{ old('kondisi', $asset->kondisi) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm"></div>
                        </div>
                        <div><label class="block text-xs font-semibold text-slate-700 mb-1.5">Produsen</label><input type="text" name="produsen" value="{{ old('produsen', $asset->produsen) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm"></div>
                        <div><label class="block text-xs font-semibold text-slate-700 mb-1.5">No. Seri / Kode Produksi</label><input type="text" name="no_seri" value="{{ old('no_seri', $asset->no_seri) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm"></div>
                        <div><label class="block text-xs font-semibold text-slate-700 mb-1.5">Tahun Produksi</label><input type="number" name="tahun_produksi" value="{{ old('tahun_produksi', $asset->tahun_produksi) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm"></div>
                        <div><label class="block text-xs font-semibold text-slate-700 mb-1.5">Deskripsi</label><textarea name="deskripsi" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm">{{ old('deskripsi', $asset->deskripsi) }}</textarea></div>
                    </div>
                </div>

                {{-- CARD: PEMBELIAN --}}
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100">
                    <h2 class="text-xs font-bold text-teal-600 tracking-wider uppercase mb-4">Pembelian</h2>
                    <div class="space-y-4">
                        <div><label class="block text-xs font-semibold text-slate-700 mb-1.5">Tanggal Pembelian <span class="text-red-500">*</span></label><input type="date" name="tanggal_pembelian" value="{{ old('tanggal_pembelian', $asset->tanggal_pembelian) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm"></div>
                        <div><label class="block text-xs font-semibold text-slate-700 mb-1.5">Toko / Distributor <span class="text-red-500">*</span></label><input type="text" name="distributor" value="{{ old('distributor', $asset->distributor) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm"></div>
                        <div><label class="block text-xs font-semibold text-slate-700 mb-1.5">No. Invoice</label><input type="text" name="no_invoice" value="{{ old('no_invoice', $asset->no_invoice) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm"></div>
                        <div class="grid grid-cols-2 gap-4">
                            <div><label class="block text-xs font-semibold text-slate-700 mb-1.5">Jumlah <span class="text-red-500">*</span></label><input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', $asset->jumlah) }}" min="1" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm"></div>
                            <div><label class="block text-xs font-semibold text-slate-700 mb-1.5">Harga Satuan (Rp) <span class="text-red-500">*</span></label><input type="number" id="harga_satuan" name="harga_satuan" value="{{ old('harga_satuan', $asset->harga_satuan) }}" min="0" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm"></div>
                        </div>
                        <div class="flex justify-between items-center pt-2 text-sm">
                            <span class="text-slate-500 font-medium">Harga Total (Rp)</span>
                            <span id="harga_total" class="font-semibold text-teal-600">0,00</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN --}}
            <div class="lg:col-span-5 space-y-6">
                
                {{-- CARD: FOTO --}}
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100">
                    <h2 class="text-xs font-bold text-teal-600 tracking-wider uppercase mb-4">Foto Aset</h2>
                    @if($asset->foto_aset)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $asset->foto_aset) }}" class="w-32 h-32 object-cover rounded-xl border mb-2">
                            <p class="text-[10px] text-slate-400">Foto saat ini terpasang.</p>
                        </div>
                    @endif
                    <div class="flex items-center gap-4">
                        <div class="w-32 h-32 border-2 border-dashed border-slate-200 rounded-xl flex flex-col items-center justify-center bg-slate-50 text-slate-400 overflow-hidden">
                            <img id="preview_foto" src="#" class="w-full h-full object-cover hidden">
                            <svg id="placeholder_icon_foto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" /></svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-slate-400 mb-3" id="nama_file_foto">Ganti foto utama aset.</p>
                            <label class="inline-block bg-[#4fa1b1] hover:bg-[#3f8897] text-white text-xs font-semibold px-4 py-2 rounded-xl cursor-pointer transition-colors">+ UPLOAD FOTO
                                <input type="file" name="foto_aset" accept="image/*" class="hidden">
                            </label>
                        </div>
                    </div>
                </div>

                {{-- CARD: LAMPIRAN --}}
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100">
                    <h2 class="text-xs font-bold text-teal-600 tracking-wider uppercase mb-3">Lampiran</h2>
                    <p class="text-xs text-slate-400 mb-4" id="nama_file_lampiran">{{ $asset->lampiran ? 'File ada: '.basename($asset->lampiran) : 'Anda bisa mengunggah dokumen baru.' }}</p>
                    <label class="inline-block bg-[#4fa1b1] hover:bg-[#3f8897] text-white text-xs font-semibold px-4 py-2 rounded-xl cursor-pointer transition-colors">+ UPLOAD
                        <input type="file" name="lampiran" class="hidden">
                    </label>
                </div>

                {{-- CARD: PENYUSUTAN --}}
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100">
                    <h2 class="text-xs font-bold text-teal-600 tracking-wider uppercase mb-4">Penyusutan</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Umur Ekonomi <span class="text-red-500">*</span></label>
                            <div class="flex items-center gap-3">
                                <input type="number" id="umur_ekonomi" name="umur_ekonomi" value="{{ old('umur_ekonomi', $asset->umur_ekonomi) }}" min="1" required class="w-24 bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm">
                                <span class="text-sm text-slate-500">Tahun</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center pt-2 text-sm">
                            <span class="text-slate-500 font-medium">Penyusutan (Rp)</span>
                            <span id="nilai_penyusutan" class="font-semibold text-teal-600">0,00 / bulan</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#4fa1b1] hover:bg-[#3f8897] text-white font-semibold py-3.5 rounded-2xl transition-all shadow-md text-sm">UPDATE DATA ASET</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jumlahInput = document.getElementById('jumlah');
        const hargaSatuanInput = document.getElementById('harga_satuan');
        const hargaTotalSpan = document.getElementById('harga_total');
        const umurEkonomiInput = document.getElementById('umur_ekonomi');
        const penyusutanSpan = document.getElementById('nilai_penyusutan');

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(number);
        }

        function calculate() {
            const jumlah = parseFloat(jumlahInput.value) || 0;
            const hargaSatuan = parseFloat(hargaSatuanInput.value) || 0;
            const total = jumlah * hargaSatuan;
            hargaTotalSpan.textContent = formatRupiah(total);
            const umurTahun = parseFloat(umurEkonomiInput.value) || 0;
            if (umurTahun > 0 && total > 0) {
                const penyusutanBulan = total / (umurTahun * 12);
                penyusutanSpan.textContent = formatRupiah(penyusutanBulan) + ' / bulan';
            } else {
                penyusutanSpan.textContent = '0,00 / bulan';
            }
        }

        [jumlahInput, hargaSatuanInput, umurEkonomiInput].forEach(el => el.addEventListener('input', calculate));
        calculate();

        const inputFoto = document.querySelector('input[name="foto_aset"]');
        inputFoto.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    document.getElementById('preview_foto').src = e.target.result;
                    document.getElementById('preview_foto').classList.remove('hidden');
                    document.getElementById('placeholder_icon_foto').classList.add('hidden');
                }
                reader.readAsDataURL(this.files[0]);
                document.getElementById('nama_file_foto').textContent = "Terpilih: " + this.files[0].name;
            }
        });
    });
</script>
@endsection