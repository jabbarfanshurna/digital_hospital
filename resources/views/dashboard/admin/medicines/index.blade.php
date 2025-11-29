<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Medicine Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Toolbar: Judul, Filter, Pencarian, Tombol Tambah --}}
            <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
                
                <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto items-center">
                    <h3 class="text-lg font-medium text-gray-900 self-center hidden md:block">List of Medicines</h3>
                    
                    {{-- Form Filter & Search (Satu form agar query string bergabung) --}}
                    <form method="GET" action="{{ route('admin.medicines.index') }}" class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
                        
                        {{-- Filter Status Stok --}}
                        <select name="status" class="border-gray-300 rounded-md text-sm focus:ring-indigo-500 focus:border-indigo-500" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                            <option value="out_of_stock" {{ request('status') == 'out_of_stock' ? 'selected' : '' }}>Stok Habis</option>
                        </select>

                        {{-- Input Pencarian --}}
                        <div class="flex gap-2">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari obat..." class="border-gray-300 rounded-md text-sm w-full md:w-48 focus:ring-indigo-500 focus:border-indigo-500">
                            <button type="submit" class="bg-gray-800 text-white px-3 py-2 rounded-md text-sm hover:bg-gray-700 transition">Cari</button>
                        </div>
                    </form>
                </div>
                
                {{-- Tombol Tambah Obat --}}
                <a href="{{ route('admin.medicines.create') }}" class="w-full md:w-auto text-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition shadow-sm">
                    + Add New Medicine
                </a>
            </div>

            {{-- Tabel Data --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($medicines as $medicine)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($medicine->image)
                                        <img src="{{ asset('storage/' . $medicine->image) }}" alt="{{ $medicine->name }}" class="h-10 w-10 rounded object-cover border border-gray-200">
                                    @else
                                        <div class="h-10 w-10 rounded bg-gray-100 flex items-center justify-center text-xs text-gray-400">No Img</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $medicine->name }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $medicine->type === 'keras' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($medicine->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm {{ $medicine->stock == 0 ? 'text-red-600 font-bold' : 'text-gray-700' }}">
                                    {{ $medicine->stock }} {{ $medicine->stock == 0 ? '(Habis)' : '' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.medicines.edit', $medicine->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                    <form action="{{ route('admin.medicines.destroy', $medicine->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this medicine?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    Data obat tidak ditemukan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>