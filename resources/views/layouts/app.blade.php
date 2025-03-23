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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
    {{-- <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Main Content -->
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>

    </div> --}}

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        {{-- <aside class="w-64 bg-gray-800 text-white p-4 min-h-screen"> --}}
            @include('components._sidebar')
        {{-- </aside> --}}
    
        <!-- Main Content -->
        {{-- <div class="flex-1 flex flex-col"> --}}
            <div class="flex-1 flex flex-col ml-64">
            @include('layouts.navigation')
    
            <!-- Main Content Area -->
            <main class="p-6 flex-1">
                {{ $slot }}

                <style>
                    .footer {
                        position: fixed;
                        bottom: 0;
                        left: 16rem; /* Sama dengan lebar sidebar */
                        width: calc(100% - 16rem); /* Pastikan footer tidak bertindih */
                        text-align: right;
                        font-size: 0.75rem;
                        color: #6b7280; /* Warna abu-abu */
                        background-color: rgb(34, 33, 33); /* Latar belakang */
                        padding: 8px 0;
                        border-top: 0px solid #e5e7eb; /* Garis atas */
                    }

                </style>
                
                <div class="footer">
                    {{-- Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) --}}
                    Hakcipta © 2025 Unit Generik BTM | Majlis Agama Islam Wilayah Persekutuan
                </div>
            </main>
        </div>
    </div>
    
    

</body>
</html>
