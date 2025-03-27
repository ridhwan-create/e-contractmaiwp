<x-app-layout>
    <div class="flex flex-col items-center justify-center">
        <div class="bg-white shadow-md rounded-lg p-6 text-center">
            <h1 class="text-2xl font-bold text-red-600">⛔ Akses Ditolak</h1>
            <p class="mt-2 text-gray-600">Anda tidak mempunyai kebenaran untuk mengakses halaman ini.</p>

            @if(auth()->check())
                <div class="mt-4 p-4 bg-gray-100 rounded-md">
                    <p class="text-gray-700"><strong>Role Anda:</strong> 
                        <span class="text-blue-500">
                            {{ auth()->user()->roles->pluck('name')->join(', ') }}
                        </span>
                    </p>
                </div>
            @endif
            
            <br><hr><br>

            <a href="{{ url()->previous() }}" 
                class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                ⬅️ Kembali
            </a>
        </div>
    </div>
</x-app-layout>
