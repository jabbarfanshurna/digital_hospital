<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Isi Rekam Medis</h2>
    </x-slot>

    <div class="p-6 max-w-xl">
        <h3>Pasien: <strong>{{ $appointment->user->name }}</strong></h3>
        <h3>Dokter: <strong>{{ $appointment->doctor->user->name }}</strong></h3>
        <hr class="my-3">

        <form action="{{ route('medical_records.store') }}" method="POST">
            @csrf

            <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

            <label>Diagnosa</label>
            <textarea name="diagnosa" class="form-control mb-4" required></textarea>

            <label>Tindakan</label>
            <textarea name="tindakan" class="form-control mb-4"></textarea>

            <label>Catatan</label>
            <textarea name="catatan" class="form-control mb-4"></textarea>

            <button class="btn btn-primary">Simpan Rekam Medis</button>
        </form>
    </div>
</x-app-layout>
