<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Quick Stats / Menu --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <a href="{{ route('admin.polis.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                    <div class="text-gray-900 font-bold text-lg">Manage Poli</div>
                    <p class="text-sm text-gray-600">Add, edit, or delete hospital departments.</p>
                </a>
                <a href="{{ route('admin.medicines.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                    <div class="text-gray-900 font-bold text-lg">Manage Medicines</div>
                    <p class="text-sm text-gray-600">Inventory control for hospital pharmacy.</p>
                </a>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900 font-bold text-lg">Manage Users</div>
                    <p class="text-sm text-gray-600">Doctors, Patients, and Admin accounts.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>