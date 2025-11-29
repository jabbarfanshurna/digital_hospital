<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Dokter</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>User Dokter</label>
                <select name="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}"
                            @if($doctor->user_id == $user->id) selected @endif>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Pilih Poli</label>
                <select name="poli_id" class="form-control" required>
                    @foreach($polis as $poli)
                        <option value="{{ $poli->id }}"
                            @if($doctor->poli_id == $poli->id) selected @endif>
                            {{ $poli->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Spesialisasi</label>
                <input type="text" name="specialization"
                       value="{{ $doctor->specialization }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>No Izin Praktek</label>
                <input type="text" name="license_number"
                       value="{{ $doctor->license_number }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Bio</label>
                <textarea name="bio" class="form-control">{{ $doctor->bio }}</textarea>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</x-app-layout>
