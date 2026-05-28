@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Manajemen User</h1>
            <p class="text-gray-500 mt-1">Kelola akses dan data pengguna sistem.</p>
        </div>
        <a href="{{ route('users.create') }}" 
           class="bg-[#4b8e96] hover:bg-[#3d7a82] text-white px-6 py-3 rounded-xl font-bold transition shadow-lg shadow-[#4b8e96]/20 text-center">
            + Tambah User
        </a>
    </div>

    {{-- SEARCH BAR --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-4 mb-6">
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" placeholder="Cari user..." 
                   value="{{ request('search') }}"
                   class="w-full border-none bg-gray-50 rounded-2xl p-4 focus:ring-2 focus:ring-[#4b8e96] transition">
            <button type="submit" class="bg-gray-800 text-white px-6 sm:px-8 rounded-2xl font-bold hover:bg-gray-900 transition">
                Cari
            </button>
        </form>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[600px]">
                <thead class="bg-gray-50 text-gray-400 text-xs uppercase tracking-widest">
                    <tr>
                        <th class="p-6">User</th>
                        <th class="p-6">Email</th>
                        <th class="p-6">Role</th>
                        <th class="p-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="p-6 flex items-center gap-4">
                            @if($user->photo)
                                <img src="{{ asset('storage/' . $user->photo) }}" class="w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover border border-gray-100">
                            @else
                                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 flex-shrink-0">👤</div>
                            @endif
                            <span class="font-bold text-gray-800 truncate">{{ $user->name }}</span>
                        </td>
                        <td class="p-6 text-sm text-gray-600">{{ $user->email }}</td>
                        <td class="p-6">
                            <span class="px-3 py-1 rounded-full text-[10px] sm:text-xs font-bold whitespace-nowrap
                                @if($user->role == 'admin_aset') bg-red-50 text-red-600 
                                @elseif($user->role == 'teknisi') bg-yellow-50 text-yellow-600 
                                @elseif($user->role == 'manajemen') bg-blue-50 text-blue-600 
                                @else bg-emerald-50 text-emerald-600 @endif">
                                {{ strtoupper($user->role) }}
                            </span>
                        </td>
                        <td class="p-6 text-center">
                            <div class="flex justify-center items-center gap-3">
                                {{-- EDIT ICON --}}
                                <a href="{{ route('users.edit', $user->id) }}" 
                                   class="text-gray-400 hover:text-[#4b8e96] transition p-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                {{-- DELETE ICON --}}
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus user ini?')" 
                                            class="text-gray-400 hover:text-red-500 transition p-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-6 border-t border-gray-50">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection