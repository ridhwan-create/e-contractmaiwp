<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ➕ Tambah Kontrak Baru
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

            <form action="{{ route('contracts.store') }}" method="POST" class="mt-6 space-y-6">
                @csrf
                
                <div>
                    <x-input-label for="contract_number" :value="__('Nombor Kontrak')" />
                    <x-text-input id="contract_number" name="contract_number" type="text" class="mt-1 block w-full"  
                        style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" />
                </div>

                <div>
                    <x-input-label for="title" :value="__('Tajuk Kontrak')" />
                    <textarea id="title" name="title" class="mt-1 block w-full border-gray-300 rounded-md h-32 resize-y" 
                        style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()"></textarea>
                </div>

                <div class="grid grid-cols-4 gap-4">
                    <div>
                        <x-input-label for="company_id" :value="__('Syarikat')" />
                        <select id="company_id" name="company_id" class="mt-1 block w-full border-gray-300 rounded-md" >
                            <option value="">Pilih Syarikat</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="contract_type_id" :value="__('Jenis Kontrak')" />
                        <select id="contract_type_id" name="contract_type_id" class="mt-1 block w-full border-gray-300 rounded-md" >
                            <option value="">Pilih Jenis Kontrak</option>
                            @foreach($contractTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="budget_code_id" :value="__('Kod Bajet')" />
                        <select id="budget_code_id" name="budget_code_id" class="mt-1 block w-full border-gray-300 rounded-md" >
                            <option value="">Pilih Kod Bajet</option>
                            @foreach($budgetCodes as $code)
                                <option value="{{ $code->id }}">{{ $code->code }} - {{ $code->description }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="contract_value" :value="__('Nilai Kontrak (RM)')" />
                        <x-text-input id="contract_value" name="contract_value" type="number" class="mt-1 block w-full" step="0.01"  />
                    </div>

                    <div>
                        <x-input-label for="start_date" :value="__('Tarikh Mula')" />
                        <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full"  />
                    </div>

                    <div>
                        <x-input-label for="end_date" :value="__('Tarikh Tamat')" />
                        <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full"  />
                    </div>

                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md" >
                            <option value="AKTIF">AKTIF</option>
                            <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                            <option value="TAMAT">TAMAT</option>
                        </select>
                    </div>

                    <div>
                        <x-input-label for="cost_center" :value="__('Cost Center')" />
                        <x-text-input id="cost_center" name="cost_center" type="text" class="mt-1 block w-full" 
                            style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" />
                    </div>

                    <div>
                        <x-input-label for="order_date" :value="__('Tarikh Pesanan')" />
                        <x-text-input id="order_date" name="order_date" type="date" class="mt-1 block w-full" />
                    </div>

                    <div>
                        <x-input-label for="transaction_no" :value="__('No. Transaksi')" />
                        <x-text-input id="transaction_no" name="transaction_no" type="text" class="mt-1 block w-full"
                            style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" />
                    </div>

                    <div>
                        <x-input-label for="supplier_id" :value="__('Pembekal')" />
                        <x-text-input id="supplier_id" name="supplier_id" type="text" class="mt-1 block w-full"
                            style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" />
                    </div>

                    <div>
                        <x-input-label for="order_no" :value="__('No. Pesanan')" />
                        <x-text-input id="order_no" name="order_no" type="text" class="mt-1 block w-full"
                            style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" />
                    </div>

                    <div>
                        <x-input-label for="sst_amount" :value="__('Jumlah SST (RM)')" />
                        <x-text-input id="sst_amount" name="sst_amount" type="number" class="mt-1 block w-full" step="0.01" />
                    </div>

                    <div>
                        <x-input-label for="purchase_method" :value="__('Kaedah Pembelian')" />
                        <select id="purchase_method" name="purchase_method" class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="TENDER">TENDER</option>
                            <option value="SEBUTHARGA">SEBUTHARGA</option>
                            <option value="PEMBELIAN TERUS">PEMBELIAN TERUS</option>
                        </select>
                    </div>
                </div>

                <div class="mt-8 flex gap-4">
                    <a href="{{ route('contracts.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">
                        ⬅️ Kembali
                    </a>
                    <x-primary-button class="px-6 py-2">✅ Daftar</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
