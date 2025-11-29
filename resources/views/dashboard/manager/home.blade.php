<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Dokter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('doctor.schedules.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition cursor-pointer">
                    <div class="text-indigo-600 mb-2">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Atur Jadwal Praktik</h3>
                    <p class="text-sm text-gray-600 mt-1">Kelola hari dan jam praktik Anda.</p>
                </a>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 opacity-75">
                    <div class="text-green-600 mb-2">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Validasi Janji Temu</h3>
                    <p class="text-sm text-gray-600 mt-1">Lihat dan setujui permintaan janji temu pasien (Segera Hadir).</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>