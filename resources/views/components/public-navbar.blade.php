<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b border-teal-100 shadow-sm fixed w-full z-50 top-0 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-extrabold text-teal-600 flex items-center gap-2 tracking-tight">
                    <div class="w-10 h-10 bg-teal-600 text-white rounded-xl flex items-center justify-center shadow-lg shadow-teal-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    Digital<span class="text-gray-800">Hospital</span>
                </a>
            </div>

            <div class="hidden md:flex md:items-center md:space-x-8">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-teal-600 font-bold' : 'text-gray-500 hover:text-teal-600 font-medium' }} transition text-sm uppercase tracking-wide">Home</a>
                <a href="{{ route('public.polis') }}" class="{{ request()->routeIs('public.polis') ? 'text-teal-600 font-bold' : 'text-gray-500 hover:text-teal-600 font-medium' }} transition text-sm uppercase tracking-wide">Layanan Poli</a>
                <a href="{{ route('public.doctors') }}" class="{{ request()->routeIs('public.doctors') ? 'text-teal-600 font-bold' : 'text-gray-500 hover:text-teal-600 font-medium' }} transition text-sm uppercase tracking-wide">Cari Dokter</a>
            </div>

            <div class="hidden md:flex items-center space-x-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-gray-700 hover:text-teal-600 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 font-bold hover:text-teal-600 transition px-4 py-2">Log in</a>
                    <a href="{{ route('register') }}" class="bg-teal-600 text-white px-6 py-2.5 rounded-full font-bold shadow-md shadow-teal-200 hover:bg-teal-700 hover:shadow-lg transition transform hover:-translate-y-0.5">Register</a>
                @endauth
            </div>

            <div class="-mr-2 flex items-center md:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-teal-600 hover:bg-teal-50 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-white border-t border-gray-100 absolute w-full shadow-lg">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block pl-3 pr-4 py-3 border-l-4 {{ request()->routeIs('home') ? 'border-teal-500 text-teal-700 bg-teal-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium transition duration-150 ease-in-out">Home</a>
            <a href="{{ route('public.polis') }}" class="block pl-3 pr-4 py-3 border-l-4 {{ request()->routeIs('public.polis') ? 'border-teal-500 text-teal-700 bg-teal-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium transition duration-150 ease-in-out">Layanan Poli</a>
            <a href="{{ route('public.doctors') }}" class="block pl-3 pr-4 py-3 border-l-4 {{ request()->routeIs('public.doctors') ? 'border-teal-500 text-teal-700 bg-teal-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium transition duration-150 ease-in-out">Cari Dokter</a>
        </div>
        <div class="pt-4 pb-6 border-t border-gray-200">
            <div class="space-y-3 px-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="block w-full text-center px-4 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-teal-600 hover:bg-teal-700">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block w-full text-center px-4 py-3 mb-2 border border-gray-300 rounded-lg text-base font-medium text-gray-700 bg-white hover:bg-gray-50">Log in</a>
                    <a href="{{ route('register') }}" class="block w-full text-center px-4 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-teal-600 hover:bg-teal-700">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>