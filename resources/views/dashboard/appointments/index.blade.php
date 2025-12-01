<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->role === 'user' ? 'Riwayat Janji Temu Saya' : 'Daftar Janji Temu Masuk' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            @if(Auth::user()->role === 'user')
                <div class="mb-4 flex justify-end">
                    <a href="{{ route('appointments.create') }}" class="bg-teal-600 text-white px-4 py-2 rounded-md text-sm hover:bg-teal-700">Buat Janji Baru</a>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                {{ Auth::user()->role === 'user' ? 'Dokter & Poli' : 'Pasien' }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keluhan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            @if(Auth::user()->role !== 'user')
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($appointments as $app)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($app->booking_date)->format('d M Y') }}</div>
                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($app->schedule->start_time)->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if(Auth::user()->role === 'user')
                                    <div class="text-sm font-medium text-gray-900">{{ $app->doctor->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $app->doctor->poli->name }}</div>
                                @else
                                    <div class="text-sm font-medium text-gray-900">{{ $app->patient->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $app->patient->email }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($app->complaint, 50) }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $colors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'approved' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                        'completed' => 'bg-blue-100 text-blue-800',
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs rounded-full font-semibold {{ $colors[$app->status] }}">
                                    {{ ucfirst($app->status) }}
                                </span>
                            </td>
                            
                            @if(Auth::user()->role !== 'user')
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if($app->status === 'pending')
                                    <div class="flex gap-2">
                                        <form action="{{ route('appointments.update', $app->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="text-green-600 hover:text-green-900">Approve</button>
                                        </form>
                                        <form action="{{ route('appointments.update', $app->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Reject appointment?')">Reject</button>
                                        </form>
                                    </div>
                                @elseif($app->status === 'approved' && Auth::user()->role === 'manager')
                                    <a href="{{ route('doctor.medical_records.create', ['appointment_id' => $app->id]) }}" class="inline-block bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                        Periksa Pasien
                                    </a>
                                @elseif($app->status === 'completed')
                                    <span class="text-gray-500 font-bold">Selesai</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data janji temu.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>