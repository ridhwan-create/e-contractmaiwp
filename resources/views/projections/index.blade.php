<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Senarai Unjuran') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <a href="{{ route('projections.create') }}" class="mb-4 px-4 py-2 bg-blue-500 text-white rounded">
                    + Tambah Unjuran
                </a>

                @if (session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">Year</th>
                            <th class="border p-2">Budget Code</th>
                            <th class="border p-2">Amount (RM)</th>
                            <th class="border p-2">Remaining Projection (RM)</th> <!-- New Column -->
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contract->projections as $projection)
                            <tr>
                                <td class="border p-2">{{ $projection->year }}</td>
                                <td class="border p-2">{{ $projection->budgetCode->code }} - {{ $projection->budgetCode->description }}</td>
                                <td class="border p-2">RM {{ number_format($projection->amount, 2) }}</td>
                                <td class="border p-2">RM {{ number_format($projection->remaining_projection, 2) }}</td> <!-- New Field -->
                                <td class="border p-2">
                                    <a href="{{ route('projections.edit', $projection->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">✏️ Edit</a>
                                    <form action="{{ route('projections.destroy', $projection->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">🗑️ Delete</button>
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
