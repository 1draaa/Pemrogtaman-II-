<x-frontend-layout title="Simulator Kredit | MotoLease">
    <main class="pt-28 pb-20 relative min-h-screen bg-slate-50">
        <style>
            /* Custom styling to hide default select arrow more robustly */
            #motor-select {
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                background-image: none !important;
            }
            #motor-select::-ms-expand {
                display: none;
            }
        </style>
        <section class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-headline font-extrabold text-primary mb-3">Simulator Kredit</h1>
                <p class="text-slate-500 font-medium text-lg">Hitung estimasi cicilan motor impian Anda dengan bunga flat 8%.</p>
            </div>

            <div class="bg-white rounded-3xl shadow-[0_20px_50px_rgba(0,30,64,0.08)] overflow-hidden border border-slate-100">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <!-- Input Section -->
                    <div class="p-8 md:p-12 space-y-8 border-r border-slate-50">
                        <!-- Motor Selection -->
                        <div class="space-y-3">
                            <label class="text-sm font-bold text-primary uppercase tracking-wider flex items-center gap-2">
                                <span class="material-symbols-outlined text-base">motorcycle</span>
                                Pilih Model Motor
                            </label>
                            <div class="relative">
                                <select id="motor-select" class="w-full bg-surface-container-low border-2 border-transparent rounded-xl py-4 px-5 text-primary font-bold appearance-none focus:ring-4 focus:ring-primary/10 focus:border-primary/20 hover:bg-surface-container transition-all cursor-pointer">
                                    <option value="" disabled selected>Pilih model...</option>
                                    @foreach($motors as $motor)
                                        <option value="{{ $motor->price }}" data-name="{{ $motor->name }}" data-slug="{{ $motor->slug }}">{{ $motor->name }} (Rp {{ number_format($motor->price, 0, ',', '.') }})</option>
                                    @endforeach
                                </select>
                                <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none flex items-center text-primary">
                                    <span class="material-symbols-outlined text-2xl font-bold">expand_more</span>
                                </div>
                            </div>
                        </div>

                        <!-- Down Payment Slider -->
                        <div class="space-y-4">
                            <div class="flex justify-between items-end">
                                <label class="text-sm font-bold text-primary uppercase tracking-wider flex items-center gap-2">
                                    <span class="material-symbols-outlined text-base">payments</span>
                                    Uang Muka
                                </label>
                                <span id="dp-display" class="text-xl font-black text-primary">Rp 0</span>
                            </div>
                            <input id="dp-slider" class="w-full h-2 bg-surface-container-high rounded-lg appearance-none cursor-pointer accent-primary" type="range" disabled/>
                            <div class="flex justify-between text-[10px] text-slate-400 font-black uppercase tracking-tighter">
                                <span id="dp-min-display">Min 10%</span>
                                <span id="dp-max-display">Max 60%</span>
                            </div>
                        </div>

                        <!-- Tenor Slider -->
                        <div class="space-y-4">
                            <div class="flex justify-between items-end">
                                <label class="text-sm font-bold text-primary uppercase tracking-wider flex items-center gap-2">
                                    <span class="material-symbols-outlined text-base">calendar_today</span>
                                    Tenor (Bulan)
                                </label>
                                <span id="tenor-display" class="text-xl font-black text-primary">36 Bln</span>
                            </div>
                            <input id="tenor-slider" class="w-full h-2 bg-surface-container-high rounded-lg appearance-none cursor-pointer accent-primary" max="60" min="12" step="12" value="36" type="range"/>
                            <div class="flex justify-between text-[10px] text-slate-400 font-black uppercase tracking-tighter">
                                <span>12 BLN</span>
                                <span>60 BLN</span>
                            </div>
                        </div>
                    </div>

                    <!-- Results Section -->
                    <div class="p-8 md:p-12 bg-primary flex flex-col justify-between text-white">
                        <div class="space-y-8">
                            <div>
                                <h3 class="text-white/60 text-xs font-bold uppercase tracking-widest mb-2">Ringkasan Kredit</h3>
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center py-3 border-b border-white/10">
                                        <span class="text-sm font-medium text-white/80">Harga Motor</span>
                                        <span id="res-price" class="font-bold">Rp 0</span>
                                    </div>
                                    <div class="flex justify-between items-center py-3 border-b border-white/10">
                                        <span class="text-sm font-medium text-white/80">Pokok Pinjaman</span>
                                        <span id="res-principal" class="font-bold">Rp 0</span>
                                    </div>
                                    <div class="flex justify-between items-center py-3 border-b border-white/10">
                                        <span class="text-sm font-medium text-white/80">Bunga Flat (8%)</span>
                                        <span id="res-interest" class="font-bold">Rp 0</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white/10 rounded-2xl p-6 backdrop-blur-sm border border-white/10 group transition-all hover:bg-white/20">
                                <span class="text-white/60 text-[10px] font-bold uppercase tracking-widest block mb-1">Estimasi Cicilan Bulanan</span>
                                <div id="installment-display" class="text-4xl md:text-5xl font-headline font-black text-on-primary-container drop-shadow-sm">Rp 0</div>
                            </div>
                        </div>

                        <div class="mt-8 space-y-4">
                            <button class="w-full bg-on-primary-container text-primary py-5 rounded-2xl font-black text-lg hover:scale-[1.03] active:scale-[0.98] transition-all shadow-[0_10px_30px_rgba(216,136,92,0.3)] hover:shadow-[0_15px_40px_rgba(216,136,92,0.4)] flex items-center justify-center gap-2">
                                AJUKAN PEMBIAYAAN SEKARANG
                                <span class="material-symbols-outlined font-black">arrow_forward</span>
                            </button>

                            <button id="save-simulation" class="w-full bg-white/10 text-white border border-white/20 py-4 rounded-2xl font-bold text-sm hover:bg-white/20 transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-base">bookmark</span>
                                SIMPAN HASIL SIMULASI
                            </button>

                            <p class="text-[10px] text-white/40 text-center italic">
                                *Hasil simulasi merupakan estimasi. Suku bunga dan persetujuan final bergantung pada analisis kredit.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const motorSelect = document.getElementById('motor-select');
            const dpSlider = document.getElementById('dp-slider');
            const tenorSlider = document.getElementById('tenor-slider');
            const dpDisplay = document.getElementById('dp-display');
            const tenorDisplay = document.getElementById('tenor-display');
            const installmentDisplay = document.getElementById('installment-display');
            const dpMinDisplay = document.getElementById('dp-min-display');
            const dpMaxDisplay = document.getElementById('dp-max-display');
            
            // Result elements
            const resPrice = document.getElementById('res-price');
            const resPrincipal = document.getElementById('res-principal');
            const resInterest = document.getElementById('res-interest');

            let currentMotorPrice = 0;

            const calculateInstallment = () => {
                if (currentMotorPrice === 0) return;
                
                let dp = parseInt(dpSlider.value);
                const minDp = currentMotorPrice * 0.1;
                const maxDp = currentMotorPrice * 0.6;
                
                if (dp < minDp) dp = minDp;
                if (dp > maxDp) dp = maxDp;
                
                const tenor = parseInt(tenorSlider.value);
                const interestRatePerYear = 0.08;
                
                const principal = currentMotorPrice - dp;
                const totalInterest = principal * interestRatePerYear * (tenor / 12);
                const totalDebt = principal + totalInterest;
                const monthlyInstallment = tenor > 0 ? totalDebt / tenor : 0;
                
                // Update UI
                dpDisplay.innerText = window.formatCurrency(dp);
                tenorDisplay.innerText = `${tenor} Bln`;
                installmentDisplay.innerText = window.formatCurrency(monthlyInstallment);
                
                // Update Summary
                resPrice.innerText = window.formatCurrency(currentMotorPrice);
                resPrincipal.innerText = window.formatCurrency(principal);
                resInterest.innerText = window.formatCurrency(totalInterest);
            };

            const updateSimulator = (price) => {
                currentMotorPrice = parseInt(price);
                dpSlider.disabled = false;
                
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

            motorSelect.addEventListener('change', (e) => {
                updateSimulator(e.target.value);
            });

            dpSlider.addEventListener('input', calculateInstallment);
            tenorSlider.addEventListener('input', calculateInstallment);

            // Save Simulation Logic
            const saveBtn = document.getElementById('save-simulation');
            saveBtn.addEventListener('click', async () => {
                if (currentMotorPrice === 0) {
                    alert('Silakan pilih motor terlebih dahulu.');
                    return;
                }

                const selectedOption = motorSelect.options[motorSelect.selectedIndex];
                const motorName = selectedOption.dataset.name;
                const dp = parseInt(dpSlider.value);
                const tenor = parseInt(tenorSlider.value);
                
                // Get raw value from installment display (cleaning Rp and dots)
                const monthlyInstallment = parseInt(installmentDisplay.innerText.replace(/[^0-9]/g, ''));

                try {
                    const response = await fetch("{{ route('simulations.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            motor_name: motorName,
                            price: currentMotorPrice,
                            dp: dp,
                            tenor: tenor,
                            monthly_installment: monthlyInstallment
                        })
                    });

                    const data = await response.json();

                    if (response.ok) {
                        alert(data.message);
                    } else if (response.status === 401) {
                        if (confirm('Anda harus login untuk menyimpan simulasi. Ke halaman login?')) {
                            window.location.href = "{{ route('login') }}";
                        }
                    } else {
                        alert(data.message || 'Terjadi kesalahan saat menyimpan simulasi.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan jaringan.');
                }
            });

            // Handle URL Parameters (from Catalog)
            const urlParams = new URLSearchParams(window.location.search);
            const motorSlug = urlParams.get('motor');
            if (motorSlug) {
                const option = Array.from(motorSelect.options).find(opt => opt.dataset.slug === motorSlug);
                if (option) {
                    motorSelect.value = option.value;
                    updateSimulator(option.value);
                }
            }
        });
    </script>
    @endpush
</x-frontend-layout>
