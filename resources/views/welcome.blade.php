<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIKAT - Sistem Informasi Kelola Aset Terpadu</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font Inter agar teks clean dan tajam --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        :root {
            --bg-gradient: url("{{ asset('images/bgg.png') }}");
        }
    </style>
</head>

<body class="min-h-screen bg-cover bg-center bg-no-repeat antialiased flex flex-col justify-between"
      style="background-image: var(--bg-gradient);">

    <div class="fixed top-0 w-full z-50 px-4 pt-4">
        <header class="max-w-7xl mx-auto bg-white/30 backdrop-blur-xl border border-white/20 rounded-2xl shadow-lg px-6 lg:px-12 py-4">
            <div class="flex justify-between items-center">
                {{-- Brand SIKAT --}}
                <div class="text-2xl font-extrabold text-[#3a5360] tracking-tight select-none">
                    SIKAT
                </div>

                {{-- Navigasi Atas --}}
                @if (Route::has('login'))
                    <nav class="flex items-center gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-[#4e7281] text-white rounded-xl text-sm font-bold shadow-md transition hover:bg-[#3f5d6a]">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2 bg-white/50 border border-white/30 text-gray-700 hover:text-black rounded-xl text-sm font-bold transition shadow-sm backdrop-blur-md">
                                Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-6 py-2 bg-[#4e7281] text-white rounded-xl text-sm font-bold shadow-sm transition hover:bg-[#3f5d6a]">
                                    Sign Up
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>
    </div>

{{-- JARAK LEBIH DEKAT --}}
    <div class="h-24"></div>

 
    {{-- HERO SECTION Utama --}}
    <main class="w-full max-w-7xl mx-auto flex-1 px-8 lg:px-14 pt-6 pb-16 space-y-16">
        
        {{-- BAGIAN ATAS: Judul & Logo Raksasa --}}
        <div class="flex flex-col lg:flex-row items-center lg:items-start justify-between gap-12">
            {{-- Kiri: Headline (Naik 1 Tingkat) --}}
            <div class="flex-1 space-y-6 max-w-2xl text-center lg:text-left">
                <div class="inline-block bg-white/40 backdrop-blur-md px-4 py-1.5 rounded-full border border-white/30 text-[11px] font-bold text-[#4e7281] tracking-wider uppercase">
                    Sistem Informasi Kelola Aset Kampus
                </div>
                <h1 class="text-5xl lg:text-6xl font-black text-[#2c3e47] tracking-tight leading-[1.1]"> {{-- Text naik ke 6xl --}}
                    Kelola Aset <br>Kampus Lebih <br>Cerdas, Lebih <br>Mudah.
                </h1>
                <p class="text-gray-700 text-sm lg:text-base leading-relaxed max-w-lg font-medium opacity-90"> {{-- Text naik ke base --}}
                    Selamat Datang di SIKAT – Solusi modern untuk pelacakan, pemeliharaan, dan manajemen inventaris Kampus yang efisien dan transparan.
                </p>
                {{-- Tombol Utama --}}
                <div class="flex items-center justify-center lg:justify-start gap-4 pt-4">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-[#4e7281] hover:bg-[#3f5d6a] text-white text-sm font-black rounded-2xl shadow-lg transition transform hover:-translate-y-1">
                        Create an Account
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-4 bg-white/40 backdrop-blur-md border border-gray-300/40 text-gray-800 hover:text-black text-sm font-black rounded-2xl transition transform hover:-translate-y-1">
                        Already Have Account
                    </a>
                </div>
            </div>

            {{-- Kanan: Logo SIKAT (Naik 1 Tingkat) --}}
            <div class="flex-1 flex justify-center lg:justify-end items-center">
                <div class="text-center lg:text-right">
                    <img src="{{ asset('images/logosikat.png') }}" alt="SIKAT Logo" 
                         class="h-64 lg:h-[22rem] w-auto mx-auto lg:mr-0 opacity-95 drop-shadow-[0_35px_35px_rgba(0,0,0,0.15)] transition-transform duration-500 hover:scale-110"> {{-- h-64 ke h-80+ --}}
                </div>
            </div>
        </div>

        {{-- BAGIAN TENGAH: 3 Card Fitur (Naik 1 Tingkat) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pt-8">
            {{-- Card 1 --}}
            <div class="bg-white/30 backdrop-blur-xl border border-white/20 rounded-[2rem] p-8 shadow-2xl space-y-4 hover:bg-white/40 transition">
                <div class="w-12 h-12 bg-[#4e7281]/10 rounded-2xl flex items-center justify-center text-[#4e7281]">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h.01M16 20h2M4 12h2m0 0h2v-2m0 0h2"></path></svg>
                </div>
                <h3 class="text-lg font-black text-gray-900">Lacak Aset dalam Sekejap</h3>
                <p class="text-gray-700 text-xs lg:text-sm leading-relaxed">Gunakan teknologi QR Code untuk inventarisasi yang lebih cepat. Cukup pindai label aset untuk melihat riwayat, lokasi, dan status terkini.</p>
            </div>

            {{-- Card 2 --}}
            <div class="bg-white/30 backdrop-blur-xl border border-white/20 rounded-[2rem] p-8 shadow-2xl space-y-4 hover:bg-white/40 transition">
                <div class="w-12 h-12 bg-[#4e7281]/10 rounded-2xl flex items-center justify-center text-[#4e7281]">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
                <h3 class="text-lg font-black text-gray-900">Transparansi Keuangan</h3>
                <p class="text-gray-700 text-xs lg:text-sm leading-relaxed">Pantau nilai aset, penyusutan, dan biaya pemeliharaan secara real-time. Memastikan akuntabilitas finansial di setiap unit kerja fakultas.</p>
            </div>

            {{-- Card 3 --}}
            <div class="bg-white/30 backdrop-blur-xl border border-white/20 rounded-[2rem] p-8 shadow-2xl space-y-4 hover:bg-white/40 transition">
                <div class="w-12 h-12 bg-[#4e7281]/10 rounded-2xl flex items-center justify-center text-[#4e7281]">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="text-lg font-black text-gray-900">Pelaporan Otomatis</h3>
                <p class="text-gray-700 text-xs lg:text-sm leading-relaxed">Buat laporan aset hanya dengan satu klik. Hemat waktu ribuan jam kerja administratif dengan sistem pelaporan yang instan dan akurat.</p>
            </div>
        </div>

        {{-- BAGIAN BAWAH (Naik 1 Tingkat) --}}
        <div class="w-full text-center space-y-6 pt-10">
            <h2 class="text-2xl lg:text-4xl font-black text-gray-950">Siap Memodernisasi Manajemen Aset?</h2>
            <p class="text-gray-700 text-sm lg:text-base max-w-2xl mx-auto leading-relaxed font-medium">
                Bergabunglah dengan ratusan admin aset kampus yang telah meningkatkan produktivitas mereka dengan SIKAT [Sistem Informasi Kelola Aset Terpadu].
            </p>
            
            <div class="w-full max-w-4xl mx-auto bg-gradient-to-br from-[#16303d] to-[#254656] rounded-[2.5rem] p-10 shadow-2xl text-left border border-white/10 relative overflow-hidden group">
                <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-white/5 rounded-full blur-[80px]"></div>
                <span class="text-xs font-black text-[#8fb4c5] uppercase tracking-[0.2em] block mb-2">Dashboard Terpusat</span>
                <p class="text-white text-base lg:text-lg font-semibold opacity-90 leading-snug">
                    Kelola ribuan aset dari satu titik kendali yang intuitif dan responsif.
                </p>
            </div>
        </div>

    </main>

    {{-- FOOTER GLASS (Naik 1 Tingkat) --}}
    <div class="px-4 pb-4">
        <footer class="max-w-7xl mx-auto bg-white/30 backdrop-blur-xl border border-white/20 rounded-2xl p-6 flex justify-between items-center text-[10px] text-gray-500 font-medium shadow-lg">
            <div>
                &copy; 2026 | SIKAT Asset Management. All rights reserved.
            </div>
            
        </footer>
    </div>

</body>
</html>