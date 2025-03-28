<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Dana') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">➕ Tambah Dana</h3>

                <form action="{{ route('funds.store') }}" method="POST">
                    @csrf

                    <div>
                        <x-input-label for="code" :value="__('Kod Dana')" />
                        <x-text-input id="code" name="code" type="text" class="mt-1 block w-full" required />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Penerangan')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" required />
                    </div>

                    <div class="mt-6 flex space-x-4 col-span-1 md:col-span-3">
                        <a href="{{ route('funds.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">
                            ⬅️ Kembali
                        </a>
                        <x-primary-button class="px-6 py-2">✅ Daftar</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
