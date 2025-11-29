<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Jadwal Dokter</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Dokter</label>
            <select name="doctor_id" class="form-control">
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}"
                        @if($doctor->id == $jadwal->doctor_id) selected @endif>
                        {{ $doctor->user->name }}
                    </option>
                @endforeach
            </select>

            <label>Hari</label>
            <select name="hari" class="form-control">
                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h)
                    <option @if($jadwal->hari == $h) selected @endif>{{ $h }}</option>
                @endforeach
            </select>

            <label>Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" value="{{ $jadwal->jam_mulai }}">

            <label>Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" value="{{ $jadwal->jam_selesai }}">

            <button class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
</x-app-layout>
