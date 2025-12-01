<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-600">Jaga kesehatan Anda dan keluarga bersama Digital Hospital.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-semibold text-gray-800">Janji Temu Terakhir</h4>
                        <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">Status</span>
                    </div>
                    
                    <div class="text-center py-8 text-gray-500 border-2 border-dashed border-gray-200 rounded-lg">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p>Belum ada riwayat janji temu.</p>
                        <button class="mt-4 px-4 py-2 bg-teal-600 text-white rounded-md text-sm hover:bg-teal-700 disabled:opacity-50 cursor-not-allowed" disabled>Buat Janji Temu (Segera)</button>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Informasi Penting</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-2 h-2 mt-2 bg-green-500 rounded-full"></span>
                            <p class="ml-3 text-sm text-gray-600">Sistem pendaftaran online kini tersedia 24 jam.</p>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-2 h-2 mt-2 bg-blue-500 rounded-full"></span>
                            <p class="ml-3 text-sm text-gray-600">Pastikan data profil Anda selalu diperbarui untuk kemudahan layanan.</p>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>