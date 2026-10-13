<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-slate-50 dark:bg-navy-950 font-sans antialiased">
        <header class="border-b border-navy-100 dark:border-navy-800 bg-white dark:bg-navy-900 sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center gap-8">
                        <x-app-logo href="{{ route('dashboard') }}" wire:navigate />
                        
                        <nav class="hidden lg:flex items-center gap-4">
                            <a href="{{ route('dashboard') }}" wire:navigate class="{{ request()->routeIs('dashboard') ? 'text-navy-900 dark:text-white font-bold' : 'text-navy-500 hover:text-navy-700 dark:text-navy-400 dark:hover:text-navy-200' }} text-sm transition-colors">
                                {{ __('Dashboard') }}
                            </a>
                        </nav>
                    </div>

                    <div class="flex items-center gap-4">
                        <x-desktop-user-menu />
                    </div>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>

        <!-- Toast Notifications -->
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
