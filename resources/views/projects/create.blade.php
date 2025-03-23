<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Projek') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    <div>
                        <x-input-label for="code" :value="__('Kod Projek')" />
                        <x-text-input id="code" name="code" type="text" class="mt-1 block w-full" required />
                    </div>
                    <div>
                        <x-input-label for="description" :value="__('Deskripsi')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" required />
                    </div>
                    
                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('projects.index') }}" class="px-5 py-3 bg-gray-500 text-white rounded">⬅️ Kembali</a>
                        <button type="submit" class="px-5 py-3 bg-green-500 text-white rounded">💾 Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
