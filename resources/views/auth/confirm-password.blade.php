<x-guest-layout>

{{-- KARTU UTAMA: Lebar 100% identik dengan Login, Register, Forgot, & Reset Password --}}
<div class="w-full max-w-[440px] mx-auto bg-white/40 backdrop-blur-2xl rounded-[32px] shadow-2xl p-8 border border-white/20">

    {{-- AREA LOGO & JUDUL --}}
    <div class="text-center mb-5">
        <img src="{{ asset('images/logosikat.png') }}" alt="SIKAT Logo" class="mx-auto h-16 w-auto mb-2 opacity-90">
        <h1 class="text-xl font-bold text-gray-950 tracking-tight">Confirm Password</h1>
    </div>

    {{-- TEKS DESKRIPSI --}}
    <div class="mb-5 text-xs text-gray-600 leading-relaxed text-center font-medium px-2">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    {{-- FORM CONFIRM PASSWORD --}}
    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        {{-- INPUT PASSWORD --}}
        <div class="space-y-1">
            <label for="password" class="block text-[11px] font-semibold text-gray-700 ml-1">Password</label>
            <div class="relative">
                <input type="password" name="password" id="password" placeholder="••••••••" required autocomplete="current-password"
                    class="w-full px-4 py-2.5 bg-[#f0f3f6]/80 border border-gray-200/50 rounded-xl text-gray-950 text-xs placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4e7281]/30 focus:border-[#4e7281] transition duration-150 tracking-widest">
                
                {{-- TOMBOL INTIP PASSWORD --}}
                <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 cursor-pointer hover:text-gray-600 focus:outline-none">
                    <svg id="eyeIcon" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-[11px] text-red-600" />
        </div>

        {{-- TOMBOL CONFIRM --}}
        <div class="pt-2">
            <button type="submit"
                class="w-full py-2.5 bg-[#4e7281] hover:bg-[#3f5d6a] text-white rounded-xl text-xs font-semibold tracking-wide transition duration-150 active:scale-[0.98] shadow-md shadow-[#4e7281]/10">
                Confirm
            </button>
        </div>
    </form>

</div>

{{-- SCRIPT JAVASCRIPT: LOGIK INTIP PASSWORD --}}
<script>
    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    const eyeOpenPath = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
    const eyeClosePath = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />`;

    togglePasswordButton.addEventListener('click', function () {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        eyeIcon.innerHTML = isPassword ? eyeOpenPath : eyeClosePath;
        isPassword ? passwordInput.classList.remove('tracking-widest') : passwordInput.classList.add('tracking-widest');
    });
</script>

</x-guest-layout>