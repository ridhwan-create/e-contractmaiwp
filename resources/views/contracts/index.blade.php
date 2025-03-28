<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-xl font-bold mb-4">📄 Senarai Kontrak</h1>
                    
                    @can('create contracts')
                        <a href="{{ route('contracts.create') }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">+ Tambah</a>
                    @endcan
                </div>

                @if (session('success'))
                    <x-alert type="success">
                        ✅ {{ session('success') }}
                    </x-alert>
                @endif

                @if ($errors->any())
                    <x-alert type="error">
                        <strong>⚠️ Terdapat ralat!</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </x-alert>
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
                                <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                                <td class="border p-2">{{ $contract->contract_number }}</td>
                                <td class="border p-2">{{ $contract->title }}</td>
                                <td class="border p-2">{{ $contract->company->name }}</td>
                                <td class="border p-2">RM {{ number_format($contract->contract_value, 2) }}</td>
                                <td class="border-t p-2 flex items-center space-x-2">
                                    <!-- Butang View -->
                                    <a href="{{ route('contracts.show', $contract) }}" class="text-green-600 ">👁️ Lihat</a>
                                
                                    @can('edit contracts')
                                        <!-- Butang Edit -->
                                        <a href="{{ route('contracts.edit', $contract) }}" class="text-blue-600 ">✏️ Edit</a>
                                    @endcan
                                
                                    @can('delete contracts')
                                        <!-- Butang Hapus -->
                                        <form action="{{ route('contracts.destroy', $contract) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda pasti ingin menghapuskan kontrak ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 ">🗑️ Hapus</button>
                                        </form>
                                    @endcan
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
