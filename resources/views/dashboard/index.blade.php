<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Dashboard Rumah Sakit</h2>
    </x-slot>

    <div class="p-6">

        <!-- STAT CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

            <div class="p-4 bg-blue-600 text-white rounded-lg shadow">
                <h3 class="text-lg">Total Pasien</h3>
                <p class="text-3xl font-bold">{{ $totalPatients }}</p>
            </div>

            <div class="p-4 bg-green-600 text-white rounded-lg shadow">
                <h3 class="text-lg">Total Dokter</h3>
                <p class="text-3xl font-bold">{{ $totalDoctors }}</p>
            </div>

            <div class="p-4 bg-purple-600 text-white rounded-lg shadow">
                <h3 class="text-lg">Total Poli</h3>
                <p class="text-3xl font-bold">{{ $totalPoli }}</p>
            </div>

            <div class="p-4 bg-red-600 text-white rounded-lg shadow">
                <h3 class="text-lg">Pendapatan Lunas</h3>
                <p class="text-3xl font-bold">Rp{{ number_format($paidPayments) }}</p>
            </div>

        </div>

        <!-- CHARTS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

            <!-- Pasien Chart -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-3">Pasien Baru per Bulan</h3>
                <canvas id="patientChart"></canvas>
            </div>

            <!-- Income Chart -->
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-3">Pendapatan per Bulan</h3>
                <canvas id="incomeChart"></canvas>
            </div>

        </div>

        <!-- LATEST ACTIVITIES -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-3">Aktivitas Terbaru</h3>

            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2">Pasien</th>
                        <th class="p-2">Dokter</th>
                        <th class="p-2">Diagnosa</th>
                        <th class="p-2">Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($latestRecords as $record)
                    <tr class="border-b">
                        <td class="p-2">{{ $record->user->name }}</td>
                        <td class="p-2">{{ $record->doctor->user->name }}</td>
                        <td class="p-2">{{ $record->diagnosis }}</td>
                        <td class="p-2">{{ $record->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Data pasien
        const patientLabels = {!! json_encode($patientChart->keys()) !!};
        const patientData   = {!! json_encode($patientChart->values()) !!};

        new Chart(document.getElementById('patientChart'), {
            type: 'line',
            data: {
                labels: patientLabels,
                datasets: [{
                    label: 'Pasien Baru',
                    data: patientData,
                    borderWidth: 2
                }]
            }
        });

        // Data pendapatan
        const incomeLabels = {!! json_encode($incomeChart->keys()) !!};
        const incomeData   = {!! json_encode($incomeChart->values()) !!};

        new Chart(document.getElementById('incomeChart'), {
            type: 'bar',
            data: {
                labels: incomeLabels,
                datasets: [{
                    label: 'Pendapatan',
                    data: incomeData,
                    borderWidth: 2
                }]
            }
        });
    </script>

</x-app-layout>
