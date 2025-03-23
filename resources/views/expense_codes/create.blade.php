<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Kod Belanja
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">🔢 Tambah Kod Belanja</h3>
                <form action="{{ route('expense-codes.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="code" :value="'Kod'" />
                        <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" required autofocus />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="'Penerangan'" />
                        <textarea id="description" class="block mt-1 w-full border-gray-300 rounded-md" name="description" required></textarea>
                    </div>

                    <div class="mt-8 flex gap-4">
                        <a href="{{ route('expense-codes.index') }}" class="px-5 py-3 bg-gray-500 text-white rounded">❌ Batal</a>
                        <button type="submit" class="px-5 py-3 bg-green-500 text-white rounded">💾 Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
