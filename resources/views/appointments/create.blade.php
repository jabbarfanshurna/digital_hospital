<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Buat Appointment</h2>
    </x-slot>

    <div class="p-6 w-full max-w-lg">
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf

            <label class="block mb-2">Pilih Dokter</label>
            <select name="doctor_id" class="form-control mb-4">
                @foreach($doctors as $d)
                    <option value="{{ $d->id }}">
                        {{ $d->user->name }} - ({{ $d->poli->name }})
                    </option>
                @endforeach
            </select>

            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control mb-4" required>

            <label>Jam Konsultasi</label>
            <input type="time" name="jam" class="form-control mb-4" required>

            <label>Keluhan (opsional)</label>
            <textarea name="keluhan" class="form-control mb-4"></textarea>

            <button class="btn btn-primary">Buat Appointment</button>
        </form>
    </div>
</x-app-layout>
