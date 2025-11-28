<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Daftar Appointment Pasien</h2>
    </x-slot>

    <div class="p-6">

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Pasien</th>
                    <th class="border p-2">Dokter</th>
                    <th class="border p-2">Poli</th>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Jam</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $app)
                <tr>
                    <td class="border p-2">{{ $app->user->name }}</td>
                    <td class="border p-2">{{ $app->doctor->user->name }}</td>
                    <td class="border p-2">{{ $app->doctor->poli->name }}</td>
                    <td class="border p-2">{{ $app->tanggal }}</td>
                    <td class="border p-2">{{ $app->jam }}</td>
                    <td class="border p-2 capitalize">
                        <span class="
                            px-2 py-1 rounded text-white 
                            @if($app->status == 'pending') bg-yellow-500 
                            @elseif($app->status == 'approved') bg-green-600
                            @else bg-red-600 @endif
                        ">
                            {{ $app->status }}
                        </span>
                    </td>
                    <td class="border p-2">

                        @if($app->status == 'pending')
                            <form action="{{ route('appointments.approve', $app->id) }}"
                                  method="POST" class="inline-block">
                                @csrf
                                <button class="bg-green-600 text-white px-3 py-1 rounded">
                                    Approve
                                </button>
                            </form>

                            <form action="{{ route('appointments.reject', $app->id) }}"
                                  method="POST" class="inline-block">
                                @csrf
                                <button class="bg-red-600 text-white px-3 py-1 rounded ml-2">
                                    Reject
                                </button>
                            </form>
                        @else
                            <span class="text-gray-500">Selesai</span>
                        @endif

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>
