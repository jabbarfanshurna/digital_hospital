<x-app-layout>
    <div class="sr-only">
        <h2>{{ __('Dashboard User') }}</h2>
    </div>

    <div class="max-w-7xl mx-auto">
        
        <div class="mb-8 bg-gradient-to-r from-teal-500 to-emerald-600 rounded-2xl p-8 text-white shadow-lg relative overflow-hidden">
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Halo, {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-teal-800 text-lg opacity-90">Kesehatan Anda adalah prioritas kami. Apa yang ingin Anda lakukan hari ini?</p>
                </div>
                <a href="{{ route('appointments.create') }}" class="bg-white text-teal-700 px-6 py-3 rounded-xl font-bold shadow-md hover:bg-teal-50 transition transform hover:-translate-y-1">
                    + Buat Janji Baru
                </a>
            </div>
            <div class="absolute -top-12 -right-12 w-48 h-48 bg-white opacity-10 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-12 -left-12 w-32 h-32 bg-white opacity-10 rounded-full blur-xl"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-white rounded-2xl p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100">
                    <div class="flex items-center justify-between mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <span class="w-2 h-8 bg-teal-500 rounded-full"></span>
                            Status Janji Temu Terakhir
                        </h3>
                        <a href="{{ route('appointments.index') }}" class="text-sm text-teal-600 hover:text-teal-800 font-medium">Lihat Semua Riwayat &rarr;</a>
                    </div>

                    @if($lastAppointment)
                        <div class="flex flex-col md:flex-row gap-6 items-start md:items-center">
                            <div class="flex-shrink-0 flex flex-col items-center justify-center bg-teal-50 text-teal-700 w-20 h-20 rounded-2xl border border-teal-100">
                                <span class="text-xs font-bold uppercase">{{ \Carbon\Carbon::parse($lastAppointment->booking_date)->format('M') }}</span>
                                <span class="text-2xl font-extrabold">{{ \Carbon\Carbon::parse($lastAppointment->booking_date)->format('d') }}</span>
                                <span class="text-xs">{{ \Carbon\Carbon::parse($lastAppointment->booking_date)->format('Y') }}</span>
                            </div>

                            <div class="flex-1">
                                <h4 class="text-lg font-bold text-gray-900">{{ $lastAppointment->doctor->name }}</h4>
                                <p class="text-sm text-gray-500 mb-2">{{ $lastAppointment->doctor->poli->name ?? 'Poli Umum' }}</p>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ \Carbon\Carbon::parse($lastAppointment->schedule->start_time)->format('H:i') }} WIB
                                </div>
                            </div>

                            <div>
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                        'approved' => 'bg-blue-100 text-blue-700 border-blue-200',
                                        'rejected' => 'bg-red-100 text-red-700 border-red-200',
                                        'completed' => 'bg-green-100 text-green-700 border-green-200',
                                    ];
                                    $statusLabel = [
                                        'pending' => 'Menunggu Konfirmasi',
                                        'approved' => 'Disetujui',
                                        'rejected' => 'Ditolak',
                                        'completed' => 'Selesai',
                                    ];
                                @endphp
                                <span class="px-4 py-2 rounded-full text-sm font-bold border {{ $statusClasses[$lastAppointment->status] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ $statusLabel[$lastAppointment->status] ?? ucfirst($lastAppointment->status) }}
                                </span>
                            </div>
                        </div>

                        @if($lastAppointment->status == 'rejected' && $lastAppointment->admin_note)
                            <div class="mt-4 bg-red-50 p-3 rounded-lg text-sm text-red-600 border border-red-100">
                                <strong>Catatan Admin:</strong> {{ $lastAppointment->admin_note }}
                            </div>
                        @endif

                    @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <p class="text-gray-500 mb-4">Anda belum memiliki riwayat janji temu.</p>
                            <a href="{{ route('appointments.create') }}" class="text-teal-600 font-semibold hover:underline">Buat janji pertama Anda sekarang</a>
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        Berikan Ulasan Layanan
                    </h3>
                    
                    @if(session('success'))
                        <div class="mb-4 bg-green-50 text-green-700 px-4 py-2 rounded-lg text-sm border border-green-200">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('feedback.store') }}" method="POST" x-data="{ currentRating: 0, hoverRating: 0 }">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-2">Berapa bintang untuk pelayanan kami?</label>
                            
                            <input type="hidden" name="rating" :value="currentRating">
                            
                            <div class="flex items-center gap-1">
                                <template x-for="star in 5">
                                    <button type="button" 
                                            @click="currentRating = star"
                                            @mouseenter="hoverRating = star"
                                            @mouseleave="hoverRating = 0"
                                            class="focus:outline-none transition transform hover:scale-110 p-1">
                                        <svg class="w-8 h-8 transition-colors duration-200" 
                                             :class="(star <= (hoverRating || currentRating)) ? 'text-yellow-400 fill-current' : 'text-gray-300'"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.563.045.8.77.362 1.122l-4.212 3.428a.562.562 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.212-3.428a.562.562 0 01.362-1.122l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                        </svg>
                                    </button>
                                </template>
                                <span class="ml-2 text-sm font-medium text-gray-500" x-text="currentRating > 0 ? currentRating + ' / 5' : 'Pilih Bintang'"></span>
                            </div>
                            @error('rating')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-2">Komentar / Saran</label>
                            <textarea name="message" rows="3" class="w-full border-gray-300 rounded-xl shadow-sm focus:border-teal-500 focus:ring-teal-500 placeholder-gray-400 text-sm p-3" placeholder="Ceritakan pengalaman Anda berobat di sini..."></textarea>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="bg-gray-800 text-white px-6 py-2.5 rounded-lg text-sm font-bold hover:bg-gray-700 transition shadow-md hover:shadow-lg disabled:opacity-50" :disabled="currentRating === 0">
                                Kirim Ulasan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="space-y-8">
                
                <div class="bg-white rounded-2xl p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Menu Cepat</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('appointments.create') }}" class="flex flex-col items-center justify-center p-4 bg-teal-50 rounded-xl text-teal-700 hover:bg-teal-100 transition border border-teal-100 hover:scale-105 transform duration-200">
                            <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-xs font-bold">Booking</span>
                        </a>
                        <a href="{{ route('medical_records.index') }}" class="flex flex-col items-center justify-center p-4 bg-blue-50 rounded-xl text-blue-700 hover:bg-blue-100 transition border border-blue-100 hover:scale-105 transform duration-200">
                            <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <span class="text-xs font-bold">Rekam Medis</span>
                        </a>
                    </div>
                </div>

                <div class="bg-indigo-900 rounded-2xl p-6 text-white shadow-lg">
                    <div class="flex items-start gap-4">
                        <div class="bg-white/20 p-2 rounded-lg">
                            <svg class="w-6 h-6 text-indigo-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg text-gray-800">Info Layanan</h4>
                            <p class="text-indigo-800 text-sm mt-1 leading-relaxed">
                                Pendaftaran online dibuka setiap hari. Untuk kondisi gawat darurat, silakan langsung menuju IGD kami 24 Jam.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Tips Sehat Hari Ini</h3>
                    <ul class="space-y-4">
                        <li class="flex gap-3">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xs font-bold">1</div>
                            <p class="text-sm text-gray-600">Minum air putih minimal 8 gelas sehari untuk menjaga hidrasi tubuh.</p>
                        </li>
                        <li class="flex gap-3">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xs font-bold">2</div>
                            <p class="text-sm text-gray-600">Lakukan olahraga ringan minimal 30 menit setiap hari.</p>
                        </li>
                        <li class="flex gap-3">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 text-xs font-bold">3</div>
                            <p class="text-sm text-gray-600">Istirahat yang cukup 7-8 jam per hari untuk imun yang kuat.</p>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>