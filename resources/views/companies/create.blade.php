<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Senarai Unjuran') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">🏢 Tambah Syarikat</h3>

                <form action="{{ route('companies.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="name" value="Company Name" />
                        <x-text-input id="name" class="block mt-1 w-full" name="name" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="registration_number" value="Registration Number" />
                        <x-text-input id="registration_number" class="block mt-1 w-full" name="registration_number" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" class="block mt-1 w-full" name="email" type="email" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="phone" value="Phone" />
                        <x-text-input id="phone" class="block mt-1 w-full" name="phone" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="address" value="Address" />
                        <textarea id="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm h-32 resize-y" name="address" class="w-full border-gray-300 rounded">{{ old('address') }}</textarea>
                    </div>

                    <div class="mt-8 flex gap-4">
                        <a href="{{ route('companies.index') }}" class="px-5 py-3 bg-gray-500 text-white rounded">❌ Batal</a>
                        <button type="submit" class="px-5 py-3 bg-green-500 text-white rounded">💾 Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
