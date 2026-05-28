@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="mb-10">
        <h1 class="text-4xl font-bold text-gray-800">
            Privacy Policy
        </h1>

        <p class="text-gray-500 mt-3">
            Kebijakan privasi penggunaan Sistem Informasi Kelola Aset Terpadu (SIKAT)
        </p>
    </div>

    <div class="bg-white/70 backdrop-blur-xl border border-white/30 rounded-3xl p-8 shadow-lg space-y-6">

        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-2">
                1. Pengumpulan Data
            </h2>

            <p class="text-gray-600 leading-relaxed">
                Sistem dapat menyimpan data pengguna seperti nama, email,
                role pengguna, dan aktivitas pengelolaan aset.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-2">
                2. Keamanan Data
            </h2>

            <p class="text-gray-600 leading-relaxed">
                Semua data disimpan secara aman dan hanya dapat diakses
                oleh pihak yang memiliki hak akses resmi.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-2">
                3. Penggunaan Informasi
            </h2>

            <p class="text-gray-600 leading-relaxed">
                Informasi pengguna digunakan untuk mendukung
                pengelolaan aset, monitoring sistem, dan keamanan aplikasi.
            </p>
        </div>

    </div>

</div>

@endsection