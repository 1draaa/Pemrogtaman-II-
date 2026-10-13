<x-frontend-layout title="Katalog Kendaraan | MotoLease">
    <main class="pt-24 relative">
        <section class="max-w-7xl mx-auto px-6 py-20">
            <!-- Header -->
            <div class="mb-10">
                <h1 class="text-4xl font-headline font-extrabold text-primary mb-3">Katalog Kendaraan</h1>
                <p class="text-slate-500 font-medium text-lg">Temukan motor impian Anda dengan persetujuan kredit instan.</p>
            </div>

            <!-- Main Layout: Sidebar + Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar Filter (1 span) -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 bg-surface-container-lowest rounded-xl border border-outline-variant/30 p-6">
                        <!-- Header Sidebar with Atur Ulang -->
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-on-background">Filter Pencarian</h3>
                            <a href="{{ route('katalog') }}" class="text-sm font-bold text-primary hover:text-primary/80 transition">
                                Atur Ulang
                            </a>
                        </div>
                        
                        <form id="filter-form" method="GET" action="{{ route('katalog') }}" class="space-y-8">
                            <!-- Filter Merek -->
                            <div>
                                <h4 class="text-sm font-bold text-slate-700 mb-3">Merek</h4>
                                <div class="space-y-2">
                                    @php
                                        $merekList = ['Honda', 'Yamaha', 'Suzuki', 'Kawasaki', 'Piaggio'];
                                        $selectedMerek = request('merek', []);
                                    @endphp
                                    @foreach($merekList as $merek)
                                        <label class="flex items-center gap-3 cursor-pointer">
                                            <input 
                                                type="checkbox" 
                                                name="merek[]" 
                                                value="{{ $merek }}"
                                                {{ in_array($merek, $selectedMerek) ? 'checked' : '' }}
                                                class="w-4 h-4 rounded border-slate-300 text-primary focus:ring-primary"
                                                onchange="document.getElementById('filter-form').submit()"
                                            >
                                            <span class="text-sm text-slate-600">{{ $merek }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Filter Tahun Produksi -->
                            <div>
                                <h4 class="text-sm font-bold text-slate-700 mb-3">Tahun Produksi</h4>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs text-slate-500 mb-1">Minimum</label>
                                        <input 
                                            type="number" 
                                            name="tahun_min" 
                                            value="{{ request('tahun_min') }}"
                                            placeholder="2015"
                                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-slate-900 focus:border-transparent"
                                            onchange="document.getElementById('filter-form').submit()"
                                        >
                                    </div>
                                    <div>
                                        <label class="block text-xs text-slate-500 mb-1">Maksimum</label>
                                        <input 
                                            type="number" 
                                            name="tahun_max" 
                                            value="{{ request('tahun_max') }}"
                                            placeholder="2024"
                                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-slate-900 focus:border-transparent"
                                            onchange="document.getElementById('filter-form').submit()"
                                        >
                                    </div>
                                </div>
                            </div>

                            <!-- Filter Kilometer -->
                            <div>
                                <h4 class="text-sm font-bold text-slate-700 mb-3">Batas Kilometer</h4>
                                <select 
                                    name="km_max" 
                                    class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-slate-900 focus:border-transparent"
                                    onchange="document.getElementById('filter-form').submit()"
                                >
                                    <option value="">Semua</option>
                                    <option value="10000" {{ request('km_max') == 10000 ? 'selected' : '' }}>
                                        < 10.000 km
                                    </option>
                                    <option value="25000" {{ request('km_max') == 25000 ? 'selected' : '' }}>
                                        < 25.000 km
                                    </option>
                                    <option value="50000" {{ request('km_max') == 50000 ? 'selected' : '' }}>
                                        < 50.000 km
                                    </option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Grid Card Motor (3 spans) -->
                <div class="lg:col-span-3">
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

                                $finalImages = [];
                                foreach ($galleryImages as $img) {
                                    if (Str::startsWith($img, 'http')) {
                                        $finalImages[] = $img;
                                    } else {
                                        $finalImages[] = asset('storage/' . $img);
                                    }
                                }
                            @endphp
                            
                            <!-- Card Container -->
                            <div class="bg-surface-container-lowest rounded-xl overflow-hidden border border-outline-variant/30 transition-all duration-300 hover:-translate-y-1 relative group">
                                <!-- Slider Area (NOT inside <a>) -->
                                @if(count($finalImages) > 1)
                                    <div 
                                        x-data="{ activeSlide: 0, slides: {{ json_encode($finalImages) }} }"
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
                                                    :src="slide" 
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
                                            src="{{ $finalImages[0] }}" 
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
                                
                                <!-- Linkable Area (Info) -->
                                <a href="{{ route('katalog.show', $motor->id) }}" class="block">
                                    <div class="p-5">
                                        <!-- BARIS 1: HARGA -->
                                        <p class="text-xl font-bold text-on-background">Rp {{ number_format($motor->price, 0, ',', '.') }}</p>
                                        
                                        <!-- BARIS 2: ANGSURAN -->
                                        <p class="text-sm text-slate-500 mt-1">
                                            Angsuran <span class="font-bold">Rp {{ number_format(round(($motor->price - ($motor->price * 0.10)) / 60), 0, ',', '.') }}/bulan</span>
                                        </p>
                                        
                                        <!-- BARIS 3: NAMA MOTOR -->
                                        <h3 class="font-semibold text-slate-800 uppercase mt-4">{{ $motor->name }}</h3>
                                        
                                        <!-- BARIS 4: TAHUN & KM -->
                                        <p class="text-sm text-slate-500 mt-1">{{ $motor->year }} | {{ number_format($motor->odometer, 0, ',', '.') }} km</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if(method_exists($motors, 'links'))
                        <div class="mt-10">
                            {{ $motors->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
</x-frontend-layout>