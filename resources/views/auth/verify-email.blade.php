<x-guest-layout>

{{-- KARTU UTAMA: Dimensi lebar dan padding dikunci sama persis (max-w-[440px]) --}}
<div class="w-full max-w-[440px] mx-auto bg-white/40 backdrop-blur-2xl rounded-[32px] shadow-2xl p-8 border border-white/20">

    {{-- AREA LOGO & JUDUL --}}
    <div class="text-center mb-5">
        <img src="{{ asset('images/logosikat.png') }}" alt="SIKAT Logo" class="mx-auto h-16 w-auto mb-2 opacity-90">
        <h1 class="text-xl font-bold text-gray-950 tracking-tight">Verify Email</h1>
    </div>

    {{-- TEKS DESKRIPSI --}}
    <div class="mb-5 text-xs text-gray-600 leading-relaxed text-center font-medium px-2">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    {{-- NOTIFIKASI JIKA LINK BARU TERKIRIM --}}
    @if (session('status') == 'verification-link-sent')
        <div class="mb-5 text-[11px] font-semibold text-green-700 bg-green-500/10 border border-green-500/20 rounded-xl p-3 text-center">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    {{-- AREA TOMBOL UTAMA (LAYOUT HORIZONTAL BERDAMPINGAN) --}}
    <div class="flex items-center justify-between gap-4 pt-2">
        
        {{-- Form Kirim Ulang Email --}}
        <form method="POST" action="{{ route('verification.send') }}" class="flex-1">
            @csrf
            <button type="submit"
                class="w-full py-2.5 bg-[#4e7281] hover:bg-[#3f5d6a] text-white rounded-xl text-xs font-semibold tracking-wide transition duration-150 active:scale-[0.98] shadow-md shadow-[#4e7281]/10 text-center whitespace-nowrap px-3">
                Resend Email
            </button>
        </form>

        {{-- Form Log Out --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                class="py-2.5 px-4 bg-gray-200/60 hover:bg-gray-200 text-gray-700 rounded-xl text-xs font-semibold transition active:scale-[0.98]">
                {{ __('Log Out') }}
            </button>
        </form>
        
    </div>

</div>

</x-guest-layout>