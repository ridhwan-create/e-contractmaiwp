<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Jenis Kontrak') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-xl font-bold mb-4">✏️ Edit Jenis Kontrak</h1>

                <form action="{{ route('contract-types.update', $contractType) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="name" value="Nama" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $contractType->name) }}" required autofocus />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" value="Deskripsi" />
                        <textarea id="description" name="description" class="block w-full border-gray-300 rounded mt-1">{{ old('description', $contractType->description) }}</textarea>
                    </div>

                    <div class="mt-8 flex gap-4">
                        <a href="{{ route('contract-types.index') }}" class="px-5 py-3 bg-gray-500 text-white rounded">❌ Batal</a>
                        <button type="submit" class="px-5 py-3 bg-green-500 text-white rounded">💾 Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
