<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Jadwal Praktik</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 max-w-md mx-auto">
                
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('doctor.schedules.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <x-input-label for="day" :value="__('Hari')" />
                        <select name="day" id="day" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="start_time" :value="__('Jam Mulai')" />
                        <input type="time" name="start_time" id="start_time" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                        <p class="text-xs text-gray-500 mt-1">Durasi otomatis diset 30 menit.</p>
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>Simpan Jadwal</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>