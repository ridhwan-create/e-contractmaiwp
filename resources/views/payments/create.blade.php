<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Bayaran Baru') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-xl font-bold mb-4">📄 Maklumat Bayaran</h3>

                <form action="{{ route('payments.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-6" id="paymentForm">
                    @csrf
                
                    <!-- Contract Title (1 Baris Penuh) -->
                    <div class="col-span-1 md:col-span-3">
                        <x-input-label for="contract_id" :value="__('Kontrak')" />
                        <select id="contract_id" name="contract_id" class="w-full border-gray-300 rounded-lg mt-2" disabled>
                            <option value="{{ request()->contract_title }}">{{ request()->contract_title }}</option>
                        </select>
                    </div>
                
                    <!-- Field Lain (3 Kolum) -->
                    <div>
                        <x-input-label for="expense_code_id" :value="__('Kod Perbelanjaan')" />
                        <select id="expense_code_id" name="expense_code_id" class="w-full border-gray-300 rounded-lg mt-2" disabled>
                            <option value="{{ request()->description }}">{{ request()->description }}</option>
                        </select>
                    </div>
                
                    <input type="hidden" name="contract_id" value="{{ request()->contract_id }}">
                    <input type="hidden" name="projection_id" value="{{ request()->projection_id }}">
                    <input type="hidden" name="expense_code_id" value="{{ request()->expense_code_id }}">
                
                    <div>
                        <x-input-label for="limit_bayaran" :value="__('Limit Bayaran Unjuran (RM)')" />
                        <x-text-input id="limit_bayaran" type="text" class="w-full border-gray-300 rounded-lg mt-2" value="{{ request()->remaining_projections }}" disabled />
                    </div>
                
                    <div>
                        <x-input-label for="amount" :value="__('Jumlah (RM)')" />
                        <x-text-input id="amount" name="amount" type="number" class="w-full border-gray-300 rounded-lg mt-2" required />
                        <p id="amountError" class="text-red-500 text-sm mt-1 hidden">Jumlah bayaran melebihi limit bayaran unjuran.</p>
                    </div>
                
                    <div>
                        <x-input-label for="payment_date" :value="__('Tarikh Bayaran')" />
                        <x-text-input id="payment_date" name="payment_date" type="date" class="w-full border-gray-300 rounded-lg mt-2" required />
                    </div>
                
                    <!-- Butang Tindakan (Satu Baris Penuh) -->
                    <div class="mt-6 flex space-x-4 col-span-1 md:col-span-3"> 
                        <a href="{{ route('contracts.show', request()->contract_id) }}"  class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">
                            ⬅️ Kembali
                        </a>
                        <x-primary-button class="px-6 py-2">✅ Daftar</x-primary-button>
                    </div>
                </form>
                
                
            </div>
        </div>
    </div>

    <script>
        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            const limitBayaran = parseFloat(document.getElementById('limit_bayaran').value);
            const amount = parseFloat(document.getElementById('amount').value);
            const amountError = document.getElementById('amountError');

            if (amount > limitBayaran) {
                amountError.classList.remove('hidden');
                event.preventDefault();
            } else {
                amountError.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
