<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white p-4 h-screen fixed top-0 left-0 overflow-y-auto">
        <div class="shrink-0 flex items-center">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
            </a>
            <span class="ml-4 text-md font-bold">E-CONTRACTMAIWP</span>
        </div>

        <nav class="mt-5">
            <a href="{{ route('dashboard') }}" class="block py-2">📈 Dashboard</a>
            <a href="{{ route('contracts.index') }}" class="block py-2">📄 Kontrak</a>

            <hr class="border-t-2 border-gray-500 my-4">

            {{-- <div class="sub-menu">
                <div onclick="toggleSubMenu('statik-menu')" class="cursor-pointer font-semibold py-2 flex items-center">
                    <span>📂 Statik</span>
                    <span id="statik-arrow" class="ml-2">▼</span>
                </div>

                <div id="statik-menu" class="hidden pl-4">
                    <a href="{{ route('expense-codes.index') }}" class="block py-2">🔢 Kod Belanja</a>
                    <a href="{{ route('budget-codes.index') }}" class="block py-2">💲 Kod Bajet</a>
                    <a href="{{ route('companies.index') }}" class="block py-2">🏢 Kod Syarikat</a>
                    <a href="{{ route('contract-types.index') }}" class="block py-2">📜 Kod Kontrak</a>
                    <a href="{{ route('entity-codes.index') }}" class="block py-2">📜 Kod Entiti</a>
                    <a href="{{ route('funds.index') }}" class="block py-2">📜 Kod Dana</a>
                    <a href="{{ route('asnaf.index') }}" class="block py-2">📜 Kod Asnaf</a>
                    <a href="{{ route('departments.index') }}" class="block py-2">📜 Kod Bahagian</a>
                    <a href="{{ route('programs.index') }}" class="block py-2">📜 Kod Program</a>
                    <a href="{{ route('projects.index') }}" class="block py-2">📜 Kod Projek</a>
                    <hr class="border-t-1 border-gray-500 my-4">
                    <a href="{{ route('users.index') }}" class="block py-2">📜 Senarai Pengguna</a>
                    <a href="{{ route('roles.index') }}" class="block py-2">📜 Senarai Peranan</a>
                </div>
            </div>

            <script>
                function toggleSubMenu(id) {
                    const subMenu = document.getElementById(id);
                    const arrow = document.getElementById('statik-arrow');
                    subMenu.classList.toggle('hidden');

                    arrow.innerHTML = subMenu.classList.contains('hidden') ? '▼' : '▲';
                }
            </script> --}}

            <div class="sub-menu">
                <div onclick="toggleSubMenu('statik-menu')" class="cursor-pointer font-semibold py-2 flex items-center">
                    <span>📂 Statik</span>
                    <span id="statik-arrow" class="ml-2">▼</span>
                </div>
            
                <div id="statik-menu" class="hidden pl-4">
                    <a href="{{ route('expense-codes.index') }}" class="block py-2">🔢 Kod Belanja</a>
                    <a href="{{ route('budget-codes.index') }}" class="block py-2">💲 Kod Bajet</a>
                    <a href="{{ route('companies.index') }}" class="block py-2">🏢 Kod Syarikat</a>
                    <a href="{{ route('contract-types.index') }}" class="block py-2">📜 Kod Kontrak</a>
                    <a href="{{ route('entity-codes.index') }}" class="block py-2">📜 Kod Entiti</a>
                    <a href="{{ route('funds.index') }}" class="block py-2">📜 Kod Dana</a>
                    <a href="{{ route('asnaf.index') }}" class="block py-2">📜 Kod Asnaf</a>
                    <a href="{{ route('departments.index') }}" class="block py-2">📜 Kod Bahagian</a>
                    <a href="{{ route('programs.index') }}" class="block py-2">📜 Kod Program</a>
                    <a href="{{ route('projects.index') }}" class="block py-2">📜 Kod Projek</a>
                    <hr class="border-t-1 border-gray-500 my-4">
                    <a href="{{ route('users.index') }}" class="block py-2">📜 Senarai Pengguna</a>
                    <a href="{{ route('roles.index') }}" class="block py-2">📜 Senarai Peranan</a>
                </div>
            </div>
            
            <script>
                function toggleSubMenu(menuId) {
                    let menu = document.getElementById(menuId);
                    let arrow = document.getElementById('statik-arrow');
            
                    if (menu.classList.contains('hidden')) {
                        menu.classList.remove('hidden');
                        arrow.innerHTML = "▲"; 
                        localStorage.setItem(menuId, "open"); // Simpan status menu dalam localStorage
                    } else {
                        menu.classList.add('hidden');
                        arrow.innerHTML = "▼"; 
                        localStorage.setItem(menuId, "closed"); // Simpan status menu dalam localStorage
                    }
                }
            
                // Pastikan toggle kekal selepas page reload
                document.addEventListener("DOMContentLoaded", function () {
                    let menu = document.getElementById("statik-menu");
                    let arrow = document.getElementById("statik-arrow");
                    let state = localStorage.getItem("statik-menu");
            
                    if (state === "open") {
                        menu.classList.remove("hidden");
                        arrow.innerHTML = "▲";
                    } else {
                        menu.classList.add("hidden");
                        arrow.innerHTML = "▼";
                    }
                });
            </script>
            

            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit" class="block w-full font-semibold text-left py-2 bg-red-600 hover:bg-red-700 rounded px-4">
                    🚪 Logout
                </button>
            </form>
        </nav>
    </aside>
</div>
