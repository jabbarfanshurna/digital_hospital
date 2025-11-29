<x-guest-layout>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900">Daftar Poli & Layanan</h2>
                <p class="mt-4 text-lg text-gray-500">Temukan layanan medis yang sesuai dengan kebutuhan Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($polis as $poli)
                <div class="group relative bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="aspect-w-3 aspect-h-2 bg-gray-200">
                        @if($poli->image)
                            <img src="{{ asset('storage/' . $poli->image) }}" alt="{{ $poli->name }}" class="object-cover w-full h-48">
                        @else
                            <div class="w-full h-48 bg-indigo-50 flex items-center justify-center text-indigo-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition">{{ $poli->name }}</h3>
                        <p class="mt-2 text-gray-600 text-sm leading-relaxed">{{ $poli->description ?? 'Layanan medis profesional.' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-guest-layout>