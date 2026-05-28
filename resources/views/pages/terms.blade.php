@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="mb-10">
        <h1 class="text-4xl font-bold text-gray-800">
            Terms of Service
        </h1>

        <p class="text-gray-500 mt-3">
            Ketentuan penggunaan Sistem Informasi Kelola Aset Terpadu (SIKAT)
        </p>
    </div>

    <div class="bg-white/70 backdrop-blur-xl border border-white/30 rounded-3xl p-8 shadow-lg space-y-6">

        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-2">
                1. Hak Akses Pengguna
            </h2>

            <p class="text-gray-600 leading-relaxed">
                Setiap pengguna wajib menggunakan akun sesuai hak akses
                yang diberikan administrator sistem.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-2">
                2. Pengelolaan Aset
            </h2>

            <p class="text-gray-600 leading-relaxed">
                Semua data aset yang dimasukkan ke dalam sistem harus valid,
                benar, dan dapat dipertanggungjawabkan.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-2">
                3. Keamanan Sistem
            </h2>

            <p class="text-gray-600 leading-relaxed">
                Pengguna dilarang melakukan tindakan yang dapat merusak,
                mengganggu, atau menyalahgunakan sistem.
            </p>
        </div>

    </div>

</div>

@endsection