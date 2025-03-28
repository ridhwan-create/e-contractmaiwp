<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kemaskini Bahagian</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">✏️ Kemaskini Bahagian</h3>

                <form action="{{ route('departments.update', $department) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="code" :value="__('Kod Bahagian')" />
                        <x-text-input id="code" name="code" type="text" class="mt-1 block w-full" value="{{ old('code', $department->code) }}" required />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Penerangan')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" value="{{ old('description', $department->description) }}" required />
                    </div>

                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('departments.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">
                            ⬅️ Kembali
                        </a>
                        {{-- <button type="submit" class="px-5 py-3 bg-blue-500 text-white rounded">💾 Simpan Perubahan</button> --}}
                        <x-primary-button class="px-6 py-2">💾 Simpan</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
