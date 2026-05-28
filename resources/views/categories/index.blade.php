@extends('layouts.app')

@section('content')
{{-- Gunakan container agar rapi di desktop --}}
<div class="max-w-6xl mx-auto px-4" x-data="{ showSubModal: false, showCategoryModal: false }">

    {{-- Header: Gunakan flex-wrap agar tombol turun ke bawah di layar kecil --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Kategori Aset</h1>
            <p class="text-gray-500 mt-1">Kelola hierarki aset universitas dengan efisien.</p>
        </div>

        <div class="flex gap-3 w-full md:w-auto">
            <button @click="showCategoryModal = true" class="flex-1 md:flex-none bg-[#4fa1b1] hover:bg-[#3f8897] text-white px-5 py-3 rounded-xl font-medium transition">
                + Tambah Kategori
            </button>
            <button @click="showSubModal = true" class="flex-1 md:flex-none bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-3 rounded-xl font-medium transition">
                + Subkategori
            </button>
        </div>
    </div>

    {{-- Tabel Kategori: Bungkus dengan div overflow-x-auto untuk responsivitas --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[600px]">
            <thead>
                <tr class="bg-gray-50 text-gray-400 text-xs uppercase tracking-widest">
                    <th class="p-6">Nama Kategori</th>
                    <th class="p-6">Subkategori</th>
                    <th class="p-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($categories as $category)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="p-6">
                        <div class="font-bold text-gray-800">{{ $category->nama_kategori }}</div>
                        <div class="text-xs text-gray-400">ID: CAT-{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}</div>
                    </td>
                    <td class="p-6">
                        <div class="flex flex-wrap gap-2">
                            @foreach($category->subCategories as $sub)
                            <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-medium border border-blue-100 whitespace-nowrap">
                                {{ $sub->nama_subkategori }}
                            </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="p-6">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('categories.edit', $category->id) }}" class="text-gray-400 hover:text-yellow-500 transition p-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg></a>
                            <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus kategori?')" class="text-gray-400 hover:text-red-500 transition p-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- MODAL TAMBAH KATEGORI --}}
    <div x-show="showCategoryModal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm"
        x-cloak>

        {{-- max-w-md membuat modal lebih kecil & tidak full layar --}}
        <div @click.away="showCategoryModal = false"
            class="bg-white rounded-[2rem] p-8 w-full max-w-md shadow-2xl transform transition-all">

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Detail Kategori</h2>
                <button @click="showCategoryModal = false" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Kategori *</label>
                    <input type="text" name="nama_kategori" placeholder="Contoh: Elektronik"
                        class="w-full border-gray-200 bg-gray-50 rounded-xl p-3 focus:ring-2 focus:ring-[#4fa1b1] transition" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kode Kategori</label>
                    <div class="relative">
                        <input type="text" disabled placeholder="CAT-2026-001"
                            class="w-full border-gray-200 bg-gray-50 rounded-xl p-3 text-gray-400 cursor-not-allowed">
                        <span class="absolute right-4 top-3 text-gray-400">🔒</span>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Keterangan</label>
                    <textarea name="keterangan" rows="3"
                        placeholder="Deskripsi singkat..."
                        class="w-full border-gray-200 bg-gray-50 rounded-xl p-3 focus:ring-2 focus:ring-[#4fa1b1] transition"></textarea>
                </div>

                <div class="flex gap-3">
                    <button type="button" @click="showCategoryModal = false"
                        class="w-full py-3 rounded-xl font-bold text-gray-600 hover:bg-gray-100 transition">Batal</button>
                    <button type="submit"
                        class="w-full py-3 rounded-xl bg-[#106677] hover:bg-[#0c4e5b] text-white font-bold transition shadow-md">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL TAMBAH SUBKATEGORI --}}
    <div x-show="showSubModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50" x-cloak>
        <div @click.away="showSubModal = false" class="bg-white rounded-3xl p-8 w-full max-w-lg shadow-2xl">
            <h2 class="text-xl font-bold mb-6">Tambah Subkategori</h2>
            <form action="{{ route('subcategories.store') }}" method="POST">
                @csrf
                <div class="mb-4"><label class="block text-sm font-semibold mb-2">Kategori Induk</label><select name="category_id" class="w-full border-gray-200 rounded-xl p-3 bg-gray-50" required>@foreach($categories as $cat)<option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>@endforeach</select></div>
                <div class="mb-6"><label class="block text-sm font-semibold mb-2">Nama Subkategori</label><input type="text" name="nama_subkategori" class="w-full border-gray-200 rounded-xl p-3 bg-gray-50" required></div>
                <div class="flex gap-3"><button type="button" @click="showSubModal = false" class="w-full py-3 rounded-xl bg-gray-100 font-bold hover:bg-gray-200 transition">Batal</button><button type="submit" class="w-full py-3 rounded-xl bg-[#4fa1b1] text-white font-bold">Simpan</button></div>
            </form>
        </div>
    </div>
</div>
@endsection