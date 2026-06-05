<x-guest-layout>

    {{-- LOADING OVERLAY (Full Screen dengan Efek Glassmorphism) --}}
    <div id="loadingOverlay" class="hidden fixed inset-0 bg-gray-950/40 backdrop-blur-md flex justify-center items-center z-[9999]">
        <div class="bg-white p-6 rounded-[24px] shadow-2xl flex flex-col items-center space-y-3 border border-gray-100">
            {{-- SVG Spinner Animasi --}}
            <svg class="animate-spin h-8 w-8 text-[#4e7281]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-xs font-semibold text-gray-700 tracking-tight">Logging into your account...</span>
        </div>
    </div>

    {{-- KARTU UTAMA: Efek kaca transparan (Glassmorphism) --}}
    <div class="w-full max-w-[460px] mx-auto bg-white/40 backdrop-blur-3xl rounded-[35px] shadow-2xl p-10 border border-white/20">

        {{-- AREA LOGO & JUDUL --}}
        <div class="text-center mb-9">
            <img src="{{ asset('images/logosikat.png') }}" alt="SIKAT Logo" class="mx-auto h-20 w-auto mb-4">
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight mb-1">Login to Account</h1>
            <p class="text-gray-500 text-xs font-medium">Please enter your email and password to continue</p>
        </div>

        {{-- STATUS SESI (ALERT ERROR/SUKSES) --}}
        <x-auth-session-status class="mb-4 text-xs" :status="session('status')" />
        {{-- ALERT ERROR LOGIN --}}
        @if ($errors->any())
        <div id="loginError"
            class="mb-4 p-4 rounded-2xl bg-red-50/90 border border-red-200 backdrop-blur-sm shadow-sm transition-all duration-500">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                </svg>

                <div>
                    <p class="text-xs font-semibold text-red-700">
                        Login Failed
                    </p>
                    <p class="text-[11px] text-red-600">
                        Email atau password yang Anda masukkan salah.
                    </p>
                </div>
            </div>
        </div>

        <script>
            setTimeout(() => {
                const alert = document.getElementById('loginError');
                if (alert) {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 5000);
        </script>
        @endif
        {{-- FORM LOGIN --}}
        <form method="POST" action="{{ route('login') }}" id="loginForm" class="space-y-4">
            @csrf

            {{-- INPUT EMAIL --}}
            <div class="space-y-1">
                <label for="email" class="block text-xs font-medium text-gray-600">Email</label>
                <input type="email" name="email" id="email" placeholder="admin_aset@ub.ac.id" required autofocus
                    class="w-full px-4 py-3 bg-[#f0f3f6]/80 border border-gray-200/50 rounded-xl text-gray-800 text-xs placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4e7281]/30 focus:border-[#4e7281] transition duration-150">
            </div>

            {{-- INPUT PASSWORD --}}
            <div class="space-y-1">
                <div class="flex justify-between items-center mb-0.5">
                    <label for="password" class="block text-xs font-medium text-gray-600">Password</label>
                    <a href="{{ route('password.request') }}" class="text-[11px] font-medium text-gray-500 hover:text-[#4e7281] hover:underline transition">
                        Forget Password?
                    </a>
                </div>
                <div class="relative">
                    <input type="password" name="password" id="password" placeholder="••••••••" required
                        class="w-full pl-4 pr-11 py-3 bg-[#f0f3f6]/80 border border-gray-200/50 rounded-xl text-gray-800 text-xs placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4e7281]/30 focus:border-[#4e7281] transition duration-150 tracking-widest">

                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 cursor-pointer hover:text-gray-600 focus:outline-none">
                        {{-- Ikon Mata Coret (Sembunyi) --}}
                        <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- REMEMBER ME --}}
            <div class="flex items-center space-x-2 pt-1">
                <input type="checkbox" name="remember" id="remember"
                    class="h-3.5 w-3.5 rounded border-gray-300 text-[#4e7281] focus:ring-[#4e7281]/30 transition cursor-pointer bg-[#f0f3f6]">
                <label for="remember" class="text-[11px] font-medium text-gray-500 cursor-pointer select-none">
                    Remember Password
                </label>
            </div>

            {{-- TOMBOL LOG IN --}}
            <div class="pt-3">
                <button type="submit"
                    class="w-full py-2.5 bg-[#4e7281] hover:bg-[#3f5d6a] text-white rounded-xl text-xs font-semibold tracking-wide shadow-md shadow-[#4e7281]/10 transition duration-150 active:scale-[0.98]">
                    Log In
                </button>
            </div>
        </form>

        {{-- FOOTER LINK --}}
        <div class="text-center mt-6 text-xs text-gray-500 font-medium">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-semibold text-gray-600 hover:text-[#4e7281] hover:underline transition">
                Sign Up
            </a>
        </div>

    </div>

    {{-- LOGIKA JAVASCRIPT --}}
    <script>
        const loginForm = document.getElementById('loginForm');
        const loadingOverlay = document.getElementById('loadingOverlay');
        const passwordInput = document.getElementById('password');
        const togglePasswordButton = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        // 1. Logika Trigger Loading Halaman
        loginForm.addEventListener('submit', function(e) {
            if (loginForm.checkValidity()) {
                loadingOverlay.classList.remove('hidden');
            }
        });

        // 2. Logika Mata Intip Password
        const eyeOpenPath = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
        const eyeClosePath = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />`;

        togglePasswordButton.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            if (type === 'text') {
                eyeIcon.innerHTML = eyeOpenPath;
                passwordInput.classList.remove('tracking-widest');
            } else {
                eyeIcon.innerHTML = eyeClosePath;
                passwordInput.classList.add('tracking-widest');
            }
        });
    </script>

</x-guest-layout>