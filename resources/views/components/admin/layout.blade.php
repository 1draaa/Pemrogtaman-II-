<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }} | MotoLease</title>
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
<body class="bg-gradient-to-br from-slate-50 to-slate-100 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-72 bg-gradient-to-b from-slate-900 to-slate-950 text-white flex-shrink-0 shadow-2xl">
            <div class="p-8 border-b border-slate-800">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <span class="material-symbols-outlined text-2xl">directions_car</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-black tracking-tight">MotoLease</h1>
                        <p class="text-xs text-slate-400 font-medium">Admin Dashboard</p>
                    </div>
                </div>
            </div>
            
            <nav class="p-6 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 text-slate-300 hover:text-white font-medium' }}">
                    <span class="material-symbols-outlined text-2xl">dashboard</span>
                    <span class="text-base">Dashboard</span>
                </a>
                <a href="{{ route('admin.dashboard') }}#stok" class="group flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300">
                    <span class="material-symbols-outlined text-2xl">inventory_2</span>
                    <span class="text-base">Manajemen Stok</span>
                </a>
                <a href="{{ route('admin.applications.index') }}" class="group flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.applications.*') ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 text-slate-300 hover:text-white font-medium' }}">
                    <span class="material-symbols-outlined text-2xl">description</span>
                    <span class="text-base">Daftar Pengajuan</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="group flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 text-slate-300 hover:text-white font-medium' }}">
                    <span class="material-symbols-outlined text-2xl">group</span>
                    <span class="text-base">Manajemen User</span>
                </a>
                <a href="#" class="group flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-slate-800 text-slate-300 hover:text-white font-medium transition-all duration-300">
                    <span class="material-symbols-outlined text-2xl">settings</span>
                    <span class="text-base">Pengaturan</span>
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
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-auto">
            <!-- Header -->
            <header class="bg-white/80 backdrop-blur-xl border-b border-slate-200 px-10 py-8 sticky top-0 z-40">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-4xl font-extrabold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">{{ $headerTitle ?? 'Dashboard' }}</h2>
                        <p class="text-slate-500 mt-2 font-medium">Selamat datang kembali, {{ auth()->user()->name }}!</p>
                    </div>
                    <div class="flex items-center gap-6">
                        <button class="relative p-4 bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-800 rounded-2xl transition-all duration-300 shadow-sm hover:shadow">
                            <span class="material-symbols-outlined text-2xl">notifications</span>
                            <span class="absolute -top-1 -right-1 w-6 h-6 bg-gradient-to-r from-rose-500 to-pink-500 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg">3</span>
                        </button>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white font-bold rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl">
                                <span class="material-symbols-outlined text-xl">logout</span>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <div class="p-10">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
