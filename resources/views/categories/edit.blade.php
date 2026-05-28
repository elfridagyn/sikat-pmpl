@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto" x-data="{ showSubModal: false }">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Edit Kategori</h1>
        <p class="text-gray-500 mt-1">Mengubah detail kategori: {{ $category->nama_kategori }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- KOLOM KIRI: FORM EDIT --}}
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 h-fit">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Form Edit</h2>
            <form method="POST" action="{{ route('categories.update', $category->id) }}">
                @csrf @method('PUT')
                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Kategori Main</label>
                    <input type="text" name="nama_kategori" value="{{ $category->nama_kategori }}" 
                           class="w-full border-gray-200 bg-gray-50 rounded-xl p-4 focus:ring-2 focus:ring-[#4b8e96] focus:border-[#4b8e96] transition" required>
                </div>
                <button type="submit" 
                        class="w-full bg-[#4b8e96] hover:bg-[#3d7a82] text-white py-4 rounded-xl font-bold transition duration-200 shadow-lg shadow-[#4b8e96]/20">
                    Update Kategori
                </button>
            </form>
        </div>

        {{-- KOLOM KANAN: SUB-KATEGORI --}}
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Sub-Kategori</h2>
                <button @click="showSubModal = true" class="text-sm font-bold text-[#4b8e96] border border-[#4b8e96] px-4 py-2 rounded-xl hover:bg-[#4b8e96] hover:text-white transition">
                    + Tambah Sub
                </button>
            </div>

            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-400 text-xs uppercase tracking-widest">
                        <th class="pb-4">Sub-Kategori</th>
                        <th class="pb-4">Kode</th>
                        <th class="pb-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($category->subCategories as $sub)
                    <tr class="group">
                        <td class="py-4 font-medium text-gray-700">{{ $sub->nama_subkategori }}</td>
                        <td class="py-4">
                            <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-lg text-xs font-mono font-bold">
                                {{ $sub->kode_subkategori }}
                            </span>
                        </td>
                        <td class="py-4 text-center">
                            <form method="POST" action="{{ route('subcategories.destroy', $sub->id) }}">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus subkategori ini?')" class="text-gray-300 hover:text-red-500 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL TAMBAH SUB-KATEGORI --}}
    <div x-show="showSubModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/30 backdrop-blur-sm" x-cloak>
        <div @click.away="showSubModal = false" class="bg-white rounded-3xl p-8 w-full max-w-md shadow-2xl">
            <h2 class="text-xl font-bold mb-6 text-gray-800">Detail Sub-Kategori</h2>
            <form action="{{ route('subcategories.store') }}" method="POST">
                @csrf
                <input type="hidden" name="category_id" value="{{ $category->id }}">
                
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Sub-Kategori</label>
                    <input type="text" name="nama_subkategori" placeholder="Contoh: Laptop, Meja, Mikroskop"
                           class="w-full border-gray-200 bg-gray-50 rounded-xl p-3 focus:ring-2 focus:ring-[#4b8e96]" required>
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Kode Sub-Kategori</label>
                    <input type="text" name="kode_subkategori" placeholder="Contoh: SUB-LAP-01"
                           class="w-full border-gray-200 bg-gray-50 rounded-xl p-3 focus:ring-2 focus:ring-[#4b8e96]" required>
                </div>

                <div class="flex gap-3 mt-8">
                    <button type="button" @click="showSubModal = false" class="w-full py-3 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition">Batal</button>
                    <button type="submit" class="w-full py-3 rounded-xl bg-[#4fa1b1] hover:bg-[#3f8897] text-white font-bold transition">Simpan Sub-Kategori</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection