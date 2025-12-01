<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Obat Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8">
                
                <form action="{{ route('admin.medicines.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <div class="space-y-6">
                            <div>
                                <x-input-label for="name" :value="__('Nama Obat')" />
                                <x-text-input id="name" class="block mt-1 w-full rounded-lg" type="text" name="name" required placeholder="Contoh: Paracetamol" />
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="type" :value="__('Tipe Obat')" />
                                    <select name="type" id="type" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                        <option value="biasa">Biasa</option>
                                        <option value="keras">Keras</option>
                                    </select>
                                </div>
                                <div>
                                    <x-input-label for="stock" :value="__('Stok Awal')" />
                                    <x-text-input id="stock" class="block mt-1 w-full rounded-lg" type="number" name="stock" required placeholder="0" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="expiry_date" :value="__('Tanggal Kadaluarsa')" />
                                <x-text-input id="expiry_date" class="block mt-1 w-full rounded-lg" type="date" name="expiry_date" required />
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <x-input-label for="description" :value="__('Deskripsi / Indikasi')" />
                                <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" placeholder="Keterangan kegunaan obat..."></textarea>
                            </div>

                            <div>
                                <x-input-label for="image" :value="__('Foto Obat')" />
                                <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-teal-700 hover:file:bg-teal-100 transition mt-1 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-gray-100">
                        <a href="{{ route('admin.medicines.index') }}" class="px-6 py-2.5 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Batal</a>
                        <button type="submit" class="px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 shadow-md transition transform hover:-translate-y-0.5">Simpan Data Obat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>