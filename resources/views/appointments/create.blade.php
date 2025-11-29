<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Buat Appointment Baru</h2>
    </x-slot>

    <div class="p-6 max-w-xl">

        {{-- Pesan Error --}}
        @if ($errors->any())
            <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
                <ul class="list-disc ml-6">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf

            {{-- PILIH DOKTER --}}
            <label class="block mb-2 font-semibold">Pilih Dokter</label>
            <select name="doctor_id" class="w-full p-2 border rounded mb-4" required>
                <option value="">-- pilih dokter --</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">
                        {{ $doctor->user->name }} ({{ $doctor->poli->name }})
                    </option>
                @endforeach
            </select>

            {{-- TANGGAL --}}
            <label class="block mb-2 font-semibold">Tanggal Konsultasi</label>
            <input type="date" name="tanggal" class="w-full p-2 border rounded mb-4" required>

            {{-- JAM --}}
            <label class="block mb-2 font-semibold">Jam Konsultasi</label>
            <input type="time" name="jam" class="w-full p-2 border rounded mb-4" required>

            {{-- KELUHAN --}}
            <label class="block mb-2 font-semibold">Keluhan (opsional)</label>
            <textarea name="keluhan" rows="3" class="w-full p-2 border rounded mb-4"></textarea>

            {{-- SUBMIT --}}
            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Buat Appointment
            </button>
        </form>

    </div>
</x-app-layout>
