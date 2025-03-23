<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Kemaskini Syarikat
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">🏢 Kemaskini Maklumat Syarikat</h3>

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

                <form action="{{ route('companies.update', $company) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="name" value="Company Name" />
                        <x-text-input id="name" class="block mt-1 w-full" name="name" value="{{ $company->name }}" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="registration_number" value="Registration Number" />
                        <x-text-input id="registration_number" class="block mt-1 w-full" name="registration_number" value="{{ $company->registration_number }}" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" class="block mt-1 w-full" name="email" type="email" value="{{ $company->email }}" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="phone" value="Phone" />
                        <x-text-input id="phone" class="block mt-1 w-full" name="phone" value="{{ $company->phone }}" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="address" value="Address" />
                        <textarea id="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm h-32 resize-y" name="address">{{ $company->address }}</textarea>
                    </div>

                    <div class="mt-8 flex gap-4">
                        <a href="{{ route('companies.index') }}" class="px-5 py-3 bg-gray-500 text-white rounded">❌ Batal</a>
                        <button type="submit" class="px-5 py-3 bg-green-500 text-white rounded">💾 Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
