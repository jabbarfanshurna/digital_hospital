<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Daftar Dokter</h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('doctors.create') }}" class="btn btn-primary mb-3">+ Tambah Dokter</a>

        @if(session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered w-full">
            <thead>
                <tr>
                    <th>Nama User</th>
                    <th>Poli</th>
                    <th>Spesialis</th>
                    <th>No. Izin Praktek</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctors as $doctor)
                    <tr>
                        <td>{{ $doctor->user->name }}</td>
                        <td>{{ $doctor->poli->name }}</td>
                        <td>{{ $doctor->specialization }}</td>
                        <td>{{ $doctor->license_number }}</td>
                        <td class="flex gap-2">
                            <a href="{{ route('doctors.edit', $doctor->id) }}" 
                               class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('doctors.destroy', $doctor->id) }}" 
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus dokter ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
