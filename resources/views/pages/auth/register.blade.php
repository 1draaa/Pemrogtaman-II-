<x-layouts::auth :title="__('Daftar')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Buat Akun Baru')" :description="__('Bergabunglah dengan MotoLease untuk mendapatkan kemudahan kredit motor impian')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm font-medium text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-bold text-slate-900 mb-2">{{ __('Nama Lengkap') }}</label>
                <input id="name" 
                       type="text" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required 
                       autofocus 
                       autocomplete="name"
                       placeholder="Contoh: Budi Santoso"
                       class="w-full bg-white border-slate-300 rounded-xl focus:border-slate-900 focus:ring-slate-900 transition-all text-slate-900 placeholder-slate-400 font-medium py-3 px-4">
            </div>

            <!-- NIK -->
            <div>
                <label for="nik" class="block text-sm font-bold text-slate-900 mb-2">{{ __('NIK (KTP)') }}</label>
                <input id="nik" 
                       type="text" 
                       name="nik" 
                       value="{{ old('nik') }}" 
                       inputmode="numeric"
                       pattern="[0-9]{16}"
                       title="NIK harus 16 digit angka"
                       required 
                       placeholder="16 digit NIK Anda"
                       class="w-full bg-white border-slate-300 rounded-xl focus:border-slate-900 focus:ring-slate-900 transition-all text-slate-900 placeholder-slate-400 font-medium py-3 px-4">
            </div>

            <!-- WhatsApp -->
            <div>
                <label for="whatsapp" class="block text-sm font-bold text-slate-900 mb-2">{{ __('Nomor WhatsApp') }}</label>
                <input id="whatsapp" 
                       type="text" 
                       name="whatsapp" 
                       value="{{ old('whatsapp') }}" 
                       inputmode="numeric"
                       required 
                       placeholder="Contoh: 081234567890"
                       class="w-full bg-white border-slate-300 rounded-xl focus:border-slate-900 focus:ring-slate-900 transition-all text-slate-900 placeholder-slate-400 font-medium py-3 px-4">
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-bold text-slate-900 mb-2">{{ __('Alamat Email') }}</label>
                <input id="email" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autocomplete="email"
                       placeholder="email@contoh.com"
                       class="w-full bg-white border-slate-300 rounded-xl focus:border-slate-900 focus:ring-slate-900 transition-all text-slate-900 placeholder-slate-400 font-medium py-3 px-4">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-bold text-slate-900 mb-2">{{ __('Kata Sandi') }}</label>
                <input id="password" 
                       type="password" 
                       name="password" 
                       required 
                       autocomplete="new-password"
                       placeholder="Buat kata sandi minimal 8 karakter"
                       class="w-full bg-white border-slate-300 rounded-xl focus:border-slate-900 focus:ring-slate-900 transition-all text-slate-900 placeholder-slate-400 font-medium py-3 px-4">
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-bold text-slate-900 mb-2">{{ __('Konfirmasi Kata Sandi') }}</label>
                <input id="password_confirmation" 
                       type="password" 
                       name="password_confirmation" 
                       required 
                       autocomplete="new-password"
                       placeholder="Ulangi kata sandi Anda"
                       class="w-full bg-white border-slate-300 rounded-xl focus:border-slate-900 focus:ring-slate-900 transition-all text-slate-900 placeholder-slate-400 font-medium py-3 px-4">
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="w-full py-4 rounded-2xl font-black shadow-lg shadow-navy-900/10 bg-slate-900 hover:bg-[#334155] text-white border-none transition-all duration-300 transform hover:scale-[1.02]">
                    {{ __('DAFTAR SEKARANG') }}
                </button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-slate-500">
            <span>{{ __('Sudah punya akun?') }}</span>
            <a href="{{ route('login') }}" wire:navigate class="font-bold text-slate-900 hover:text-slate-800 underline decoration-slate-900/30 decoration-2 underline-offset-4">{{ __('Masuk di sini') }}</a>
        </div>
    </div>
</x-layouts::auth>
