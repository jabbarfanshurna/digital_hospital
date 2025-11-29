<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Dokter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="text-sm text-gray-500">Menunggu Validasi</div>
                    <div class="text-3xl font-bold text-gray-800">{{ $doctorPending }}</div>
                    <a href="{{ route('appointments.index') }}" class="text-xs text-indigo-600 hover:underline mt-2 inline-block">Lihat Daftar</a>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-sm text-gray-500">Pasien Hari Ini</div>
                    <div class="text-3xl font-bold text-gray-800">{{ $todayAppointments->count() }}</div>
                </div>

                <a href="{{ route('doctor.schedules.index') }}" class="bg-indigo-600 text-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col justify-center items-center hover:bg-indigo-700 transition">
                    <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold">Atur Jadwal</span>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Jadwal Praktik Hari Ini</h3>
                    @forelse($todayAppointments as $app)
                        <div class="flex items-center justify-between py-3 border-b last:border-0">
                            <div>
                                <div class="font-semibold text-gray-900">{{ $app->patient->name }}</div>
                                <div class="text-xs text-gray-500">Jam: {{ \Carbon\Carbon::parse($app->schedule->start_time)->format('H:i') }}</div>
                            </div>
                            <a href="{{ route('doctor.medical_records.create', ['appointment_id' => $app->id]) }}" class="px-3 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">Periksa</a>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm italic">Tidak ada pasien terjadwal hari ini.</p>
                    @endforelse
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Riwayat Pemeriksaan Terakhir</h3>
                    @forelse($recentExaminations as $record)
                        <div class="py-3 border-b last:border-0">
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-900">{{ $record->patient->name }}</span>
                                <span class="text-xs text-gray-500">{{ $record->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="text-sm text-gray-600 truncate">{{ $record->diagnosis }}</div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm italic">Belum ada riwayat pemeriksaan.</p>
                    @endforelse
                    
                    @if($recentExaminations->count() > 0)
                        <a href="{{ route('medical_records.index') }}" class="block mt-4 text-center text-sm text-indigo-600 hover:underline">Lihat Semua Riwayat</a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>