<x-layouts::auth :title="__('Masuk')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Selamat Datang Kembali')" :description="__('Silakan masuk ke akun Anda untuk melanjutkan pengajuan kredit')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm font-medium text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Alamat Email') }}</label>
                <input id="email" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       autocomplete="email"
                       placeholder="email@contoh.com"
                       class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:border-blue-600 focus:ring-blue-600 transition-all text-gray-900 placeholder-gray-400 font-medium">
            </div>

            <!-- Password -->
            <div class="relative">
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Kata Sandi') }}</label>
                    @if (Route::has('password.request'))
                        <a class="text-xs font-bold text-slate-700 hover:text-slate-900 transition-colors" href="{{ route('password.request') }}" wire:navigate>
                            {{ __('Lupa kata sandi?') }}
                        </a>
                    @endif
                </div>
                <input id="password" 
                       type="password" 
                       name="password" 
                       required 
                       autocomplete="current-password"
                       placeholder="Masukkan kata sandi"
                       class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 focus:border-blue-600 focus:ring-blue-600 transition-all text-gray-900 placeholder-gray-400 font-medium">
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember" type="checkbox" name="remember" class="size-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900">
                <label for="remember" class="ml-3 text-sm font-medium text-gray-700">{{ __('Ingat saya') }}</label>
            </div>

            <div>
                <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                    {{ __('MASUK SEKARANG') }}
                </button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-slate-500">
                <span>{{ __('Belum punya akun?') }}</span>
                <a href="{{ route('register') }}" wire:navigate class="font-bold text-slate-900 hover:text-slate-700 underline decoration-slate-900/30 decoration-2 underline-offset-4">{{ __('Daftar Gratis') }}</a>
            </div>
        @endif
    </div>
</x-layouts::auth>
