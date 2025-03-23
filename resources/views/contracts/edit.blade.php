<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Edit Kontrak
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-bold mb-4">📝 Maklumat Kontrak</h3>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <strong>⚠️ Terdapat ralat dalam borang:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('contracts.update', $contract->id) }}" method="POST" class="mt-6 space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <x-input-label for="contract_number" :value="__('Nombor Kontrak')" />
                    <x-text-input id="contract_number" name="contract_number" type="text" class="mt-1 block w-full"  
                        style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" 
                        value="{{ old('contract_number', $contract->contract_number) }}" />
                </div>

                <div>
                    <x-input-label for="title" :value="__('Tajuk Kontrak')" />
                    <textarea id="title" name="title" class="mt-1 block w-full border-gray-300 rounded-md h-32 resize-y" 
                        style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()">{{ old('title', $contract->title) }}</textarea>
                </div>

                <div class="grid grid-cols-4 gap-4">
                    <div>
                        <x-input-label for="company_id" :value="__('Syarikat')" />
                        <select id="company_id" name="company_id" class="mt-1 block w-full border-gray-300 rounded-md" >
                            <option value="">Pilih Syarikat</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id', $contract->company_id) == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="contract_type_id" :value="__('Jenis Kontrak')" />
                        <select id="contract_type_id" name="contract_type_id" class="mt-1 block w-full border-gray-300 rounded-md" >
                            <option value="">Pilih Jenis Kontrak</option>
                            @foreach($contractTypes as $type)
                                <option value="{{ $type->id }}" {{ old('contract_type_id', $contract->contract_type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="budget_code_id" :value="__('Kod Bajet')" />
                        <select id="budget_code_id" name="budget_code_id" class="mt-1 block w-full border-gray-300 rounded-md" >
                            <option value="">Pilih Kod Bajet</option>
                            @foreach($budgetCodes as $code)
                                <option value="{{ $code->id }}" {{ old('budget_code_id', $contract->budget_code_id) == $code->id ? 'selected' : '' }}>{{ $code->code }} - {{ $code->description }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="contract_value" :value="__('Nilai Kontrak (RM)')" />
                        <x-text-input id="contract_value" name="contract_value" type="number" class="mt-1 block w-full" step="0.01" 
                            value="{{ old('contract_value', $contract->contract_value) }}" />
                    </div>

                    <div>
                        <x-input-label for="start_date" :value="__('Tarikh Mula')" />
                        <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" 
                            value="{{ old('start_date', $contract->start_date) }}" />
                    </div>

                    <div>
                        <x-input-label for="end_date" :value="__('Tarikh Tamat')" />
                        <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" 
                            value="{{ old('end_date', $contract->end_date) }}" />
                    </div>

                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md" >
                            <option value="AKTIF" {{ old('status', $contract->status) == 'AKTIF' ? 'selected' : '' }}>AKTIF</option>
                            <option value="TIDAK AKTIF" {{ old('status', $contract->status) == 'TIDAK AKTIF' ? 'selected' : '' }}>TIDAK AKTIF</option>
                            <option value="TAMAT" {{ old('status', $contract->status) == 'TAMAT' ? 'selected' : '' }}>TAMAT</option>
                        </select>
                    </div>

                    <div>
                        <x-input-label for="cost_center" :value="__('Cost Center')" />
                        <x-text-input id="cost_center" name="cost_center" type="text" class="mt-1 block w-full" 
                            style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" 
                            value="{{ old('cost_center', $contract->cost_center) }}" />
                    </div>

                    <div>
                        <x-input-label for="order_date" :value="__('Tarikh Pesanan')" />
                        <x-text-input id="order_date" name="order_date" type="date" class="mt-1 block w-full" 
                            value="{{ old('order_date', $contract->order_date) }}" />
                    </div>

                    <div>
                        <x-input-label for="transaction_no" :value="__('No. Transaksi')" />
                        <x-text-input id="transaction_no" name="transaction_no" type="text" class="mt-1 block w-full"
                            style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" 
                            value="{{ old('transaction_no', $contract->transaction_no) }}" />
                    </div>

                    <div>
                        <x-input-label for="supplier_id" :value="__('Pembekal')" />
                        <x-text-input id="supplier_id" name="supplier_id" type="text" class="mt-1 block w-full"
                            style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" 
                            value="{{ old('supplier_id', $contract->supplier_id) }}" />
                    </div>

                    <div>
                        <x-input-label for="order_no" :value="__('No. Pesanan')" />
                        <x-text-input id="order_no" name="order_no" type="text" class="mt-1 block w-full"
                            style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" 
                            value="{{ old('order_no', $contract->order_no) }}" />
                    </div>

                    <div>
                        <x-input-label for="sst_amount" :value="__('Jumlah SST (RM)')" />
                        <x-text-input id="sst_amount" name="sst_amount" type="number" class="mt-1 block w-full" step="0.01" 
                            value="{{ old('sst_amount', $contract->sst_amount) }}" />
                    </div>

                    <div>
                        <x-input-label for="purchase_method" :value="__('Kaedah Pembelian')" />
                        <select id="purchase_method" name="purchase_method" class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="TENDER" {{ old('purchase_method', $contract->purchase_method) == 'TENDER' ? 'selected' : '' }}>TENDER</option>
                            <option value="SEBUTHARGA" {{ old('purchase_method', $contract->purchase_method) == 'SEBUTHARGA' ? 'selected' : '' }}>SEBUTHARGA</option>
                            <option value="PEMBELIAN TERUS" {{ old('purchase_method', $contract->purchase_method) == 'PEMBELIAN TERUS' ? 'selected' : '' }}>PEMBELIAN TERUS</option>
                        </select>
                    </div>
                </div>

                <div class="mt-8 flex gap-4">
                    <a href="{{ route('contracts.index') }}" class="px-5 py-3 bg-gray-500 text-white rounded">❌ Batal</a>
                    <button type="submit" class="px-5 py-3 bg-green-500 text-white rounded">💾 Kemaskini</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>