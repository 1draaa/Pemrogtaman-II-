<x-frontend-layout>
    <main class="pt-24 relative">
        <!-- Hero Section -->
        <section class="relative min-h-[716px] flex items-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-gradient-to-r from-primary via-primary-container to-transparent z-10 opacity-90"></div>
                <img alt="Presisi Mekanis" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA4s3D4yjERMgiDkK6__YJQ4DzgFDdRyrqeHjS-EVubl_K638sHRI6x82VtOT3-XgKEJ5mTb1EwDuA4Ipco2021Xq6kuiq9OZY_Am689PGXmAetJc6bRlqocNvIqAU9FH30FdZGaBzJF7Oq8a4VpstMpEsZCkqNqRgwr9h3wLVVM7KFaPhxlkPbWKuQBBl76iYiWf-ZmOPsxiXcSCAREC8jlOr8Lz1JmZXU1fOoFcfQ2ESbbkZS-rS5BWjNZNNURjAEfAlkXxch4Daj"/>
            </div>
            <div class="relative z-20 max-w-7xl mx-auto px-6 py-20 w-full">
                <div class="max-w-2xl">
                    <h1 class="text-white font-headline font-extrabold text-6xl leading-[1.1] mb-6 tracking-tight">
                        Presisi <span class="text-on-primary-container">Mekanis</span> dalam Pembiayaan.
                    </h1>
                    <p class="text-blue-100/80 text-xl mb-10 leading-relaxed font-light">
                        Percepat perjalanan Anda dengan MotoLease. Pembiayaan langsung untuk motor bekas premium dengan persetujuan real-time dan verifikasi dealer terintegrasi.
                    </p>
                </div>
            </div>
        </section>

        <!-- Main Content Layout -->
        <section class="max-w-7xl mx-auto px-6 py-20 grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Motorcycle Catalog -->
            <div class="lg:col-span-8">
                <div class="flex justify-between items-end mb-10">
                    <div>
                        <h2 class="text-3xl font-headline font-extrabold text-primary mb-2">Katalog Unggulan</h2>
                        <p class="text-slate-500 font-medium">Performa mekanis terverifikasi dan surat-surat lengkap.</p>
                    </div>
                    <a href="{{ route('katalog') }}" class="text-primary font-bold flex items-center gap-1 hover:gap-2 transition-all">
                        Lihat Semua <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($motors as $motor)
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
                        
                        <!-- Card Container -->
                        <div id="motor-card-{{ Str::slug($motor->name) }}" class="motor-card bg-white rounded-xl overflow-hidden border border-slate-200 transition-all duration-300 hover:-translate-y-1 relative group">
                            <!-- Slider Area (NOT inside <a>) -->
                            @if(count($galleryImages) > 1)
                                <div 
                                    x-data="{ activeSlide: 0, slides: {{ json_encode($galleryImages) }} }"
                                    class="relative w-full aspect-[4/3] overflow-hidden"
                                >
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
                                    <button 
                                        @click="activeSlide = (activeSlide - 1 + slides.length) % slides.length"
                                        type="button"
                                        class="absolute left-3 top-1/2 -translate-y-1/2 bg-gradient-to-br from-slate-800 to-slate-950 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-xl shadow-slate-900/30 transition-all opacity-0 group-hover:opacity-100 z-10 hover:scale-110 hover:from-slate-700 hover:to-slate-900"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-white" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </button>
                                    <button 
                                        @click="activeSlide = (activeSlide + 1) % slides.length"
                                        type="button"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 bg-gradient-to-br from-slate-800 to-slate-950 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-xl shadow-slate-900/30 transition-all opacity-0 group-hover:opacity-100 z-10 hover:scale-110 hover:from-slate-700 hover:to-slate-900"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-white" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                    
                                    <!-- Indikator dots -->
                                    <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                                        <template x-for="(slide, index) in slides" :key="index">
                                            <button 
                                                @click="activeSlide = index"
                                                type="button"
                                                :class="activeSlide === index ? 'w-8 bg-gradient-to-r from-slate-800 to-slate-900' : 'w-3 bg-white/70'"
                                                class="h-3 rounded-full transition-all duration-300 shadow-lg"
                                            ></button>
                                        </template>
                                    </div>
                                </div>
                            @else
                                <!-- Single Image -->
                                <div class="relative w-full aspect-[4/3] overflow-hidden">
                                    <img 
                                        src="{{ $galleryImages[0] ? (Str::startsWith($galleryImages[0], 'http') ? $galleryImages[0] : asset('storage/' . $galleryImages[0])) : 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=2070&auto=format&fit=crop' }}" 
                                        alt="{{ $motor->name }}" 
                                        class="w-full h-full object-cover"
                                    >
                                </div>
                            @endif
                            
                            <!-- Tag Promosi -->
                            @if($motor->tag_promosi)
                                <div class="absolute top-3 left-3 bg-primary text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest z-20">
                                    {{ $motor->tag_promosi }}
                                </div>
                            @endif
                            
                            <!-- Linkable Area (Info & Select Button) -->
                            <div class="p-5">
                                <!-- BARIS 1: HARGA -->
                                <p class="text-xl font-bold text-slate-900">Rp {{ number_format($motor->price, 0, ',', '.') }}</p>
                                
                                <!-- BARIS 2: ANGSURAN -->
                                <p class="text-sm text-slate-500 mt-1">
                                    Angsuran <span class="font-bold">Rp {{ number_format(round(($motor->price - ($motor->price * 0.10)) / 60), 0, ',', '.') }}/bulan</span>
                                </p>
                                
                                <!-- BARIS 3: NAMA MOTOR -->
                                <h3 class="font-semibold text-slate-800 uppercase mt-4">{{ $motor->name }}</h3>
                                
                                <!-- BARIS 4: TAHUN & KM -->
                                <p class="text-sm text-slate-500 mt-1 mb-4">{{ $motor->year }} | {{ number_format($motor->odometer, 0, ',', '.') }} km</p>
                                
                                <!-- Button untuk Select Motor (untuk simulator) -->
                                <button class="btn-select-motor bg-secondary-container text-on-secondary-container px-3 py-2 rounded-lg hover:bg-primary hover:text-white transition-colors text-xs font-bold w-full" 
                                        data-name="{{ $motor->name }}" 
                                        data-price="{{ $motor->price }}"
                                        data-slug="{{ Str::slug($motor->name) }}"
                                        data-motor-id="{{ $motor->id }}">
                                    Simulasi
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Floating Credit Simulator Widget -->
            <div class="lg:col-span-4">
                <div id="simulator-widget" class="sticky top-28 bg-white rounded-2xl shadow-[0_20px_40px_rgba(0,30,64,0.06)] overflow-hidden">
                    <div class="bg-primary p-6 text-white">
                        <h3 class="text-xl font-headline font-extrabold flex items-center gap-2">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">analytics</span>
                            Simulator Kredit
                        </h3>
                        <p class="text-blue-100/70 text-sm mt-1">Estimasi cicilan bulanan presisi Anda.</p>
                    </div>
                    <div class="p-8 space-y-8">
                        <!-- Selected Motor Info -->
                        <div class="bg-surface-container-high p-4 rounded-xl border border-outline-variant/30">
                            <p class="text-xs font-bold text-slate-500 uppercase mb-1">Motor Terpilih</p>
                            <div class="flex justify-between items-center">
                                <span id="selected-motor-name" class="font-headline font-bold text-primary">Pilih Motor di Katalog</span>
                                <span id="selected-motor-price" class="text-sm font-extrabold text-primary">-</span>
                            </div>
                        </div>

                        <!-- Down Payment Slider -->
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <label class="text-sm font-bold text-primary uppercase tracking-wider">Uang Muka</label>
                                <span id="dp-display" class="text-lg font-extrabold text-primary">Rp 0</span>
                            </div>
                            <input id="dp-slider" class="w-full h-1.5 bg-surface-container-high rounded-lg appearance-none cursor-pointer accent-primary" type="range"/>
                            <div class="flex justify-between text-[10px] text-slate-400 font-bold">
                                <span id="dp-min-display">Rp 0</span>
                                <span id="dp-max-display">Rp 0</span>
                            </div>
                        </div>

                        <!-- Tenor Slider -->
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <label class="text-sm font-bold text-primary uppercase tracking-wider">Tenor (Bulan)</label>
                                <span id="tenor-display" class="text-lg font-extrabold text-primary">36 Bln</span>
                            </div>
                            <input id="tenor-slider" class="w-full h-1.5 bg-surface-container-high rounded-lg appearance-none cursor-pointer accent-primary" max="60" min="12" step="12" value="36" type="range"/>
                            <div class="flex justify-between text-[10px] text-slate-400 font-bold">
                                <span>12 BLN</span>
                                <span>60 BLN</span>
                            </div>
                        </div>

                        <!-- Estimated Results -->
                        <div class="bg-surface-container-low rounded-xl p-6">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-xs font-bold text-slate-500 uppercase">Estimasi Cicilan Bulanan</span>
                                <span class="material-symbols-outlined text-blue-500 text-sm cursor-pointer hover:text-blue-700" data-message="Bunga flat 8% per tahun.">info</span>
                            </div>
                            <div id="installment-display" class="text-4xl font-headline font-black text-primary">Rp 0</div>
                            <p class="text-[10px] text-slate-400 mt-2 italic">*Tergantung pada persetujuan kredit dan verifikasi dealer.</p>
                        </div>
                        <!-- Form & Tombol -->
                        <form action="{{ route('pengajuan.create') }}" method="GET">
                            <input type="hidden" name="motor_id" id="input-motor-id" value="">
                            <input type="hidden" name="dp" id="input-dp" value="">
                            <input type="hidden" name="tenor" id="input-tenor" value="">

                            <button 
                                type="submit" 
                                class="w-full bg-primary text-white py-4 rounded-xl font-bold text-lg hover:bg-primary-container transition-all shadow-lg shadow-primary/10"
                            >
                                Ajukan Pembiayaan Sekarang
                            </button>
                        </form>
                    </div>
                    <div class="px-8 pb-8 flex items-center justify-center gap-4 border-t border-slate-50 pt-6">
                        <span class="material-symbols-outlined text-green-600" style="font-variation-settings: 'FILL' 1;">verified</span>
                        <span class="text-xs font-medium text-slate-500">Diamankan oleh Protokol Blockchain MotoLease</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section (Bento Style) -->
        <section class="bg-surface-container-low py-20">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2 bg-primary rounded-3xl p-10 flex flex-col justify-between relative overflow-hidden text-white min-h-[300px]">
                        <div class="relative z-10">
                            <h3 class="text-3xl font-headline font-extrabold mb-4">Keandalan Mekanis</h3>
                            <p class="text-blue-100 max-w-md">Setiap sepeda motor di inventaris kami menjalani pemeriksaan mekanis 120 poin oleh para ahli bersertifikat.</p>
                        </div>
                        <div class="grid grid-cols-2 gap-8 relative z-10">
                            <div>
                                <div class="text-5xl font-black text-on-primary-container">120+</div>
                                <div class="text-xs uppercase font-bold tracking-widest mt-2 text-blue-200">Poin Inspeksi</div>
                            </div>
                            <div>
                                <div class="text-5xl font-black text-on-primary-container">48j</div>
                                <div class="text-xs uppercase font-bold tracking-widest mt-2 text-blue-200">Kecepatan Persetujuan</div>
                            </div>
                        </div>
                        <span class="absolute -right-20 -bottom-20 material-symbols-outlined text-[300px] opacity-10 rotate-12">settings_suggest</span>
                    </div>
                    <div class="bg-on-tertiary-container rounded-3xl p-10 text-white flex flex-col items-center text-center justify-center">
                        <div class="mb-6 bg-white/20 p-4 rounded-full">
                            <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">account_balance</span>
                        </div>
                        <h3 class="text-2xl font-headline font-extrabold mb-2">Presisi Fintech</h3>
                        <p class="text-blue-50/80 text-sm">Penjaminan emisi otomatis untuk integrasi dealer tercepat di industri.</p>
                        <button class="mt-8 bg-white text-primary font-bold px-6 py-2 rounded-full text-sm">Pelajari Lebih Lanjut</button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @push('scripts')
    <style>
        .active-motor-card {
            border: 2px solid var(--md-sys-color-primary, #003366) !important;
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 51, 102, 0.15) !important;
            z-index: 10;
        }
        .active-motor-card::after {
            content: 'SIMULASI AKTIF';
            position: absolute;
            top: 12px;
            right: 12px;
            background: #003366;
            color: white;
            font-size: 8px;
            font-weight: 900;
            padding: 4px 8px;
            border-radius: 4px;
            letter-spacing: 1px;
            z-index: 20;
            animation: fadeIn 0.3s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dpSlider = document.getElementById('dp-slider');
            const tenorSlider = document.getElementById('tenor-slider');
            const dpDisplay = document.getElementById('dp-display');
            const tenorDisplay = document.getElementById('tenor-display');
            const installmentDisplay = document.getElementById('installment-display');
            const selectedMotorName = document.getElementById('selected-motor-name');
            const selectedMotorPrice = document.getElementById('selected-motor-price');
            const dpMinDisplay = document.getElementById('dp-min-display');
            const dpMaxDisplay = document.getElementById('dp-max-display');
            const inputMotorId = document.getElementById('input-motor-id');
            const inputDp = document.getElementById('input-dp');
            const inputTenor = document.getElementById('input-tenor');
            
            let currentMotorPrice = 0;
            let currentMotorId = null;

            const updateHiddenInputs = () => {
                if (currentMotorId) {
                    inputMotorId.value = currentMotorId;
                }
                inputDp.value = dpSlider.value;
                inputTenor.value = tenorSlider.value;
            };

            const calculateInstallment = () => {
                if (currentMotorPrice === 0) return;
                
                let dp = parseInt(dpSlider.value);
                const minDp = currentMotorPrice * 0.1;
                const maxDp = currentMotorPrice * 0.6;
                
                // Safety validation for DP
                if (dp < minDp) dp = minDp;
                if (dp > maxDp) dp = maxDp;
                
                const tenor = parseInt(tenorSlider.value);
                const interestRatePerYear = 0.08; // 8% Flat
                
                // Rumus Perhitungan:
                // Pokok Pinjaman = Harga Motor - Uang Muka
                const principal = currentMotorPrice - dp;
                
                // Total Bunga = Pokok Pinjaman × Bunga Tahunan (%) × (Tenor / 12)
                const totalInterest = principal * interestRatePerYear * (tenor / 12);
                
                // Total Hutang = Pokok Pinjaman + Total Bunga
                const totalDebt = principal + totalInterest;
                
                // Cicilan Per Bulan = Total Hutang / Tenor
                const monthlyInstallment = tenor > 0 ? totalDebt / tenor : 0;
                
                // Update UI Real-time
                dpDisplay.innerText = window.formatCurrency(dp);
                tenorDisplay.innerText = `${tenor} Bln`;
                installmentDisplay.innerText = window.formatCurrency(monthlyInstallment);
                
                // Update hidden inputs
                updateHiddenInputs();
            };

            const updateSimulator = (name, price, slug = null, motorId = null) => {
                currentMotorPrice = parseInt(price);
                currentMotorId = motorId;
                selectedMotorName.innerText = name;
                selectedMotorPrice.innerText = window.formatCurrency(currentMotorPrice);
                
                // Remove active class from all cards
                document.querySelectorAll('.motor-card').forEach(card => {
                    card.classList.remove('active-motor-card');
                });

                // Add active class to selected card
                const targetSlug = slug || name.toLowerCase().replace(/ /g, '-');
                const selectedCard = document.getElementById(`motor-card-${targetSlug}`);
                if (selectedCard) {
                    selectedCard.classList.add('active-motor-card');
                }
                
                const minDp = currentMotorPrice * 0.1;
                const maxDp = currentMotorPrice * 0.6;
                
                dpSlider.min = minDp;
                dpSlider.max = maxDp;
                dpSlider.step = 500000;
                dpSlider.value = currentMotorPrice * 0.2;
                
                dpMinDisplay.innerText = `10%: ${window.formatCurrency(minDp)}`;
                dpMaxDisplay.innerText = `60%: ${window.formatCurrency(maxDp)}`;
                calculateInstallment();
            };

            // Event listeners for select motor buttons
            document.querySelectorAll('.btn-select-motor').forEach(btn => {
                btn.addEventListener('click', () => {
                    updateSimulator(btn.dataset.name, btn.dataset.price, btn.dataset.slug, btn.dataset.motorId);
                    window.showToast(`Motor ${btn.dataset.name} dipilih.`);
                    if(window.innerWidth < 1024) {
                        document.getElementById('simulator-widget').scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });

            dpSlider.addEventListener('input', calculateInstallment);
            tenorSlider.addEventListener('input', calculateInstallment);

            // Handle deep linking from Catalog
            const urlParams = new URLSearchParams(window.location.search);
            const motorSlug = urlParams.get('motor');
            if (motorSlug) {
                const targetBtn = Array.from(document.querySelectorAll('.btn-select-motor'))
                    .find(btn => btn.dataset.slug === motorSlug);
                if (targetBtn) {
                    updateSimulator(targetBtn.dataset.name, targetBtn.dataset.price, targetBtn.dataset.slug, targetBtn.dataset.motorId);
                    document.getElementById('simulator-widget').scrollIntoView({ behavior: 'smooth' });
                } else {
                    // Default if slug not found in current list
                    const firstBtn = document.querySelector('.btn-select-motor');
                    if(firstBtn) updateSimulator(firstBtn.dataset.name, firstBtn.dataset.price, firstBtn.dataset.slug, firstBtn.dataset.motorId);
                }
            } else {
                const firstBtn = document.querySelector('.btn-select-motor');
                if(firstBtn) updateSimulator(firstBtn.dataset.name, firstBtn.dataset.price, firstBtn.dataset.slug, firstBtn.dataset.motorId);
            }
        });
    </script>
    @endpush
</x-frontend-layout>
