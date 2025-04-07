<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($allocation) ? '✏️ Kemaskini Peruntukan' : '➕ Tambah Peruntukan' }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">
                    {{ isset($allocation) ? '✏️ Kemaskini Peruntukan' : '➕ Tambah Peruntukan' }}
                </h3>

                <form action="{{ isset($allocation) ? route('allocations.update', $allocation) : route('allocations.store') }}" method="POST">
                    @csrf
                    @if(isset($allocation)) @method('PUT') @endif

                    <div class="mb-4">
                        <x-input-label for="year" :value="__('Tahun')" />
                        <x-text-input id="year" name="year" type="number" step="1" class="mt-1 block w-full"
                            value="{{ old('year', $allocation->year ?? '') }}" required />
                        <x-input-error for="year" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="total_allocation" :value="__('Peruntukan (RM)')" />
                        <x-text-input id="total_allocation" name="total_allocation" type="number" step="1" class="mt-1 block w-full"
                            value="{{ old('total_allocation', $allocation->total_allocation ?? '') }}" required />
                        <x-input-error for="total_allocation" />
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('allocations.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">
                            ⬅️ Kembali
                        </a>
                        <x-primary-button class="px-6 py-2">
                            {{ isset($allocation) ? '✅ Kemaskini' : '✅ Simpan' }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
