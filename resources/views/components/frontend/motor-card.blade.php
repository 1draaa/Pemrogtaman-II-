@props(['name', 'price', 'year', 'mileage', 'image', 'tag' => null, 'type' => null, 'isCatalog' => false])

<div id="motor-card-{{ Str::slug($name) }}" class="motor-card group bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_4px_20px_rgba(0,30,64,0.04)] transition-all duration-300 hover:-translate-y-1">
    <div class="h-48 overflow-hidden relative">
        <img alt="{{ $name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $image }}"/>
        @if($tag)
            <span class="absolute top-4 left-4 {{ $tag === 'Terlaris' ? 'bg-on-tertiary-container' : 'bg-primary' }} text-white text-[10px] uppercase font-bold tracking-widest px-3 py-1 rounded-full">
                {{ $tag }}
            </span>
        @endif
    </div>
    <div class="p-5 flex flex-col justify-between {{ $isCatalog ? 'h-[180px]' : '' }}">
        <div>
            <div class="flex justify-between items-start mb-2">
                <h3 class="font-headline font-bold text-lg text-primary leading-tight">{{ $name }}</h3>
                <span class="bg-surface-container-high text-on-surface-variant text-[12px] font-bold px-2 py-1 rounded">{{ $year }}</span>
            </div>
            <p class="text-slate-500 text-sm mb-4">{{ number_format($mileage, 0, ',', '.') }} km {{ $type ? '• ' . $type : '' }}</p>
        </div>
        <div class="flex justify-between items-center pt-4 border-t border-slate-50 mt-auto">
            <div>
                <span class="text-[10px] uppercase text-slate-400 block font-bold">Harga</span>
                <span class="text-xl font-extrabold text-primary">Rp {{ number_format($price, 0, ',', '.') }}</span>
            </div>
            @if($isCatalog)
                <a href="{{ route('simulasi', ['motor' => Str::slug($name)]) }}" class="bg-secondary-container text-on-secondary-container px-3 py-2 rounded-lg hover:bg-primary hover:text-white transition-colors text-xs font-bold text-center">
                    Simulasi
                </a>
            @else
                <button class="btn-select-motor bg-secondary-container text-on-secondary-container px-3 py-2 rounded-lg hover:bg-primary hover:text-white transition-colors text-xs font-bold" 
                        data-name="{{ $name }}" 
                        data-price="{{ $price }}"
                        data-slug="{{ Str::slug($name) }}">
                    Simulasi
                </button>
            @endif
        </div>
    </div>
</div>
