<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-8 p-6 lg:p-8">
        <!-- Stats Overview -->
        <div class="grid gap-6 md:grid-cols-4">
            <div class="p-6 bg-white rounded-2xl border border-slate-100 shadow-md transition-all duration-300 hover:scale-[1.02]">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-slate-50 rounded-xl text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m.75 3.75h7.5a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v12.75a2.25 2.25 0 0 0 2.25 2.25h7.5" />
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-[#000000]">Total Pengajuan</p>
                </div>
                <h3 class="text-3xl font-black text-[#000000]">2</h3>
            </div>
            <div class="p-6 bg-white rounded-2xl border border-slate-100 shadow-md transition-all duration-300 hover:scale-[1.02]">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-amber-50 rounded-xl text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-[#000000]">Dalam Proses</p>
                </div>
                <h3 class="text-3xl font-black text-[#000000]">1</h3>
            </div>
            <div class="p-6 bg-white rounded-2xl border border-slate-100 shadow-md transition-all duration-300 hover:scale-[1.02]">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-[#000000]">Disetujui</p>
                </div>
                <h3 class="text-3xl font-black text-[#000000]">1</h3>
            </div>
            <div class="p-6 bg-white rounded-2xl border border-slate-100 shadow-md transition-all duration-300 hover:scale-[1.02]">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-rose-50 rounded-xl text-rose-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-[#000000]">Ditolak</p>
                </div>
                <h3 class="text-3xl font-black text-[#000000]">0</h3>
            </div>
        </div>

        <!-- Recent Applications Table & Saved Simulations -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-md overflow-hidden flex flex-col">
                <div class="px-8 py-6 border-b border-slate-50 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-[#1e293b]">Pengajuan Kredit Terbaru</h3>
                        <p class="text-xs text-slate-500 mt-1 font-medium">Status pengajuan unit motor Anda</p>
                    </div>
                    <a href="#" class="text-xs font-bold text-slate-600 hover:text-slate-900 transition-colors">Lihat Semua</a>
                </div>
                <div class="flex-1 overflow-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="px-8 py-4 text-xs font-bold text-slate-900 uppercase tracking-widest">Motor</th>
                                <th class="px-8 py-4 text-xs font-bold text-slate-900 uppercase tracking-widest text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <tr class="hover:bg-slate-50/30 transition-colors">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="size-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                            </svg>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-bold text-[#1e293b] text-base">Ducati Panigale V4</span>
                                            <span class="text-xs text-slate-600 font-medium">24 Apr 2026 • Sport</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full bg-amber-50 text-amber-700 border border-amber-100">
                                        Verifikasi Dealer
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/30 transition-colors">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="size-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                            </svg>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-bold text-[#1e293b] text-base">Yamaha MT-09</span>
                                            <span class="text-xs text-slate-600 font-medium">15 Mar 2026 • Naked</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        Disetujui
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Saved Simulations Section -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-md overflow-hidden flex flex-col">
                <div class="px-8 py-6 border-b border-slate-50 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-[#1e293b]">Simulasi</h3>
                        <p class="text-xs text-slate-500 mt-1 font-medium">Perhitungan tersimpan</p>
                    </div>
                    <a href="{{ route('simulasi') }}" class="p-2 bg-slate-50 rounded-lg text-slate-600 hover:bg-slate-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </a>
                </div>
                <div class="flex-1 overflow-auto max-h-[500px]">
                    @if($simulations->isEmpty())
                        <div class="flex flex-col items-center justify-center p-12 text-center h-full">
                            <div class="size-20 bg-slate-50 rounded-full flex items-center justify-center mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10 text-slate-200">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75V18m-3-3V18m-3-3V18m3-3.375a1.5 1.5 0 0 0 0-3m0 3a1.5 1.5 0 0 1 0-3m0 3h3.375a1.5 1.5 0 0 1 0 3m-3-3h-3.375a1.5 1.5 0 0 0 0 3m-.375-11.25h10.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25h-10.5a2.25 2.25 0 0 1-2.25-2.25v-10.5a2.25 2.25 0 0 1 2.25-2.25Z" />
                                </svg>
                            </div>
                            <h4 class="font-bold text-slate-900 mb-2">Belum ada simulasi</h4>
                            <p class="text-sm text-slate-500 leading-relaxed">Mulai hitung cicilan motor impian Anda sekarang.</p>
                            <a href="{{ route('simulasi') }}" class="mt-6 inline-flex items-center px-4 py-2 bg-slate-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-slate-700 focus:bg-slate-700 active:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition ease-in-out duration-150">Buat Simulasi</a>
                        </div>
                    @else
                        <div class="divide-y divide-slate-50">
                            @foreach($simulations as $sim)
                                <div class="p-6 hover:bg-slate-50/50 transition-colors">
                                    <div class="flex justify-between items-start mb-6">
                                        <div class="flex items-center gap-3">
                                            <div class="size-8 rounded-lg bg-slate-700 flex items-center justify-center text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-slate-900">{{ $sim->motor_name }}</h4>
                                                <p class="text-[10px] text-slate-500 uppercase tracking-wider">{{ $sim->created_at->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                        <form action="{{ route('simulations.destroy', $sim) }}" method="POST" onsubmit="return confirm('Hapus simulasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-300 hover:text-rose-500 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="space-y-4">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-slate-500">Uang Muka</span>
                                            <span class="font-bold text-slate-900">Rp {{ number_format($sim->dp, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-slate-500">Tenor</span>
                                            <span class="font-bold text-slate-900">{{ $sim->tenor }} Bulan</span>
                                        </div>
                                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100/50">
                                            <span class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] block mb-2">Cicilan Per Bulan</span>
                                            <div class="flex items-baseline gap-1">
                                                <span class="text-xl font-black text-slate-900">Rp {{ number_format($sim->monthly_installment, 0, ',', '.') }}</span>
                                                <span class="text-xs text-slate-500">/bln</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>