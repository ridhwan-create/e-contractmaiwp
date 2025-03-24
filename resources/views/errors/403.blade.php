<x-app-layout>
    {{-- Paparan mesej di bahagian atas --}}
    {{-- <div class="fixed top-0 left-0 w-full bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-center shadow-md">
        <strong>⛔ Akses Ditolak:</strong> Anda tidak mempunyai kebenaran untuk mengakses halaman ini.
    </div> --}}

    {{-- Konten utama ditolak ke bawah --}}
    <div class="flex flex-col items-center justify-center">
        <div class="bg-white shadow-md rounded-lg p-6 text-center">
            <h1 class="text-2xl font-bold text-red-600">⛔ Akses Ditolak</h1>
            <p class="mt-2 text-gray-600">Anda tidak mempunyai kebenaran untuk mengakses halaman ini.</p>
            <br><hr><br>
            <a href="{{ url()->previous() }}" 
                class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                ⬅️ Kembali
            </a>
        </div>
    </div>
</x-app-layout>
