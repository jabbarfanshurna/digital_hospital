<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pemeriksaan Pasien</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-6 border-b pb-4">
                    <h3 class="text-lg font-bold text-gray-900">Data Pasien</h3>
                    <div class="grid grid-cols-2 gap-4 mt-2 text-sm">
                        <div><span class="text-gray-500">Nama:</span> {{ $appointment->patient->name }}</div>
                        <div><span class="text-gray-500">Email:</span> {{ $appointment->patient->email }}</div>
                        <div><span class="text-gray-500">Keluhan Awal:</span> {{ $appointment->complaint }}</div>
                        <div><span class="text-gray-500">Tanggal Booking:</span> {{ \Carbon\Carbon::parse($appointment->booking_date)->format('d M Y') }}</div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('doctor.medical_records.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

                    <div class="grid grid-cols-1 gap-6 mb-6">
                        <div>
                            <x-input-label for="diagnosis" :value="__('Diagnosis Dokter')" />
                            <textarea id="diagnosis" name="diagnosis" rows="2" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                        </div>
                        <div>
                            <x-input-label for="treatment" :value="__('Tindakan Medis')" />
                            <textarea id="treatment" name="treatment" rows="2" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                        </div>
                        <div>
                            <x-input-label for="notes" :value="__('Catatan Tambahan (Opsional)')" />
                            <textarea id="notes" name="notes" rows="2" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>
                    </div>

                    <div class="mb-6" x-data="{ 
                        medicines: [], 
                        addMedicine() { 
                            this.medicines.push({ id: '', qty: 1, instructions: '' }); 
                        },
                        removeMedicine(index) {
                            this.medicines.splice(index, 1);
                        }
                    }">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-lg font-bold text-gray-900">Resep Obat</h3>
                            <button type="button" @click="addMedicine()" class="px-3 py-1 bg-green-600 text-white rounded text-sm hover:bg-green-700">+ Tambah Obat</button>
                        </div>

                        <template x-if="medicines.length === 0">
                            <p class="text-sm text-gray-500 italic mb-4">Belum ada obat yang ditambahkan. Klik tombol di atas jika perlu resep.</p>
                        </template>

                        <div class="space-y-3">
                            <template x-for="(med, index) in medicines" :key="index">
                                <div class="flex gap-2 items-start border p-3 rounded bg-gray-50">
                                    <div class="flex-1">
                                        <label class="text-xs text-gray-600">Nama Obat</label>
                                        <select :name="'medicines[' + index + ']'" class="block w-full border-gray-300 rounded-md text-sm" required>
                                            <option value="">-- Pilih Obat --</option>
                                            @foreach($medicines as $m)
                                                <option value="{{ $m->id }}">{{ $m->name }} (Stok: {{ $m->stock }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-24">
                                        <label class="text-xs text-gray-600">Jumlah</label>
                                        <input type="number" :name="'quantities[' + index + ']'" value="1" min="1" class="block w-full border-gray-300 rounded-md text-sm" required>
                                    </div>
                                    <div class="flex-1">
                                        <label class="text-xs text-gray-600">Aturan Pakai</label>
                                        <input type="text" :name="'instructions[' + index + ']'" placeholder="Contoh: 3x1 sesudah makan" class="block w-full border-gray-300 rounded-md text-sm">
                                    </div>
                                    <div class="mt-5">
                                        <button type="button" @click="removeMedicine(index)" class="text-red-600 hover:text-red-800 font-bold">X</button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t">
                        <x-primary-button class="bg-teal-600 hover:bg-teal-700">
                            {{ __('Simpan & Selesaikan Pemeriksaan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>