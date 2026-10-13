<header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl docked full-width top-0 z-50 shadow-[0_20px_40px_rgba(0,30,64,0.06)] fixed w-full">
    <div class="flex justify-between items-center w-full px-6 py-4 max-w-screen-2xl mx-auto">
        <div class="flex items-center gap-8">
            <a href="{{ route('home') }}" class="text-2xl font-black tracking-tighter text-blue-950 dark:text-white font-headline hover:text-blue-700 transition-colors">MotoLease</a>
            <nav class="hidden md:flex items-center gap-6">
                <a class="font-headline font-bold text-lg leading-tight {{ request()->routeIs('katalog') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'text-slate-500 font-medium' }} hover:text-blue-700 transition-colors duration-200" href="{{ route('katalog') }}">Katalog</a>
                <a class="font-headline font-bold text-lg leading-tight {{ request()->routeIs('pembiayaan') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'text-slate-500 font-medium' }} hover:text-blue-700 transition-colors duration-200" href="{{ route('pembiayaan') }}">Pembiayaan</a>
                <a class="font-headline font-bold text-lg leading-tight {{ request()->routeIs('asuransi') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'text-slate-500 font-medium' }} hover:text-blue-700 transition-colors duration-200" href="{{ route('asuransi') }}">Asuransi</a>
                <a class="font-headline font-bold text-lg leading-tight {{ request()->routeIs('bantuan') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'text-slate-500 font-medium' }} hover:text-blue-700 transition-colors duration-200" href="{{ route('bantuan') }}">Bantuan</a>
            </nav>
        </div>
        <div class="flex items-center gap-4">
            <div class="hidden lg:flex items-center bg-surface-container-high rounded-full px-4 py-2 gap-2">
                <span class="material-symbols-outlined text-outline">search</span>
                <input class="bg-transparent border-none focus:ring-0 text-sm w-48" placeholder="Cari model..." type="text"/>
            </div>
            <button class="material-symbols-outlined text-slate-500 hover:text-primary transition-colors">notifications</button>
            @guest
                <a class="text-sm font-bold text-primary hover:text-primary-container px-4 py-2 rounded-lg border border-primary/20 transition-all" href="{{ route('login') }}">Login/Daftar</a>
            @endguest
            @auth
                <div class="flex items-center gap-3">
                    <a href="{{ route('customer.dashboard') }}" class="text-sm font-bold text-slate-700 hover:text-blue-600 transition-colors">{{ auth()->user()->name }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-bold text-rose-600 hover:text-rose-700 px-4 py-2 rounded-lg border border-rose-200 transition-all">
                            Logout
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</header>
