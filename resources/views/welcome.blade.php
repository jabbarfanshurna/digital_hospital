<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Layanan Kesehatan Premium</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Custom Blob Animation */
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 bg-white">
    
    <x-public-navbar />

    <div class="relative bg-gradient-to-r from-cyan-50 to-blue-50 pt-32 pb-20 lg:pt-40 lg:pb-32 overflow-hidden">
        
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-teal-100 opacity-50 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-72 h-72 rounded-full bg-blue-100 opacity-50 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6 text-center lg:text-left">
                    <span class="inline-block py-1 px-3 rounded-full bg-teal-100 text-teal-800 text-sm font-bold tracking-wide uppercase">
                        Solusi Kesehatan Terpercaya
                    </span>
                    <h1 class="text-4xl lg:text-6xl font-extrabold text-gray-900 leading-tight">
                        Perawatan Premium untuk <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-cyan-600">
                            Gaya Hidup Sehat
                        </span>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        Kami menghadirkan arsitektur layanan kesehatan masa depan. Efisiensi tinggi, prosedur pengujian kritis, dan tenaga medis terbaik untuk Anda dan keluarga.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-4">
                        <a href="{{ route('public.doctors') }}" class="px-8 py-4 bg-teal-600 text-white font-bold rounded-full shadow-lg shadow-teal-200 hover:bg-teal-700 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2">
                            <span>Temukan Dokter</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </a>
                        <a href="#services" class="px-8 py-4 bg-white text-teal-700 font-bold rounded-full border border-teal-100 shadow-md hover:border-teal-300 hover:bg-teal-50 transition-all duration-300 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Lihat Layanan</span>
                        </a>
                    </div>

                    <div class="grid grid-cols-3 gap-6 pt-8 border-t border-gray-200/60">
                        <div>
                            <h4 class="text-2xl font-bold text-gray-900">4500+</h4>
                            <p class="text-sm text-gray-500">Pasien Puas</p>
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold text-gray-900">200+</h4>
                            <p class="text-sm text-gray-500">Kamar Rawat</p>
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold text-gray-900">500+</h4>
                            <p class="text-sm text-gray-500">Penghargaan</p>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="relative w-full max-w-lg mx-auto">
                        <div class="absolute top-0 -left-4 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                        <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
                        
                        <img src="https://img.freepik.com/free-photo/pleased-young-female-doctor-wearing-medical-robe-stethoscope-around-neck-standing-with-closed-posture_409827-254.jpg?t=st=1717650000~exp=1717653600~hmac=..." 
                             alt="Professional Doctor" 
                             class="relative rounded-3xl shadow-2xl z-10 w-full object-cover h-[500px] border-4 border-white/50">
                        
                        <div class="absolute top-10 -right-6 z-20 bg-white p-3 rounded-2xl shadow-xl flex items-center gap-3 animate-bounce" style="animation-duration: 3s;">
                            <div class="bg-green-100 p-2 rounded-full text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-semibold">Dokter Online</p>
                                <p class="text-sm font-bold text-gray-800">2500+ Aktif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative -mt-16 z-30 px-4">
        <div class="max-w-6xl mx-auto bg-teal-700 rounded-3xl shadow-2xl p-4 lg:p-8 backdrop-blur-sm bg-opacity-95">
            <form action="{{ route('appointments.create') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="relative">
                        <select name="poli_id" class="w-full bg-teal-800/50 text-white border-none rounded-xl py-4 pl-4 pr-10 focus:ring-2 focus:ring-cyan-400 placeholder-teal-200">
                            <option value="" class="text-gray-900">Pilih Poli / Departemen</option>
                            @foreach($featured_polis as $poli)
                                <option value="{{ $poli->id }}" class="text-gray-900">{{ $poli->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="relative">
                        <select class="w-full bg-teal-800/50 text-white border-none rounded-xl py-4 pl-4 pr-10 focus:ring-2 focus:ring-cyan-400">
                            <option value="" class="text-gray-900">Pilih Dokter</option>
                            <option value="" class="text-gray-900">Dr. Budi Santoso</option>
                            <option value="" class="text-gray-900">Dr. Rina Hartati</option>
                        </select>
                    </div>

                    <div class="relative">
                        <input type="date" class="w-full bg-teal-800/50 text-white border-none rounded-xl py-4 px-4 focus:ring-2 focus:ring-cyan-400" placeholder="Pilih Tanggal">
                    </div>

                    <button type="submit" class="w-full bg-white text-teal-800 font-bold rounded-xl py-4 hover:bg-cyan-50 transition shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Cari Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900">Kategori Departemen</h2>
                <p class="mt-4 text-gray-500">Telusuri berdasarkan departemen untuk layanan khusus.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">
                <a href="{{ route('public.polis') }}" class="group flex flex-col items-center gap-4 p-6 rounded-2xl border border-gray-100 hover:border-teal-200 hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 group-hover:bg-teal-500 group-hover:text-white transition-colors duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <span class="font-semibold text-gray-700 group-hover:text-teal-600">Jantung</span>
                </a>
                <a href="{{ route('public.polis') }}" class="group flex flex-col items-center gap-4 p-6 rounded-2xl border border-gray-100 hover:border-teal-200 hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 group-hover:bg-teal-500 group-hover:text-white transition-colors duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <span class="font-semibold text-gray-700 group-hover:text-teal-600">Radiologi</span>
                </a>
                <a href="{{ route('public.polis') }}" class="group flex flex-col items-center gap-4 p-6 rounded-2xl border border-gray-100 hover:border-teal-200 hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 group-hover:bg-teal-500 group-hover:text-white transition-colors duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <span class="font-semibold text-gray-700 group-hover:text-teal-600">Gigi</span>
                </a>
                <a href="{{ route('public.polis') }}" class="group flex flex-col items-center gap-4 p-6 rounded-2xl border border-gray-100 hover:border-teal-200 hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 group-hover:bg-teal-500 group-hover:text-white transition-colors duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="font-semibold text-gray-700 group-hover:text-teal-600">Anak</span>
                </a>
                <a href="{{ route('public.polis') }}" class="group flex flex-col items-center gap-4 p-6 rounded-2xl border border-gray-100 hover:border-teal-200 hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 group-hover:bg-teal-500 group-hover:text-white transition-colors duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                    </div>
                    <span class="font-semibold text-gray-700 group-hover:text-teal-600">Syaraf</span>
                </a>
                <a href="{{ route('public.polis') }}" class="group flex flex-col items-center gap-4 p-6 rounded-2xl border border-gray-100 hover:border-teal-200 hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 group-hover:bg-teal-500 group-hover:text-white transition-colors duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    </div>
                    <span class="font-semibold text-gray-700 group-hover:text-teal-600">Paru-paru</span>
                </a>
            </div>
        </div>
    </div>

    <div id="services" class="py-24 bg-teal-800 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white opacity-5 rounded-full blur-3xl -mr-20 -mt-20"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <div>
                    <h2 class="text-4xl font-extrabold mb-6 leading-tight">Layanan Kesehatan Kelas Dunia untuk Anda</h2>
                    <p class="text-teal-100 text-lg mb-8 leading-relaxed">
                        Kami menyediakan fasilitas medis komprehensif, dari unit gawat darurat 24 jam, laboratorium canggih, hingga apotek lengkap.
                    </p>
                    <a href="{{ route('public.polis') }}" class="inline-flex items-center px-6 py-3 bg-white text-teal-800 font-bold rounded-full hover:bg-cyan-50 transition">
                        Lihat Selengkapnya &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="bg-white text-gray-900 p-6 rounded-2xl shadow-lg transform hover:-translate-y-2 transition duration-300">
                        <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center mb-4 text-teal-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold mb-2">Gawat Darurat</h4>
                        <p class="text-sm text-gray-600">Layanan medis darurat 24/7 dengan respon cepat untuk kondisi kritis.</p>
                    </div>

                    <div class="bg-white text-gray-900 p-6 rounded-2xl shadow-lg transform hover:-translate-y-2 transition duration-300">
                        <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center mb-4 text-teal-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold mb-2">Laboratorium</h4>
                        <p class="text-sm text-gray-600">Tes diagnostik akurat menggunakan teknologi laboratorium terkini.</p>
                    </div>

                    <div class="bg-white text-gray-900 p-6 rounded-2xl shadow-lg transform hover:-translate-y-2 transition duration-300 sm:col-span-2 lg:col-span-1 lg:col-start-2">
                        <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center mb-4 text-teal-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold mb-2">Apotek Lengkap</h4>
                        <p class="text-sm text-gray-600">Penyediaan obat resep dan kesehatan terlengkap di lokasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-public-footer />

</body>
</html>