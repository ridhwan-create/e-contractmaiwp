<x-app-layout>
    <x-slot name="header">📊 Senarai Peruntukan</x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="flex justify-between mb-4">
                    <h1 class="text-xl font-bold">📋 Senarai Peruntukan</h1>
                        <a href="{{ route('allocations.create') }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">+ Tambah</a>
                </div>

            @if (session('success'))
                <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif

            <table class="min-w-full bg-white border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Tahun</th>
                        <th class="px-4 py-2 border">Peruntukan</th>
                        <th class="px-4 py-2 border">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allocations as $allocation)
                        <tr>
                            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $allocation->year }}</td>
                            <td class="border px-4 py-2">RM {{ number_format($allocation->total_allocation, 2) }}</td>
                            <td class="border px-4 py-2 space-x-2">
                                <a href="{{ route('allocations.edit', $allocation) }}" class="text-blue-600">✏️ Edit</a>
                                <form action="{{ route('allocations.destroy', $allocation) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">{{ $allocations->links() }}</div>
            </div>
        </div>
    </div>

</x-app-layout>
