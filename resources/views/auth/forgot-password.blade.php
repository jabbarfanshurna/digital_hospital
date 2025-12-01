<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Lupa Kata Sandi</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-white">
    
    <div class="min-h-screen grid grid-cols-1 md:grid-cols-2">
        
        <div class="flex flex-col justify-center px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white order-2 md:order-1">
            <div class="mx-auto w-full max-w-sm lg:w-96 py-12">
                
                <div class="mb-8">
                    <a href="/" class="flex items-center gap-2 text-2xl font-bold text-teal-600 mb-6">
                        <div class="w-10 h-10 bg-teal-600 text-white rounded-xl flex items-center justify-center shadow-lg shadow-teal-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        Digital Hospital
                    </a>
                    <h2 class="text-3xl font-extrabold text-gray-900">Lupa Kata Sandi?</h2>
                    <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                        Jangan khawatir. Cukup masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi.
                    </p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <input type="email" name="email" id="email" :value="old('email')" required autofocus class="block w-full pl-10 pr-3 py-3 border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 sm:text-sm placeholder-gray-400" placeholder="nama@email.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-all transform hover:-translate-y-0.5">
                            Kirim Tautan Reset
                        </button>
                    </div>
                </form>
                
                <p class="mt-8 text-center text-sm text-gray-600">
                    Ingat kata sandi Anda? 
                    <a href="{{ route('login') }}" class="font-bold text-teal-600 hover:text-teal-500 hover:underline transition">
                        Kembali ke Login
                    </a>
                </p>

            </div>
        </div>

        <div class="hidden md:block relative w-full h-full bg-teal-50 order-1 md:order-2">
            <img class="absolute inset-0 w-full h-full object-cover" src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?q=80&w=2936&auto=format&fit=crop" alt="Medical Technology">
            <div class="absolute inset-0 bg-gradient-to-t from-teal-900/70 to-teal-500/30 mix-blend-multiply"></div>
            <div class="absolute bottom-0 left-0 p-12 text-white">
                <h2 class="text-4xl font-bold mb-4">Keamanan Data Prioritas Kami</h2>
                <p class="text-lg text-teal-100 max-w-md">Sistem kami dilindungi dengan enkripsi terkini untuk memastikan data kesehatan Anda tetap aman dan pribadi.</p>
            </div>
        </div>

    </div>
</body>
</html>