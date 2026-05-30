<x-guest-layout>

    {{-- LOADING OVERLAY (Full Screen dengan Efek Glassmorphism) --}}
    <div id="loadingOverlay" class="hidden fixed inset-0 bg-gray-950/40 backdrop-blur-md flex justify-center items-center z-[9999]">
        <div class="bg-white p-6 rounded-[24px] shadow-2xl flex flex-col items-center space-y-3 border border-gray-100">
            {{-- SVG Spinner Animasi --}}
            <svg class="animate-spin h-8 w-8 text-[#4e7281]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-xs font-semibold text-gray-700 tracking-tight">Creating your account...</span>
        </div>
    </div>

    {{-- KARTU UTAMA: Slim 390px --}}
    <div class="w-full max-w-[390px] mx-auto bg-white/40 backdrop-blur-2xl rounded-[28px] shadow-2xl p-6 border border-white/20">

        {{-- AREA LOGO & JUDUL --}}
        <div class="text-center mb-4">
            <img src="{{ asset('images/logosikat.png') }}" alt="SIKAT Logo" class="mx-auto h-20 w-auto mb-1 opacity-90">
            <h1 class="text-lg font-bold text-gray-950 tracking-tight">Create an Account</h1>
            <p class="text-gray-600 text-[10px]">Create an account to continue</p>
        </div>

        {{-- FORM REGISTRASI --}}
        <form method="POST" action="{{ route('register') }}" id="registerForm" class="space-y-2.5">
            @csrf

            {{-- ERROR VALIDATION --}}
            @if ($errors->any())
                <div class="p-3 bg-red-100 border border-red-300 rounded-xl">
                    <ul class="text-red-600 text-xs">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- NAME --}}
            <div class="space-y-1">
                <label for="name" class="block text-[10px] font-semibold text-gray-700 ml-1">
                    Name
                </label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    placeholder="Name"
                    required
                    autofocus
                    class="w-full px-4 py-2 bg-[#f0f3f6]/80 border border-gray-200/50 rounded-xl text-gray-950 text-xs placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4e7281]/30 focus:border-[#4e7281]"
                >
            </div>

            {{-- EMAIL --}}
            <div class="space-y-1">
                <label for="email" class="block text-[10px] font-semibold text-gray-700 ml-1">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    placeholder="admin_aset@ub.ac.id"
                    required
                    class="w-full px-4 py-2 bg-[#f0f3f6]/80 border border-gray-200/50 rounded-xl text-gray-950 text-xs placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4e7281]/30 focus:border-[#4e7281]"
                >
            </div>

            {{-- ROLE DROPDOWN --}}
            <div class="space-y-1 relative">
                <label class="block text-[10px] font-semibold text-gray-700 ml-1">
                    Role
                </label>

                <input
                    type="hidden"
                    name="role"
                    id="roleInput"
                    value="admin_aset"
                >

                <button
                    type="button"
                    id="dropdownBtn"
                    class="w-full flex justify-between items-center px-4 py-2 bg-[#f0f3f6]/80 border border-gray-200/50 rounded-xl text-gray-950 text-xs text-left text-gray-950"
                >
                    <span id="dropdownLabel">Admin Aset</span>
                    <svg id="dropdownArrow"
                        class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div id="dropdownMenu"
                    class="hidden absolute left-0 w-full mt-1 bg-white border rounded-xl shadow-xl z-50">
                    <div data-value="admin_aset" class="dropdown-item px-4 py-2 hover:bg-[#4e7281]/10 cursor-pointer text-xs text-gray-900">
                        Admin Aset
                    </div>
                    <div data-value="petugas_inventaris" class="dropdown-item px-4 py-2 hover:bg-[#4e7281]/10 cursor-pointer text-xs text-gray-900">
                        Petugas Inventaris
                    </div>
                    <div data-value="teknisi" class="dropdown-item px-4 py-2 hover:bg-[#4e7281]/10 cursor-pointer text-xs text-gray-900">
                        Teknisi
                    </div>
                </div>
            </div>

            {{-- PASSWORD --}}
            <div class="space-y-1">
                <label for="password" class="block text-[10px] font-semibold text-gray-700 ml-1">
                    Password
                </label>
                <div class="relative">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        placeholder="••••••••"
                        class="w-full pl-4 pr-10 py-2 bg-[#f0f3f6]/80 border border-gray-200/50 rounded-xl text-gray-950 text-xs focus:outline-none focus:ring-2 focus:ring-[#4e7281]/30 focus:border-[#4e7281]"
                    >
                    <button 
                        type="button" 
                        onclick="togglePasswordVisibility('password', 'eyeIconPassword')" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none"
                    >
                        <svg id="eyeIconPassword" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            <path class="eye-closed hidden" stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4m3.045-1.138A9.935 9.935 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.4M9.9 9.9l4.2 4.2m0-4.2l-4.2 4.2" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- CONFIRM PASSWORD --}}
            <div class="space-y-1">
                <label for="password_confirmation" class="block text-[10px] font-semibold text-gray-700 ml-1">
                    Confirm Password
                </label>
                <div class="relative">
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        required
                        placeholder="••••••••"
                        class="w-full pl-4 pr-10 py-2 bg-[#f0f3f6]/80 border border-gray-200/50 rounded-xl text-gray-950 text-xs focus:outline-none focus:ring-2 focus:ring-[#4e7281]/30 focus:border-[#4e7281]"
                    >
                    <button 
                        type="button" 
                        onclick="togglePasswordVisibility('password_confirmation', 'eyeIconConfirm')" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none"
                    >
                        <svg id="eyeIconConfirm" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            <path class="eye-closed hidden" stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4m3.045-1.138A9.935 9.935 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.4M9.9 9.9l4.2 4.2m0-4.2l-4.2 4.2" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- TERMS --}}
            <div class="flex items-center space-x-2 pt-1">
                <input type="checkbox" id="terms" required class="h-3 w-3 rounded text-[#4e7281] focus:ring-[#4e7281]/30">
                <label for="terms" class="text-[10px] text-gray-500">
                    I accept terms and conditions
                </label>
            </div>

            {{-- SUBMIT --}}
            <button
                type="submit"
                class="w-full py-2.5 bg-[#4e7281] hover:bg-[#3f5d6a] text-white rounded-xl text-xs font-semibold transition-colors duration-155">
                Sign Up
            </button>
        </form>

        {{-- FOOTER LINK --}}
        <div class="text-center mt-4 text-[11px] text-gray-500 font-medium">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-[#4e7281] hover:underline transition">Login</a>
        </div>

    </div>

    {{-- SCRIPTS JAVASCRIPT LOGIC --}}
    <script>
        // 1. LOGIKA UTK HALAMAN LOADING OVERLAY
        const registerForm = document.getElementById('registerForm');
        const loadingOverlay = document.getElementById('loadingOverlay');

        registerForm.addEventListener('submit', function(e) {
            // Hanya aktifkan overlay jika inputan form tervalidasi lengkap (bukan asal klik)
            if (registerForm.checkValidity()) {
                loadingOverlay.classList.remove('hidden');
            }
        });

        // 2. LOGIKA TOGGLE MATA INTIP PASSWORD & CONFIRM PASSWORD
        function togglePasswordVisibility(inputId, svgId) {
            const passwordInput = document.getElementById(inputId);
            const svgIcon = document.getElementById(svgId);
            
            const openPaths = svgIcon.querySelectorAll('.eye-open');
            const closedPath = svgIcon.querySelector('.eye-closed');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                openPaths.forEach(path => path.classList.add('hidden'));
                closedPath.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                openPaths.forEach(path => path.classList.remove('hidden'));
                closedPath.classList.add('hidden');
            }
        }

        // 3. LOGIKA CUSTOM ROLE DROPDOWN
        const dropdownBtn = document.getElementById('dropdownBtn');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const dropdownLabel = document.getElementById('dropdownLabel');
        const dropdownArrow = document.getElementById('dropdownArrow');
        const roleInput = document.getElementById('roleInput');
        const dropdownItems = document.querySelectorAll('.dropdown-item');

        dropdownBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
            dropdownArrow.classList.toggle('rotate-180');
        });

        dropdownItems.forEach(item => {
            item.addEventListener('click', function() {
                dropdownLabel.innerText = this.innerText;
                roleInput.value = this.getAttribute('data-value');
                dropdownMenu.classList.add('hidden');
                dropdownArrow.classList.remove('rotate-180');
            });
        });

        // Klik di luar area dropdown untuk otomatis menutup menu
        document.addEventListener('click', () => {
            dropdownMenu.classList.add('hidden');
            dropdownArrow.classList.remove('rotate-180');
        });
    </script>

</x-guest-layout>