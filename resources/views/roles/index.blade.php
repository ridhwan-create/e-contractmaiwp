<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Senarai Peranan</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-semibold">Senarai Peranan</h1>
                <a href="{{ route('roles.create') }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">+ Tambah</a>
            </div>

            @if (session('success'))
                <x-alert type="success">
                    ✅ {{ session('success') }}
                </x-alert>
            @endif

            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">#</th>
                        <th class="border px-4 py-2">Nama Peranan</th>
                        <th class="border px-4 py-2">Kebenaran</th>
                        <th class="border px-4 py-2">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $index => $role)
                    <tr>
                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border px-4 py-2">{{ $role->name }}</td>
                        <td class="border px-4 py-2">{{ $role->permissions->pluck('name')->implode(', ') ?: 'Tiada Kebenaran' }}</td>
                        <td class="border px-4 py-2 flex space-x-2">
                            <a href="{{ route('roles.edit', $role->id) }}" class="text-blue-600">✏️ Edit</a>
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Padam peranan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">🗑️ Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $roles->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
