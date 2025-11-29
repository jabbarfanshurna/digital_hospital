<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Daftar Akun</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-white">
    
    <div class="min-h-screen grid grid-cols-1 md:grid-cols-2">
        
        <div class="flex flex-col justify-center px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white order-2 md:order-1">
            <div class="mx-auto w-full max-w-sm lg:w-96 py-12">
                
                <div class="mb-8">
                    <a href="/" class="flex items-center gap-2 text-2xl font-bold text-indigo-600 mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        Digital Hospital
                    </a>
                    <h2 class="text-3xl font-extrabold text-gray-900">Buat Akun Baru</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Daftar sekarang untuk mulai menggunakan layanan kami.
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="text" name="name" id="name" :value="old('name')" required autofocus class="block w-full px-3 py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Nama Anda">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="email" name="email" id="email" :value="old('email')" required class="block w-full px-3 py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="nama@email.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Daftar Sebagai</label>
                        <select id="role" name="role" class="mt-1 block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-lg">
                            <option value="user">Pasien</option>
                            <option value="manager">Dokter</option>
                        </select>
                        <p class="mt-1 text-xs text-gray-500">*Pilih 'Dokter' jika Anda adalah tenaga medis profesional.</p>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="password" name="password" id="password" required autocomplete="new-password" class="block w-full px-3 py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Minimal 8 karakter">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="password" name="password_confirmation" id="password_confirmation" required class="block w-full px-3 py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Ulangi kata sandi">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>
                
                <p class="mt-8 text-center text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Masuk di sini
                    </a>
                </p>

            </div>
        </div>

        <div class="hidden md:block relative w-full h-full bg-blue-50 order-1 md:order-2">
            <img class="absolute inset-0 w-full h-full object-cover" src="https://images.unsplash.com/photo-1638202993928-7267aad84c31?q=80&w=2787&auto=format&fit=crop" alt="Medical Illustration">
            <div class="absolute inset-0 bg-gradient-to-t from-indigo-900/60 to-transparent mix-blend-multiply"></div>
            <div class="absolute bottom-0 left-0 p-12 text-white">
                <h2 class="text-4xl font-bold mb-4">Bergabung dengan Komunitas Sehat</h2>
                <p class="text-lg text-indigo-100 max-w-md">Daftarkan diri Anda sekarang untuk mendapatkan akses mudah ke layanan kesehatan berkualitas.</p>
            </div>
        </div>

    </div>
</body>
</html>