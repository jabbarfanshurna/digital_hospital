<nav class="flex flex-1 flex-col">
    <ul role="list" class="flex flex-1 flex-col gap-y-7">
        <li>
            <ul role="list" class="-mx-2 space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}" 
                       class="{{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all">
                        <svg class="{{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }} h-6 w-6 shrink-0 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Dashboard
                    </a>
                </li>

                {{-- MENU ADMIN --}}
                @if(Auth::user()->role === 'admin')
                <li class="mt-6 mb-2">
                    <span class="text-xs font-semibold leading-6 text-gray-400 uppercase tracking-wider pl-2">Administrator</span>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}" 
                       class="{{ request()->routeIs('admin.users.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all">
                        <svg class="{{ request()->routeIs('admin.users.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                        Users Management
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.polis.index') }}" class="{{ request()->routeIs('admin.polis.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                        <svg class="{{ request()->routeIs('admin.polis.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" /></svg>
                        Data Poli
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.medicines.index') }}" class="{{ request()->routeIs('admin.medicines.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                        <svg class="{{ request()->routeIs('admin.medicines.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" /></svg>
                        Data Obat
                    </a>
                </li>
                @endif

                {{-- MENU LAINNYA (Appointment, Feedback) - Berlaku untuk semua yang login --}}
                <li class="mt-6 mb-2">
                    <span class="text-xs font-semibold leading-6 text-gray-400 uppercase tracking-wider pl-2">Layanan</span>
                </li>
                <li>
                    <a href="{{ route('appointments.index') }}" class="{{ request()->routeIs('appointments.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                        <svg class="{{ request()->routeIs('appointments.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                        Janji Temu
                    </a>
                </li>
                <li>
                    <a href="{{ route('medical_records.index') }}" class="{{ request()->routeIs('medical_records.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                        <svg class="{{ request()->routeIs('medical_records.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                        Rekam Medis
                    </a>
                </li>
                 @if(Auth::user()->role === 'admin')
                <li>
                    <a href="{{ route('admin.feedbacks.index') }}" class="{{ request()->routeIs('admin.feedbacks.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                        <svg class="{{ request()->routeIs('admin.feedbacks.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }} h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9 3h9.063M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Ulasan Pasien
                    </a>
                </li>
                @endif
            </ul>
        </li>
        
        <li class="mt-auto">
            <div class="flex items-center gap-x-4 px-2 py-3 text-sm font-semibold leading-6 text-gray-900 bg-gray-50 rounded-xl">
                <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <span class="sr-only">Your profile</span>
                <div class="flex flex-col">
                    <span aria-hidden="true">{{ Auth::user()->name }}</span>
                    <span class="text-xs text-gray-500 font-normal capitalize">{{ Auth::user()->role }}</span>
                </div>
            </div>
        </li>
    </ul>
</nav>