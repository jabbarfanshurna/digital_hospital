<x-app-layout>
    <div class="max-w-7xl mx-auto">
        
        <div class="mb-8 bg-teal-600 rounded-2xl p-8 text-white shadow-lg relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                <p class="text-teal-100 opacity-90">Berikut adalah ringkasan operasional dan analitik rumah sakit hari ini.</p>
            </div>
            <div class="absolute -top-12 -right-12 w-48 h-48 bg-white opacity-10 rounded-full"></div>
            <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-white opacity-10 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] flex items-center border-l-4 border-yellow-500 transition hover:shadow-md">
                <div class="mr-4 bg-yellow-100 rounded-full p-3 text-yellow-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <div class="text-gray-500 text-xs font-bold uppercase tracking-wider">Pending</div>
                    <div class="text-2xl font-extrabold text-gray-900">{{ $pendingAppointments }}</div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] flex items-center border-l-4 border-blue-500 transition hover:shadow-md">
                <div class="mr-4 bg-blue-100 rounded-full p-3 text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <div class="text-gray-500 text-xs font-bold uppercase tracking-wider">Dokter</div>
                    <div class="text-2xl font-extrabold text-gray-900">{{ $totalDoctors }}</div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] flex items-center border-l-4 border-green-500 transition hover:shadow-md">
                <div class="mr-4 bg-green-100 rounded-full p-3 text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <div class="text-gray-500 text-xs font-bold uppercase tracking-wider">Pasien</div>
                    <div class="text-2xl font-extrabold text-gray-900">{{ $totalPatients }}</div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] flex items-center border-l-4 border-teal-500 transition hover:shadow-md">
                <div class="mr-4 bg-purple-100 rounded-full p-3 text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <div class="text-gray-500 text-xs font-bold uppercase tracking-wider">Total Akun</div>
                    <div class="text-2xl font-extrabold text-gray-900">{{ $totalUsers }}</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span>🏆</span> Top 5 Performa Dokter
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-600">
                        <thead class="bg-gray-50 text-xs text-gray-700 uppercase">
                            <tr>
                                <th class="px-6 py-3">Nama Dokter</th>
                                <th class="px-6 py-3 text-center">Total Pasien</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($topDoctors as $doc)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-3 font-medium text-gray-900">{{ $doc->name }}</td>
                                <td class="px-6 py-3 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">
                                        {{ $doc->total_treated }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span>📊</span> Pasien per Poli
                </h3>
                <div class="space-y-4">
                    @foreach($patientsPerPoli as $poli)
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700">{{ $poli->name }}</span>
                            <span class="text-xs font-medium text-gray-500">{{ $poli->completed_appointments_count }} Pasien</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2.5">
                            @php
                                $percent = $totalPatients > 0 ? ($poli->completed_appointments_count / $totalPatients) * 100 : 0;
                            @endphp
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            
            <div class="bg-white rounded-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span>💊</span> Obat Paling Banyak Digunakan
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-600">
                        <thead class="bg-gray-50 text-xs text-gray-700 uppercase">
                            <tr>
                                <th class="px-6 py-3">Nama Obat</th>
                                <th class="px-6 py-3 text-center">Total Keluar</th>
                                <th class="px-6 py-3 text-center">Sisa Stok</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($topMedicines as $med)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-3 font-medium text-gray-900">{{ $med->name }}</td>
                                <td class="px-6 py-3 text-center">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded">
                                        {{ $med->total_usage ?? 0 }} unit
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-center {{ $med->stock < 10 ? 'text-red-600 font-bold' : '' }}">
                                    {{ $med->stock }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span>📅</span> Dokter Bertugas Hari Ini
                </h3>
                @if($doctorsOnDuty->count() > 0)
                    <div class="space-y-3">
                        @foreach($doctorsOnDuty as $schedule)
                            <div class="flex items-center p-3 bg-gray-50 rounded-xl border border-gray-200">
                                <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-600 font-bold mr-3 shrink-0">
                                    {{ substr($schedule->doctor->name, 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ $schedule->doctor->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $schedule->doctor->poli->name ?? 'Umum' }}</p>
                                </div>
                                <div class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-lg">
                                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500 italic bg-gray-50 rounded-lg">
                        Tidak ada jadwal dokter hari ini.
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">⚡ Aksi Cepat</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('admin.users.create') }}" class="flex flex-col items-center justify-center p-4 bg-teal-50 rounded-xl text-teal-700 hover:bg-teal-100 hover:scale-105 transition transform duration-200">
                    <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    <span class="text-sm font-semibold">+ User</span>
                </a>
                <a href="{{ route('admin.medicines.create') }}" class="flex flex-col items-center justify-center p-4 bg-green-50 rounded-xl text-green-700 hover:bg-green-100 hover:scale-105 transition transform duration-200">
                    <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <span class="text-sm font-semibold">+ Obat</span>
                </a>
                <a href="{{ route('admin.polis.create') }}" class="flex flex-col items-center justify-center p-4 bg-purple-50 rounded-xl text-purple-700 hover:bg-purple-100 hover:scale-105 transition transform duration-200">
                    <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="text-sm font-semibold">+ Poli</span>
                </a>
                <a href="{{ route('appointments.index') }}" class="flex flex-col items-center justify-center p-4 bg-orange-50 rounded-xl text-orange-700 hover:bg-orange-100 hover:scale-105 transition transform duration-200">
                    <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    <span class="text-sm font-semibold">Validasi Janji</span>
                </a>
            </div>
        </div>

    </div>
</x-app-layout>