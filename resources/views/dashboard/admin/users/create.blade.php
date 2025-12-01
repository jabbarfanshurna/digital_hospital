<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New User</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8">
                
                <h3 class="text-lg font-bold text-gray-900 mb-6 border-b pb-4">Formulir Pengguna Baru</h3>

                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    
                    <div x-data="{ role: 'user' }" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="col-span-2">
                            <x-input-label for="role" :value="__('Role Pengguna')" />
                            <select id="role" name="role" x-model="role" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                <option value="user">Pasien (User)</option>
                                <option value="manager">Dokter (Manager)</option>
                                <option value="admin">Admin</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Pilih peran pengguna dalam sistem.</p>
                        </div>

                        <div class="col-span-2 bg-teal-50 p-4 rounded-lg border border-teal-100" x-show="role === 'manager'" style="display: none;" x-transition>
                            <x-input-label for="poli_id" :value="__('Tugaskan ke Poli')" class="text-teal-700" />
                            <select id="poli_id" name="poli_id" class="block mt-1 w-full border-teal-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                <option value="">-- Pilih Poli --</option>
                                @foreach($polis as $poli)
                                    <option value="{{ $poli->id }}">{{ $poli->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-xs text-teal-500 mt-1">*Wajib dipilih untuk Dokter.</p>
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Nama Lengkap')" />
                            <x-text-input id="name" class="block mt-1 w-full rounded-lg" type="text" name="name" required placeholder="Contoh: Budi Santoso" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Alamat Email')" />
                            <x-text-input id="email" class="block mt-1 w-full rounded-lg" type="email" name="email" required placeholder="email@contoh.com" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Kata Sandi')" />
                            <x-text-input id="password" class="block mt-1 w-full rounded-lg" type="password" name="password" required />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-lg" type="password" name="password_confirmation" required />
                        </div>

                    </div>

                    <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-gray-100">
                        <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Batal</a>
                        <button type="submit" class="px-6 py-2.5 bg-teal-600 text-white rounded-lg hover:bg-teal-700 shadow-md transition transform hover:-translate-y-0.5">Simpan User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>