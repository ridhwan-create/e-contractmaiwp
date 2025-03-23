{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html> --}}

{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sistem Kontrak') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-900 text-white p-5">
            <h2 class="text-lg font-bold">Sistem Kontrak</h2>
            <nav class="mt-5">
                <a href="{{ route('contracts.index') }}" class="block py-2">📄 Kontrak</a>
                <a href="{{ route('projections.index') }}" class="block py-2">📊 Unjuran</a>
                <a href="{{ route('payments.index') }}" class="block py-2">💰 Bayaran</a>
                <a href="{{ route('expense-codes.index') }}" class="block py-2">🔢 Kod Bayaran</a>
                <a href="{{ route('budget-codes.index') }}" class="block py-2">💲 Kod Bajet</a>
                <a href="{{ route('companies.index') }}" class="block py-2">🏢 Syarikat</a>
                <a href="{{ route('contract-types.index') }}" class="block py-2">📜 Jenis Kontrak</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sistem Kontrak') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')
    <div class="min-h-screen flex">

    <!-- Sidebar -->
    {{-- <aside class="w-60 bg-gray-700 text-white p-5"> --}}
        <aside class="w-60 bg-gray-800 font-semibold text-gray-100 p-5 shadow-lg">
        {{-- <h2 class="text-lg font-bold">E-CONTRACTMAIWP</h2> --}}
        <nav class="mt-5">
            <a href="{{ route('dashboard') }}" class="block py-2">📈 Dashboard</a>
            <a href="{{ route('contracts.index') }}" class="block py-2">📄 Kontrak</a>
            {{-- <a href="{{ route('projections.index') }}" class="block py-2">📊 Unjuran</a>
            <a href="{{ route('payments.index') }}" class="block py-2">💰 Bayaran</a> --}}

            <hr class="border-t-2 border-gray-500 my-4">

            <div class="sub-menu">
                <!-- Sub Menu Statik (Clickable) -->
                <div onclick="toggleSubMenu('statik-menu')" class="cursor-pointer font-semibold py-2 flex items-center">
                    <span>📂 Statik</span>
                    <span id="statik-arrow" class="ml-2">▼</span> <!-- Ikon panah ke bawah -->
                </div>
            
                <!-- Menu dalam Sub Menu Statik (Awalnya Disembunyikan) -->
                <div id="statik-menu" class="hidden pl-4">
                    <a href="{{ route('expense-codes.index') }}" class="block py-2">🔢 Kod Belanja</a>
                    <a href="{{ route('budget-codes.index') }}" class="block py-2">💲 Kod Bajet</a>
                    <a href="{{ route('companies.index') }}" class="block py-2">🏢 Syarikat</a>
                    <a href="{{ route('contract-types.index') }}" class="block py-2">📜 Jenis Kontrak</a>
                </div>
            </div>
            
            <!-- Script untuk Toggle Sub Menu dan Animasi Panah -->
            <script>
                function toggleSubMenu(id) {
                    const subMenu = document.getElementById(id);
                    const arrow = document.getElementById('statik-arrow');
                    subMenu.classList.toggle('hidden');
            
                    // Ubah ikon panah
                    if (subMenu.classList.contains('hidden')) {
                        arrow.innerHTML = '▼'; // Panah ke bawah
                    } else {
                        arrow.innerHTML = '▲'; // Panah ke atas
                    }
                }
            </script>

            {{-- <a href="{{ route('expense-codes.index') }}" class="block py-2">🔢 Kod Bayaran</a>
            <a href="{{ route('budget-codes.index') }}" class="block py-2">💲 Kod Bajet</a>
            <a href="{{ route('companies.index') }}" class="block py-2">🏢 Syarikat</a>
            <a href="{{ route('contract-types.index') }}" class="block py-2">📜 Jenis Kontrak</a> --}}

            <!-- Butang Logout -->
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit" class="block w-full font-semibold text-left py-2 bg-red-600 hover:bg-red-700 rounded px-4">
                    🚪 Logout
                </button>
            </form>
        </nav>
    </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            {{ $slot }}

            <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                <div class="text-center text-sm sm:text-left">
                    &nbsp;
                </div>
        
                <style>
                    .footer {
                        position: fixed;
                        bottom: 0;
                        left: 0;
                        width: 100%;
                        text-align: right;
                        font-size: 0.75rem;
                        color: #6b7280; /* Warna abu-abu */
                        background-color: rgb(224, 224, 224); /* Latar belakang */
                        padding: 8px 0;
                        border-top: 0px solid #e5e7eb; /* Garis atas */
                    }
                </style>
                
                <div class="footer">
                    {{-- Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) --}}
                    Hakcipta © 2025 Unit Generik BTM | Majlis Agama Islam Wilayah Persekutuan
                </div>
            </div>
        </main>
    </div>
    </div>

</body>
</html>
