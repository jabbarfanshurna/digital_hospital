<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Layanan Poli - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">
    
    <x-public-navbar />

    <div class="pt-32 pb-20 bg-gradient-to-r from-indigo-700 to-blue-600 text-white text-center px-4">
        <h1 class="text-4xl font-extrabold tracking-tight mb-4">Layanan Medis & Spesialisasi</h1>
        <p class="text-indigo-100 text-lg max-w-2xl mx-auto">
            Fasilitas lengkap dengan standar pelayanan terbaik untuk kenyamanan pasien.
        </p>
    </div>

    <div class="py-16 -mt-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($polis as $poli)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                
                <div class="h-52 bg-gray-200 relative overflow-hidden group">
                    @if($poli->image)
                        <img src="{{ asset('storage/' . $poli->image) }}" alt="{{ $poli->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-indigo-50">
                            <svg class="w-16 h-16 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-black bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $poli->name }}</h3>
                    <p class="text-gray-600 mb-6 text-sm leading-relaxed line-clamp-3">
                        {{ $poli->description ?? 'Layanan medis profesional dengan fasilitas modern.' }}
                    </p>
                    <div class="border-t border-gray-100 pt-4 flex justify-between items-center">
                        <span class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-full uppercase tracking-wide">Tersedia</span>
                        <a href="{{ route('public.doctors') }}" class="text-indigo-600 font-semibold text-sm hover:text-indigo-800">Cari Dokter &rarr;</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($polis->isEmpty())
            <div class="text-center py-20 bg-white rounded-lg shadow-sm">
                <p class="text-gray-500 text-lg">Belum ada data poli tersedia.</p>
            </div>
        @endif
    </div>

    <x-public-footer />

</body>
</html>