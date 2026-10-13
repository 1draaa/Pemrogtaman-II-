<x-layouts::customer :title="__('Review Pengajuan')">
    <!-- Header -->
    <header class="bg-white/80 backdrop-blur-xl border-b border-slate-200 px-10 py-8 sticky top-0 z-40">
        <div class="flex justify-between items-center">
            <div>
                <a href="{{ route('katalog') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-slate-900 mb-2">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Kembali ke Katalog
                </a>
                <h2 class="text-4xl font-extrabold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">Review Pengajuan Anda</h2>
                <p class="text-slate-500 mt-2 font-medium">Pastikan semua data pengajuan sudah benar sebelum melanjutkan.</p>
            </div>
        </div>
    </header>

    <div class="p-10">
        @if(session('error'))
            <div class="mb-10 bg-gradient-to-r from-rose-50 to-pink-50 border border-rose-200 text-rose-700 px-6 py-4 rounded-2xl shadow-lg">
                <p class="font-bold">{{ session('error') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 max-w-6xl mx-auto">
            <!-- Ringkasan Motor -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden sticky top-24">
                    @php
                        $motImage = null;
                        if ($motor->galleries && $motor->galleries->isNotEmpty()) {
                            $motImage = $motor->galleries->first()->foto_path;
                        } elseif ($motor->image) {
                            $motImage = $motor->image;
                        }
                    @endphp
                    <div class="aspect-[4/3] w-full">
                        @if($motImage)
                            <img 
                                src="{{ Str::startsWith($motImage, 'http') ? $motImage : asset('storage/' . $motImage) }}" 
                                alt="{{ $motor->name }}" 
                                class="w-full h-full object-cover"
                            >
                        @else
                            <img 
                                src="https://images.unsplash.com/photo-1558618666-fcd2585cd64?q=80&w=2070&auto=format&fit=crop" 
                                alt="{{ $motor->name }}" 
                                class="w-full h-full object-cover"
                            >
                        @endif
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-extrabold text-slate-900">{{ $motor->name }}</h3>
                        <p class="text-slate-500 mt-2 font-medium">{{ $motor->brand }} {{ $motor->name }} ({{ $motor->year }})</p>
                        <p class="text-sm text-slate-400 mt-1">Tahun {{ $motor->year }} • {{ number_format($motor->odometer, 0, ',', '.') }} km</p>
                        <div class="flex justify-between items-center mt-6 pt-6 border-t border-slate-100">
                            <span class="text-xs font-bold text-slate-500 uppercase">Harga Tunai</span>
                            <span class="text-xl font-bold text-slate-900">Rp {{ number_format($motor->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Konfirmasi & Ringkasan -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Form -->
                <form action="{{ route('pengajuan.store') }}" method="POST" class="bg-white rounded-3xl shadow-2xl border border-slate-200 p-10">
                    @csrf
                    <input type="hidden" name="motor_id" value="{{ $motor->id }}">
                    <input type="hidden" name="dp" value="{{ $dp }}">
                    <input type="hidden" name="tenor" value="{{ $tenor }}">

                    <div class="space-y-8">
                        <!-- Uang Muka -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-3">Uang Muka (DP)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 font-bold text-lg">Rp</span>
                                <input 
                                    type="text" 
                                    value="{{ number_format($dp, 0, ',', '.') }}" 
                                    readonly
                                    class="w-full pl-14 pr-5 py-4 border border-slate-200 bg-slate-50 rounded-2xl text-slate-900 font-semibold text-lg"
                                >
                            </div>
                        </div>

                        <!-- Tenor -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-3">Tenor (Bulan)</label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    value="{{ $tenor }}" 
                                    readonly
                                    class="w-full px-5 py-4 border border-slate-200 bg-slate-50 rounded-2xl text-slate-900 font-semibold text-lg"
                                >
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 font-bold text-lg">Bulan</span>
                            </div>
                        </div>

                        <!-- Pilih Leasing -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-3">Pilih Mitra Leasing</label>
                            <select 
                                name="leasing_id" 
                                id="mitra_leasing_id"
                                required
                                onchange="hitungLeasing()"
                                class="w-full px-5 py-4 border border-slate-200 bg-slate-50 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-900 font-semibold text-lg"
                            >
                                <option value="" disabled selected>Pilih mitra leasing...</option>
                                @foreach($leasings as $leasing)
                                    <option value="{{ $leasing->id }}" data-bunga="{{ $leasing->interest_rate }}">
                                        {{ $leasing->name }} (Bunga {{ $leasing->interest_rate }}% p.a)
                                    </option>
                                @endforeach
                            </select>
                            @error('leasing_id')
                                <p class="text-rose-600 text-sm mt-2 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Ringkasan Pembiayaan -->
                    <div class="mt-10 pt-8 border-t border-slate-200">
                        <div class="bg-slate-50 rounded-2xl p-8 border border-slate-200">
                            <h4 class="text-lg font-extrabold text-slate-900 mb-6">Ringkasan Pembiayaan</h4>
                            
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-500 font-medium">Pokok Hutang</span>
                                    <span class="font-semibold text-slate-900 text-lg" id="val-pokok-hutang">Rp 0</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-500 font-medium">Total Bunga</span>
                                    <span class="font-semibold text-slate-900 text-lg" id="val-total-bunga">Rp 0</span>
                                </div>
                                <div class="flex justify-between items-center mt-4 pt-4 border-t border-dashed border-slate-300">
                                    <span class="font-bold text-slate-700 text-lg">Estimasi Cicilan Bulanan</span>
                                    <span class="text-2xl font-bold text-blue-600" id="val-cicilan">Rp 0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-5 rounded-2xl font-extrabold text-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center gap-3">
                            Konfirmasi & Lanjut Upload Dokumen
                            <span class="material-symbols-outlined text-2xl">arrow_forward</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function hitungLeasing() {
            let harga = {{ $motor->price ?? 0 }};
            let dp = {{ $dp ?? 0 }};
            let tenor = {{ $tenor ?? 1 }};
            
            let selectMitra = document.getElementById('mitra_leasing_id');
            if(!selectMitra || selectMitra.selectedIndex === -1) return;
            let bunga = parseFloat(selectMitra.options[selectMitra.selectedIndex].getAttribute('data-bunga')) || 0;

            let pokokHutang = harga - dp;
            let totalBunga = pokokHutang * (bunga / 100) * (tenor / 12);
            let totalHutang = pokokHutang + totalBunga;
            let cicilanBulanan = totalHutang / tenor;

            const formatRp = (angka) => 'Rp ' + Math.round(angka).toLocaleString('id-ID');

            document.getElementById('val-pokok-hutang').innerText = formatRp(pokokHutang);
            document.getElementById('val-total-bunga').innerText = formatRp(totalBunga);
            document.getElementById('val-cicilan').innerText = formatRp(cicilanBulanan);
        }

        document.addEventListener('DOMContentLoaded', function() {
            let selectMitra = document.getElementById('mitra_leasing_id');
            if (selectMitra && selectMitra.options.length > 1) {
                selectMitra.selectedIndex = 1;
                hitungLeasing();
            }
            if (selectMitra) {
                selectMitra.addEventListener('change', hitungLeasing);
            }
        });
    </script>
</x-layouts::customer>
