<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Pembayaran</h2>
    </x-slot>

    <div class="p-6">
        @if(session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered w-full">
            <thead>
                <tr>
                    <th>Pasien</th>
                    <th>Biaya Konsultasi</th>
                    <th>Biaya Tindakan</th>
                    <th>Biaya Obat</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($payments as $p)
                <tr>
                    <td>{{ $p->record->user->name }}</td>
                    <td>Rp{{ number_format($p->biaya_konsultasi) }}</td>
                    <td>Rp{{ number_format($p->biaya_tindakan) }}</td>
                    <td>Rp{{ number_format($p->biaya_obat) }}</td>
                    <td>Rp{{ number_format($p->total_biaya) }}</td>
                    <td>{{ ucfirst($p->status) }}</td>
                    <td>
                        @if(auth()->user()->role != 'patient' && $p->status == 'unpaid')
                        <form action="{{ route('payments.paid', $p->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success btn-sm">Tandai Lunas</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
