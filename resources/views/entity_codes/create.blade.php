<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kod Entiti') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">➕ Tambah Kod Entiti</h3>

                <form action="{{ route('entity_codes.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf

                    <div>
                        <x-input-label for="code" :value="__('Kod Entiti')" />
                        <x-text-input id="code" name="code" type="text" class="mt-1 block w-full" required />
                        @error('code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Penerangan')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" required />
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-6 flex space-x-4 col-span-2">
                        <a href="{{ route('entity_codes.index') }}" class="px-5 py-3 bg-gray-500 text-white rounded">⬅️ Kembali</a> 
                        <button type="submit" class="px-5 py-3 bg-green-500 text-white rounded">💾 Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
