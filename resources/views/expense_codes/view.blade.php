<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lihat Kod Perbelanjaan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4">
                    <p class="font-semibold">Kod:</p>
                    <p class="text-gray-700">{{ $expenseCode->code }}</p>
                </div>

                <div class="mb-4">
                    <p class="font-semibold">Penerangan:</p>
                    <p class="text-gray-700">{{ $expenseCode->description }}</p>
                </div>

                <!-- Butang Kembali -->
                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('expense-codes.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">⬅️ Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
