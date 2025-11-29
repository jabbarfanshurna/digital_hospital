<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Rekam Medis</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <div class="text-center mb-8 border-b pb-4">
                    <h1 class="text-2xl font-bold text-indigo-700">Digital Hospital</h1>
                    <p class="text-gray-500">Laporan Pemeriksaan Medis</p>
                    <p class="text-sm text-gray-400">Tanggal: {{ $medicalRecord->created_at->format('d F Y') }}</p>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <h4 class="text-xs font-bold text-gray-400 uppercase">Pasien</h4>
                        <p class="text-lg font-medium">{{ $medicalRecord->patient->name }}</p>
                        <p class="text-sm text-gray-500">{{ $medicalRecord->patient->email }}</p>
                    </div>
                    <div class="text-right">
                        <h4 class="text-xs font-bold text-gray-400 uppercase">Dokter Pemeriksa</h4>
                        <p class="text-lg font-medium">{{ $medicalRecord->doctor->name }}</p>
                        <p class="text-sm text-gray-500">{{ $medicalRecord->doctor->poli->name ?? 'Dokter Umum' }}</p>
                    </div>
                </div>

                <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-bold text-gray-800 mb-2">Hasil Pemeriksaan</h3>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <span class="font-semibold text-sm text-gray-600">Diagnosis:</span>
                            <p>{{ $medicalRecord->diagnosis }}</p>
                        </div>
                        <div>
                            <span class="font-semibold text-sm text-gray-600">Tindakan:</span>
                            <p>{{ $medicalRecord->treatment }}</p>
                        </div>
                        @if($medicalRecord->notes)
                        <div>
                            <span class="font-semibold text-sm text-gray-600">Catatan:</span>
                            <p class="italic">{{ $medicalRecord->notes }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="font-bold text-gray-800 mb-2">Resep Obat</h3>
                    <table class="min-w-full divide-y divide-gray-200 border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Obat</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aturan Pakai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medicalRecord->medicines as $med)
                            <tr>
                                <td class="px-4 py-2">{{ $med->name }}</td>
                                <td class="px-4 py-2">{{ $med->pivot->quantity }}</td>
                                <td class="px-4 py-2 text-gray-600 italic">{{ $med->pivot->instructions }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 flex justify-between">
                    <a href="{{ route('medical_records.index') }}" class="text-gray-600 hover:text-gray-900 underline">Kembali</a>
                    <button onclick="window.print()" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">Cetak Laporan</button>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>