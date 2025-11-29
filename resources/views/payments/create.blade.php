<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Buat Tagihan Pembayaran</h2>
    </x-slot>

    <div class="p-6 max-w-xl">

        <h3>Pasien: <strong>{{ $record->user->name }}</strong></h3>
        <h3>Dokter: <strong>{{ $record->doctor->user->name }}</strong></h3>
        <hr>

        <form action="{{ route('payments.store') }}" method="POST">
            @csrf

            <input type="hidden" name="record_id" value="{{ $record->id }}">

            <label>Biaya Konsultasi</label>
            <input type="number" name="biaya_konsultasi" 
                   value="50000" class="form-control mb-3" required>

            <label>Biaya Tindakan</label>
            <input type="number" name="biaya_tindakan" 
                   value="0" class="form-control mb-3">

            <label>Biaya Obat</label>
            <input type="number" name="biaya_obat"
                   value="{{ $biaya_obat }}" class="form-control mb-3">

            <button class="btn btn-primary">Buat Tagihan</button>
        </form>

    </div>
</x-app-layout>
