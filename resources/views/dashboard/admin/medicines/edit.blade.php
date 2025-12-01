<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Medicine</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8">
                <form action="{{ route('admin.medicines.update', $medicine->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="space-y-6">
                            <div>
                                <x-input-label for="name" :value="__('Medicine Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $medicine->name)" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="type" :value="__('Type')" />
                                <select name="type" id="type" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                    <option value="biasa" {{ old('type', $medicine->type) == 'biasa' ? 'selected' : '' }}>Biasa</option>
                                    <option value="keras" {{ old('type', $medicine->type) == 'keras' ? 'selected' : '' }}>Keras</option>
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="stock" :value="__('Stock')" />
                                <x-text-input id="stock" class="block mt-1 w-full" type="number" name="stock" :value="old('stock', $medicine->stock)" required />
                                <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="expiry_date" :value="__('Expiry Date')" />
                                <x-text-input id="expiry_date" class="block mt-1 w-full" type="date" name="expiry_date" :value="old('expiry_date', optional($medicine->expiry_date)->format('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('expiry_date')" class="mt-2" />
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">{{ old('description', $medicine->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            @if($medicine->image)
                                <div>
                                    <span class="block text-sm font-medium text-gray-700 mb-2">Current Image</span>
                                    <img src="{{ asset('storage/' . $medicine->image) }}" alt="Current Image" class="w-32 h-32 object-cover rounded-lg border border-gray-200">
                                </div>
                            @endif

                            <div>
                                <x-input-label for="image" :value="__('Update Image (Optional)')" />
                                <input type="file" name="image" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 transition">
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 mt-8">
                        <x-primary-button class="bg-teal-600 hover:bg-teal-700">Update Medicine</x-primary-button>
                        <a href="{{ route('admin.medicines.index') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>