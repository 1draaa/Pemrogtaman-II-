<x-frontend-layout title="{{ $motor->name }} | MotoLease">
    <main class="pt-24 relative">
        <section class="max-w-7xl mx-auto px-6 py-10">
            <!-- Breadcrumb -->
            <div class="mb-8">
                <nav class="flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a>
                    <span class="material-symbols-outlined text-xs">chevron_right</span>
                    <a href="{{ route('katalog') }}" class="hover:text-primary transition-colors">Katalog</a>
                    <span class="material-symbols-outlined text-xs">chevron_right</span>
                    <span class="text-on-background font-semibold">{{ $motor->name }}</span>
                </nav>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <!-- Kolom Kiri: Gambar & Spesifikasi -->
                <div class="lg:col-span-8 space-y-8">
                    @php
                        $galleryImages = [];
                        
                        foreach ($motor->galleries as $gallery) {
                            $galleryImages[] = $gallery->foto_path;
                        }
                        
                        if (empty($galleryImages)) {
                            if ($motor->image) {
                                $galleryImages[] = $motor->image;
                            } else {
                                $galleryImages[] = 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=2070&auto=format&fit=crop';
                            }
                        }
                    @endphp
                    
                    <!-- Area Gambar dengan SLIDER -->
                    <div x-data="{ activeSlide: 0, slides: {{ json_encode($galleryImages) }} }">
                        <!-- Gambar Utama Besar -->
                        <div class="relative w-full aspect-[4/3] md:aspect-video overflow-hidden rounded-2xl">
                            <template x-for="(slide, index) in slides" :key="index">
                                <div 
                                    x-show="activeSlide === index"
                                    x-transition:enter="transition-transform duration-500 ease-out"
                                    x-transition:enter-start="transform translate-x-full"
                                    x-transition:enter-end="transform translate-x-0"
                                    x-transition:leave="transition-transform duration-500 ease-in"
                                    x-transition:leave-start="transform translate-x-0"
                                    x-transition:leave-end="transform -translate-x-full"
                                    class="absolute inset-0 w-full h-full"
                                >
                                    <img 
                                        :src="slide.startsWith('http') ? slide : '{{ asset('storage') }}/' + slide" 
                                        alt="{{ $motor->name }}" 
                                        class="w-full h-full object-cover"
                                    >
                                </div>
                            </template>

                            <!-- Panah Navigasi -->
                            @if(count($galleryImages) > 1)
                                <button 
                                    @click="activeSlide = (activeSlide - 1 + slides.length) % slides.length"
                                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-gradient-to-br from-slate-800 to-slate-950 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-xl shadow-slate-900/30 transition-all hover:scale-110 hover:from-slate-700 hover:to-slate-900"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 stroke-white" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <button 
                                    @click="activeSlide = (activeSlide + 1) % slides.length"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-gradient-to-br from-slate-800 to-slate-950 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-xl shadow-slate-900/30 transition-all hover:scale-110 hover:from-slate-700 hover:to-slate-900"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 stroke-white" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Header Info -->
                    <div>
                        <h1 class="text-3xl md:text-4xl font-headline font-extrabold text-on-background uppercase">{{ $motor->name }}</h1>
                        <p class="text-lg text-slate-500 mt-2">Tahun {{ $motor->year }}</p>
                    </div>

                    <!-- Grid Spesifikasi Cepat - LEFT ALIGNED -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <!-- Tipe -->
                        <div class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant/30 text-left">
                            <div class="flex items-start gap-3 mb-2 text-left">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <span class="text-xs font-semibold text-slate-500 uppercase text-left">Tipe</span>
                            </div>
                            <p class="text-lg font-bold text-on-background text-left">{{ $motor->type }}</p>
                        </div>

                        <!-- Odometer -->
                        <div class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant/30 text-left">
                            <div class="flex items-start gap-3 mb-2 text-left">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                                <span class="text-xs font-semibold text-slate-500 uppercase text-left">Odometer</span>
                            </div>
                            <p class="text-lg font-bold text-on-background text-left">{{ number_format($motor->odometer, 0, ',', '.') }} km</p>
                        </div>

                        <!-- Brand -->
                        <div class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant/30 text-left">
                            <div class="flex items-start gap-3 mb-2 text-left">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <span class="text-xs font-semibold text-slate-500 uppercase text-left">Brand</span>
                            </div>
                            <p class="text-lg font-bold text-on-background text-left">{{ $motor->brand }}</p>
                        </div>

                        <!-- Pajak -->
                        <div class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant/30 text-left">
                            <div class="flex items-start gap-3 mb-2 text-left">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                <span class="text-xs font-semibold text-slate-500 uppercase text-left">Pajak</span>
                            </div>
                            <p class="text-lg font-bold text-on-background text-left">{{ $motor->tax_status }}</p>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/30">
                        <h3 class="text-xl font-headline font-bold text-on-background mb-4">Deskripsi</h3>
                        <p class="text-slate-600 leading-relaxed">
                            {{ $motor->description ?? 'Unit terawat, mesin halus, surat-surat lengkap dan dijamin keabsahannya. Kendaraan ini telah melalui inspeksi menyeluruh oleh tim teknis profesional kami.' }}
                        </p>
                    </div>
                </div>

                <!-- Kolom Kanan: Simulator Kredit Interaktif -->
                <div class="lg:col-span-4">
                    <div class="sticky top-28 bg-surface-container-lowest rounded-2xl shadow-[0_20px_40px_rgba(0,30,64,0.06)] overflow-hidden">
                        <!-- Header -->
                        <div class="bg-primary p-6 text-white">
                            <div class="flex items-center gap-3 mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                <h3 class="text-xl font-headline font-extrabold">Simulator Kredit</h3>
                            </div>
                            <p class="text-blue-100/70 text-sm mt-1">Estimasi cicilan bulanan presisi Anda.</p>
                        </div>

                        <!-- Konten Simulator -->
                        <div class="p-6">
                            <!-- Harga -->
                            <div class="mb-6">
                                <span class="text-sm font-semibold text-slate-500 uppercase">Harga Tunai</span>
                                <p class="text-3xl font-headline font-black text-on-background mt-2">Rp {{ number_format($motor->price, 0, ',', '.') }}</p>
                            </div>

                            <hr class="border-outline-variant/30 mb-6">

                            <!-- Slider Inputs -->
                            <div class="space-y-8" x-data="simulatorData({{ $motor->price }})">
                                <!-- Uang Muka -->
                                <div>
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="text-sm font-bold text-primary uppercase tracking-wider">Uang Muka</span>
                                        <span class="text-base font-bold text-on-background" x-text="'Rp ' + dpNominal.toLocaleString('id-ID')"></span>
                                    </div>
                                    <div class="relative">
                                        <input 
                                            type="range" 
                                            x-model="dpPersen"
                                            min="10" 
                                            max="60" 
                                            step="5"
                                            class="w-full h-1.5 bg-surface-container-high rounded-lg appearance-none cursor-pointer accent-primary"
                                        >
                                        <div class="flex justify-between text-xs font-bold text-slate-400 mt-2">
                                            <span>10%</span>
                                            <span>60%</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tenor -->
                                <div>
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="text-sm font-bold text-primary uppercase tracking-wider">Tenor (Bulan)</span>
                                        <span class="text-base font-bold text-on-background" x-text="tenor + ' BLN'"></span>
                                    </div>
                                    <div class="relative">
                                        <input 
                                            type="range" 
                                            x-model="tenor"
                                            min="12" 
                                            max="60" 
                                            step="12"
                                            class="w-full h-1.5 bg-surface-container-high rounded-lg appearance-none cursor-pointer accent-primary"
                                        >
                                        <div class="flex justify-between text-xs font-bold text-slate-400 mt-2">
                                            <span>12 BLN</span>
                                            <span>60 BLN</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kotak Estimasi -->
                                <div class="bg-surface-container-low rounded-xl p-5 mt-6">
                                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Estimasi Cicilan Bulanan</p>
                                    <p class="text-4xl font-headline font-black text-primary" x-text="'Rp ' + cicilanBulanan.toLocaleString('id-ID')"></p>
                                </div>

                                <!-- Form & Tombol -->
                                <form action="{{ route('pengajuan.create') }}" method="GET" class="mt-6">
                                    <input type="hidden" name="motor_id" value="{{ $motor->id }}">
                                    <input type="hidden" name="dp" x-model="dpNominal">
                                    <input type="hidden" name="tenor" x-model="tenor">

                                    <button 
                                        type="submit" 
                                        class="w-full bg-primary text-white py-4 rounded-xl font-bold text-lg hover:bg-primary-container transition-all shadow-lg shadow-primary/10"
                                    >
                                        Ajukan Pembiayaan Sekarang
                                    </button>

                                    <div class="flex items-center justify-center gap-2 mt-4 text-sm text-slate-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <span>Diamankan oleh Sistem MotoLease</span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            function simulatorData(hargaAwal) {
                return {
                    dpPersen: 15,
                    tenor: 36,

                    init() {
                        this.$watch('dpPersen', () => {
                            if (this.dpPersen < 10) this.dpPersen = 10;
                            if (this.dpPersen > 60) this.dpPersen = 60;
                        });
                    },

                    get dpNominal() {
                        return Math.round(hargaAwal * (this.dpPersen / 100));
                    },

                    get cicilanBulanan() {
                        const pokokHutang = hargaAwal - this.dpNominal;
                        const totalBunga = pokokHutang * 0.08 * (this.tenor / 12);
                        return Math.round((pokokHutang + totalBunga) / this.tenor);
                    }
                };
            }
        </script>
    </main>
</x-frontend-layout>