<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Edit Peranan</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('roles.update', $role->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <x-input-label for="name" value="Nama Peranan" />
                    <x-text-input id="name" class="w-full" type="text" name="name" value="{{ $role->name }}" required />
                </div>

                <div class="mb-4">
                    <x-input-label value="Kebenaran" />
                    @foreach ($permissions as $permission)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-checkbox"
                                {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                            <span class="ml-2">{{ $permission->name }}</span>
                        </label><br>
                    @endforeach
                </div>

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
