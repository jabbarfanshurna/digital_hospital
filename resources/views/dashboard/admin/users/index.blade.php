<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('User Management') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Kelola data dokter, pasien, dan administrator.</p>
            </div>
            
            {{-- Tombol Tambah User (Satu-satunya) --}}
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-5 py-2.5 bg-teal-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 active:bg-teal-900 focus:outline-none focus:border-teal-900 focus:ring ring-teal-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Create New User
            </a>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r shadow-sm flex justify-between items-center">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <p class="text-green-700 font-medium">{{ session('success') }}</p>
                    </div>
                    <button @click="show = false" class="text-green-500 hover:text-green-700"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                </div>
            @endif

            {{-- Card Utama --}}
            <div class="bg-white overflow-hidden shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] sm:rounded-2xl border border-gray-100">
                
                {{-- Toolbar: Filter & Search --}}
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col sm:flex-row gap-4">
                        
                        <div class="relative min-w-[150px]">
                            <select name="role" class="block w-full pl-3 pr-10 py-2 text-sm border-gray-300 focus:outline-none focus:ring-teal-500 focus:border-teal-500 rounded-lg shadow-sm" onchange="this.form.submit()">
                                <option value="">Semua Role</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="manager" {{ request('role') == 'manager' ? 'selected' : '' }}>Dokter</option>
                                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Pasien</option>
                            </select>
                        </div>

                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-20 py-2 border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-teal-500 focus:border-teal-500 sm:text-sm shadow-sm" placeholder="Cari nama user atau email...">
                            <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                                <button type="submit" class="inline-flex items-center border border-gray-200 rounded px-2 text-sm font-sans font-medium text-gray-400 hover:text-gray-500">
                                    Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Tabel Modern --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">User Info</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Role</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Poli (Dokter)</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Terdaftar</th>
                                <th scope="col" class="relative px-6 py-4">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($users as $user)
                            <tr class="hover:bg-gray-50/80 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        {{-- Avatar Inisial Modern --}}
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-teal-600 to-green-600 flex items-center justify-center text-gray font-bold shadow-sm">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{-- Badge Role Berwarna --}}
                                    @php
                                        $badges = [
                                            'admin' => 'bg-red-100 text-red-700 ring-red-600/20',
                                            'manager' => 'bg-blue-100 text-blue-700 ring-blue-700/10', // Dokter
                                            'user' => 'bg-green-100 text-green-700 ring-green-600/20', // Pasien
                                        ];
                                        $roleName = $user->role == 'manager' ? 'Dokter' : ($user->role == 'user' ? 'Pasien' : 'Admin');
                                    @endphp
                                    <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $badges[$user->role] ?? 'bg-gray-100 text-gray-600' }}">
                                        {{ $roleName }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->role === 'manager' && $user->poli)
                                        <div class="flex items-center text-sm text-gray-700">
                                            <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                            {{ $user->poli->name }}
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-teal-600 hover:text-teal-900 font-semibold transition">Edit</a>
                                        
                                        @if(Auth::id() !== $user->id)
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 font-semibold transition" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="mx-auto h-12 w-12 text-gray-300">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    </div>
                                    <h3 class="mt-2 text-sm font-semibold text-gray-900">User tidak ditemukan</h3>
                                    <p class="mt-1 text-sm text-gray-500">Coba ubah filter atau kata kunci pencarian Anda.</p>
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