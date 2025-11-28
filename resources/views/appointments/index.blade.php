<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Daftar Appointment Saya</h2>
    </x-slot>

    <div class="p-6">

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-3 rounded mb-3">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-200 text-red-800 p-3 rounded mb-3">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('appointments.create') }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded mb-4 inline-block">
           + Buat Appointment Baru
        </a>

        <table class="table-auto w-full mt-4 border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Dokter</th>
                    <th class="p-2 border">Poli</th>
                    <th class="p-2 border">Tanggal</th>
                    <th class="p-2 border">Jam</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($appointments as $app)
                <tr class="border">
                    <td class="p-2 border">{{ $app->doctor->user->name }}</td>
                    <td class="p-2 border">{{ $app->poli->name }}</td>
                    <td class="p-2 border">{{ $app->tanggal }}</td>
                    <td class="p-2 border">{{ $app->jam }}</td>

                    <td class="p-2 border">
                        @if($app->status == 'pending')
                            <span class="text-yellow-600 font-semibold">Pending</span>
                        @elseif($app->status == 'approved')
                            <span class="text-green-600 font-semibold">Approved</span>
                        @else
                            <span class="text-red-600 font-semibold">Rejected</span>
                        @endif
                    </td>

                    <td class="p-2 border">
                        @if($app->status == 'pending')
                            <form action="{{ route('appointments.destroy', $app->id) }}" 
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Batalkan appointment?')"
                                        class="px-3 py-1 bg-red-600 text-white rounded">
                                        Batalkan
                                </button>
                            </form>
                        @else
                            <span class="text-gray-500">Tidak ada aksi</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</x-app-layout>
