<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Daftar Appointment</h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('appointments.create') }}" class="btn btn-primary mb-3">
            + Buat Appointment
        </a>

        @if(session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered w-full">
            <thead>
                <tr>
                    <th>Dokter</th>
                    <th>Poli</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $a)
                <tr>
                    <td>{{ $a->doctor->user->name }}</td>
                    <td>{{ $a->doctor->poli->name }}</td>
                    <td>{{ $a->tanggal }}</td>
                    <td>{{ $a->jam }}</td>
                    <td>{{ ucfirst($a->status) }}</td>
                        <td class="flex gap-2">

                            @if(auth()->user()->role != 'patient')

                                @if($a->status == 'pending')
                                    <form action="{{ route('appointments.approve', $a->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success btn-sm">Approve</button>
                                    </form>

                                    <form action="{{ route('appointments.reject', $a->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                @endif

                            @endif

                            {{-- Tombol batal khusus pasien --}}
                            @if(auth()->user()->role == 'patient')
                            <form action="{{ route('appointments.destroy', $a->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-warning btn-sm">Batal</button>
                            </form>
                            @endif

                        </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
