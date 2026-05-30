@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- HEADER --}}
    <div class="mb-10">
        <h1 class="text-4xl font-bold text-gray-800">
            Help Center
        </h1>
        <p class="text-gray-500 mt-3">
            Panduan penggunaan Sistem Informasi Kelola Aset Terpadu
        </p>
    </div>

    {{-- GRID UTAMA --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- CARD 1 --}}
        <div class="bg-white/70 backdrop-blur-xl border border-white/30 rounded-3xl p-6 shadow-lg">
            <div class="w-14 h-14 rounded-2xl bg-[#4E7281]/10 flex items-center justify-center mb-5">
                <svg class="w-7 h-7 text-[#4E7281]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800 mb-3">Tambah Aset</h2>
            <p class="text-sm text-gray-500 leading-relaxed">
                Untuk menambahkan aset baru, buka menu Data Aset lalu klik tombol “Tambah Aset”.
            </p>
        </div>

        {{-- CARD 2 --}}
        <div class="bg-white/70 backdrop-blur-xl border border-white/30 rounded-3xl p-6 shadow-lg">
            <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center mb-5">
                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800 mb-3">Export Laporan</h2>
            <p class="text-sm text-gray-500 leading-relaxed">
                Sistem mendukung export data ke format Excel dan PDF melalui halaman Data Aset.
            </p>
        </div>

        {{-- CARD 3 --}}
        <div class="bg-white/70 backdrop-blur-xl border border-white/30 rounded-3xl p-6 shadow-lg">
            <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center mb-5">
                <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800 mb-3">Manajemen Keuangan</h2>
            <p class="text-sm text-gray-500 leading-relaxed">
                Menu keuangan digunakan untuk mencatat transaksi aset dan biaya maintenance.
            </p>
        </div>

        {{-- CARD 4 --}}
        <div class="bg-white/70 backdrop-blur-xl border border-white/30 rounded-3xl p-6 shadow-lg">
            <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center mb-5">
                <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800 mb-3">Riwayat Aset</h2>
            <p class="text-sm text-gray-500 leading-relaxed">
                Semua aktivitas aset akan otomatis tercatat pada halaman riwayat sistem.
            </p>
        </div>

        {{-- CARD 5 --}}
        <div class="bg-white/70 backdrop-blur-xl border border-white/30 rounded-3xl p-6 shadow-lg">
            <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center mb-5">
                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 .552-.448 1-1 1s-1-.448-1-1 .448-1 1-1 1 .448 1 1zm0 0v2m0 4h.01"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800 mb-3">Bantuan Sistem</h2>
            <p class="text-sm text-gray-500 leading-relaxed">
                Jika mengalami kendala, silakan hubungi administrator sistem atau teknisi IT.
            </p>
        </div>

    </div>

</div>

{{-- ==================== FLOATING SUPPORT WIIDGET ==================== --}}
<div x-data="{ open: false }" class="fixed bottom-6 right-6 z-50 flex flex-col items-end">

    {{-- WRAPPER MENU POPUP --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-5 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-5 scale-95"
         class="flex flex-col items-end gap-4 mb-4 w-80 sm:w-96 max-w-[calc(100vw-2rem)]">

        {{-- CONTAINER FLOATING FAQ & EMAIL (Membatasi Tinggi & Mengaktifkan Scroll internal) --}}
        <div class="w-full bg-white/90 backdrop-blur-2xl border border-white/40 rounded-3xl p-5 shadow-2xl flex flex-col gap-4 max-h-[70vh] overflow-y-auto scrollbar-thin">
            
            {{-- HEADER MINI MENU --}}
            <div>
                <h3 class="text-lg font-bold text-gray-800">Pusat Bantuan</h3>
                <p class="text-xs text-gray-400 mt-0.5">Pertanyaan populer & kontak admin</p>
            </div>

            <hr class="border-gray-200/50">

            {{-- FAQ ACCORDION SECTION INSIDE FLOATING --}}
            <div class="space-y-3">
                
                {{-- FAQ 1 --}}
                <div x-data="{ itemOpen: false }" class="bg-gray-50/50 border border-gray-100 rounded-2xl overflow-hidden">
                    <button @click="itemOpen = !itemOpen" class="w-full flex items-center justify-between px-4 py-3 text-left">
                        <span class="font-bold text-gray-700 text-xs sm:text-sm">Bagaimana cara menambah aset?</span>
                        <svg :class="itemOpen ? 'rotate-180' : ''" class="w-4 h-4 text-gray-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="itemOpen" x-transition class="px-4 pb-3 text-xs text-gray-500 leading-relaxed border-t border-gray-100/30 pt-2">
                        Buka menu <span class="font-semibold text-[#4E7281]">Data Aset</span> lalu klik tombol <span class="font-semibold text-[#4E7281]">Tambah Aset</span>.
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div x-data="{ itemOpen: false }" class="bg-gray-50/50 border border-gray-100 rounded-2xl overflow-hidden">
                    <button @click="itemOpen = !itemOpen" class="w-full flex items-center justify-between px-4 py-3 text-left">
                        <span class="font-bold text-gray-700 text-xs sm:text-sm">Apakah data aset bisa di-export?</span>
                        <svg :class="itemOpen ? 'rotate-180' : ''" class="w-4 h-4 text-gray-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="itemOpen" x-transition class="px-4 pb-3 text-xs text-gray-500 leading-relaxed border-t border-gray-100/30 pt-2">
                        Ya, sistem mendukung export data ke format Excel dan PDF melalui halaman Data Aset.
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div x-data="{ itemOpen: false }" class="bg-gray-50/50 border border-gray-100 rounded-2xl overflow-hidden">
                    <button @click="itemOpen = !itemOpen" class="w-full flex items-center justify-between px-4 py-3 text-left">
                        <span class="font-bold text-gray-700 text-xs sm:text-sm">Siapa yang bisa akses keuangan?</span>
                        <svg :class="itemOpen ? 'rotate-180' : ''" class="w-4 h-4 text-gray-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="itemOpen" x-transition class="px-4 pb-3 text-xs text-gray-500 leading-relaxed border-t border-gray-100/30 pt-2">
                        Hanya user dengan role <span class="font-semibold text-[#6b2b38]">admin_aset</span> yang diberikan akses penuh.
                    </div>
                </div>

            </div>

            <hr class="border-gray-200/50">

            {{-- EMAIL SUPPORT BUTTON INSIDE CONTAINER --}}
            <a href="mailto:elfridawidad@student.ub.ac.id?subject=Bantuan Sistem SIKAT UB&body=Halo Admin,%0ASaya mengalami kendala pada sistem..."
               class="group flex items-center justify-between gap-3 bg-[#4E7281]/10 hover:bg-[#4E7281] p-3 rounded-2xl transition duration-300">
                <div class="pl-1">
                    <p class="text-[10px] text-[#4E7281] group-hover:text-white/80 transition font-medium">Masih terkendala?</p>
                    <span class="text-xs font-bold text-gray-700 group-hover:text-white transition block mt-0.5">Hubungi Admin Via Email</span>
                </div>
                <div class="w-8 h-8 rounded-xl bg-[#4E7281] group-hover:bg-white/20 flex items-center justify-center transition duration-300">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 4H8m8-8H8m-2-4h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2z"></path>
                    </svg>
                </div>
            </a>

        </div>
    </div>

    {{-- MAIN FLOATING BUTTON --}}
    <button @click="open = !open"
            class="w-14 h-14 rounded-full bg-gradient-to-r from-[#4E7281] to-[#6b2b38] text-white shadow-xl flex items-center justify-center hover:scale-105 active:scale-95 transition-all duration-300">
        
        {{-- ICON CHAT --}}
        <svg x-show="!open" x-transition class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
        </svg>

        {{-- ICON CLOSE --}}
        <svg x-show="open" x-transition class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>

@endsection