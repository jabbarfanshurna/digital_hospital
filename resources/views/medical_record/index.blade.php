<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Rekam Medis</h2>
    </x-slot>

    <div class="p-6">
        @if(session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered w-full">
            <thead>
                <tr>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Diagnosa</th>
                    <th>Tindakan</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $r)
                <tr>
                    <td>{{ $r->user->name }}</td>
                    <td>{{ $r->doctor->user->name }}</td>
                    <td>{{ $r->diagnosa }}</td>
                    <td>{{ $r->tindakan }}</td>
                    <td>{{ $r->catatan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
