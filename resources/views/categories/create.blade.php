@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">
    {{-- Header Modal-like --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Detail Kategori</h1>
        <p class="text-gray-500 text-sm">Tambahkan kategori baru untuk hierarki aset Anda.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            {{-- NAMA KATEGORI --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kategori <span class="text-red-500">*</span></label>
                <input type="text" name="nama_kategori" 
                    placeholder="Contoh: Elektronik & Teknologi Informasi"
                    class="w-full border-gray-200 bg-gray-50 rounded-xl p-3.5 focus:ring-2 focus:ring-[#4fa1b1] focus:border-transparent transition"
                    required>
            </div>

            {{-- KODE KATEGORI (Read-only/Disabled) --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Kategori</label>
                <div class="relative">
                    <input type="text" disabled placeholder="CAT-2024-001"
                        class="w-full border-gray-200 bg-gray-50 rounded-xl p-3.5 text-gray-400 cursor-not-allowed">
                    <span class="absolute right-4 top-3.5 text-gray-400">🔒</span>
                </div>
                <p class="text-[10px] text-gray-400 mt-1">ID dibuat otomatis oleh sistem</p>
            </div>

            {{-- KETERANGAN --}}
            <div class="mb-8">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
                <textarea name="keterangan" rows="4"
                    placeholder="Berikan deskripsi singkat mengenai cakupan kategori ini..."
                    class="w-full border-gray-200 bg-gray-50 rounded-xl p-3.5 focus:ring-2 focus:ring-[#4fa1b1] focus:border-transparent transition"></textarea>
            </div>

            {{-- BUTTONS --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('categories.index') }}" class="px-6 py-3 rounded-xl font-bold text-gray-600 hover:bg-gray-100 transition">
                    Batal
                </a>
                <button type="submit" class="bg-[#106677] hover:bg-[#0c4e5b] text-white px-6 py-3 rounded-xl font-bold transition shadow-md">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>

@endsection