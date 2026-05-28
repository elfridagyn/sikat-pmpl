@extends('layouts.app')

@section('content')
{{-- Menambahkan px-4 untuk memberi napas di layar HP --}}
<div class="max-w-2xl mx-auto px-4 sm:px-0">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Edit Profil User</h1>
        <p class="text-gray-500 mt-1">Mengubah data: {{ $user->name }}</p>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 text-emerald-700 p-4 rounded-2xl mb-6 font-bold text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8">
        <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- FOTO - Menggunakan flex-col di mobile agar foto dan input tidak saling tabrak --}}
            <div class="mb-8">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Foto Profil</label>
                <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6">
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" class="w-20 h-20 rounded-full object-cover border-4 border-gray-50 shadow-sm">
                    @else
                        <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center text-2xl flex-shrink-0">👤</div>
                    @endif
                    
                    {{-- Input file dengan w-full di mobile --}}
                    <input type="file" name="photo" accept="image/*" 
                           class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-gray-100 file:text-gray-700 file:font-bold hover:file:bg-gray-200 transition cursor-pointer">
                </div>
            </div>

            {{-- FORM INPUTS --}}
            <div class="space-y-6">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ $user->name }}" 
                           class="w-full border-gray-200 bg-gray-50 rounded-xl p-4 focus:ring-2 focus:ring-[#4b8e96] outline-none transition" required>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" 
                           class="w-full border-gray-200 bg-gray-50 rounded-xl p-4 focus:ring-2 focus:ring-[#4b8e96] outline-none transition" required>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Role Akses</label>
                    <select name="role" class="w-full border-gray-200 bg-gray-50 rounded-xl p-4 focus:ring-2 focus:ring-[#4b8e96] outline-none transition" required>
                        <option value="admin_aset" @selected($user->role == 'admin_aset')>Admin Asset</option>
                        <option value="petugas_inventaris" @selected($user->role == 'petugas_inventaris')>Petugas Inventaris</option>
                        <option value="teknisi" @selected($user->role == 'teknisi')>Teknisi</option>
                        <option value="manajemen" @selected($user->role == 'manajemen')>Manajemen</option>
                    </select>
                </div>
            </div>

            {{-- BUTTONS - Stacked di mobile --}}
            <div class="flex flex-col sm:flex-row gap-3 mt-8">
                <a href="{{ url()->previous() }}" class="w-full sm:w-auto text-center px-6 py-4 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition">Batal</a>
                <button type="submit" class="w-full sm:flex-1 bg-[#4b8e96] hover:bg-[#3d7a82] text-white py-4 rounded-xl font-bold shadow-lg shadow-[#4b8e96]/20 transition">
                    Update User
                </button>
            </div>

        </form>
    </div>

</div>
@endsection