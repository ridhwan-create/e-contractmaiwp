<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Senarai Projek') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="flex justify-between mb-4">
                    <h1 class="text-xl font-bold">📁 Senarai Projek</h1>
                    <a href="{{ route('projects.create') }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">+ Tambah</a>
                </div>

                @if (session('success'))
                    <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <table class="w-full bg-white rounded shadow">
                    <thead>
                        <tr class="bg-gray-200 text-left">
                            <th class="border p-2">#</th>
                            <th class="border p-2">Kod</th>
                            <th class="border p-2">Deskripsi</th>
                            <th class="border p-2">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr class="border-b">
                                <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                                <td class="border p-2">{{ $project->code }}</td>
                                <td class="border p-2">{{ $project->description }}</td>
                                <td class="border p-2">
                                    <a href="{{ route('projects.edit', $project) }}" class="text-blue-600">✏️ Edit</a>
                                    <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline delete-form">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 delete-button">🗑️ Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $projects->links() }}
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
                text: "Rekod ini akan dipadam!",
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
