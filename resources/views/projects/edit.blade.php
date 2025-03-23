<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kemaskini Projek') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('projects.update', $project) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="code" :value="__('Kod Projek')" />
                        <x-text-input id="code" name="code" type="text" class="mt-1 block w-full"
                            value="{{ old('code', $project->code) }}" required />
                        @error('code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Deskripsi')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full"
                            value="{{ old('description', $project->description) }}" required />
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('projects.index') }}" class="px-5 py-3 bg-gray-500 text-white rounded">⬅️ Kembali</a>
                        <button type="submit" class="px-5 py-3 bg-blue-500 text-white rounded">💾 Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
