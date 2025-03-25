<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Daftar Pengguna Baru</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <x-input-label for="name" value="Nama" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus />
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required />
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <x-input-label for="password" value="Kata Laluan" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <x-input-label for="password_confirmation" value="Sahkan Kata Laluan" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <div class="mb-4">
                <x-input-label value="Peranan" />
                @foreach($roles as $id => $name)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="roles[]" value="{{ $id }}" class="form-checkbox">
                        <span class="ml-2">{{ $name }}</span>
                    </label><br>
                @endforeach
                @error('roles') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <x-primary-button class="mt-4">Daftar</x-primary-button>
        </form>
    </div>
</x-app-layout>
