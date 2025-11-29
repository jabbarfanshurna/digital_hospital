<x-guest-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900">Temukan Dokter Kami</h2>
                <p class="mt-4 text-lg text-gray-500">Dokter spesialis berpengalaman siap membantu kesehatan Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($doctors as $doctor)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                    <div class="p-6 text-center">
                        <div class="w-24 h-24 mx-auto bg-indigo-100 rounded-full flex items-center justify-center text-indigo-500 mb-4 text-3xl font-bold">
                            {{ substr($doctor->name, 0, 1) }}
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $doctor->name }}</h3>
                        <p class="text-indigo-600 font-medium mb-4">{{ $doctor->poli ? $doctor->poli->name : 'Dokter Umum' }}</p>
                        
                        <div class="border-t border-gray-100 pt-4 mt-2">
                            <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Jadwal Praktik</h4>
                            
                            @if($doctor->schedules->count() > 0)
                                <div class="space-y-2">
                                    @foreach($doctor->schedules as $schedule)
                                        <div class="flex justify-between text-sm">
                                            <span class="font-medium text-gray-700 w-16 text-left">{{ $schedule->day }}</span>
                                            <span class="text-gray-500">
                                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - 
                                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-400 italic">Belum ada jadwal tersedia.</p>
                            @endif
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 text-center">
                        @auth
                            <a href="#" class="text-indigo-600 font-medium text-sm hover:text-indigo-800">Buat Janji (Segera)</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-500 font-medium text-sm hover:text-gray-700">Login untuk Booking</a>
                        @endauth
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-guest-layout>