<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-slate-50 antialiased">
        <div class="bg-slate-50 flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-md flex-col gap-2">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium mb-4" wire:navigate>
                    <span class="flex h-10 w-10 mb-1 items-center justify-center rounded-xl bg-slate-100 p-2">
                        <x-app-logo-icon class="size-8 fill-current text-slate-900" />
                    </span>
                    <span class="font-headline font-black text-2xl text-slate-900 tracking-tight">MotoLease</span>
                </a>
                <div class="bg-white p-8 md:p-10 rounded-2xl shadow-xl">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- Toast Notifications (simplified) -->
        <div x-data="{ toasts: [] }" 
             @toast.window="toasts.push($event.detail); setTimeout(() => toasts.shift(), 3000)"
             class="fixed bottom-6 right-6 z-[100] space-y-3">
            <template x-for="toast in toasts" :key="toast.id">
                <div class="bg-white border border-slate-100 shadow-xl rounded-2xl p-4 min-w-[300px] flex items-center gap-3 animate-slide-in">
                    <p class="text-sm font-medium text-slate-900" x-text="toast.message"></p>
                </div>
            </template>
        </div>
    </body>
</html>
