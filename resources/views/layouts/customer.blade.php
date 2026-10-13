<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }
        </style>
    </head>
    <body class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 font-sans antialiased flex">
        <!-- Sidebar -->
        <aside class="w-72 min-h-screen bg-gradient-to-b from-slate-900 to-slate-950 text-white hidden lg:flex flex-col sticky top-0 shadow-2xl">
            <div class="p-8 border-b border-slate-800">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <span class="material-symbols-outlined text-2xl">directions_car</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-black tracking-tight">MotoLease</h1>
                        <p class="text-xs text-slate-400 font-medium">Customer Dashboard</p>
                    </div>
                </div>
            </div>

            <nav class="p-6 space-y-2">
                <a href="{{ route('customer.dashboard') }}" class="group flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('customer.dashboard') ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 text-slate-300 hover:text-white font-medium' }}">
                    <span class="material-symbols-outlined text-2xl">dashboard</span>
                    <span class="text-base">{{ __('Beranda') }}</span>
                </a>
                <a href="{{ route('customer.pengajuan') }}" class="group flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('customer.pengajuan') ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 text-slate-300 hover:text-white font-medium' }}">
                    <span class="material-symbols-outlined text-2xl">description</span>
                    <span class="text-base">{{ __('Pengajuan Saya') }}</span>
                </a>



                <a href="{{ route('customer.dokumen') }}" class="group flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('customer.dokumen') ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 text-slate-300 hover:text-white font-medium' }}">
                    <span class="material-symbols-outlined text-2xl">folder</span>
                    <span class="text-base">{{ __('Dokumen') }}</span>
                </a>

                <a href="{{ route('customer.profile') }}" class="group flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('customer.profile') ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 text-slate-300 hover:text-white font-medium' }}">
                    <span class="material-symbols-outlined text-2xl">settings</span>
                    <span class="text-base">{{ __('Pengaturan') }}</span>
                </a>
            </nav>

            <div class="mt-auto p-6 border-t border-slate-800">
                <div class="bg-slate-800/50 rounded-2xl p-5">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg">
                            <span class="text-lg font-black">{{ substr(auth()->user()->name, 0, 2) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="w-full mt-4">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white font-bold rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl w-full justify-center">
                        <span class="material-symbols-outlined text-xl">logout</span>
                        {{ __('Keluar') }}
                    </button>
                </form>
            </div>
        </aside>

        <!-- Mobile Header -->
        <header class="lg:hidden fixed top-0 left-0 right-0 h-16 bg-gradient-to-b from-slate-900 to-slate-950 text-white flex items-center px-4 z-50 shadow-2xl">
            <button class="p-2 -ml-2" onclick="document.getElementById('customer-mobile-sidebar').classList.remove('-translate-x-full')">
                <span class="material-symbols-outlined text-2xl">menu</span>
            </button>
            <div class="ml-4 font-extrabold text-xl tracking-tight">MotoLease</div>
            <div class="ml-auto">
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg">
                            <span class="text-sm font-black">{{ substr(auth()->user()->name, 0, 2) }}</span>
                        </div>
                    </button>
                    <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-64 bg-white rounded-3xl shadow-2xl py-4 text-slate-900 border border-slate-200">
                        <div class="px-6 py-4 border-b border-slate-100 mb-2">
                            <p class="font-extrabold text-lg truncate text-slate-900">{{ auth()->user()->name }}</p>
                            <p class="text-sm text-slate-500 truncate">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ route('customer.profile') }}" class="block px-6 py-3 text-slate-700 hover:bg-slate-50 transition-all duration-200 font-semibold">{{ __('Pengaturan') }}</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-6 py-3 text-rose-600 hover:bg-rose-50 transition-all duration-200 font-bold">{{ __('Keluar') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Mobile Sidebar Overlay -->
        <div id="customer-mobile-sidebar" class="fixed inset-0 bg-slate-900/50 z-[60] lg:hidden transition-transform duration-300 -translate-x-full" onclick="this.classList.add('-translate-x-full')">
            <div class="w-72 h-full bg-gradient-to-b from-slate-900 to-slate-950 flex flex-col shadow-2xl" onclick="event.stopPropagation()">
                <div class="p-8 flex items-center justify-between border-b border-slate-800">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <span class="material-symbols-outlined text-2xl">directions_car</span>
                        </div>
                        <div>
                            <h1 class="text-2xl font-black tracking-tight">MotoLease</h1>
                            <p class="text-xs text-slate-400 font-medium">Customer Dashboard</p>
                        </div>
                    </div>
                    <button onclick="document.getElementById('customer-mobile-sidebar').classList.add('-translate-x-full')">
                        <span class="material-symbols-outlined text-3xl text-white">close</span>
                    </button>
                </div>
                <!-- Mobile Nav Content same as desktop -->
                <nav class="p-6 space-y-2 flex-1">
                    <a href="{{ route('customer.dashboard') }}" class="group flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('customer.dashboard') ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 text-slate-300 hover:text-white font-medium' }}" onclick="document.getElementById('customer-mobile-sidebar').classList.add('-translate-x-full')">
                        <span class="material-symbols-outlined text-2xl">dashboard</span>
                        <span class="text-base">{{ __('Beranda') }}</span>
                    </a>
                    <a href="{{ route('customer.pengajuan') }}" class="group flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('customer.pengajuan') ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 text-slate-300 hover:text-white font-medium' }}" onclick="document.getElementById('customer-mobile-sidebar').classList.add('-translate-x-full')">
                        <span class="material-symbols-outlined text-2xl">description</span>
                        <span class="text-base">{{ __('Pengajuan Saya') }}</span>
                    </a>

                    <a href="{{ route('customer.dokumen') }}" class="group flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('customer.dokumen') ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 text-slate-300 hover:text-white font-medium' }}" onclick="document.getElementById('customer-mobile-sidebar').classList.add('-translate-x-full')">
                        <span class="material-symbols-outlined text-2xl">folder</span>
                        <span class="text-base">{{ __('Dokumen') }}</span>
                    </a>
                    <a href="{{ route('customer.profile') }}" class="group flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('customer.profile') ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 text-slate-300 hover:text-white font-medium' }}">
                        <span class="material-symbols-outlined text-2xl">settings</span>
                        <span class="text-base">{{ __('Pengaturan') }}</span>
                    </a>
                </nav>
                <div class="p-6 border-t border-slate-800">
                    <div class="bg-slate-800/50 rounded-2xl p-5 mb-4">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg">
                                <span class="text-lg font-black">{{ substr(auth()->user()->name, 0, 2) }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white font-bold rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl w-full justify-center">
                            <span class="material-symbols-outlined text-xl">logout</span>
                            {{ __('Keluar') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content Wrapper -->
        <div class="flex-1">
            <main class="w-full">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
