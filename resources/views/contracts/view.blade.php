<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Maklumat Kontrak') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                {{-- <!-- Maklumat Kontrak -->
                <h3 class="text-xl font-bold mb-4">📄 Maklumat Kontrak</h3>
                <table class="w-full border-collapse border border-gray-300">
                    <tbody>
                        <tr>
                            <th class="border p-2 text-left w-1/3 bg-gray-200">No. Kontrak</th>
                            <td class="border p-2">{{ $contract->contract_number }}</td>
                        </tr>
                        <tr>
                            <th class="border p-2 text-left bg-gray-200">Tajuk</th>
                            <td class="border p-2">{{ $contract->title }}</td>
                        </tr>
                        <tr>
                            <th class="border p-2 text-left bg-gray-200">Syarikat</th>
                            <td class="border p-2">{{ $contract->company->name }}</td>
                        </tr>
                        <tr>
                            <th class="border p-2 text-left bg-gray-200">Jenis Kontrak</th>
                            <td class="border p-2">{{ $contract->contractType->name }}</td>
                        </tr>
                        <tr>
                            <th class="border p-2 text-left bg-gray-200">Kod Bajet</th>
                            <td class="border p-2">{{ $contract->budgetCode->code }} - {{ $contract->budgetCode->description }}</td>
                        </tr>
                        <tr>
                            <th class="border p-2 text-left bg-gray-200">Nilai Kontrak (RM)</th>
                            <td class="border p-2">RM {{ number_format($contract->contract_value, 2) }}</td>
                        </tr>
                        
                        <tr>
                            <th class="border p-2 text-left bg-gray-200">Tarikh Mula</th>
                            <td class="border p-2">{{ $contract->start_date }}</td>
                        </tr>
                        <tr>
                            <th class="border p-2 text-left bg-gray-200">Tarikh Tamat</th>
                            <td class="border p-2">{{ $contract->end_date }}</td>
                        </tr>
                    </tbody>
                </table> --}}

                <!-- Maklumat Kontrak -->
                <h3 class="text-xl font-bold mb-4">📄 Maklumat Kontrak</h3>
                <table class="w-full border-collapse border border-gray-300">
                    <tbody>
                        <tr>
                            <th class="border p-2 text-left w-1/3 bg-gray-200">No. Kontrak</th>
                            <td class="border p-2">{{ $contract->contract_number }}</td>
                        </tr>
                        <tr>
                            <th class="border p-2 text-left bg-gray-200">Tajuk</th>
                            <td class="border p-2">{{ $contract->title }}</td>
                        </tr>
                        <tr>
                            <th class="border p-2 text-left bg-gray-200">Syarikat</th>
                            <td class="border p-2">{{ $contract->company->name }}</td>
                        </tr>
                        <tr>
                            <th class="border p-2 text-left bg-gray-200">Jenis Kontrak</th>
                            <td class="border p-2">{{ $contract->contractType->name }}</td>
                        </tr>
                        <tr>
                            <th class="border p-2 text-left bg-gray-200">Kod Bajet</th>
                            <td class="border p-2">{{ $contract->budgetCode->code }} - {{ $contract->budgetCode->description }}</td>
                        </tr>
                        <tr>
                            <th class="border p-2 text-left bg-gray-200">Nilai Kontrak (RM)</th>
                            <td class="border p-2">RM {{ number_format($contract->contract_value, 2) }}</td>
                        </tr>
                        <tr>
                            <th class="border p-2 text-left bg-gray-200">Baki Kontrak (RM)</th>
                            <td class="border p-2 font-bold text-red-600">
                                RM {{ number_format($contract->contract_value - $contract->payments->sum('amount'), 2) }}
                            </td>
                        </tr>
                        <tr>
                            <th class="border p-2 text-left bg-gray-200">Tarikh Mula</th>
                            <td class="border p-2">{{ $contract->start_date }}</td>
                        </tr>
                        <tr>
                            <th class="border p-2 text-left bg-gray-200">Tarikh Tamat</th>
                            <td class="border p-2">{{ $contract->end_date }}</td>
                        </tr>
                    </tbody>
                </table>

                {{-- <!-- Maklumat Unjuran -->
                <div class="mt-8 bg-gray-50 p-6 rounded-lg shadow">
                    <h3 class="text-xl font-bold mb-4">📊 Maklumat Unjuran</h3>

                    @if($contract->projections->count() > 0)
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border p-2">#</th> <!-- Lajur No -->
                                    <th class="border p-2">Tahun</th>
                                    <th class="border p-2">Kod Bajet</th>
                                    <th class="border p-2">Amaun (RM)</th>
                                    <th class="border p-2">Baki Unjuran (RM)</th>
                                    <th class="border p-2">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contract->projections as $index => $projection)
                                    <tr>
                                        <td class="border p-2 text-center">{{ $loop->iteration }}</td> <!-- Numbering -->
                                        <td class="border p-2">{{ $projection->year }}</td>
                                        <td class="border p-2">{{ $projection->budgetCode->code }} - {{ $projection->budgetCode->description }}</td>
                                        <td class="border p-2">RM {{ number_format($projection->amount, 2) }}</td>
                                        <td class="border p-2">RM {{ number_format($projection->remaining_projection, 2) }}</td>
                                        <td class="border p-2 flex space-x-2">
                                            <a href="{{ route('projections.edit', $projection->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">✏️ Edit</a>
                                            
                                            <form action="{{ route('projections.destroy', $projection->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">🗑️ Hapus</button>
                                            </form>
                                        
                                            <!-- Butang Bayaran -->
                                            @if($projection->remaining_projection > 0)
                                                <a href="{{ route('payments.create', ['contract_id' => $contract->id, 'projection_id' => $projection->id]) }}" 
                                                    class="px-2 py-1 bg-blue-500 text-white rounded">💰 Bayaran</a>
                                            @else
                                                <button class="px-2 py-1 bg-gray-400 text-white rounded cursor-not-allowed" disabled>💰 Bayaran</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            
                                <!-- Baris Jumlah Keseluruhan -->
                                <tr class="bg-gray-50 font-bold">
                                    <td class="border p-2 text-right" colspan="3">Jumlah</td>
                                    <td class="border p-2">RM {{ number_format($contract->projections->sum('amount'), 2) }}</td>
                                    <td class="border p-2">RM {{ number_format($contract->projections->sum('remaining_projection'), 2) }}</td>
                                    <td class="border p-2"></td> 
                                </tr>
                            </tbody>                            
                        </table>
                    @else
                        <p class="text-gray-500">❌ Tiada unjuran direkodkan untuk kontrak ini.</p>
                    @endif

                    <!-- Butang Tambah Unjuran -->
                    <div class="mt-4">
                        <a href="{{ route('projections.create', ['contract_id' => $contract->id]) }}" 
                        class="px-4 py-2 bg-green-500 text-white rounded">➕ Tambah Unjuran</a>
                    </div>
                </div> --}}

                <!-- Maklumat Unjuran -->
                <div class="mt-8 bg-gray-50 p-6 rounded-lg shadow">
                    <h3 class="text-xl font-bold mb-4">📊 Maklumat Unjuran</h3>

                    @if (session('success_projections'))
                        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
                            ✅ {{ session('success_projections') }}
                        </div>
                    @endif
                
                    @if($projections->isNotEmpty())
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border p-2">#</th>
                                    <th class="border p-2">Tahun</th>
                                    <th class="border p-2">Tajuk</th>
                                    <th class="border p-2">Kod Bajet</th>
                                    <th class="border p-2">Amaun (RM)</th>
                                    <th class="border p-2">Baki Unjuran (RM)</th>
                                    <th class="border p-2">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projections as $projection)
                                    <tr>
                                        <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                                        <td class="border p-2">{{ $projection->year }}</td>
                                        <td class="border p-2">{{ $projection->title }}</td>
                                        <td class="border p-2">{{ $projection->budgetCode->code }} - {{ $projection->budgetCode->description }}</td>
                                        <td class="border p-2">RM {{ number_format($projection->amount, 2) }}</td>
                                        <td class="border p-2 {{ $projection->remaining_projection == 0 ? 'text-green-500' : 'text-red-500' }}">
                                            RM {{ number_format($projection->remaining_projection, 2) }}
                                        </td>
                                        <td class="border p-2 flex space-x-2">
                                            @if($projection->remaining_projection > 0)
                                                @if($projection->remaining_projection < $projection->amount)
                                                    <button class="px-2 py-1 bg-gray-400 text-white rounded cursor-not-allowed" disabled>✏️ Edit</button>
                                                    <button class="px-2 py-1 bg-gray-400 text-white rounded cursor-not-allowed" disabled>🗑️ Hapus</button>
                                                @else
                                                @can('edit projections')
                                                    <a href="{{ route('projections.edit', $projection->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">✏️ Edit</a>
                                                @endcan
                                                    <form action="{{ route('projections.destroy', $projection->id) }}" method="POST" class="inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        @can('delete projections')
                                                            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">🗑️ Hapus</button>
                                                        @endcan
                                                    </form>
                                                @endif
                                                @can('create payments')
                                                    <a href="{{ route('payments.create', [
                                                        'remaining_projections' => $projection->remaining_projection, 
                                                        'expense_code_id' => $projection->expense_code_id,
                                                        'description' => $projection->expenseCode?->description,
                                                        'contract_title' => $contract->title, 
                                                        'contract_id' => $contract->id, 
                                                        'projection_id' => $projection->id]) }}" 
                                                        class="px-2 py-1 bg-blue-500 text-white rounded">💰 Bayaran
                                                    </a>
                                                @endcan
                                            @else
                                                <button class="px-2 py-1 bg-gray-400 text-white rounded cursor-not-allowed" disabled>✏️ Edit</button>
                                                <button class="px-2 py-1 bg-gray-400 text-white rounded cursor-not-allowed" disabled>🗑️ Hapus</button>
                                                <button class="px-2 py-1 bg-gray-400 text-white rounded cursor-not-allowed" disabled>💰 Bayaran</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="bg-gray-50 font-bold">
                                    <td class="border p-2 text-right" colspan="4">Jumlah</td>
                                    <td class="border p-2">RM {{ number_format($contract->projections->sum('amount'), 2) }}</td>
                                    {{-- <td class="border p-2 font-bold {{ $projections->sum('remaining_projection') == 0 ? 'text-green-500' : 'text-red-500' }}">
                                        RM {{ number_format($projections->sum('remaining_projection'), 2) }}
                                    </td> --}}
                                    <td class="border p-2 text-red-500">RM {{ number_format($contract->projections->sum('remaining_projection'), 2) }}</td>
                                    <td class="border p-2"></td>
                                </tr>
                            </tbody>
                        </table>
                
                        <div class="mt-4">
                            {{ $projections->appends(['projections_per_page' => request('projections_per_page')])->links() }}
                            <div class="flex items-center justify-end space-x-4 mt-4">
                                <label for="projections_per_page" class="text-sm font-medium text-gray-700">Rekod per halaman:</label>
                                <select id="projections_per_page" name="projections_per_page" class="border border-gray-300 rounded px-4 py-1 bg-white w-20"
                                        onchange="window.location = '?projections_per_page=' + this.value + '&payments_per_page={{ request('payments_per_page', 10) }}&projectionsPage={{ $projections->currentPage() }}&paymentsPage={{ $payments->currentPage() }}';">
                                    <option value="5" {{ request('projections_per_page') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('projections_per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('projections_per_page') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('projections_per_page') == 50 ? 'selected' : '' }}>50</option>
                                </select>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500">❌ Tiada unjuran direkodkan untuk kontrak ini.</p>
                    @endif
                
                    <div class="mt-6">
                        @can('create projections')
                            <a href="{{ route('projections.create', ['contract_id' => $contract->id]) }}" 
                            class="px-4 py-2 bg-green-500 text-white rounded">➕ Tambah Unjuran</a>
                        @endcan
                    </div>
                </div>

                <!-- Maklumat Bayaran -->
                <div class="mt-8 bg-gray-50 p-6 rounded-lg shadow">
                    <h3 class="text-xl font-bold mb-4">💳 Maklumat Bayaran</h3>

                    @if (session('success_payments'))
                        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
                            ✅ {{ session('success_payments') }}
                        </div>
                    @endif
                
                    @if($payments->isNotEmpty())
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border p-2">#</th>
                                    <th class="border p-2">Tarikh Bayaran</th>
                                    <th class="border p-2">Kod Belanja</th>
                                    <th class="border p-2">Amaun (RM)</th>
                                    <th class="border p-2">Unjuran Tahun</th>
                                    <th class="border p-2">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $index => $payment)
                                    <tr>
                                        <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                                        <td class="border p-2">{{ $payment->payment_date }}</td>
                                        <td class="border p-2">{{ $payment->expenseCode?->description ?? 'Tiada Kod Perbelanjaan' }}</td>
                                        <td class="border p-2">RM {{ number_format($payment->amount, 2) }}</td>
                                        <td class="border p-2">{{ $payment->projection ? $payment->projection->year : '-' }}</td>
                                        <td class="border p-2">
                                            {{-- <a href="{{ route('payments.edit', $payment->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">✏️ Edit</a> --}}
                                            <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                @can('delete payments')
                                                    <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded delete-button">🗑️ Hapus</button>
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                
                                <tr class="bg-gray-50 font-bold">
                                    <td class="border p-2 text-right" colspan="1"></td>
                                    <td class="border p-2 text-right" colspan="1"></td>
                                    <td class="border p-2 text-right">Jumlah</td>
                                    <td class="border p-2 text-blue-600">RM {{ number_format($contract->payments->sum('amount'), 2) }}</td>
                                    <td class="border p-2"></td>
                                    <td class="border p-2"></td>
                                </tr>
                            </tbody>
                        </table>
                
                        <div class="mt-4">
                            {{ $payments->appends(['payments_per_page' => request('payments_per_page')])->links() }}
                            <div class="flex items-center justify-end space-x-4 mt-4">
                                <label for="payments_per_page" class="text-sm font-medium text-gray-700">Rekod per halaman:</label>
                                <select id="payments_per_page" name="payments_per_page" class="border border-gray-300 rounded px-4 py-1 bg-white w-20"
                                        onchange="window.location = '?payments_per_page=' + this.value + '&projections_per_page={{ request('projections_per_page', 10) }}&projectionsPage={{ $projections->currentPage() }}&paymentsPage={{ $payments->currentPage() }}';">
                                    <option value="5" {{ request('payments_per_page') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('payments_per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('payments_per_page') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('payments_per_page') == 50 ? 'selected' : '' }}>50</option>
                                </select>
                            </div>
                        </div>
                
                    @else
                        <p class="text-gray-500">❌ Tiada bayaran direkodkan untuk kontrak ini.</p>
                    @endif
                </div>
                
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const deleteForms = document.querySelectorAll('.delete-form');
                
                        deleteForms.forEach(form => {
                            form.addEventListener('submit', function(event) {
                                event.preventDefault();
                
                                Swal.fire({
                                    title: 'Adakah anda pasti?',
                                    text: "Anda tidak akan dapat mengembalikan rekod ini!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ya, hapuskan!',
                                    cancelButtonText: 'Batal'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        form.submit();
                                    }
                                });
                            });
                        });
                    });
                </script>

                <!-- Butang Kembali -->
                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('contracts.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">⬅️ Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
