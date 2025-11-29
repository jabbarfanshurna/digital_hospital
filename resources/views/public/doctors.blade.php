<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jadwal Dokter - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">
    
    <x-public-navbar />

    <div class="bg-white border-b border-gray-200 pt-28 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-indigo-600 font-semibold tracking-wide uppercase text-sm">Tim Medis Kami</span>
            <h1 class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">Temukan Dokter Spesialis</h1>
            <p class="mt-4 max-w-2xl text-lg text-gray-500 mx-auto">
                Pilih dokter yang tepat dan sesuaikan dengan jadwal Anda.
            </p>
        </div>
    </div>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($doctors as $doctor)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 hover:shadow-xl hover:border-indigo-100 transition-all duration-300 flex flex-col h-full">
                    
                    <div class="p-6 flex flex-col items-center border-b border-gray-50 bg-gradient-to-b from-white to-gray-50 rounded-t-2xl">
                        <div class="w-24 h-24 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-3xl font-bold mb-4 ring-4 ring-white shadow-md">
                            {{ substr($doctor->name, 0, 1) }}
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 text-center">{{ $doctor->name }}</h3>
                        <span class="mt-2 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">
                            {{ $doctor->poli ? $doctor->poli->name : 'Dokter Umum' }}
                        </span>
                    </div>

                    <div class="p-6 flex-grow">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Jadwal Praktik
                        </h4>
                        
                        @if($doctor->schedules->count() > 0)
                            <div class="space-y-3">
                                @foreach($doctor->schedules as $schedule)
                                    <div class="flex justify-between items-center text-sm bg-gray-50 p-3 rounded-lg border border-gray-100">
                                        <span class="font-semibold text-gray-700 w-16">{{ $schedule->day }}</span>
                                        <span class="text-gray-600 bg-white px-2 py-1 rounded border border-gray-200 text-xs">
                                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - 
                                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-6 bg-gray-50 rounded-lg border border-dashed border-gray-200">
                                <p class="text-sm text-gray-400 italic">Jadwal belum tersedia</p>
                            </div>
                        @endif
                    </div>

                    <div class="p-4 border-t border-gray-100">
                        @auth
                            <a href="{{ route('appointments.create', ['poli_id' => $doctor->poli_id]) }}" class="block w-full text-center px-4 py-3 bg-indigo-600 text-white rounded-xl font-semibold text-sm hover:bg-indigo-700 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                Buat Janji Temu
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-3 bg-white text-gray-700 border border-gray-300 rounded-xl font-semibold text-sm hover:bg-gray-50 transition">
                                Login untuk Booking
                            </a>
                        @endauth
                    </div>
                </div>
                @endforeach
            </div>

            @if($doctors->isEmpty())
                <div class="text-center py-20">
                    <h3 class="text-lg font-medium text-gray-900">Belum ada Dokter</h3>
                    <p class="text-gray-500 mt-1">Silakan hubungi admin.</p>
                </div>
            @endif
        </div>
    </div>

    <x-public-footer />

</body>
</html>