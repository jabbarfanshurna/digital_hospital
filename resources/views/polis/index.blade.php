<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Daftar Poli</h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('polis.create') }}" class="btn btn-primary mb-3">+ Tambah Poli</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered w-full">
            <thead>
                <tr>
                    <th>Nama Poli</th>
                    <th>Deskripsi</th>
                    <th>Icon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($polis as $poli)
                    <tr>
                        <td>{{ $poli->name }}</td>
                        <td>{{ $poli->description }}</td>
                        <td>{{ $poli->icon }}</td>
                        <td class="flex gap-2">
                            <a href="{{ route('polis.edit', $poli->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('polis.destroy', $poli->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
