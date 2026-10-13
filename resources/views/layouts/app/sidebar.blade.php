<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-[#f8fafc] font-sans antialiased flex">
        <!-- Sidebar -->
        <aside class="w-72 min-h-screen bg-[#1e293b] text-white hidden lg:flex flex-col sticky top-0 shadow-xl">
            <div class="p-6 mb-2">
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" class="text-white" />
            </div>

            <nav class="flex-1 px-4 space-y-2">
                <a href="{{ route('dashboard') }}" wire:navigate class="{{ request()->routeIs('dashboard') ? 'bg-slate-700 text-white shadow-lg shadow-black/20' : 'text-white/70 hover:bg-white/10 hover:text-white' }} flex items-center gap-3 transition-all duration-200 rounded-xl py-3 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <span class="font-medium">{{ __('Dashboard') }}</span>
                </a>
                
                <a href="{{ route('katalog') }}" wire:navigate class="{{ request()->routeIs('katalog') ? 'bg-navy-600 text-white shadow-lg shadow-black/20' : 'text-white/70 hover:bg-white/10 hover:text-white' }} flex items-center gap-3 transition-all duration-200 rounded-xl py-3 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-.23 2.1-.461 2.124-1.011l1.012-4.103c.19-.777-.405-1.488-1.208-1.488H5.913m4.446 13.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm9.75 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                    </svg>
                    <span class="font-medium">{{ __('Katalog Motor') }}</span>
                </a>

                <a href="{{ route('simulasi') }}" wire:navigate class="{{ request()->routeIs('simulasi') ? 'bg-navy-600 text-white shadow-lg shadow-black/20' : 'text-white/70 hover:bg-white/10 hover:text-white' }} flex items-center gap-3 transition-all duration-200 rounded-xl py-3 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75V18m-3-3V18m-3-3V18m3-3.375a1.5 1.5 0 0 0 0-3m0 3a1.5 1.5 0 0 1 0-3m0 3h3.375a1.5 1.5 0 0 1 0 3m-3-3h-3.375a1.5 1.5 0 0 0 0 3m-.375-11.25h10.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25h-10.5a2.25 2.25 0 0 1-2.25-2.25v-10.5a2.25 2.25 0 0 1 2.25-2.25Z" />
                    </svg>
                    <span class="font-medium">{{ __('Simulator Kredit') }}</span>
                </a>
            </nav>

            <div class="mt-auto px-4 pb-4">
                <a href="{{ route('bantuan') }}" wire:navigate class="text-white/70 hover:bg-white/10 hover:text-white flex items-center gap-3 transition-all duration-200 rounded-xl py-3 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                    </svg>
                    <span class="font-medium">{{ __('Pusat Bantuan') }}</span>
                </a>
            </div>

            <div class="px-4 pb-6">
                <x-desktop-user-menu :name="auth()->user()->name" />
            </div>
        </aside>

        <!-- Mobile Header -->
        <header class="lg:hidden fixed top-0 left-0 right-0 h-16 bg-[#1e293b] text-white flex items-center px-4 z-50 shadow-md">
            <button class="p-2 -ml-2" onclick="document.getElementById('mobile-sidebar').classList.remove('-translate-x-full')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
            <div class="ml-4 font-bold">MotoLease</div>
            <div class="ml-auto">
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-2">
                        <div class="size-8 rounded-full bg-slate-700 flex items-center justify-center text-xs font-bold border border-white/20">
                            {{ auth()->user()->initials() }}
                        </div>
                    </button>
                    <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl py-2 text-navy-900 border border-navy-100">
                        <div class="px-4 py-2 border-b border-navy-50 mb-2">
                            <p class="font-bold truncate text-navy-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-navy-500 truncate">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-navy-700 hover:bg-navy-50 transition-colors">{{ __('Settings') }}</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-rose-500 hover:bg-rose-50 transition-colors">{{ __('Log out') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Mobile Sidebar Overlay -->
        <div id="mobile-sidebar" class="fixed inset-0 bg-navy-900/50 z-[60] lg:hidden transition-transform duration-300 -translate-x-full" onclick="this.classList.add('-translate-x-full')">
            <div class="w-72 h-full bg-[#1e293b] flex flex-col shadow-2xl" onclick="event.stopPropagation()">
                <div class="p-6 flex items-center justify-between">
                    <x-app-logo class="text-white" />
                    <button onclick="document.getElementById('mobile-sidebar').classList.add('-translate-x-full')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Mobile Nav Content same as desktop -->
                <nav class="flex-1 px-4 space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 text-white py-3 px-4 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-slate-700 shadow-lg' : 'hover:bg-white/10' }} transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="font-medium">{{ __('Dashboard') }}</span>
                    </a>
                    <a href="{{ route('katalog') }}" class="flex items-center gap-3 text-white py-3 px-4 rounded-xl {{ request()->routeIs('katalog') ? 'bg-navy-600 shadow-lg' : 'hover:bg-white/10' }} transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-.23 2.1-.461 2.124-1.011l1.012-4.103c.19-.777-.405-1.488-1.208-1.488H5.913m4.446 13.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm9.75 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                        </svg>
                        <span class="font-medium">{{ __('Katalog Motor') }}</span>
                    </a>
                    <a href="{{ route('simulasi') }}" class="flex items-center gap-3 text-white py-3 px-4 rounded-xl {{ request()->routeIs('simulasi') ? 'bg-slate-700 shadow-lg' : 'hover:bg-white/10' }} transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75V18m-3-3V18m-3-3V18m3-3.375a1.5 1.5 0 0 0 0-3m0 3a1.5 1.5 0 0 1 0-3m0 3h3.375a1.5 1.5 0 0 1 0 3m-3-3h-3.375a1.5 1.5 0 0 0 0 3m-.375-11.25h10.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25h-10.5a2.25 2.25 0 0 1-2.25-2.25v-10.5a2.25 2.25 0 0 1 2.25-2.25Z" />
                        </svg>
                        <span class="font-medium">{{ __('Simulator Kredit') }}</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content Area -->
        <main class="flex-1 min-h-screen lg:pt-0 pt-16 overflow-hidden">
            {{ $slot }}
        </main>

        <!-- Toast Notifications (simplified replacement for flux:toast) -->
        <div x-data="{ toasts: [] }" 
             @toast.window="toasts.push($event.detail); setTimeout(() => toasts.shift(), 3000)"
             class="fixed bottom-6 right-6 z-[100] space-y-3">
            <template x-for="toast in toasts" :key="toast.id">
                <div class="bg-white dark:bg-navy-800 border border-navy-100 dark:border-navy-700 shadow-xl rounded-2xl p-4 min-w-[300px] flex items-center gap-3 animate-slide-in">
                    <div class="size-8 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-navy-900 dark:text-white" x-text="toast.message"></p>
                </div>
            </template>
        </div>
    </body>
</html>
