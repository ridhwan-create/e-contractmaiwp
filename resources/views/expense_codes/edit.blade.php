<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kemaskini Kod Perbelanjaan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

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

                <form action="{{ route('expense-codes.update', $expenseCode->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="code" :value="'Kod'" />
                        <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" value="{{ $expenseCode->code }}" readonly />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="'Penerangan'" />
                        <textarea id="description" class="block mt-1 w-full border-gray-300 rounded-md" name="description" required>{{ $expenseCode->description }}</textarea>
                    </div>

                    <div class="mt-8 flex gap-4">
                        <a href="{{ route('expense-codes.index') }}"  class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">
                            ⬅️ Kembali
                        </a>
                        {{-- <button type="submit" class="px-5 py-3 bg-green-500 text-white rounded">💾 Simpan</button> --}}
                        <x-primary-button class="px-6 py-2">💾 Simpan</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
