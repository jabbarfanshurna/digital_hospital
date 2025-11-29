<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8">
                
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    {{-- AlpineJS Data untuk Logika Role --}}
                    <div x-data="{ role: '{{ old('role', $user->role) }}' }" class="space-y-6 max-w-xl">
                        
                        <div>
                            <x-input-label for="role" :value="__('Role')" />
                            <select id="role" name="role" x-model="role" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="user">Pasien (User)</option>
                                <option value="manager">Dokter (Manager)</option>
                                <option value="admin">Admin</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <div x-show="role === 'manager'" style="display: none;" x-transition>
                            <x-input-label for="poli_id" :value="__('Assign to Poli')" />
                            <select id="poli_id" name="poli_id" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">-- Select Poli --</option>
                                @foreach($polis as $poli)
                                    <option value="{{ $poli->id }}" {{ (old('poli_id', $user->poli_id) == $poli->id) ? 'selected' : '' }}>
                                        {{ $poli->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('poli_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <hr class="border-gray-200 my-4">
                        <p class="text-sm text-gray-500 mb-4">Kosongkan password jika tidak ingin menggantinya.</p>

                        <div>
                            <x-input-label for="password" :value="__('New Password (Optional)')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm New Password')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" />
                        </div>

                    </div>

                    <div class="flex items-center gap-4 mt-8">
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">Update User</x-primary-button>
                        <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>