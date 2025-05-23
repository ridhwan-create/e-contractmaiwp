<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Budget Codes') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-4 gap-4">
                    <h1 class="text-xl font-bold mb-4">💲 Senarai Kod Bajet</h1>
                    <a href="{{ route('budget-codes.create') }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">+ Tambah</a>
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
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-2 px-4 border">Kod</th>
                            <th class="py-2 px-4 border">Deskripsi</th>
                            <th class="py-2 px-4 border">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($budgetCode as $code)
                        <tr>
                            <td class="py-2 px-4 border">{{ $code->code }}</td>
                            <td class="py-2 px-4 border">{{ $code->description }}</td>
                            <td class="py-2 px-4 border">
                                <a href="{{ route('budget-codes.show', $code->id) }}" class="text-blue-500">Lihat</a>
                                <a href="{{ route('budget-codes.edit', $code->id) }}" class="text-yellow-500 ml-2">Edit</a>
                                <form action="{{ route('budget-codes.destroy', $code->id) }}" method="POST" class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 delete-button">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $budgetCode->appends(['perPage' => request('perPage')])->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Adakah anda pasti?',
                    text: "Anda tidak akan dapat mengembalikan rekod ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapuskan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>