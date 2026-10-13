<x-layouts::customer :title="__('Pengaturan Akun')">
    <!-- Header -->
    <header class="bg-white/80 backdrop-blur-xl border-b border-slate-200 px-10 py-8 sticky top-0 z-40">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-4xl font-extrabold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">Pengaturan Akun</h2>
                <p class="text-slate-500 mt-2 font-medium">Kelola informasi profil dan keamanan akun Anda</p>
            </div>
            <div class="flex items-center gap-6">
                <button class="relative p-4 bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-800 rounded-2xl transition-all duration-300 shadow-sm hover:shadow">
                    <span class="material-symbols-outlined text-2xl">notifications</span>
                </button>
            </div>
        </div>
    </header>

    <div class="p-10">
        @if(session('success'))
            <div class="mb-8 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl shadow-lg">
                <p class="font-semibold">{{ session('success') }}</p>
            </div>
        @endif

        <div class="space-y-6 max-w-3xl">
            <!-- Card 1: Profil Info -->
            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-slate-700 text-3xl">person</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-extrabold text-slate-900">Informasi Profil</h2>
                        <p class="text-slate-500">Perbarui nama dan email Anda</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('customer.profile.update') }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-bold text-slate-900 mb-2">Nama</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', auth()->user()->name) }}" 
                            class="w-full px-4 py-4 rounded-2xl border border-slate-200 bg-slate-50 text-slate-900 focus:ring-2 focus:ring-slate-900 focus:border-transparent outline-none transition-all"
                            required
                        >
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-900 mb-2">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email', auth()->user()->email) }}" 
                            class="w-full px-4 py-4 rounded-2xl border border-slate-200 bg-slate-50 text-slate-900 focus:ring-2 focus:ring-slate-900 focus:border-transparent outline-none transition-all"
                            required
                        >
                    </div>

                    <div>
                        <label for="nik" class="block text-sm font-bold text-slate-900 mb-2">NIK (KTP)</label>
                        <input 
                            type="text" 
                            id="nik" 
                            name="nik" 
                            value="{{ old('nik', auth()->user()->nik) }}" 
                            inputmode="numeric"
                            pattern="[0-9]{16}"
                            title="NIK harus 16 digit angka"
                            class="w-full px-4 py-4 rounded-2xl border border-slate-200 bg-slate-50 text-slate-900 focus:ring-2 focus:ring-slate-900 focus:border-transparent outline-none transition-all"
                            required
                        >
                    </div>

                    <div>
                        <label for="whatsapp" class="block text-sm font-bold text-slate-900 mb-2">Nomor WhatsApp</label>
                        <input 
                            type="text" 
                            id="whatsapp" 
                            name="whatsapp" 
                            value="{{ old('whatsapp', auth()->user()->whatsapp) }}" 
                            inputmode="numeric"
                            class="w-full px-4 py-4 rounded-2xl border border-slate-200 bg-slate-50 text-slate-900 focus:ring-2 focus:ring-slate-900 focus:border-transparent outline-none transition-all"
                            required
                        >
                    </div>

                    <button type="submit" class="mt-2 w-full sm:w-auto px-8 py-4 bg-slate-900 text-white font-bold rounded-2xl hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/10">
                        Simpan Perubahan
                    </button>
                </form>
            </div>

            <!-- Card 2: Security -->
            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-slate-700 text-3xl">lock</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-extrabold text-slate-900">Keamanan Akun</h2>
                        <p class="text-slate-500">Ubah password Anda</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('customer.password.update') }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="current_password" class="block text-sm font-bold text-slate-900 mb-2">Password Saat Ini</label>
                        <input 
                            type="password" 
                            id="current_password" 
                            name="current_password" 
                            class="w-full px-4 py-4 rounded-2xl border border-slate-200 bg-slate-50 text-slate-900 focus:ring-2 focus:ring-slate-900 focus:border-transparent outline-none transition-all"
                            required
                        >
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-bold text-slate-900 mb-2">Password Baru</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="w-full px-4 py-4 rounded-2xl border border-slate-200 bg-slate-50 text-slate-900 focus:ring-2 focus:ring-slate-900 focus:border-transparent outline-none transition-all"
                            required
                        >
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-slate-900 mb-2">Konfirmasi Password Baru</label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            class="w-full px-4 py-4 rounded-2xl border border-slate-200 bg-slate-50 text-slate-900 focus:ring-2 focus:ring-slate-900 focus:border-transparent outline-none transition-all"
                            required
                        >
                    </div>

                    <button type="submit" class="mt-2 w-full sm:w-auto px-8 py-4 bg-slate-900 text-white font-bold rounded-2xl hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/10">
                        Perbarui Password
                    </button>
                </form>
            </div>

            <!-- Card 3: Delete Account -->
            <div class="bg-white rounded-3xl shadow-lg border border-red-100 p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-red-600 text-3xl">delete</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-extrabold text-red-600">Hapus Akun</h2>
                        <p class="text-slate-500">Hapus akun Anda secara permanen</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('customer.delete') }}" x-data="{ confirmDelete: false }" class="space-y-4">
                    @csrf
                    @method('DELETE')

                    <p class="text-slate-600">Setelah akun Anda dihapus, semua data dan sumber daya akan hilang secara permanen. Pastikan Anda telah menyimpan data penting sebelum melanjutkan.</p>

                    <div x-show="!confirmDelete">
                        <button type="button" @click="confirmDelete = true" class="px-8 py-4 bg-red-600 text-white font-bold rounded-2xl hover:bg-red-700 transition-all shadow-lg shadow-red-600/10">
                            Hapus Akun
                        </button>
                    </div>

                    <div x-show="confirmDelete" x-transition class="space-y-4">
                        <p class="text-slate-700 font-semibold">Untuk mengkonfirmasi, silakan masukkan password Anda:</p>
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="Masukkan password Anda"
                            class="w-full px-4 py-4 rounded-2xl border border-slate-200 bg-slate-50 text-slate-900 focus:ring-2 focus:ring-red-600 focus:border-transparent outline-none transition-all"
                            required
                        >

                        <div class="flex gap-4">
                            <button type="submit" class="px-8 py-4 bg-red-600 text-white font-bold rounded-2xl hover:bg-red-700 transition-all shadow-lg shadow-red-600/10">
                                Ya, Hapus Akun
                            </button>
                            <button type="button" @click="confirmDelete = false" class="px-8 py-4 bg-slate-100 text-slate-700 font-bold rounded-2xl hover:bg-slate-200 transition-all">
                                Batal
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts::customer>
