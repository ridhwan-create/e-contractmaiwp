<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Maklumat Budget Code') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div>
                    <strong>Kod:</strong>
                    <p>{{ $budgetCode->code }}</p>
                </div>

                <div class="mt-4">
                    <strong>Deskripsi:</strong>
                    <p>{{ $budgetCode->description }}</p>
                </div>

                <div class="mt-8 flex gap-4">
                    <a href="{{ route('budget-codes.index') }}" class="px-5 py-3 bg-gray-500 text-white rounded">⬅️ Kembali</a>
                    <a href="{{ route('budget-codes.edit', $budgetCode->id) }}" class="px-5 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">💾 Kemaskini </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
