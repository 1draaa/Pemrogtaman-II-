<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | MotoLease</title>
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
    <div class="flex min-h-screen" x-data="{ activeTab: '{{ session('active_tab', 'statistik') }}' }">
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
                <a href="#" @click.prevent="activeTab = 'statistik'" class="group flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300" :class="activeTab === 'statistik' ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 text-slate-300 hover:text-white font-medium'">
                    <span class="material-symbols-outlined text-2xl">dashboard</span>
                    <span class="text-base">Dashboard</span>
                </a>
                <a href="#" @click.prevent="activeTab = 'stok'" class="group flex items-center gap-4 px-5 py-4 rounded-2xl transition-all duration-300" :class="activeTab === 'stok' ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 text-slate-300 hover:text-white font-medium'">
                    <span class="material-symbols-outlined text-2xl">inventory_2</span>
                    <span class="text-base">Manajemen Stok</span>
                </a>
                <a href="{{ route('admin.applications.index') }}" class="group flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-slate-800 text-slate-300 hover:text-white font-medium transition-all duration-300">
                    <span class="material-symbols-outlined text-2xl">description</span>
                    <span class="text-base">Daftar Pengajuan</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="group flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-slate-800 text-slate-300 hover:text-white font-medium transition-all duration-300">
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
                        <h2 class="text-4xl font-extrabold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent" x-text="activeTab === 'statistik' ? 'Dashboard' : 'Manajemen Stok'"></h2>
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
                <!-- Statistik Tab -->
                <div x-show="activeTab === 'statistik'" x-transition>
                    <!-- KPI Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                        <!-- Total Pengajuan -->
                        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-3xl p-8 shadow-2xl text-white transform hover:scale-[1.02] transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-blue-100 uppercase tracking-widest">Total Pengajuan</p>
                                    <p class="text-5xl font-black mt-4">{{ $totalApplications }}</p>
                                    <div class="flex items-center gap-2 mt-4 bg-white/20 px-3 py-1 rounded-full w-fit">
                                        <span class="material-symbols-outlined text-sm">{{ $appGrowth >= 0 ? 'trending_up' : 'trending_down' }}</span>
                                        <span class="text-xs font-bold">{{ $appGrowth >= 0 ? '+' : '' }}{{ $appGrowth }}% bulan ini</span>
                                    </div>
                                </div>
                                <div class="w-16 h-16 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center">
                                    <span class="material-symbols-outlined text-4xl">description</span>
                                </div>
                            </div>
                        </div>

                        <!-- Menunggu Verifikasi -->
                        <div class="bg-gradient-to-br from-amber-500 to-orange-600 rounded-3xl p-8 shadow-2xl text-white transform hover:scale-[1.02] transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-amber-100 uppercase tracking-widest">Menunggu Verifikasi</p>
                                    <p class="text-5xl font-black mt-4">{{ $pendingApplications }}</p>
                                    <div class="flex items-center gap-2 mt-4 bg-white/20 px-3 py-1 rounded-full w-fit">
                                        <span class="material-symbols-outlined text-sm">schedule</span>
                                        <span class="text-xs font-bold">Perlu review</span>
                                    </div>
                                </div>
                                <div class="w-16 h-16 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center">
                                    <span class="material-symbols-outlined text-4xl">pending_actions</span>
                                </div>
                            </div>
                        </div>

                        <!-- Unit Terjual -->
                        <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl p-8 shadow-2xl text-white transform hover:scale-[1.02] transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-emerald-100 uppercase tracking-widest">Unit Terjual</p>
                                    <p class="text-5xl font-black mt-4">{{ $soldUnits }}</p>
                                    <div class="flex items-center gap-2 mt-4 bg-white/20 px-3 py-1 rounded-full w-fit">
                                        <span class="material-symbols-outlined text-sm">{{ $soldGrowth >= 0 ? 'trending_up' : 'trending_down' }}</span>
                                        <span class="text-xs font-bold">{{ $soldGrowth >= 0 ? '+' : '' }}{{ $soldGrowth }}% bulan ini</span>
                                    </div>
                                </div>
                                <div class="w-16 h-16 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center">
                                    <span class="material-symbols-outlined text-4xl">check_circle</span>
                                </div>
                            </div>
                        </div>

                        <!-- Stok Tersedia -->
                        <div class="bg-gradient-to-br from-slate-700 to-slate-900 rounded-3xl p-8 shadow-2xl text-white transform hover:scale-[1.02] transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-slate-300 uppercase tracking-widest">Stok Tersedia</p>
                                    <p class="text-5xl font-black mt-4">{{ $availableStock }}</p>
                                    <div class="flex items-center gap-2 mt-4 bg-white/10 px-3 py-1 rounded-full w-fit">
                                        <span class="material-symbols-outlined text-sm">inventory</span>
                                        <span class="text-xs font-bold">Unit ready</span>
                                    </div>
                                </div>
                                <div class="w-16 h-16 bg-white/10 backdrop-blur rounded-2xl flex items-center justify-center">
                                    <span class="material-symbols-outlined text-4xl">warehouse</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Pengajuan Terbaru -->
                    <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden">
                        <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-gradient-to-r from-slate-50 to-white">
                            <h3 class="text-2xl font-extrabold text-slate-900">Pengajuan Terbaru</h3>
                            <a href="{{ route('admin.applications.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-2xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                                Lihat Semua
                                <span class="material-symbols-outlined text-lg">arrow_forward</span>
                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gradient-to-r from-slate-50 to-slate-100">
                                    <tr>
                                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase tracking-wider">Nama Nasabah</th>
                                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase tracking-wider">Unit Motor</th>
                                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase tracking-wider">Tanggal</th>
                                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase tracking-wider">Status</th>
                                        <th class="text-right px-8 py-5 text-sm font-black text-slate-700 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach(\App\Models\Application::latest()->take(4)->get() as $app)
                                        <tr class="hover:bg-slate-50 transition-all duration-300">
                                            <td class="px-8 py-5">
                                                <div class="flex items-center gap-4">
                                                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                                                        <span class="text-base font-black text-slate-700">{{ substr($app->customer_name, 0, 2) }}</span>
                                                    </div>
                                                    <div>
                                                        <p class="font-bold text-slate-900">{{ $app->customer_name }}</p>
                                                        <p class="text-sm text-slate-500 font-medium">{{ $app->customer_phone }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-8 py-5">
                                                <p class="font-bold text-slate-900">{{ optional($app->motor)->name ?? '-' }}</p>
                                                <p class="text-sm text-slate-500 font-medium">{{ optional($app->motor)->year ?? '-' }} • {{ optional($app->motor)->type ?? '-' }}</p>
                                            </td>
                                            <td class="px-8 py-5">
                                                <span class="text-slate-600 font-semibold">{{ $app->created_at->format('d M Y') }}</span>
                                            </td>
                                            <td class="px-8 py-5">
                                                @php
                                                    $statusColors = [
                                                        'pending' => 'bg-gradient-to-r from-amber-100 to-orange-100 text-amber-800',
                                                        'survey' => 'bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800',
                                                        'approved' => 'bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-800',
                                                        'rejected' => 'bg-gradient-to-r from-rose-100 to-pink-100 text-rose-800',
                                                        'completed' => 'bg-gradient-to-r from-slate-100 to-slate-200 text-slate-800'
                                                    ];
                                                    $statusLabels = [
                                                        'pending' => 'Menunggu',
                                                        'survey' => 'Survei',
                                                        'approved' => 'Disetujui',
                                                        'rejected' => 'Ditolak',
                                                        'completed' => 'Selesai'
                                                    ];
                                                @endphp
                                                <span class="inline-flex items-center px-4 py-2 rounded-2xl text-sm font-black {{ $statusColors[$app->status] ?? 'bg-gradient-to-r from-slate-100 to-slate-200 text-slate-800' }}">
                                                    {{ $statusLabels[$app->status] ?? $app->status }}
                                                </span>
                                            </td>
                                            <td class="px-8 py-5 text-right">
                                                <a href="{{ route('admin.applications.show', $app->id) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-slate-900 to-slate-800 text-white font-bold rounded-2xl hover:from-slate-800 hover:to-slate-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                                                    Review Berkas
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Manajemen Stok Tab -->
                <div x-show="activeTab === 'stok'" x-transition>
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
                        <div class="flex items-center gap-4">
                            <button @click="activeTab = 'statistik'" class="p-4 bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-800 rounded-2xl transition-all duration-300 shadow-sm hover:shadow">
                                <span class="material-symbols-outlined text-2xl">arrow_back</span>
                            </button>
                            <div>
                                <h3 class="text-3xl font-extrabold text-slate-900">Daftar Unit Motor</h3>
                                <p class="text-slate-500 mt-1 font-medium">Kelola stok motor di showroom</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.motors.create') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-2xl font-black hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <span class="material-symbols-outlined text-2xl">add</span>
                            Tambah Unit Baru
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="mb-8 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl shadow-lg">
                            <p class="font-bold">{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gradient-to-r from-slate-50 to-slate-100">
                                    <tr>
                                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase">Foto</th>
                                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase">Nama Motor</th>
                                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase">Tipe</th>
                                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase">Harga</th>
                                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase">Status</th>
                                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($motors as $motor)
                                        <tr class="hover:bg-slate-50 transition-all duration-300">
                                            <td class="px-8 py-5">
                                                <img 
                                                    src="{{ $motor->image ? asset('storage/' . $motor->image) : 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=200&auto=format&fit=crop' }}" 
                                                    alt="{{ $motor->name }}" 
                                                    class="w-20 h-20 object-cover rounded-2xl border-2 border-slate-200 shadow-sm"
                                                >
                                            </td>
                                            <td class="px-8 py-5">
                                                <div>
                                                    <p class="font-bold text-slate-900 text-lg">{{ $motor->brand }} {{ $motor->name }}</p>
                                                    <p class="text-slate-500 font-medium mt-1">Tahun {{ $motor->year }} • {{ number_format($motor->odometer, 0, ',', '.') }} km</p>
                                                </div>
                                            </td>
                                            <td class="px-8 py-5">
                                                <span class="text-slate-700 font-semibold text-lg">{{ $motor->type }}</span>
                                            </td>
                                            <td class="px-8 py-5">
                                                <p class="font-black text-slate-900 text-xl">Rp {{ number_format($motor->price, 0, ',', '.') }}</p>
                                            </td>
                                            <td class="px-8 py-5">
                                                <span class="inline-flex items-center px-4 py-2 rounded-2xl text-sm font-black {{ $motor->is_available ? 'bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-800' : 'bg-gradient-to-r from-slate-100 to-slate-200 text-slate-800' }}">
                                                    {{ $motor->is_available ? 'Tersedia' : 'Terjual' }}
                                                </span>
                                            </td>
                                            <td class="px-8 py-5">
                                                <div class="flex items-center gap-4">
                                                    <a href="{{ route('admin.motors.edit', $motor) }}" class="p-3 bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-800 rounded-xl transition-all duration-300 shadow-sm hover:shadow">
                                                        <span class="material-symbols-outlined text-xl">edit</span>
                                                    </a>
                                                    <form action="{{ route('admin.motors.destroy', $motor) }}" method="POST" onsubmit="return confirm('Yakin hapus unit ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="p-3 bg-rose-100 hover:bg-rose-200 text-rose-600 hover:text-rose-800 rounded-xl transition-all duration-300 shadow-sm hover:shadow">
                                                            <span class="material-symbols-outlined text-xl">delete</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-8 py-16 text-center">
                                                <div class="flex flex-col items-center">
                                                    <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                                        <span class="material-symbols-outlined text-5xl text-slate-400">directions_car</span>
                                                    </div>
                                                    <p class="text-xl font-bold text-slate-700 mb-2">Belum ada unit motor</p>
                                                    <p class="text-slate-500">Tambahkan unit motor pertama Anda!</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($motors->hasPages())
                            <div class="px-8 py-6 border-t border-slate-100 bg-slate-50">
                                {{ $motors->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
