<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Senarai Pengguna & Peranan</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-semibold leading-tight">Senarai Pengguna & Peranan</h1>
                <a href="{{ route('users.create') }}" class="px-5 py-3 bg-blue-500 text-white rounded">+ Tambah</a>
            </div>

                {{-- <x-session-status class="mb-4" /> --}}
                @if (session('success'))
                    <x-alert type="success">
                        ✅ {{ session('success') }}
                    </x-alert>
                @endif

            
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">#</th>
                        <th class="border border-gray-300 px-4 py-2">Nama</th>
                        <th class="border border-gray-300 px-4 py-2">Email</th>
                        <th class="border border-gray-300 px-4 py-2">Peranan</th>
                        <th class="border border-gray-300 px-4 py-2">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $user->roles->pluck('name')->implode(', ') ?: 'Tiada Role' }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <a href="{{ route('users.edit', $user) }}" class="text-blue-600">✏️ Edit</a>
                            {{-- <a href="{{ route('users.assign-role', $user) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700">
                                Daftar Peranan
                            </a> --}}
                        </td>                    
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
