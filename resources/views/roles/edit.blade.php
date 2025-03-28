<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Edit Peranan</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('roles.update', $role->id) }}">
                @csrf
                @method('PUT')

                {{-- Container: Maklumat Peranan --}}
                <div class="mb-6 border p-4 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">📌 Maklumat Peranan</h3>

                    <div class="mb-4">
                        <x-input-label for="name" value="Nama Peranan" />
                        <x-text-input id="name" class="w-full uppercase" type="text" name="name" value="{{ $role->name }}" required />
                    </div>
                </div>

                {{-- Container: Senarai Kebenaran --}}
                <div class="mb-6 border p-4 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">🔑 Senarai Kebenaran</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach ($permissions as $permission)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-checkbox"
                                    {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                                <span>{{ $permission->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Butang Kembali & Simpan --}}
                <div class="flex justify-between">
                    <a href="{{ route('roles.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">
                        ⬅️ Kembali
                    </a>

                    <x-primary-button class="px-6 py-2">💾 Simpan</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
