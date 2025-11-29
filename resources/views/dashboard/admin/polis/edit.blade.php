<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Poli</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8">
                <form action="{{ route('admin.polis.update', $poli->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6 max-w-xl">
                        <div>
                            <x-input-label for="name" :value="__('Poli Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $poli->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $poli->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        @if($poli->image)
                            <div>
                                <span class="block text-sm font-medium text-gray-700 mb-2">Current Image</span>
                                <img src="{{ asset('storage/' . $poli->image) }}" alt="Current Image" class="w-32 h-32 object-cover rounded-lg border border-gray-200">
                            </div>
                        @endif

                        <div>
                            <x-input-label for="image" :value="__('Update Icon/Image (Optional)')" />
                            <input type="file" name="image" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center gap-4 mt-8">
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">Update Poli</x-primary-button>
                        <a href="{{ route('admin.polis.index') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>