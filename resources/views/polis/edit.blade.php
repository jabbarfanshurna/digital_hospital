<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Poli</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('polis.update', $poli->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Poli</label>
                <input type="text" name="name" value="{{ $poli->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control">{{ $poli->description }}</textarea>
            </div>

            <div class="mb-3">
                <label>Icon</label>
                <input type="text" name="icon" value="{{ $poli->icon }}" class="form-control">
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('polis.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</x-app-layout>
