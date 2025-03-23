<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-xl font-bold mb-4">📄 Senarai Kontrak</h1>
                    <a href="{{ route('contracts.create') }}" class="px-5 py-3 bg-blue-500 text-white rounded">+ Tambah</a>
                </div>

                @if (session('success'))
                    <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded">
                        <strong>⚠️ Terdapat ralat!</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border p-2">#</th>
                            <th class="border p-2">No Kontrak</th>
                            <th class="border p-2">Tajuk</th>
                            <th class="border p-2">Syarikat</th>
                            <th class="border p-2">Nilai</th>
                            <th class="border p-2">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contracts as $contract)
                        <tr>
                            <td class="border p-2">{{ $loop->iteration }}</td>
                            <td class="border p-2">{{ $contract->contract_number }}</td>
                            <td class="border p-2">{{ $contract->title }}</td>
                            <td class="border p-2">{{ $contract->company->name }}</td>
                            <td class="border p-2">RM {{ number_format($contract->contract_value, 2) }}</td>
                            <td class="border p-2 flex space-x-2">
                                <!-- Butang View -->
                                <a href="{{ route('contracts.show', $contract) }}" class="text-green-600">👁️ Lihat</a>
                                
                                <!-- Butang Edit -->
                                <a href="{{ route('contracts.edit', $contract) }}" class="text-blue-600">✏️ Edit</a>

                                <!-- Butang Hapus -->
                                <form action="{{ route('contracts.destroy', $contract) }}" method="POST" class="inline-block">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
