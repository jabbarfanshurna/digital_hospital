<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jadwal Praktik Saya</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between mb-4">
                <p class="text-gray-600">Durasi setiap sesi praktik adalah 30 menit.</p>
                <a href="{{ route('doctor.schedules.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Tambah Jadwal</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hari</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jam Mulai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jam Selesai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($schedules as $schedule)
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $schedule->day }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('doctor.schedules.destroy', $schedule->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm" onclick="return confirm('Hapus jadwal ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada jadwal yang diatur.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>