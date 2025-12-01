<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Masuk</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-white">
    
    <div class="min-h-screen grid grid-cols-1 md:grid-cols-2">
        
        <div class="flex flex-col justify-center px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white">
            <div class="mx-auto w-full max-w-sm lg:w-96 py-12">
                
                <div class="mb-8">
                    <a href="/" class="flex items-center gap-2 text-2xl font-bold text-teal-600 mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        Digital Hospital
                    </a>
                    <h2 class="text-3xl font-extrabold text-gray-900">Selamat Datang Kembali</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Silakan masuk ke akun Anda untuk melanjutkan.
                    </p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <input type="email" name="email" id="email" :value="old('email')" required autofocus class="block w-full pl-10 pr-3 py-3 border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 sm:text-sm" placeholder="nama@email.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input type="password" name="password" id="password" required autocomplete="current-password" class="block w-full pl-10 pr-3 py-3 border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 sm:text-sm" placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">Ingat Saya</label>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-sm">
                                <a href="{{ route('password.request') }}" class="font-medium text-teal-600 hover:text-teal-500">Lupa Kata Sandi?</a>
                            </div>
                        @endif
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-colors">
                            Masuk
                        </button>
                    </div>
                </form>
                
                <p class="mt-8 text-center text-sm text-gray-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-medium text-teal-600 hover:text-teal-500">
                        Daftar Sekarang
                    </a>
                    <span class="mx-2">|</span>
                    <a href="{{ route('home') }}" class="font-medium text-gray-500 hover:text-gray-700">
                        Kembali ke Beranda
                    </a>
                </p>

            </div>
        </div>

        <div class="hidden md:block relative w-full h-full bg-blue-50">
            <img class="absolute inset-0 w-full h-full object-cover" src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?q=80&w=2940&auto=format&fit=crop" alt="Medical Illustration">
            <div class="absolute inset-0 bg-gradient-to-t from-teal-900/60 to-transparent mix-blend-multiply"></div>
            <div class="absolute bottom-0 left-0 p-12 text-white">
                <h2 class="text-4xl font-bold mb-4">Layanan Kesehatan Masa Depan</h2>
                <p class="text-lg text-indigo-100 max-w-md">Akses layanan medis, buat janji temu dengan dokter spesialis, dan kelola kesehatan Anda dalam satu aplikasi terintegrasi.</p>
            </div>
        </div>

    </div>
</body>
</html>