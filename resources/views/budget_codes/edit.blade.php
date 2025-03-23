<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kemaskini Budget Code') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('budget-codes.update', $budgetCode->id) }}">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="code" value="Kod" />
                        <x-text-input id="code" name="code" type="text" class="block mt-1 w-full" value="{{ $budgetCode->code }}" readonly />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="description" value="Deskripsi" />
                        <x-text-input id="description" name="description" type="text" class="block mt-1 w-full" value="{{ $budgetCode->description }}" required />
                    </div>

                    <div class="mt-8 flex gap-4">
                        <a href="{{ route('budget-codes.index') }}" class="px-5 py-3 bg-gray-500 text-white rounded">❌ Batal</a>
                        <button type="submit" class="px-5 py-3 bg-green-500 text-white rounded">💾 Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
