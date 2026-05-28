@extends('layouts.app')

@section('content')
<div class="p-6 max-w-5xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-3xl font-black text-slate-800 tracking-tight">Pengaturan Profil</h1>
        <p class="text-slate-400 mt-2 font-medium">Kelola informasi akun dan pengaturan profil Anda.</p>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 text-emerald-600 border border-emerald-100 p-4 rounded-2xl mb-8 font-bold text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        {{-- PROFILE SECTION --}}
        <div class="bg-white rounded-3xl border border-slate-100 p-8 shadow-sm">
            <h2 class="text-xl font-black text-[#469CB0] mb-8 tracking-tight">Informasi Profil</h2>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="flex justify-center mb-8">
                    <div class="relative">
                        @if(auth()->user()->photo)
                            <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="w-32 h-32 rounded-full object-cover border-4 border-slate-50 shadow-md">
                        @else
                            <div class="w-32 h-32 rounded-full bg-slate-100 flex items-center justify-center text-4xl shadow-inner text-slate-400">
                                👤
                            </div>
                        @endif
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full border-slate-200 bg-slate-50 rounded-xl p-3 mt-1 focus:ring-2 focus:ring-[#469CB0] outline-none transition">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}" class="w-full border-slate-200 bg-slate-50 rounded-xl p-3 mt-1 focus:ring-2 focus:ring-[#469CB0] outline-none transition">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Role</label>
                        <input type="text" value="{{ auth()->user()->role }}" disabled class="w-full border-slate-200 bg-slate-50 text-slate-400 rounded-xl p-3 mt-1 cursor-not-allowed">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Foto Profil</label>
                        <input type="file" name="photo" class="w-full border-slate-200 bg-slate-50 rounded-xl p-2.5 mt-1 text-sm text-slate-500 file:mr-4 file:rounded-lg file:border-0 file:bg-[#469CB0] file:text-white file:px-4 file:py-2 hover:file:bg-[#398091] transition">
                    </div>
                </div>

                <button class="w-full mt-8 bg-[#469CB0] hover:bg-[#398091] text-white font-black py-3 rounded-2xl transition shadow-lg shadow-[#469CB0]/20">
                    Update Profil
                </button>
            </form>
        </div>
    </div>
</div>
@endsection