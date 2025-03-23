<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Senarai Bayaran') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <a href="{{ route('payments.create') }}" class="mb-4 px-4 py-2 bg-blue-500 text-white rounded">
                    + Tambah Bayaran
                </a>

                @if (session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2">#</th>
                            <th class="border border-gray-300 px-4 py-2">No. Kontrak</th>
                            <th class="border border-gray-300 px-4 py-2">Jumlah (RM)</th>
                            <th class="border border-gray-300 px-4 py-2">Tarikh Bayaran</th>
                            <th class="border border-gray-300 px-4 py-2">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr class="text-center">
                                <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $payment->contract->contract_number }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ number_format($payment->amount, 2) }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $payment->payment_date }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('payments.edit', $payment->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded" onclick="return confirm('Padam bayaran ini?')">Padam</button>
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
