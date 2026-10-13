<x-layouts::customer :title="__('Pengajuan Kredit Saya')">
    <!-- Header -->
    <header class="bg-white/80 backdrop-blur-xl border-b border-slate-200 px-10 py-8 sticky top-0 z-40">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-4xl font-extrabold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">{{ __('Pengajuan Kredit Saya') }}</h2>
                <p class="text-slate-500 mt-2 font-medium">{{ __('Pantau riwayat dan status pengajuan pembiayaan motor Anda.') }}</p>
            </div>
        </div>
    </header>

    <div class="p-10">
        @if(session('success'))
            <div class="mb-8 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl shadow-lg">
                <p class="font-bold">{{ session('success') }}</p>
            </div>
        @endif

        @php
            function getStatusLabel($status) {
                return match($status) {
                    'pending' => 'Menunggu Verifikasi',
                    'survey' => 'Survei Lapangan',
                    'approved' => 'Disetujui',
                    'rejected' => 'Ditolak',
                    'completed' => 'Selesai',
                    default => ucfirst($status)
                };
            }

            function getStatusColor($status) {
                return match($status) {
                    'pending' => 'bg-gradient-to-r from-amber-100 to-orange-100 text-amber-800',
                    'survey' => 'bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800',
                    'approved' => 'bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-800',
                    'rejected' => 'bg-gradient-to-r from-rose-100 to-pink-100 text-rose-800',
                    'completed' => 'bg-gradient-to-r from-slate-100 to-slate-200 text-slate-800',
                    default => 'bg-gradient-to-r from-slate-100 to-slate-200 text-slate-800'
                };
            }

            function formatCurrency($amount) {
                return 'Rp ' . number_format($amount, 0, ',', '.');
            }
        @endphp

        @if($applications->isEmpty())
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center p-16 bg-white rounded-3xl shadow-2xl border border-slate-200 text-center">
                <div class="w-32 h-32 rounded-full bg-slate-50 flex items-center justify-center mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m.75 3.75h7.5a2.25 2.25 0 002.25-2.25V6.75a2.25 2.25 0 00-2.25-2.25h-15a2.25 2.25 0 00-2.25 2.25v12.75a2.25 2.25 0 002.25 2.25h7.5" />
                    </svg>
                </div>
                <h3 class="text-2xl font-extrabold text-slate-900 mb-4">{{ __('Belum Ada Pengajuan') }}</h3>
                <p class="text-slate-500 text-lg max-w-md mb-10">{{ __('Anda belum memiliki pengajuan kredit. Mulai ajukan pembiayaan motor impian Anda!') }}</p>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-10 py-5 rounded-2xl font-extrabold text-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    {{ __('Lihat Katalog') }}
                </a>
            </div>
        @else
            <!-- Daftar Pengajuan -->
            <div class="space-y-6">
                @foreach($applications as $app)
                    <div class="bg-white p-8 rounded-3xl shadow-2xl border border-slate-200 flex flex-col md:flex-row justify-between gap-8 items-start md:items-center">
                        <!-- Kiri: Thumbnail & Info Motor -->
                        <div class="flex items-center gap-6 flex-1">
                            @php
                                $appMotImage = null;
                                if ($app->motor && $app->motor->galleries && $app->motor->galleries->isNotEmpty()) {
                                    $appMotImage = $app->motor->galleries->first()->foto_path;
                                } elseif ($app->motor && $app->motor->image) {
                                    $appMotImage = $app->motor->image;
                                }
                            @endphp
                            @if($appMotImage)
                                <img src="{{ Str::startsWith($appMotImage, 'http') ? $appMotImage : asset('storage/' . $appMotImage) }}" alt="{{ $app->motor->name }}" class="w-28 h-28 object-cover rounded-2xl bg-slate-100 shadow-lg">
                            @else
                                <div class="w-28 h-28 bg-slate-100 rounded-2xl flex items-center justify-center shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM5.25 17.25a6.75 6.75 0 0113.5 0v.75H5.25v-.75z" />
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <h4 class="text-xl font-extrabold text-slate-900">{{ $app->motor ? $app->motor->name : 'Motor Tidak Ditemukan' }}</h4>
                                <p class="text-sm text-slate-500 mt-1 font-medium">{{ $app->motor ? $app->motor->brand . ' • ' . $app->motor->year : '' }}</p>
                                <p class="text-xs text-slate-400 mt-2">Diajukan pada {{ $app->created_at->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>

                        <!-- Tengah: Detail Kredit -->
                        <div class="flex flex-col md:flex-row gap-8 items-start md:items-center flex-1">
                            @if($app->down_payment)
                                <div class="text-center md:text-left">
                                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">{{ __('Uang Muka') }}</p>
                                    <p class="text-2xl font-black text-slate-900">{{ formatCurrency($app->down_payment) }}</p>
                                </div>
                            @endif
                            @if($app->tenor)
                                <div class="text-center md:text-left">
                                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">{{ __('Tenor') }}</p>
                                    <p class="text-2xl font-black text-slate-900">{{ $app->tenor }} Bulan</p>
                                </div>
                            @endif
                            @if($app->monthly_payment)
                                <div class="text-center md:text-left">
                                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">{{ __('Angsuran/Bulan') }}</p>
                                    <p class="text-2xl font-black text-slate-900">{{ formatCurrency($app->monthly_payment) }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Kanan: Status & Aksi -->
                        <div class="flex flex-col gap-4 items-start md:items-end w-full md:w-auto">
                            <span class="inline-flex items-center px-5 py-3 rounded-2xl text-sm font-black {{ getStatusColor($app->status) }}">
                                {{ getStatusLabel($app->status) }}
                            </span>
                            <div class="flex gap-3 w-full md:w-auto">
                                <button class="px-5 py-3 border border-slate-300 text-slate-700 bg-white rounded-2xl font-semibold hover:bg-slate-50 transition-all duration-300">
                                    {{ __('Lihat Progres') }}
                                </button>
                                @if($app->status === 'pending')
                                    <form action="{{ route('customer.pengajuan.destroy', $app) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?');" class="w-full md:w-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full md:w-auto px-5 py-3 bg-rose-50 text-rose-700 rounded-2xl font-semibold hover:bg-rose-100 transition-all duration-300">
                                            {{ __('Hapus') }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts::customer>
