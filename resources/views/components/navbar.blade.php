<nav class="bg-[#2272FF] p-4">
    <div class="w-full mx-auto flex justify-between items-center">
        <!-- Logo et Nom de l'École -->
        <a href="/" class="flex flex-col items-center text-white text-xl font-semibold">
            @if ($schoolInfo->logo == null)
                <img src="{{ asset('assets/logo.png') }}" alt="Logo NH High School" class="w-12 h-8">
            @else
                <img src="{{ asset('storage/' . $schoolInfo->logo) }}" alt="Logo {{  $schoolInfo->name ?? 'NH High School'}}" class="w-12 h-8">
            @endif

            <span>{{$schoolInfo->name ?? 'NH High School'}}</span>
        </a>

        <!-- Menu Principal -->
        <div class="hidden md:flex space-x-6">
            <a href="/" class="text-white hover:text-[#1D1D1D]">Accueil</a>
            <a href="{{ route('about') }}" class="text-white hover:text-[#1D1D1D]">A Propos</a>
            <a href="{{ route('programmes') }}" class="text-white hover:text-[#1D1D1D]">Programmes</a>
            <a href="{{ route('blog') }}" class="text-white hover:text-[#1D1D1D]">Blog</a>
            <a href="{{ route('contact') }}" class="text-white hover:text-[#1D1D1D]">Contact</a>
        </div>

        <!-- Actions Utilisateur -->
        <div class="flex items-center space-x-4">
            <!-- Connexion/Profil -->
            <a href="{{ route('login') }}" class="bg-[#1D1D1D] text-sm text-white px-4 py-2 rounded-full shadow-md hover:bg-white hover:text-[#2272FF]">
                Se connecter
            </a>
        </div>

        <!-- Menu Mobile -->
        <button class="md:hidden text-white" id="menu-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Menu Mobile (Caché par défaut) -->
    <div class="md:hidden mt-4 space-y-4 bg-[#2272FF] text-white" id="mobile-menu" style="display: none;">
        <a href="#" class="block px-4 py-2 hover:text-[#1D1D1D]">Accueil</a>
        <a href="#" class="block px-4 py-2 hover:text-[#1D1D1D]">A Propos</a>
        <a href="#" class="block px-4 py-2 hover:text-[#1D1D1D]">Programmes</a>
        <a href="#" class="block px-4 py-2 hover:text-[#1D1D1D]">Blog</a>
        <a href="#" class="block px-4 py-2 hover:text-[#1D1D1D]">Contact</a>
    </div>
</nav>

<!-- Script JS pour Menu Mobile -->
<script>
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    menuToggle.addEventListener('click', () => {
        mobileMenu.style.display = mobileMenu.style.display === 'none' ? 'block' : 'none';
    });
</script>
