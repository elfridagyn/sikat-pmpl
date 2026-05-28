@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-10">

        <h1 class="text-4xl font-bold text-gray-800">
            Help Center
        </h1>

        <p class="text-gray-500 mt-3">
            Panduan penggunaan Sistem Informasi Kelola Aset Terpadu
        </p>

    </div>

    {{-- GRID --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- CARD --}}
        <div class="bg-white/70 backdrop-blur-xl
                    border border-white/30
                    rounded-3xl p-6 shadow-lg">

            <div class="w-14 h-14 rounded-2xl
                        bg-[#4E7281]/10
                        flex items-center justify-center mb-5">

                <svg class="w-7 h-7 text-[#4E7281]"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v16m8-8H4">
                    </path>

                </svg>

            </div>

            <h2 class="text-xl font-bold text-gray-800 mb-3">
                Tambah Aset
            </h2>

            <p class="text-sm text-gray-500 leading-relaxed">

                Untuk menambahkan aset baru,
                buka menu Data Aset lalu klik
                tombol “Tambah Aset”.

            </p>

        </div>

        {{-- CARD --}}
        <div class="bg-white/70 backdrop-blur-xl
                    border border-white/30
                    rounded-3xl p-6 shadow-lg">

            <div class="w-14 h-14 rounded-2xl
                        bg-green-100
                        flex items-center justify-center mb-5">

                <svg class="w-7 h-7 text-green-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4v-6">
                    </path>

                </svg>

            </div>

            <h2 class="text-xl font-bold text-gray-800 mb-3">
                Export Laporan
            </h2>

            <p class="text-sm text-gray-500 leading-relaxed">

                Sistem mendukung export data
                ke format Excel dan PDF
                melalui halaman Data Aset.

            </p>

        </div>

        {{-- CARD --}}
        <div class="bg-white/70 backdrop-blur-xl
                    border border-white/30
                    rounded-3xl p-6 shadow-lg">

            <div class="w-14 h-14 rounded-2xl
                        bg-yellow-100
                        flex items-center justify-center mb-5">

                <svg class="w-7 h-7 text-yellow-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2
                             s1.343 2 3 2
                             3 .895 3 2
                             -1.343 2-3 2">
                    </path>

                </svg>

            </div>

            <h2 class="text-xl font-bold text-gray-800 mb-3">
                Manajemen Keuangan
            </h2>

            <p class="text-sm text-gray-500 leading-relaxed">

                Menu keuangan digunakan
                untuk mencatat transaksi
                aset dan biaya maintenance.

            </p>

        </div>

        {{-- CARD --}}
        <div class="bg-white/70 backdrop-blur-xl
                    border border-white/30
                    rounded-3xl p-6 shadow-lg">

            <div class="w-14 h-14 rounded-2xl
                        bg-red-100
                        flex items-center justify-center mb-5">

                <svg class="w-7 h-7 text-red-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7
                             a2 2 0 01-2-2V5
                             a2 2 0 012-2h5.586
                             a1 1 0 01.707.293
                             l5.414 5.414
                             a1 1 0 01.293.707V19
                             a2 2 0 01-2 2z">
                    </path>

                </svg>

            </div>

            <h2 class="text-xl font-bold text-gray-800 mb-3">
                Riwayat Aset
            </h2>

            <p class="text-sm text-gray-500 leading-relaxed">

                Semua aktivitas aset akan
                otomatis tercatat pada
                halaman riwayat sistem.

            </p>

        </div>

        {{-- CARD --}}
        <div class="bg-white/70 backdrop-blur-xl
                    border border-white/30
                    rounded-3xl p-6 shadow-lg">

            <div class="w-14 h-14 rounded-2xl
                        bg-blue-100
                        flex items-center justify-center mb-5">

                <svg class="w-7 h-7 text-blue-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 11c0 .552-.448 1-1 1
                             s-1-.448-1-1
                             .448-1 1-1
                             1 .448 1 1zm0 0v2m0 4h.01">
                    </path>

                </svg>

            </div>

            <h2 class="text-xl font-bold text-gray-800 mb-3">
                Bantuan Sistem
            </h2>

            <p class="text-sm text-gray-500 leading-relaxed">

                Jika mengalami kendala,
                silakan hubungi administrator
                sistem atau teknisi IT.

            </p>

        </div>

    </div>

</div>
{{-- FLOATING SUPPORT --}}
<div
    x-data="{ open: false }"
    class="fixed bottom-6 right-6 z-50">

    {{-- MENU SUPPORT --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-5 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-5 scale-95"
        class="flex flex-col items-end gap-3 mb-4">

        {{-- EMAIL SUPPORT --}}
        <a href="mailto:elfridawidad@student.ub.ac.id?subject=Bantuan Sistem SIKAT UB&body=Halo Admin,%0ASaya mengalami kendala pada sistem..."
            class="group flex items-center gap-3
                  bg-white/80 backdrop-blur-xl
                  border border-white/30
                  px-5 py-3 rounded-2xl
                  shadow-xl hover:scale-105
                  transition-all duration-300">

            <span class="text-sm font-semibold text-gray-700">
                Hubungi Support
            </span>

            <div class="w-11 h-11 rounded-2xl
                        bg-[#4E7281]/10
                        flex items-center justify-center
                        group-hover:bg-[#4E7281]
                        transition">

                <svg class="w-5 h-5 text-[#4E7281] group-hover:text-white transition"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M16 12H8m8 4H8m8-8H8
                             m-2-4h12a2 2 0 012 2v12
                             a2 2 0 01-2 2H6a2 2 0 01-2-2V6
                             a2 2 0 012-2z">
                    </path>

                </svg>

            </div>

        </a>

        {{-- FAQ SECTION --}}
        <div id="faq" class="mt-16">

            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">
                    Frequently Asked Questions
                </h2>

                <p class="text-gray-500 mt-2">
                    Pertanyaan yang sering ditanyakan pengguna sistem.
                </p>
            </div>

            <div class="space-y-5">

                {{-- FAQ ITEM --}}
                <div
                    x-data="{ open: false }"
                    class="bg-white/70 backdrop-blur-xl
                   border border-white/30
                   rounded-3xl overflow-hidden shadow-lg">

                    <button
                        @click="open = !open"
                        class="w-full flex items-center justify-between
                       px-6 py-5 text-left">

                        <span class="font-bold text-gray-800">
                            Bagaimana cara menambahkan aset baru?
                        </span>

                        <svg
                            :class="open ? 'rotate-180' : ''"
                            class="w-5 h-5 text-gray-500 transition-transform duration-300"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7">
                            </path>

                        </svg>

                    </button>

                    <div
                        x-show="open"
                        x-transition
                        class="px-6 pb-5 text-sm text-gray-600 leading-relaxed">

                        Masuk ke menu Data Aset lalu klik tombol
                        <span class="font-semibold text-[#4E7281]">
                            Tambah Aset
                        </span>
                        untuk menambahkan data aset baru.

                    </div>

                </div>

                {{-- FAQ ITEM --}}
                <div
                    x-data="{ open: false }"
                    class="bg-white/70 backdrop-blur-xl
                   border border-white/30
                   rounded-3xl overflow-hidden shadow-lg">

                    <button
                        @click="open = !open"
                        class="w-full flex items-center justify-between
                       px-6 py-5 text-left">

                        <span class="font-bold text-gray-800">
                            Apakah data aset bisa di-export?
                        </span>

                        <svg
                            :class="open ? 'rotate-180' : ''"
                            class="w-5 h-5 text-gray-500 transition-transform duration-300"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7">
                            </path>

                        </svg>

                    </button>

                    <div
                        x-show="open"
                        x-transition
                        class="px-6 pb-5 text-sm text-gray-600 leading-relaxed">

                        Ya, sistem mendukung export data
                        ke format Excel dan PDF melalui halaman Data Aset.

                    </div>

                </div>

                {{-- FAQ ITEM --}}
                <div
                    x-data="{ open: false }"
                    class="bg-white/70 backdrop-blur-xl
                   border border-white/30
                   rounded-3xl overflow-hidden shadow-lg">

                    <button
                        @click="open = !open"
                        class="w-full flex items-center justify-between
                       px-6 py-5 text-left">

                        <span class="font-bold text-gray-800">
                            Siapa yang dapat mengakses menu keuangan?
                        </span>

                        <svg
                            :class="open ? 'rotate-180' : ''"
                            class="w-5 h-5 text-gray-500 transition-transform duration-300"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7">
                            </path>

                        </svg>

                    </button>

                    <div
                        x-show="open"
                        x-transition
                        class="px-6 pb-5 text-sm text-gray-600 leading-relaxed">

                        Hanya user dengan role
                        <span class="font-semibold text-[#6b2b38]">
                            admin_aset
                        </span>
                        yang dapat mengakses modul keuangan aset.

                    </div>

                </div>

                {{-- FAQ ITEM --}}
                <div
                    x-data="{ open: false }"
                    class="bg-white/70 backdrop-blur-xl
                   border border-white/30
                   rounded-3xl overflow-hidden shadow-lg">

                    <button
                        @click="open = !open"
                        class="w-full flex items-center justify-between
                       px-6 py-5 text-left">

                        <span class="font-bold text-gray-800">
                            Bagaimana jika saya lupa password?
                        </span>

                        <svg
                            :class="open ? 'rotate-180' : ''"
                            class="w-5 h-5 text-gray-500 transition-transform duration-300"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7">
                            </path>

                        </svg>

                    </button>

                    <div
                        x-show="open"
                        x-transition
                        class="px-6 pb-5 text-sm text-gray-600 leading-relaxed">

                        Hubungi administrator sistem atau gunakan
                        menu reset password pada profile pengguna.

                    </div>

                </div>

            </div>

        </div>
    </div>

    {{-- MAIN FLOATING BUTTON --}}
    <button
        @click="open = !open"
        class="group w-16 h-16 rounded-full
               bg-gradient-to-r
               from-[#4E7281]
               to-[#6b2b38]
               text-white shadow-2xl
               flex items-center justify-center
               hover:scale-110
               transition-all duration-300
               animate-pulse">

        {{-- ICON CHAT --}}
        <svg x-show="!open"
            x-transition
            class="w-7 h-7"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24">

            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M8 10h.01M12 10h.01M16 10h.01
                     M9 16H5a2 2 0 01-2-2V6
                     a2 2 0 012-2h14a2 2 0 012 2v8
                     a2 2 0 01-2 2h-5l-5 5v-5z">
            </path>

        </svg>

        {{-- ICON CLOSE --}}
        <svg x-show="open"
            x-transition
            class="w-7 h-7"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24">

            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12">
            </path>

        </svg>

    </button>

</div>
@endsection