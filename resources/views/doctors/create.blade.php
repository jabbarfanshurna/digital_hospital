<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Tambah Dokter</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('doctors.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>User Dokter (harus punya role = doctor)</label>
                <select name="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Pilih Poli</label>
                <select name="poli_id" class="form-control" required>
                    @foreach($polis as $poli)
                        <option value="{{ $poli->id }}">{{ $poli->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Spesialisasi</label>
                <input type="text" name="specialization" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>No Izin Praktek</label>
                <input type="text" name="license_number" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Bio (optional)</label>
                <textarea name="bio" class="form-control"></textarea>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</x-app-layout>
