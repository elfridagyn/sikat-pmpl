@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Tambah User Baru</h1>
        <p class="text-gray-500 mt-1">Lengkapi informasi untuk menambahkan pengguna baru ke sistem.</p>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- NAME --}}
            <div class="mb-6">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                <input type="text" name="name" placeholder="Nama Lengkap" 
                       class="w-full border-gray-200 bg-gray-50 rounded-xl p-4 focus:ring-2 focus:ring-[#4b8e96] outline-none transition" required>
            </div>

            {{-- EMAIL --}}
            <div class="mb-6">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Email</label>
                <input type="email" name="email" placeholder="nama@email.com" 
                       class="w-full border-gray-200 bg-gray-50 rounded-xl p-4 focus:ring-2 focus:ring-[#4b8e96] outline-none transition" required>
            </div>

            {{-- PASSWORD --}}
            <div class="mb-6">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Password</label>
                <input type="password" name="password" placeholder="••••••••" 
                       class="w-full border-gray-200 bg-gray-50 rounded-xl p-4 focus:ring-2 focus:ring-[#4b8e96] outline-none transition" required>
            </div>

            {{-- ROLE --}}
            <div class="mb-6">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Role Akses</label>
                <select name="role" class="w-full border-gray-200 bg-gray-50 rounded-xl p-4 focus:ring-2 focus:ring-[#4b8e96] outline-none transition" required>
                    <option value="admin_aset">Admin Asset</option>
                    <option value="petugas_inventaris">Petugas Inventaris</option>
                    <option value="teknisi">Teknisi</option>
                    <option value="manajemen">Manajemen</option>
                </select>
            </div>

            {{-- FOTO --}}
            <div class="mb-8">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Foto Profil</label>
                <input type="file" name="photo" accept="image/*" 
                       class="w-full border-gray-200 bg-gray-50 rounded-xl p-3 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-[#4b8e96] file:text-white file:font-bold hover:file:bg-[#3d7a82] transition">
            </div>

            <div class="flex gap-3">
                <a href="{{ url()->previous() }}" class="px-6 py-4 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition">Batal</a>
                <button type="submit" class="flex-1 bg-[#4b8e96] hover:bg-[#3d7a82] text-white py-4 rounded-xl font-bold shadow-lg shadow-[#4b8e96]/20 transition">
                    Simpan User
                </button>
            </div>
        </form>
    </div>

</div>
@endsection