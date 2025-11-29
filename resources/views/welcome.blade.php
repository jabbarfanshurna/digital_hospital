<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-white">
    
    <nav class="bg-white border-b border-gray-100 shadow-sm fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        Digital Hospital
                    </a>
                </div>
                <div class="hidden sm:flex sm:items-center sm:space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-900 hover:text-indigo-600 font-medium">Home</a>
                    <a href="{{ route('public.polis') }}" class="text-gray-500 hover:text-indigo-600 font-medium">Layanan Poli</a>
                    <a href="{{ route('public.doctors') }}" class="text-gray-500 hover:text-indigo-600 font-medium">Cari Dokter</a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-900 font-medium hover:text-indigo-600">Log in</a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="relative bg-blue-50 pt-24 pb-12 lg:pt-32 lg:pb-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight leading-tight mb-6">
                        Layanan Kesehatan Terpercaya untuk <span class="text-indigo-600">Keluarga Anda</span>
                    </h1>
                    <p class="text-lg text-gray-600 mb-8">
                        Kami menyediakan layanan medis terbaik dengan dokter spesialis berpengalaman dan fasilitas modern. Buat janji temu secara online dengan mudah dan cepat.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-3 bg-indigo-600 text-white font-semibold rounded-md shadow-lg hover:bg-indigo-700 transition text-center">
                            Buat Janji Temu
                        </a>
                        <a href="{{ route('public.doctors') }}" class="px-8 py-3 bg-white text-indigo-600 font-semibold rounded-md border border-indigo-200 hover:bg-indigo-50 transition text-center">
                            Lihat Jadwal Dokter
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1638202993928-7267aad84c31?q=80&w=2787&auto=format&fit=crop" alt="Hospital Team" class="rounded-2xl shadow-2xl relative z-10 w-full object-cover h-96">
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-blue-200 rounded-full blur-xl opacity-50"></div>
                    <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-indigo-200 rounded-full blur-xl opacity-50"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-indigo-600 font-semibold tracking-wide uppercase text-sm">Layanan Kami</h2>
                <h3 class="mt-2 text-3xl font-extrabold text-gray-900">Poli Unggulan</h3>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">Berbagai layanan spesialis untuk memenuhi kebutuhan kesehatan Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($featured_polis as $poli)
                <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 hover:shadow-lg transition duration-300">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4 text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $poli->name }}</h4>
                    <p class="text-gray-600 mb-4">{{ Str::limit($poli->description, 80) }}</p>
                    <a href="{{ route('public.polis') }}" class="text-indigo-600 font-medium hover:text-indigo-800 flex items-center">
                        Selengkapnya <span class="ml-1">&rarr;</span>
                    </a>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-10">
                <a href="{{ route('public.polis') }}" class="inline-block px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
                    Lihat Semua Poli
                </a>
            </div>
        </div>
    </div>

    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Digital Hospital. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>