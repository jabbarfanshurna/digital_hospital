<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Buat Resep Obat</h2>
    </x-slot>

    <div class="p-6 max-w-xl">
        
        <h3>Pasien: <strong>{{ $record->user->name }}</strong></h3>
        <h3>Dokter: <strong>{{ $record->doctor->user->name }}</strong></h3>
        <hr class="my-3">

        <form action="{{ route('prescriptions.store') }}" method="POST">
            @csrf

            <input type="hidden" name="medical_record_id" value="{{ $record->id }}">

            <label>Nama Obat</label>
            <input type="text" name="obat" class="form-control mb-4" required>

            <label>Dosis</label>
            <input type="text" name="dosis" class="form-control mb-4" placeholder="Contoh: 500 mg" required>

            <label>Frekuensi Minum</label>
            <input type="text" name="frekuensi" class="form-control mb-4" placeholder="3x sehari" required>

            <label>Durasi</label>
            <input type="text" name="durasi" class="form-control mb-4" placeholder="5 hari">

            <button class="btn btn-primary">Simpan Resep</button>
        </form>
    </div>
</x-app-layout>
