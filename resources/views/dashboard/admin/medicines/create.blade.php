<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Medicine</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.medicines.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Medicine Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required />
                    </div>
                    
                    <div class="mb-4">
                        <x-input-label for="type" :value="__('Type')" />
                        <select name="type" id="type" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="biasa">Biasa</option>
                            <option value="keras">Keras</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="stock" :value="__('Stock')" />
                        <x-text-input id="stock" class="block mt-1 w-full" type="number" name="stock" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="image" :value="__('Image')" />
                        <input type="file" name="image" class="block mt-1 w-full border border-gray-300 rounded-md p-2">
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>Save</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>