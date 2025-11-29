<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Tambah Jadwal Dokter</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('jadwal.store') }}" method="POST">
            @csrf

            <label>Dokter</label>
            <select name="doctor_id" required class="form-control">
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
                @endforeach
            </select>

            <label>Hari</label>
            <select name="hari" class="form-control">
                <option>Senin</option>
                <option>Selasa</option>
                <option>Rabu</option>
                <option>Kamis</option>
                <option>Jumat</option>
                <option>Sabtu</option>
                <option>Minggu</option>
            </select>

            <label>Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control">

            <label>Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control">

            <button class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
</x-app-layout>
