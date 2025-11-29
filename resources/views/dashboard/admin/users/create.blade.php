<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New User</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    
                    <div x-data="{ role: 'user' }" class="space-y-4">
                        
                        <div>
                            <x-input-label for="role" :value="__('Role')" />
                            <select id="role" name="role" x-model="role" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="user">Pasien (User)</option>
                                <option value="manager">Dokter (Manager)</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div x-show="role === 'manager'" style="display: none;">
                            <x-input-label for="poli_id" :value="__('Assign to Poli')" />
                            <select id="poli_id" name="poli_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Select Poli --</option>
                                @foreach($polis as $poli)
                                    <option value="{{ $poli->id }}">{{ $poli->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                        </div>

                    </div>

                    <div class="flex justify-end mt-4">
                        <x-primary-button>Create User</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>