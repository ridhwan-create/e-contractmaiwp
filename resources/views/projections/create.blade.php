<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Unjuran') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">📊 Tambah Unjuran</h3>

                @if (session('success'))
                    <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded">
                        <strong>⚠️ Terdapat ralat!</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <table class="w-full border-collapse border border-gray-300 mb-4">
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
                    </tbody>
                </table>

                {{-- <form action="{{ route('projections.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    <input type="hidden" name="contract_id" value="{{ $contract->id }}">

                    <div>
                        <x-input-label for="year" :value="__('Tahun')" />
                        <x-text-input id="year" name="year" type="number" class="mt-1 block w-full" :value="old('year', date('Y'))" />
                    </div>

                    @foreach ([
                        'entity_code_id' => $entityCodes,
                        'fund_id' => $funds,
                        'asnaf_id' => $asnaf,
                        'department_id' => $departments,
                        'program_id' => $programs,
                        'project_id' => $projects,
                        'expense_code_id' => $expenseCodes,
                        'budget_code_id' => $budgetCodes
                    ] as $name => $collection)
                        <div>
                            <x-input-label for="{{ $name }}" :value="__(str_replace('_', ' ', ucfirst($name)))" />
                            <select id="{{ $name }}" name="{{ $name }}" class="mt-1 block w-full border-gray-300 rounded-lg">
                                <option value="">-- Pilih {{ str_replace('_', ' ', ucfirst($name)) }} --</option>
                                @foreach($collection as $item)
                                    <option value="{{ $item->id }}" {{ old($name) == $item->id ? 'selected' : '' }}>
                                        {{ $item->code }} - {{ $item->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach

                    <div>
                        <x-input-label for="amount" :value="__('Amaun (RM)')" />
                        <x-text-input id="amount" name="amount" type="number" step="0.01" class="mt-1 block w-full" :value="old('amount')" />
                    </div>

                    <div class="mt-6 flex space-x-4 col-span-2"> 
                        <a href="{{ route('contracts.show', $contract->id) }}" class="px-5 py-3 bg-gray-500 text-white rounded">⬅️ Kembali</a> 
                        <button type="submit" class="px-5 py-3 bg-green-500 text-white rounded">💾 Simpan</button>
                    </div>
                </form> --}}

                <form action="{{ route('projections.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @csrf
                    <input type="hidden" name="contract_id" value="{{ $contract->id }}">

                    <div>
                        <x-input-label for="title" :value="__('Tajuk Unjuran')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>
                
                    <div>
                        <x-input-label for="year" :value="__('Tahun')" />
                        <x-text-input id="year" name="year" type="number" class="mt-1 block w-full" :value="old('year', date('Y'))" />
                    </div>
                
                    @php
                    $labels = [
                        'entity_code_id' => 'Kod Entiti',
                        'fund_id' => 'Kod Dana',
                        'asnaf_id' => 'Kod Asnaf',
                        'department_id' => 'Kod Bahagian',
                        'program_id' => 'Kod Program',
                        'project_id' => 'Kod Projek',
                        'expense_code_id' => 'Kod Belanja',
                        'budget_code_id' => 'Kod Bajet'
                    ];
                @endphp
                
                @foreach ([
                    'entity_code_id' => $entityCodes,
                    'fund_id' => $funds,
                    'asnaf_id' => $asnaf,
                    'department_id' => $departments,
                    'program_id' => $programs,
                    'project_id' => $projects,
                    'expense_code_id' => $expenseCodes,
                    'budget_code_id' => $budgetCodes
                ] as $name => $collection)
                    <div>
                        <x-input-label for="{{ $name }}" :value="__($labels[$name])" />
                        <select id="{{ $name }}" name="{{ $name }}" class="mt-1 block w-full border-gray-300 rounded-lg">
                            <option value="">-- Pilih {{ $labels[$name] }} --</option>
                            @foreach($collection as $item)
                                <option value="{{ $item->id }}" {{ old($name) == $item->id ? 'selected' : '' }}>
                                    {{ $item->code }} - {{ $item->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
                
                
                    <div>
                        <x-input-label for="amount" :value="__('Amaun (RM)')" />
                        <x-text-input id="amount" name="amount" type="number" step="0.01" class="mt-1 block w-full" :value="old('amount')" />
                    </div>
                
                    <div class="mt-6 flex space-x-4 col-span-3"> 
                        <a href="{{ route('contracts.show', $contract->id) }}"  class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">
                            ⬅️ Kembali
                        </a>
                        <x-primary-button class="px-6 py-2">✅ Daftar</x-primary-button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>
