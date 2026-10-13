<x-frontend-layout title="Bantuan | MotoLease">
    <main class="relative min-h-screen bg-surface overflow-hidden">
        <!-- Hero Search Section -->
        <section class="relative pt-32 pb-16 md:pt-40 md:pb-24 px-6 bg-primary overflow-hidden">
            <div class="max-w-4xl mx-auto text-center relative z-10">
                <h1 class="text-3xl md:text-5xl font-headline font-black text-white mb-8">Ada yang bisa kami bantu?</h1>
                <div class="relative max-w-2xl mx-auto">
                    <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 text-2xl">search</span>
                    <input type="text" placeholder="Cari bantuan (misal: cara bayar, syarat kredit...)" class="w-full py-5 pl-14 pr-6 rounded-2xl bg-white border-none focus:ring-4 focus:ring-secondary/30 text-primary font-medium shadow-2xl">
                </div>
            </div>
            <!-- Decorative circles -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-20 -mt-20 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-secondary/10 rounded-full -ml-20 -mb-20 blur-3xl"></div>
        </section>

        <!-- FAQ Section -->
        <section class="py-20 px-6">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-headline font-black text-primary mb-4">Pertanyaan Populer</h2>
                    <div class="w-20 h-1.5 bg-secondary mx-auto rounded-full"></div>
                </div>

                <div class="space-y-12" x-data="{ activeAccordion: null }">
                    <!-- Kategori 1: Proses Kredit -->
                    <div>
                        <h3 class="text-xl font-black text-primary mb-6 flex items-center gap-3">
                            <span class="material-symbols-outlined text-secondary">assignment_turned_in</span>
                            Proses Kredit
                        </h3>
                        <div class="space-y-4">
                            <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                                <button @click="activeAccordion === 1 ? activeAccordion = null : activeAccordion = 1" class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-slate-50 transition-colors">
                                    <span class="font-bold text-primary">Berapa lama proses persetujuan kredit?</span>
                                    <span class="material-symbols-outlined transition-transform duration-300" :class="activeAccordion === 1 ? 'rotate-180' : ''">expand_more</span>
                                </button>
                                <div x-show="activeAccordion === 1" x-collapse class="px-6 pb-5 text-slate-500 text-sm leading-relaxed">
                                    Proses persetujuan biasanya memakan waktu 1-3 hari kerja setelah semua dokumen persyaratan dinyatakan lengkap oleh tim analis kami dan pihak leasing.
                                </div>
                            </div>
                            <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                                <button @click="activeAccordion === 2 ? activeAccordion = null : activeAccordion = 2" class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-slate-50 transition-colors">
                                    <span class="font-bold text-primary">Apakah saya bisa mengajukan kredit jika berdomisili di luar kota?</span>
                                    <span class="material-symbols-outlined transition-transform duration-300" :class="activeAccordion === 2 ? 'rotate-180' : ''">expand_more</span>
                                </button>
                                <div x-show="activeAccordion === 2" x-collapse class="px-6 pb-5 text-slate-500 text-sm leading-relaxed">
                                    Tentu bisa, asalkan Anda masih dalam cakupan wilayah operasional partner leasing kami di Indonesia. Tim kami akan membantu mengarahkan ke cabang terdekat.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kategori 2: Pembayaran -->
                    <div>
                        <h3 class="text-xl font-black text-primary mb-6 flex items-center gap-3">
                            <span class="material-symbols-outlined text-secondary">payments</span>
                            Pembayaran
                        </h3>
                        <div class="space-y-4">
                            <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                                <button @click="activeAccordion === 3 ? activeAccordion = null : activeAccordion = 3" class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-slate-50 transition-colors">
                                    <span class="font-bold text-primary">Metode pembayaran apa saja yang tersedia?</span>
                                    <span class="material-symbols-outlined transition-transform duration-300" :class="activeAccordion === 3 ? 'rotate-180' : ''">expand_more</span>
                                </button>
                                <div x-show="activeAccordion === 3" x-collapse class="px-6 pb-5 text-slate-500 text-sm leading-relaxed">
                                    Anda dapat membayar melalui transfer bank (Virtual Account), ATM, Mobile Banking, atau minimarket rekanan seperti Alfamart dan Indomaret sesuai instruksi pihak leasing.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kategori 3: Kondisi Unit -->
                    <div>
                        <h3 class="text-xl font-black text-primary mb-6 flex items-center gap-3">
                            <span class="material-symbols-outlined text-secondary">verified</span>
                            Kondisi Unit
                        </h3>
                        <div class="space-y-4">
                            <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                                <button @click="activeAccordion === 4 ? activeAccordion = null : activeAccordion = 4" class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-slate-50 transition-colors">
                                    <span class="font-bold text-primary">Apakah motor yang dijual sudah melalui inspeksi?</span>
                                    <span class="material-symbols-outlined transition-transform duration-300" :class="activeAccordion === 4 ? 'rotate-180' : ''">expand_more</span>
                                </button>
                                <div x-show="activeAccordion === 4" x-collapse class="px-6 pb-5 text-slate-500 text-sm leading-relaxed">
                                    Ya, setiap unit di MotoLease telah melewati inspeksi ketat di 120+ titik pengecekan untuk memastikan kualitas mesin, kelistrikan, dan keaslian surat-surat.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Cards -->
        <section class="py-20 bg-white border-y border-slate-50 px-6">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-surface p-8 rounded-3xl text-center border border-slate-100 group hover:shadow-xl transition-all duration-500">
                        <div class="w-16 h-16 bg-green-50 text-green-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <span class="material-symbols-outlined text-3xl">chat</span>
                        </div>
                        <h4 class="font-bold text-primary mb-2">WhatsApp</h4>
                        <p class="text-slate-500 text-sm mb-6">Respon cepat via chat</p>
                        <a href="#" class="inline-block w-full py-3 bg-green-500 text-white rounded-xl font-bold hover:bg-green-600 transition-colors">Chat Sekarang</a>
                    </div>
                    <div class="bg-surface p-8 rounded-3xl text-center border border-slate-100 group hover:shadow-xl transition-all duration-500">
                        <div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <span class="material-symbols-outlined text-3xl">mail</span>
                        </div>
                        <h4 class="font-bold text-primary mb-2">Email</h4>
                        <p class="text-slate-500 text-sm mb-6">support@motolease.com</p>
                        <a href="mailto:support@motolease.com" class="inline-block w-full py-3 bg-primary text-white rounded-xl font-bold hover:bg-primary-container transition-colors">Kirim Email</a>
                    </div>
                    <div class="bg-surface p-8 rounded-3xl text-center border border-slate-100 group hover:shadow-xl transition-all duration-500">
                        <div class="w-16 h-16 bg-secondary/10 text-secondary rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <span class="material-symbols-outlined text-3xl">call</span>
                        </div>
                        <h4 class="font-bold text-primary mb-2">Telepon</h4>
                        <p class="text-slate-500 text-sm mb-6">021-1234-5678</p>
                        <a href="tel:02112345678" class="inline-block w-full py-3 border-2 border-primary text-primary rounded-xl font-bold hover:bg-primary hover:text-white transition-all">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Form Section -->
        <section class="py-24 px-6 bg-surface">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-[2.5rem] p-8 md:p-12 shadow-2xl shadow-primary/5 border border-slate-50">
                    <div class="text-center mb-10">
                        <h2 class="text-3xl font-headline font-black text-primary mb-2">Kirim Pesan</h2>
                        <p class="text-slate-400">Punya pertanyaan khusus? Tim kami siap membantu Anda.</p>
                    </div>
                    <form action="#" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-primary uppercase ml-1">Nama Lengkap</label>
                                <input type="text" class="w-full bg-surface border-none rounded-xl py-4 px-5 focus:ring-2 focus:ring-primary/20 transition-all" placeholder="John Doe">
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-primary uppercase ml-1">Email</label>
                                <input type="email" class="w-full bg-surface border-none rounded-xl py-4 px-5 focus:ring-2 focus:ring-primary/20 transition-all" placeholder="john@example.com">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-primary uppercase ml-1">Subjek</label>
                            <input type="text" class="w-full bg-surface border-none rounded-xl py-4 px-5 focus:ring-2 focus:ring-primary/20 transition-all" placeholder="Tanya stok motor moge...">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-primary uppercase ml-1">Pesan</label>
                            <textarea rows="4" class="w-full bg-surface border-none rounded-xl py-4 px-5 focus:ring-2 focus:ring-primary/20 transition-all" placeholder="Tuliskan pesan Anda di sini..."></textarea>
                        </div>
                        <button type="submit" class="w-full bg-primary text-white py-5 rounded-2xl font-black text-lg hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl shadow-primary/20">
                            KIRIM PESAN SEKARANG
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Footer Help Info -->
        <section class="py-12 px-6 text-center border-t border-slate-100">
            <div class="flex flex-col items-center gap-4">
                <div class="flex items-center gap-2 text-primary font-bold">
                    <span class="material-symbols-outlined">schedule</span>
                    Jam Operasional Showroom
                </div>
                <p class="text-slate-500 font-medium">Senin - Minggu: 09:00 - 18:00 WIB</p>
                <p class="text-xs text-slate-300 italic">*Kami tetap buka di hari libur nasional</p>
            </div>
        </section>
    </main>
</x-frontend-layout>
