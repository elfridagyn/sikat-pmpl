<x-guest-layout>

{{-- KARTU UTAMA: Di-slimkan ke 390px, padding lebih padat p-6 --}}
<div class="w-full max-w-[390px] mx-auto bg-white/40 backdrop-blur-2xl rounded-[28px] shadow-2xl p-6 border border-white/20">

    {{-- AREA LOGO & JUDUL: Logo diperbesar, margin dikurangi --}}
    <div class="text-center mb-4">
        <img src="{{ asset('images/logosikat.png') }}" alt="SIKAT Logo" class="mx-auto h-20 w-auto mb-1 opacity-90">
        <h1 class="text-lg font-bold text-gray-950 tracking-tight">Create an Account</h1>
        <p class="text-gray-600 text-[10px]">Create an account to continue</p>
    </div>

    {{-- FORM REGISTRASI: Jarak antar elemen makin rapat space-y-2.5 --}}
    <form method="POST" action="{{ route('register') }}" class="space-y-2.5">
        @csrf

        {{-- INPUT NAME --}}
        <div class="space-y-1">
            <label for="name" class="block text-[10px] font-semibold text-gray-700 ml-1">Name</label>
            <input type="text" name="name" id="name" placeholder="Name" required autofocus
                class="w-full px-4 py-2 bg-[#f0f3f6]/80 border border-gray-200/50 rounded-xl text-gray-950 text-xs placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4e7281]/30 focus:border-[#4e7281] transition duration-150">
        </div>

        {{-- INPUT EMAIL --}}
        <div class="space-y-1">
            <label for="email" class="block text-[10px] font-semibold text-gray-700 ml-1">Email</label>
            <input type="email" name="email" id="email" placeholder="admin_aset@ub.ac.id" required
                class="w-full px-4 py-2 bg-[#f0f3f6]/80 border border-gray-200/50 rounded-xl text-gray-950 text-xs placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4e7281]/30 focus:border-[#4e7281] transition duration-150">
        </div>

        {{-- DROPDOWN ROLE MODERN --}}
        <div class="space-y-1 relative">
            <label class="block text-[10px] font-semibold text-gray-700 ml-1">Role</label>
            <input type="hidden" name="role" id="roleInput" value="" required>

            <button type="button" id="dropdownBtn"
                class="w-full flex justify-between items-center px-4 py-2 bg-[#f0f3f6]/80 border border-gray-200/50 rounded-xl text-gray-400 text-xs text-left focus:outline-none focus:ring-2 focus:ring-[#4e7281]/30 focus:border-[#4e7281] transition duration-150 select-none">
                <span id="dropdownLabel">Admin Aset</span>
                <svg id="dropdownArrow" class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div id="dropdownMenu" class="hidden absolute left-0 w-full mt-1 bg-white/95 backdrop-blur-md border border-gray-100 shadow-xl rounded-xl py-1 z-50 text-xs animate-fadeIn">
                <div data-value="admin_aset" class="dropdown-item px-4 py-2 hover:bg-[#4e7281]/10 hover:text-[#4e7281] text-gray-700 cursor-pointer transition font-medium">Admin Aset</div>
                <div data-value="petugas_inventaris" class="dropdown-item px-4 py-2 hover:bg-[#4e7281]/10 hover:text-[#4e7281] text-gray-700 cursor-pointer transition font-medium">Petugas Inventaris</div>
                <div data-value="teknisi" class="dropdown-item px-4 py-2 hover:bg-[#4e7281]/10 hover:text-[#4e7281] text-gray-700 cursor-pointer transition font-medium">Teknisi</div>
            </div>
        </div>

        {{-- INPUT PASSWORD --}}
        <div class="space-y-1">
            <div class="flex justify-between items-center ml-1">
                <label for="password" class="block text-[10px] font-semibold text-gray-700">Password</label>
            </div>
            <div class="relative">
                <input type="password" name="password" id="password" placeholder="••••••••" required
                    class="w-full px-4 py-2 bg-[#f0f3f6]/80 border border-gray-200/50 rounded-xl text-gray-950 text-xs placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4e7281]/30 focus:border-[#4e7281] transition duration-150 tracking-widest">
                
                <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 cursor-pointer hover:text-gray-600 focus:outline-none">
                    <svg id="eyeIcon" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path>
                    </svg>
                </button>
            </div>
        </div>

        {{-- TERMS & CONDITIONS --}}
        <div class="flex items-center space-x-2 pt-0.5 ml-1">
            <input type="checkbox" name="terms" id="terms" required
                class="h-3 w-3 rounded border-gray-300 text-[#4e7281] focus:ring-[#4e7281]/30 transition cursor-pointer bg-[#f0f3f6]">
            <label for="terms" class="text-[10px] font-medium text-gray-500 cursor-pointer select-none">
                I accept terms and conditions
            </label>
        </div>

        {{-- TOMBOL SIGN UP --}}
        <div class="pt-1">
            <button type="submit"
                class="w-full py-2.5 bg-[#4e7281] hover:bg-[#3f5d6a] text-white rounded-xl text-xs font-semibold tracking-wide transition duration-150 active:scale-[0.98]">
                Sign Up
            </button>
        </div>
    </form>

    {{-- FOOTER LINK --}}
    <div class="text-center mt-4 text-[11px] text-gray-500 font-medium">
        Already have an account? 
        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-[#4e7281] hover:underline transition">Login</a>
    </div>

</div>

{{-- JAVASCRIPT --}}
<script>
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
            dropdownBtn.classList.replace('text-gray-400', 'text-gray-950');
            roleInput.value = this.getAttribute('data-value');
            dropdownMenu.classList.add('hidden');
            dropdownArrow.classList.remove('rotate-180');
        });
    });

    document.addEventListener('click', () => {
        dropdownMenu.classList.add('hidden');
        dropdownArrow.classList.remove('rotate-180');
    });

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