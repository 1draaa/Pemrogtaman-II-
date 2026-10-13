<x-layouts::customer :title="__('Dashboard Pelanggan')">
    <!-- Header -->
    <header class="bg-white/80 backdrop-blur-xl border-b border-slate-200 px-10 py-8 sticky top-0 z-40">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-4xl font-extrabold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">Dashboard</h2>
                <p class="text-slate-500 mt-2 font-medium">Selamat datang kembali, {{ auth()->user()->name }}!</p>
            </div>
            <div class="flex items-center gap-6">
                <button class="relative p-4 bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-800 rounded-2xl transition-all duration-300 shadow-sm hover:shadow">
                    <span class="material-symbols-outlined text-2xl">notifications</span>
                </button>
            </div>
        </div>
    </header>

    <div class="p-10">

            @if(session('success'))
                <div class="mb-8 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl shadow-lg">
                    <p class="font-bold text-lg">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Alert Banner (Only if there are rejected documents) -->
            @if($application && $hasRejectedDocuments && $application->catatan_admin)
            <div class="mb-8 bg-gradient-to-r from-rose-50 to-pink-50 border border-rose-200 rounded-3xl p-6 flex items-start gap-5 shadow-lg">
                <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-100 to-pink-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-rose-600" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="font-extrabold text-rose-800 text-xl">{{ __('Dokumen Perlu Diperbaiki') }}</h3>
                    <p class="text-base text-rose-700 mt-2 font-medium">{{ $application->catatan_admin }}</p>
                </div>
                <a href="{{ route('customer.dokumen') }}" class="px-8 py-4 bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white text-base font-bold rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl">
                    {{ __('Perbaiki Sekarang') }}
                </a>
            </div>
            @endif

            <div class="space-y-8">
                <!-- Status Pengajuan Card -->
                <div class="bg-white shadow-2xl rounded-3xl p-10 border border-slate-200">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
                        <h2 class="text-3xl font-extrabold text-slate-900">{{ __('Status Pengajuan Kredit') }}</h2>
                        @if($application && in_array($application->status, ['pending', 'perlu_unggah_ulang']))
                            <form action="{{ route('customer.pengajuan.destroy', $application->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-rose-100 to-pink-100 text-rose-700 text-base font-bold rounded-2xl hover:from-rose-200 hover:to-pink-200 transition-all duration-300 shadow-sm hover:shadow">
                                    {{ __('Hapus Pengajuan') }}
                                </button>
                            </form>
                        @endif
                    </div>
                    
                    <!-- Stepper 5 Tahap -->
                    <div class="relative">
                        @php
                            $isError = $application && in_array($application->status, ['perlu_unggah_ulang', 'rejected']);
                        @endphp
                        
                        <!-- Error Alert if needed -->
                        @if($application && $isError)
                            <div class="mb-10 bg-gradient-to-r from-rose-50 to-pink-50 border border-rose-200 rounded-3xl p-6 flex items-start gap-5">
                                <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-100 to-pink-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-rose-600" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-extrabold text-rose-800 text-xl">
                                        @if($application->status === 'rejected')
                                            {{ __('Pengajuan Ditolak') }}
                                        @else
                                            {{ __('Dokumen Perlu Diperbaiki') }}
                                        @endif
                                    </h3>
                                    @if($application->catatan_admin)
                                        <p class="text-base text-rose-700 mt-2 font-medium">{{ $application->catatan_admin }}</p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- WADAH UTAMA (CONTAINER) untuk 5 Steps -->
                        <style>
                            .stepper-progress-bg {
                                background-color: #deff9a;
                            }
                        </style>
                        <div class="relative w-full mx-auto mt-4 mb-8">
                            <!-- GARIS PENGHUBUNG (TRACK LINE) - Lebih tebal (8px = h-2), warna aktif #deff9a -->
                            <div class="absolute top-4 left-0 w-full h-2 bg-slate-200 z-0 rounded-full"></div>
                            <div id="stepper-progress" class="absolute top-4 left-0 h-2 stepper-progress-bg z-0 rounded-full transition-all duration-500" data-width="{{ $persentase_progres }}"></div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const progressBar = document.getElementById('stepper-progress');
                                    if (progressBar) {
                                        progressBar.style.width = progressBar.getAttribute('data-width') + '%';
                                    }
                                });
                            </script>

                            <!-- ITEM LINGKARAN (5 STEPS) -->
                            <div class="relative z-10 flex justify-between w-full">
                                <!-- Step 1: Berkas Terkirim -->
                                <div class="flex flex-col items-center text-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold shadow-lg
                                        @if($currentStep >= 0) stepper-progress-bg text-slate-900 @else bg-white border-2 border-slate-200 text-slate-400 @endif">
                                        @if($currentStep >= 0)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @else
                                            1
                                        @endif
                                    </div>
                                    <span class="text-xs mt-2 font-medium @if($currentStep >= 0) text-slate-900 @else text-slate-500 @endif">{{ __('Berkas Terkirim') }}</span>
                                </div>

                                <!-- Step 2: Verifikasi Admin -->
                                <div class="flex flex-col items-center text-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold shadow-lg
                                        @if($currentStep >= 1) stepper-progress-bg text-slate-900 @else bg-white border-2 border-slate-200 text-slate-400 @endif">
                                        @if($currentStep >= 1)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @else
                                            2
                                        @endif
                                    </div>
                                    <span class="text-xs mt-2 font-medium @if($currentStep >= 1) text-slate-900 @else text-slate-500 @endif">{{ __('Verifikasi Admin') }}</span>
                                </div>

                                <!-- Step 3: Survei Lapangan -->
                                <div class="flex flex-col items-center text-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold shadow-lg
                                        @if($currentStep >= 2) stepper-progress-bg text-slate-900 @else bg-white border-2 border-slate-200 text-slate-400 @endif">
                                        @if($currentStep >= 2)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @else
                                            3
                                        @endif
                                    </div>
                                    <span class="text-xs mt-2 font-medium @if($currentStep >= 2) text-slate-900 @else text-slate-500 @endif">{{ __('Survei Lapangan') }}</span>
                                </div>

                                <!-- Step 4: Persetujuan Leasing -->
                                <div class="flex flex-col items-center text-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold shadow-lg
                                        @if($currentStep >= 3) stepper-progress-bg text-slate-900 @else bg-white border-2 border-slate-200 text-slate-400 @endif">
                                        @if($currentStep >= 3)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @else
                                            4
                                        @endif
                                    </div>
                                    <span class="text-xs mt-2 font-medium @if($currentStep >= 3) text-slate-900 @else text-slate-500 @endif">{{ __('Persetujuan Leasing') }}</span>
                                </div>

                                <!-- Step 5: Selesai (Unit Terkirim) -->
                                <div class="flex flex-col items-center text-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold shadow-lg
                                        @if($currentStep >= 4) stepper-progress-bg text-slate-900 @else bg-white border-2 border-slate-200 text-slate-400 @endif">
                                        @if($currentStep >= 4)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @else
                                            5
                                        @endif
                                    </div>
                                    <span class="text-xs mt-2 font-medium @if($currentStep >= 4) text-slate-900 @else text-slate-500 @endif">{{ __('Selesai') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grid Content - Dokumen dan Ringkasan -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    <!-- Kolom Kiri: Dokumen -->
                    <div class="lg:col-span-7">
                        <div class="bg-white shadow-2xl rounded-3xl p-10 h-full border border-slate-200">
                            <div class="flex flex-col md:flex-row items-center justify-between mb-8 gap-6">
                                <h3 class="text-2xl font-extrabold text-slate-900">{{ __('Dokumen yang Diperlukan') }}</h3>
                                <span class="text-lg text-slate-500 font-bold">
                                    {{ $application ? ($documents['ktp']['uploaded'] + $documents['kk']['uploaded'] + $documents['slip_gaji']['uploaded']) : 0 }} dari 3
                                </span>
                            </div>
                            
                            <div class="space-y-6">
                                <!-- KTP -->
                                <div class="flex items-center justify-between p-6 bg-gradient-to-r from-slate-50 to-slate-100 rounded-2xl hover:from-slate-100 hover:to-slate-200 transition-all duration-300 border border-slate-200 hover:border-slate-300">
                                    <div class="flex items-center gap-5">
                                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-all duration-300
                                            @if($application && $documents['ktp']['status'] == 'verified') bg-gradient-to-br from-emerald-100 to-teal-100 @elseif($application && $documents['ktp']['status'] == 'rejected') bg-gradient-to-br from-rose-100 to-pink-100 @else bg-gradient-to-br from-amber-100 to-orange-100 @endif">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 transition-all duration-300
                                                @if($application && $documents['ktp']['status'] == 'verified') text-emerald-600 @elseif($application && $documents['ktp']['status'] == 'rejected') text-rose-600 @else text-amber-600 @endif" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-extrabold text-slate-900 text-lg">{{ __('KTP') }}</p>
                                            <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold mt-2 transition-all duration-300
                                                @if($application && $documents['ktp']['status'] == 'verified') bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-700 @elseif($application && $documents['ktp']['status'] == 'rejected') bg-gradient-to-r from-rose-100 to-pink-100 text-rose-700 @elseif($application && $documents['ktp']['uploaded']) bg-gradient-to-r from-amber-100 to-orange-100 text-amber-700 @else bg-gradient-to-r from-amber-100 to-orange-100 text-amber-700 @endif">
                                                @if($application)
                                                    @if($documents['ktp']['status'] == 'verified')
                                                        {{ __('Terverifikasi') }}
                                                    @elseif($documents['ktp']['status'] == 'rejected')
                                                        {{ __('Perlu Unggah Ulang') }}
                                                    @elseif($documents['ktp']['uploaded'])
                                                        {{ __('Menunggu Verifikasi') }}
                                                    @else
                                                        {{ __('Belum Diunggah') }}
                                                    @endif
                                                @else
                                                    {{ __('Belum Diunggah') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    @if($application && $documents['ktp']['uploaded'])
                                        <a href="{{ asset("storage/{$application->dokumen_ktp}") }}" target="_blank" class="px-6 py-3 bg-gradient-to-r from-slate-100 to-slate-200 hover:from-slate-200 hover:to-slate-300 text-slate-700 text-base font-bold rounded-2xl transition-all duration-300 shadow-sm hover:shadow">
                                            {{ __('Lihat') }}
                                        </a>
                                    @elseif($application)
                                        <a href="{{ route('customer.dokumen') }}" class="px-6 py-3 bg-gradient-to-r from-slate-900 to-slate-800 hover:from-slate-800 hover:to-slate-700 text-white text-base font-bold rounded-2xl transition-all duration-300 shadow-xl shadow-slate-900/10 hover:shadow-2xl">
                                            {{ __('Unggah') }}
                                        </a>
                                    @else
                                        <a href="{{ route('katalog') }}" class="px-6 py-3 bg-slate-900 text-white text-base font-bold rounded-2xl hover:bg-slate-800 transition">
                                            {{ __('Pilih Unit Dulu') }}
                                        </a>
                                    @endif
                                </div>

                                <!-- KK -->
                                <div class="flex items-center justify-between p-6 bg-gradient-to-r from-slate-50 to-slate-100 rounded-2xl hover:from-slate-100 hover:to-slate-200 transition-all duration-300 border border-slate-200 hover:border-slate-300">
                                    <div class="flex items-center gap-5">
                                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-all duration-300
                                            @if($application && $documents['kk']['status'] == 'verified') bg-gradient-to-br from-emerald-100 to-teal-100 @elseif($application && $documents['kk']['status'] == 'rejected') bg-gradient-to-br from-rose-100 to-pink-100 @else bg-gradient-to-br from-amber-100 to-orange-100 @endif">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 transition-all duration-300
                                                @if($application && $documents['kk']['status'] == 'verified') text-emerald-600 @elseif($application && $documents['kk']['status'] == 'rejected') text-rose-600 @else text-amber-600 @endif" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-extrabold text-slate-900 text-lg">{{ __('Kartu Keluarga (KK)') }}</p>
                                            <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold mt-2 transition-all duration-300
                                                @if($application && $documents['kk']['status'] == 'verified') bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-700 @elseif($application && $documents['kk']['status'] == 'rejected') bg-gradient-to-r from-rose-100 to-pink-100 text-rose-700 @elseif($application && $documents['kk']['uploaded']) bg-gradient-to-r from-amber-100 to-orange-100 text-amber-700 @else bg-gradient-to-r from-amber-100 to-orange-100 text-amber-700 @endif">
                                                @if($application)
                                                    @if($documents['kk']['status'] == 'verified')
                                                        {{ __('Terverifikasi') }}
                                                    @elseif($documents['kk']['status'] == 'rejected')
                                                        {{ __('Perlu Unggah Ulang') }}
                                                    @elseif($documents['kk']['uploaded'])
                                                        {{ __('Menunggu Verifikasi') }}
                                                    @else
                                                        {{ __('Belum Diunggah') }}
                                                    @endif
                                                @else
                                                    {{ __('Belum Diunggah') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    @if($application && $documents['kk']['uploaded'])
                                        <a href="{{ asset("storage/{$application->dokumen_kk}") }}" target="_blank" class="px-6 py-3 bg-gradient-to-r from-slate-100 to-slate-200 hover:from-slate-200 hover:to-slate-300 text-slate-700 text-base font-bold rounded-2xl transition-all duration-300 shadow-sm hover:shadow">
                                            {{ __('Lihat') }}
                                        </a>
                                    @elseif($application)
                                        <a href="{{ route('customer.dokumen') }}" class="px-6 py-3 bg-gradient-to-r from-slate-900 to-slate-800 hover:from-slate-800 hover:to-slate-700 text-white text-base font-bold rounded-2xl transition-all duration-300 shadow-xl shadow-slate-900/10 hover:shadow-2xl">
                                            {{ __('Unggah') }}
                                        </a>
                                    @else
                                        <a href="{{ route('katalog') }}" class="px-6 py-3 bg-slate-900 text-white text-base font-bold rounded-2xl hover:bg-slate-800 transition">
                                            {{ __('Pilih Unit Dulu') }}
                                        </a>
                                    @endif
                                </div>

                                <!-- Slip Gaji -->
                                <div class="flex items-center justify-between p-6 bg-gradient-to-r from-slate-50 to-slate-100 rounded-2xl hover:from-slate-100 hover:to-slate-200 transition-all duration-300 border border-slate-200 hover:border-slate-300">
                                    <div class="flex items-center gap-5">
                                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-all duration-300
                                            @if($application && $documents['slip_gaji']['status'] == 'verified') bg-gradient-to-br from-emerald-100 to-teal-100 @elseif($application && $documents['slip_gaji']['status'] == 'rejected') bg-gradient-to-br from-rose-100 to-pink-100 @else bg-gradient-to-br from-amber-100 to-orange-100 @endif">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 transition-all duration-300
                                                @if($application && $documents['slip_gaji']['status'] == 'verified') text-emerald-600 @elseif($application && $documents['slip_gaji']['status'] == 'rejected') text-rose-600 @else text-amber-600 @endif" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-extrabold text-slate-900 text-lg">{{ __('Slip Gaji') }}</p>
                                            <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold mt-2 transition-all duration-300
                                                @if($application && $documents['slip_gaji']['status'] == 'verified') bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-700 @elseif($application && $documents['slip_gaji']['status'] == 'rejected') bg-gradient-to-r from-rose-100 to-pink-100 text-rose-700 @elseif($application && $documents['slip_gaji']['uploaded']) bg-gradient-to-r from-amber-100 to-orange-100 text-amber-700 @else bg-gradient-to-r from-amber-100 to-orange-100 text-amber-700 @endif">
                                                @if($application)
                                                    @if($documents['slip_gaji']['status'] == 'verified')
                                                        {{ __('Terverifikasi') }}
                                                    @elseif($documents['slip_gaji']['status'] == 'rejected')
                                                        {{ __('Perlu Unggah Ulang') }}
                                                    @elseif($documents['slip_gaji']['uploaded'])
                                                        {{ __('Menunggu Verifikasi') }}
                                                    @else
                                                        {{ __('Belum Diunggah') }}
                                                    @endif
                                                @else
                                                    {{ __('Belum Diunggah') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    @if($application && $documents['slip_gaji']['uploaded'])
                                        <a href="{{ asset("storage/{$application->dokumen_slip_gaji}") }}" target="_blank" class="px-6 py-3 bg-gradient-to-r from-slate-100 to-slate-200 hover:from-slate-200 hover:to-slate-300 text-slate-700 text-base font-bold rounded-2xl transition-all duration-300 shadow-sm hover:shadow">
                                            {{ __('Lihat') }}
                                        </a>
                                    @elseif($application)
                                        <a href="{{ route('customer.dokumen') }}" class="px-6 py-3 bg-gradient-to-r from-slate-900 to-slate-800 hover:from-slate-800 hover:to-slate-700 text-white text-base font-bold rounded-2xl transition-all duration-300 shadow-xl shadow-slate-900/10 hover:shadow-2xl">
                                            {{ __('Unggah') }}
                                        </a>
                                    @else
                                        <a href="{{ route('katalog') }}" class="px-6 py-3 bg-slate-900 text-white text-base font-bold rounded-2xl hover:bg-slate-800 transition">
                                            {{ __('Pilih Unit Dulu') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Ringkasan Kredit -->
                    <div class="lg:col-span-5">
                        <div class="bg-white shadow-2xl rounded-3xl p-10 border border-slate-200">
                            <h3 class="text-2xl font-extrabold text-slate-900 mb-8">{{ __('Ringkasan Unit & Kredit') }}</h3>
                            
                            @if($application?->motor)
                            <!-- Thumbnail Motor -->
                            <div class="mb-8">
                                <div class="aspect-video w-full rounded-3xl overflow-hidden mb-6 bg-gradient-to-br from-slate-100 to-slate-200 shadow-xl">
                                    @php
                                        $motImage = null;
                                        if ($application->motor->galleries && $application->motor->galleries->isNotEmpty()) {
                                            $motImage = $application->motor->galleries->first()->foto_path;
                                        } elseif ($application->motor->image) {
                                            $motImage = $application->motor->image;
                                        }
                                    @endphp
                                    @if($motImage)
                                        <img src="{{ Str::startsWith($motImage, 'http') ? $motImage : asset('storage/' . $motImage) }}" 
                                             alt="{{ $application->motor->name }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <h4 class="text-xl font-extrabold text-slate-900">{{ $application->motor->name }}</h4>
                            </div>

                            <!-- Detail -->
                            <div class="space-y-5 mb-8">
                                <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                                    <span class="text-base font-bold text-slate-600">{{ __('Harga Motor') }}</span>
                                    <span class="text-2xl font-black text-slate-900">Rp {{ number_format($application->motor->price, 0, ',', '.') }}</span>
                                </div>
                                @if($application->tenor)
                                <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                                    <span class="text-base font-bold text-slate-600">{{ __('Tenor') }}</span>
                                    <span class="text-2xl font-black text-slate-900">{{ $application->tenor }} Bulan</span>
                                </div>
                                @else
                                <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                                    <span class="text-base font-bold text-slate-600">{{ __('Tenor') }}</span>
                                    <span class="text-2xl font-black text-slate-900">-</span>
                                </div>
                                @endif
                                @if($application->down_payment)
                                <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                                    <span class="text-base font-bold text-slate-600">{{ __('Uang Muka') }}</span>
                                    <span class="text-2xl font-black text-slate-900">Rp {{ number_format($application->down_payment, 0, ',', '.') }}</span>
                                </div>
                                @else
                                <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                                    <span class="text-base font-bold text-slate-600">{{ __('Uang Muka') }}</span>
                                    <span class="text-2xl font-black text-slate-900">-</span>
                                </div>
                                @endif
                            </div>

                            <!-- Estimasi Cicilan -->
                            @if($application->monthly_installment)
                            <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl p-8 text-center text-white shadow-2xl">
                                <p class="text-base font-bold text-slate-300 mb-3">{{ __('Estimasi Cicilan/Bulan') }}</p>
                                <p class="text-4xl font-black">Rp {{ number_format($application->monthly_installment, 0, ',', '.') }}</p>
                                @if($application->leasing)
                                <p class="text-sm text-slate-400 mt-4 font-semibold">{{ $application->leasing->name }}</p>
                                @endif
                            </div>
                            @else
                            <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl p-8 text-center text-white shadow-2xl">
                                <p class="text-base font-bold text-slate-300 mb-3">{{ __('Estimasi Cicilan/Bulan') }}</p>
                                <p class="text-4xl font-black">Rp 0</p>
                            </div>
                            @endif
                            @else
                            <!-- Placeholder when no application -->
                            <!-- Thumbnail Placeholder -->
                            <div class="mb-8">
                                <div class="bg-slate-100 rounded-lg h-32 flex items-center justify-center text-slate-400 text-sm">
                                    Belum ada unit
                                </div>
                                <h4 class="text-xl font-extrabold text-slate-900 mt-6">Belum Ada Pengajuan</h4>
                            </div>

                            <!-- Detail Placeholder -->
                            <div class="space-y-5 mb-8">
                                <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                                    <span class="text-base font-bold text-slate-600">{{ __('Harga Motor') }}</span>
                                    <span class="text-2xl font-black text-slate-900">-</span>
                                </div>
                                <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                                    <span class="text-base font-bold text-slate-600">{{ __('Tenor') }}</span>
                                    <span class="text-2xl font-black text-slate-900">-</span>
                                </div>
                                <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                                    <span class="text-base font-bold text-slate-600">{{ __('Uang Muka') }}</span>
                                    <span class="text-2xl font-black text-slate-900">-</span>
                                </div>
                            </div>

                            <!-- Estimasi Cicilan Placeholder -->
                            <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl p-8 text-center text-white shadow-2xl">
                                <p class="text-base font-bold text-slate-300 mb-3">{{ __('Estimasi Cicilan/Bulan') }}</p>
                                <p class="text-4xl font-black">Rp 0</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::customer>
