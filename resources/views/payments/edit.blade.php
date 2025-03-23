<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kemaskini Bayaran') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('payments.update', $payment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700">Kontrak</label>
                        <select name="contract_id" class="w-full border-gray-300 rounded-lg mt-2" required>
                            @foreach ($contracts as $contract)
                                <option value="{{ $contract->id }}" @if ($contract->id == $payment->contract_id) selected @endif>
                                    {{ $contract->contract_number }} - {{ $contract->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Jumlah (RM)</label>
                        <input type="number" name="amount" value="{{ $payment->amount }}" class="w-full border-gray-300 rounded-lg mt-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Tarikh Bayaran</label>
                        <input type="date" name="payment_date" value="{{ $payment->payment_date }}" class="w-full border-gray-300 rounded-lg mt-2" required>
                    </div>

                    
                    <a href="{{ route('payments.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Kemaskini</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
