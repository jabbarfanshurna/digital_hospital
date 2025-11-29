<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Buat Janji Temu Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ $errors->first() }}</span>
                    </div>
                @endif

                <form method="GET" action="{{ route('appointments.create') }}" class="mb-6">
                    <div>
                        <x-input-label for="poli_id" :value="__('Pilih Poli Terlebih Dahulu')" />
                        <select name="poli_id" id="poli_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" onchange="this.form.submit()">
                            <option value="">-- Pilih Poli --</option>
                            @foreach($polis as $poli)
                                <option value="{{ $poli->id }}" {{ request('poli_id') == $poli->id ? 'selected' : '' }}>
                                    {{ $poli->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>

                @if(request('poli_id') && count($doctors) > 0)
                <form action="{{ route('appointments.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <x-input-label for="doctor_id" :value="__('Pilih Dokter')" />
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                            @foreach($doctors as $doctor)
                                <label class="border p-4 rounded-lg cursor-pointer hover:bg-gray-50 flex items-start">
                                    <input type="radio" name="doctor_id" value="{{ $doctor->id }}" class="mt-1 mr-3 text-indigo-600" required>
                                    <div>
                                        <div class="font-bold text-gray-900">{{ $doctor->name }}</div>
                                        <div class="text-sm text-gray-500 mt-1">Jadwal Praktik:</div>
                                        <ul class="text-xs text-gray-600 list-disc ml-4">
                                            @foreach($doctor->schedules as $schedule)
                                                <li>
                                                    {{ $schedule->day }} 
                                                    ({{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - 
                                                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }})
                                                    <span class="text-gray-400 hidden">ID:{{ $schedule->id }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="schedule_id" :value="__('Pilih Slot Waktu')" />
                        <select name="schedule_id" id="schedule_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">-- Pilih Jadwal --</option>
                            @foreach($doctors as $doctor)
                                @foreach($doctor->schedules as $schedule)
                                    <option value="{{ $schedule->id }}">
                                        {{ $doctor->name }} - {{ $schedule->day }} ({{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }})
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">*Pastikan memilih jadwal milik dokter yang Anda centang di atas.</p>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="booking_date" :value="__('Tanggal Janji Temu')" />
                        <x-text-input id="booking_date" class="block mt-1 w-full" type="date" name="booking_date" required />
                        <p class="text-xs text-red-500 mt-1">*Penting: Pilih tanggal yang harinya SAMA dengan jadwal dokter (Contoh: Jadwal Senin, pilih tanggal yang jatuh hari Senin).</p>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="complaint" :value="__('Keluhan Singkat')" />
                        <textarea id="complaint" name="complaint" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" rows="3" required></textarea>
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>Kirim Permintaan Janji Temu</x-primary-button>
                    </div>
                </form>
                @elseif(request('poli_id'))
                    <div class="text-center py-10 text-gray-500">
                        <p>Tidak ada dokter yang tersedia di Poli ini.</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>