<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKAT - Sistem Informasi Kelola Aset</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-image: url("{{ asset('images/bggg.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(226, 232, 240, 0.4);
            border-radius: 10px;
        }
    </style>
</head>

<body class="antialiased text-gray-700 min-h-screen">

    <div class="flex min-h-screen overflow-hidden">

        {{-- SIDEBAR --}}
        <aside class="w-64 bg-white/40 backdrop-blur-xl border-r border-white/20 flex-shrink-0 flex flex-col h-screen sticky top-0 z-50 justify-between py-6 shadow-[4px_0_24px_rgba(0,0,0,0.02)]">

            <div>
                {{-- BRAND LOGO AREA --}}
                <div class="px-6 py-2 flex justify-center items-center">
                    <img src="{{ asset('images/logosikat.png') }}" class="h-16 w-auto object-contain transition-transform duration-300 hover:scale-105" alt="SIKAT Logo">
                </div>

                {{-- NAVIGASI UTAMA --}}
                <nav class="px-4 space-y-1 mt-8 overflow-y-auto custom-scrollbar">

                    {{-- Dashboard --}}
                    <a href="/dashboard" class="group flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-semibold tracking-wide transition duration-150 relative {{ Request::is('dashboard*') ? 'bg-[#4E7281]/15 text-[#4E7281] font-bold shadow-xs' : 'text-gray-600 hover:bg-white/30 hover:text-gray-900' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 transition {{ Request::is('dashboard*') ? 'text-[#4E7281]' : 'text-gray-500 group-hover:text-gray-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            <span>Dashboard</span>
                        </div>
                        @if(Request::is('dashboard*'))
                        <span class="absolute right-0 top-1/4 w-1 h-5 bg-[#4E7281] rounded-l-md"></span>
                        @endif
                    </a>

                    {{-- Kategori --}}
                    <a href="/categories" class="group flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-semibold tracking-wide transition duration-150 relative {{ Request::is('categories*') ? 'bg-[#4E7281]/15 text-[#4E7281] font-bold' : 'text-gray-600 hover:bg-white/30 hover:text-gray-900' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 transition {{ Request::is('categories*') ? 'text-[#4E7281]' : 'text-gray-500 group-hover:text-gray-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <span>Kategori</span>
                        </div>
                        @if(Request::is('categories*'))
                        <span class="absolute right-0 top-1/4 w-1 h-5 bg-[#4E7281] rounded-l-md"></span>
                        @endif
                    </a>

                    {{-- Data Aset --}}
                    <a href="/assets" class="group flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-semibold tracking-wide transition duration-150 relative {{ Request::is('assets*') && !Request::is('asset-finances*') ? 'bg-[#4E7281]/15 text-[#4E7281] font-bold' : 'text-gray-600 hover:bg-white/30 hover:text-gray-900' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 transition {{ Request::is('assets*') && !Request::is('asset-finances*') ? 'text-[#4E7281]' : 'text-gray-500 group-hover:text-gray-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <span>Data Aset</span>
                        </div>
                        @if(Request::is('assets*') && !Request::is('asset-finances*'))
                        <span class="absolute right-0 top-1/4 w-1 h-5 bg-[#4E7281] rounded-l-md"></span>
                        @endif
                    </a>

                    {{-- MENU KEUANGAN: Terbuka untuk Admin Aset DAN Petugas Inventaris --}}
                    @if(auth()->check() && (auth()->user()->role == 'admin_aset' || auth()->user()->role == 'petugas_inventaris'))
                    <a href="/asset-finances" class="group flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-semibold tracking-wide transition duration-150 relative {{ Request::is('asset-finances*') ? 'bg-[#4E7281]/15 text-[#4E7281] font-bold' : 'text-gray-600 hover:bg-white/30 hover:text-gray-900' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 transition {{ Request::is('asset-finances*') ? 'text-[#4E7281]' : 'text-gray-500 group-hover:text-gray-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Keuangan</span>
                        </div>
                        @if(Request::is('asset-finances*'))
                        <span class="absolute right-0 top-1/4 w-1 h-5 bg-[#4E7281] rounded-l-md"></span>
                        @endif
                    </a>
                    @endif

                    {{-- MENU EXCLUSIVE HANYA ADMIN ASET: Manajemen User --}}
                    @if(auth()->check() && auth()->user()->role == 'admin_aset')
                    <a href="{{ route('users.index') }}" class="group flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-semibold tracking-wide transition duration-150 relative {{ Request::is('users*') ? 'bg-[#4E7281]/15 text-[#4E7281] font-bold' : 'text-gray-600 hover:bg-white/30 hover:text-gray-900' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 transition {{ Request::is('users*') ? 'text-[#4E7281]' : 'text-gray-500 group-hover:text-gray-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span>Manajemen User</span>
                        </div>
                        @if(Request::is('users*'))
                        <span class="absolute right-0 top-1/4 w-1 h-5 bg-[#4E7281] rounded-l-md"></span>
                        @endif
                    </a>
                    @endif

                    {{-- Riwayat Aset --}}
                    <a href="{{ Route::has('asset.histories') ? route('asset.histories') : '#' }}" class="group flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-semibold tracking-wide transition duration-150 relative {{ Request::is('asset/histories*') ? 'bg-[#4E7281]/15 text-[#4E7281] font-bold' : 'text-gray-600 hover:bg-white/30 hover:text-gray-900' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 transition {{ Request::is('asset/histories*') ? 'text-[#4E7281]' : 'text-gray-500 group-hover:text-gray-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Riwayat Aset</span>
                        </div>
                        @if(Request::is('asset/histories*'))
                        <span class="absolute right-0 top-1/4 w-1 h-5 bg-[#4E7281] rounded-l-md"></span>
                        @endif
                    </a>
                </nav>
            </div>

            {{-- KARTU AKUN USER DENGAN DROPDOWN --}}
            @auth
            <div class="px-4">
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="w-full flex items-center gap-2.5 p-2.5 bg-white/50 backdrop-blur-md border border-white/40 rounded-2xl shadow-[0_2px_12px_rgba(0,0,0,0.02)] hover:bg-white/70 transition">
                        @if(auth()->user()->photo)
                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="w-8 h-8 rounded-full object-cover border border-white shadow-2xs">
                        @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=4E7281&color=fff" class="w-8 h-8 rounded-full border border-white shadow-2xs">
                        @endif
                        <div class="overflow-hidden text-left flex-1">
                            <p class="text-xs font-bold text-gray-900 truncate leading-none mb-1">
                                {{ auth()->user()->nama ?? auth()->user()->name }}
                            </p>
                            <p class="text-[9px] font-medium text-gray-500 capitalize truncate leading-none">{{ str_replace('_', ' ', auth()->user()->role) }}</p>
                        </div>
                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="open"
                        @click.away="open = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        class="absolute bottom-full left-0 mb-2 w-full bg-white/90 backdrop-blur-md border border-white/50 rounded-2xl shadow-xl overflow-hidden py-1 z-50">

                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-[11px] font-bold text-gray-700 hover:bg-[#4E7281]/10 hover:text-[#4E7281] transition">
                            Edit Profile
                        </a>

                        <a href="{{ route('custom.password.reset') }}" class="block px-4 py-2 text-[11px] font-bold text-gray-700 hover:bg-[#4E7281]/10 hover:text-[#4E7281] transition">
                            Reset Password
                        </a>
                    </div>
                </div>
            </div>
            @endauth
        </aside>

        {{-- AREA KANAN UTAMA --}}
        <div class="flex-1 flex flex-col h-screen overflow-y-auto bg-transparent">

            {{-- TOPBAR GLASSMORPHISM --}}
            <header class="bg-white/30 backdrop-blur-md sticky top-0 z-40 px-8 py-3.5 flex justify-between items-center transition duration-200 border-b border-white/10">

                {{-- Search Bar --}}
                <form action="{{ route('assets.index') }}" method="GET" class="relative w-80 lg:w-96 group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-500 group-focus-within:text-[#4E7281] transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari aset infrastruktur..."
                        class="w-full pl-9 pr-4 py-2 bg-white/70 backdrop-blur-xs border border-white/40 rounded-xl text-xs font-medium text-gray-800 shadow-[0_2px_8px_rgba(0,0,0,0.01)] focus:outline-none focus:ring-4 focus:ring-[#4E7281]/10 focus:border-[#4E7281]/40 transition duration-200">
                </form>

                {{-- Sisi Kanan Topbar --}}
                <div class="flex items-center gap-3">
                    <div x-data="{ notifOpen: false }" class="relative">
                        <button
                            @click="notifOpen = !notifOpen"
                            class="p-2 text-gray-500 hover:text-gray-700 bg-white/60 border border-white/40 rounded-xl shadow-3xs hover:scale-105 transition relative">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            @if($notifications->count() > 0)
                            <span class="absolute top-2 right-2 w-1.5 h-1.5 bg-red-500 rounded-full border border-white"></span>
                            @endif
                        </button>

                        <div x-show="notifOpen"
                            @click.away="notifOpen = false"
                            class="absolute right-0 mt-3 w-96 bg-white/80 backdrop-blur-xl border border-white/30 rounded-3xl shadow-2xl overflow-hidden z-50">
                            <div class="px-5 py-4 border-b">
                                <h3 class="font-bold text-sm">Notifications</h3>
                            </div>
                            <div class="max-h-[400px] overflow-y-auto">
                                @forelse($notifications as $notif)
                                <div class="flex gap-4 px-5 py-4 hover:bg-white/40 transition border-b">
                                    <div class="w-10 h-10 rounded-2xl bg-[#4E7281]/10 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-[#4E7281]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-800">{{ $notif->aktivitas }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $notif->keterangan }}</p>
                                        <p class="text-[10px] text-gray-400 mt-2">{{ $notif->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                @empty
                                <div class="p-6 text-center text-gray-400 text-sm">Belum ada notifikasi</div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- HELP BUTTON --}}
                    <a href="{{ route('help') }}" class="p-2 text-gray-500 hover:text-gray-700 bg-white/60 border border-white/40 rounded-xl shadow-3xs hover:scale-105 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </a>

                    <span class="h-4 w-px bg-gray-300/60 mx-1"></span>

                    {{-- Tombol Logout --}}
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-white/60 hover:bg-red-500 hover:text-white border border-white/40 text-gray-600 font-bold text-xs rounded-xl shadow-3xs transition duration-150">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                    @else
                    <a href="/login" class="px-4 py-1.5 bg-[#4E7281] text-white text-xs font-bold rounded-xl shadow-sm transition">Login</a>
                    @endauth
                </div>
            </header>

            {{-- MAIN CONTENT RECEPTACLE --}}
            <main class="px-8 py-4 flex-1 bg-transparent">
                @yield('content')
            </main>

            {{-- FOOTER --}}
            <footer class="px-8 py-5 text-[10px] font-medium text-gray-400 flex justify-between border-t border-white/10 bg-white/5">
                <p>&copy; 2026 SIKAT | All rights reserved.</p>
                <div class="flex gap-4 font-semibold text-gray-400/80">
                    <a href="{{ route('privacy') }}" class="hover:text-[#4E7281] transition">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="hover:text-[#4E7281] transition">Terms of Service</a>
                </div>
            </footer>
        </div>
    </div>

</body>

</html>