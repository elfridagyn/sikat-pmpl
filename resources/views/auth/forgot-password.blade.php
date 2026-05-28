<x-guest-layout>

{{-- KARTU UTAMA: Lebar 100% identik dengan Login, Register, & Reset Password --}}
<div class="w-full max-w-[440px] mx-auto bg-white/40 backdrop-blur-2xl rounded-[32px] shadow-2xl p-8 border border-white/20">

    {{-- AREA LOGO & JUDUL --}}
    <div class="text-center mb-5">
        <img src="{{ asset('images/logosikat.png') }}" alt="SIKAT Logo" class="mx-auto h-16 w-auto mb-2 opacity-90">
        <h1 class="text-xl font-bold text-gray-950 tracking-tight">Forgot Password</h1>
    </div>

    {{-- TEKS DESKRIPSI: Dibuat tipis, kalem, dan estetik sesuai tema --}}
    <div class="mb-5 text-xs text-gray-600 leading-relaxed text-center font-medium px-2">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
    </div>

    {{-- STATUS SESI (ALERT SUKSES KIRIM EMAIL) --}}
    <x-auth-session-status class="mb-4 text-xs font-semibold text-green-600 text-center" :status="session('status')" />

    {{-- FORM FORGOT PASSWORD --}}
    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        {{-- INPUT EMAIL --}}
        <div class="space-y-1">
            <label for="email" class="block text-[11px] font-semibold text-gray-700 ml-1">Email Address</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="admin_aset@ub.ac.id" required autofocus
                class="w-full px-4 py-2.5 bg-[#f0f3f6]/80 border border-gray-200/50 rounded-xl text-gray-950 text-xs placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4e7281]/30 focus:border-[#4e7281] transition duration-150">
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-[11px] text-red-600" />
        </div>

        {{-- TOMBOL KIRIM LINK RESET --}}
        <div class="pt-2">
            <button type="submit"
                class="w-full py-2.5 bg-[#4e7281] hover:bg-[#3f5d6a] text-white rounded-xl text-xs font-semibold tracking-wide transition duration-150 active:scale-[0.98] shadow-md shadow-[#4e7281]/10">
                Email Password Reset Link
            </button>
        </div>
    </form>

    {{-- FOOTER LINK: Tombol balik ke Login jika batal --}}
    <div class="text-center mt-5 text-xs text-gray-500 font-medium">
        Remember your password? 
        <a href="{{ route('login') }}" class="font-bold text-gray-700 hover:text-[#4e7281] hover:underline transition">Login</a>
    </div>

</div>

</x-guest-layout>