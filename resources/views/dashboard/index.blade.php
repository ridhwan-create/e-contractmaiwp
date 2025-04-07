<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                {{-- <div class="flex justify-between mb-4">
                    <h1 class="text-xl font-bold">📈 Dashboard</h1>
                </div> --}}

                <div class="flex justify-between mb-4 items-center">
                    <h1 class="text-xl font-bold">📈 Dashboard</h1>
                
                    <form method="GET" action="{{ route('dashboard') }}">
                        <label for="year" class="mr-2 font-semibold text-sm">Tahun:</label>
                        <select name="year" id="year" onchange="this.form.submit()" class="border-gray-300 rounded-md shadow-sm">
                            @foreach ($availableYears as $availableYear)
                                <option value="{{ $availableYear }}" {{ $availableYear == $year ? 'selected' : '' }}>
                                    {{ $availableYear }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                

                <div class="grid grid-cols-3 md:grid-cols-3 gap-4 mb-4">
                    <x-dashboard.card title="JUMLAH PERUNTUKAN" value="RM {{ number_format($totalAllocation, 2) }}" icon="💰" color="text-blue-600" />
                    <x-dashboard.card title="JUMLAH KONTRAK" value="{{ $totalContracts }}" icon="📄" color="text-green-600" />
                    <x-dashboard.card title="BAKI PERUNTUKAN" value="RM {{ number_format($remainingAllocation, 2) }}" icon="👛" color="text-cyan-600" />
                    {{-- <x-dashboard.card title="JUMLAH STAFF BTM" value="{{ $totalStaffBTM }}" icon="👥" color="text-orange-600" /> --}}
                </div>
{{-- 
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Chart: Monthly Payments -->
                    <div class="bg-white p-4 rounded shadow">
                        <h3 class="font-bold mb-2">Payment Statistic</h3>
                        <canvas id="paymentChart"></canvas>
                    </div>

                    <!-- Chart: Contract Types -->
                    <div class="bg-white p-4 rounded shadow">
                        <h3 class="font-bold mb-2">Jenis Kontrak</h3>
                        <canvas id="contractChart"></canvas>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    {{-- @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const paymentChart = new Chart(document.getElementById('paymentChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Total Payments (RM)',
                    data: @json($monthlyPayments),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true,
                    tension: 0.4,
                }]
            }
        });

        const contractChart = new Chart(document.getElementById('contractChart'), {
            type: 'doughnut',
            data: {
                labels: @json($contractTypes->keys()),
                datasets: [{
                    data: @json($contractTypes->values()),
                    backgroundColor: ['#f87171', '#60a5fa', '#fde68a'],
                }]
            }
        });
    </script>
    @endpush --}}
</x-app-layout>
