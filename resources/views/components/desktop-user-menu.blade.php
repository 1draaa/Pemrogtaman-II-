<div x-data="{ open: false }" class="relative w-full">
    <button @click="open = !open" class="w-full flex items-center gap-3 p-3 rounded-2xl bg-navy-800/50 hover:bg-slate-900/50 border border-slate-900/30 transition-all duration-200 group text-left">
        <div class="relative">
            <div class="size-10 rounded-full bg-slate-900 flex items-center justify-center text-white border-2 border-navy-500/50 group-hover:border-white transition-colors overflow-hidden font-bold">
                {{ auth()->user()->initials() }}
            </div>
            <div class="absolute -bottom-0.5 -right-0.5 size-3.5 bg-emerald-500 border-2 border-slate-800 rounded-full"></div>
        </div>
        
        <div class="flex-1 min-w-0">
            <p class="text-sm font-bold text-white truncate">{{ auth()->user()->name }}</p>
            <p class="text-[10px] text-navy-300 font-medium uppercase tracking-wider">Premium Member</p>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-navy-400 group-hover:text-white transition-colors">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
        </svg>
    </button>

    <div x-show="open" 
         @click.outside="open = false"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute bottom-full left-0 mb-2 w-64 bg-white dark:bg-navy-800 rounded-2xl shadow-2xl border border-navy-100 dark:border-slate-800 overflow-hidden z-50">
        
        <div class="flex items-center gap-3 px-4 py-4 text-start">
            <div class="size-12 rounded-full bg-slate-900 flex items-center justify-center text-white text-lg font-bold">
                {{ auth()->user()->initials() }}
            </div>
            <div class="grid flex-1 text-start leading-tight">
                <h4 class="truncate font-bold text-base text-navy-900 dark:text-white">{{ auth()->user()->name }}</h4>
                <p class="truncate text-xs text-navy-500">{{ auth()->user()->email }}</p>
            </div>
        </div>
        
        <div class="border-t border-navy-50 dark:border-slate-800"></div>
        
        <div class="p-2 space-y-1">
            <a href="{{ route('profile.edit') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-slate-900 dark:text-navy-300 hover:bg-navy-50 dark:hover:bg-slate-800 rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                {{ __('My Profile') }}
            </a>
            <a href="#" wire:navigate class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-slate-900 dark:text-navy-300 hover:bg-navy-50 dark:hover:bg-slate-800 rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 0 1 0 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 0 1-.22.127c-.332.183-.582.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 0 1 0-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                {{ __('Settings') }}
            </a>
            
            <div class="border-t border-navy-50 dark:border-slate-800 my-1"></div>
            
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 text-sm font-medium text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-950/30 rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    {{ __('Log out') }}
                </button>
            </form>
        </div>
    </div>
</div>
