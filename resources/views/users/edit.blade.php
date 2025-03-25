<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Kemaskini Pengguna</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        @if (session('success'))
        <div class="mb-4 p-3 bg-green-500 text-white rounded">
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-input-label for="name" value="Nama" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus />
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email', $user->email) }}" required />
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <x-input-label for="password" value="Kata Laluan (Biarkan kosong jika tidak mahu ubah)" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" />
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <x-input-label value="Peranan" />
                @foreach($roles as $id => $name)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="roles[]" value="{{ $id }}" 
                            class="form-checkbox"
                            {{ in_array($id, $user->roles->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <span class="ml-2">{{ $name }}</span>
                    </label><br>
                @endforeach
                @error('roles') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <x-primary-button class="mt-4">Simpan</x-primary-button>
        </form>
    </div>
</x-app-layout>
