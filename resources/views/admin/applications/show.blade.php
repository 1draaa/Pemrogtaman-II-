<x-admin.layout :title="'Detail Pengajuan'" :headerTitle="'Detail Pengajuan'">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.applications.index') }}" class="p-4 bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-800 rounded-2xl transition-all duration-300 shadow-sm hover:shadow">
                <span class="material-symbols-outlined text-2xl">arrow_back</span>
            </a>
            <div>
                <h3 class="text-3xl font-extrabold text-slate-900">Detail Pengajuan</h3>
                <p class="text-slate-500 mt-1 font-medium">No. Pengajuan: {{ $application->application_number }}</p>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-8 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl shadow-lg">
            <p class="font-bold">{{ session('success') }}</p>
        </div>
    @endif

    @if($application->catatan_admin)
        <div class="mb-8 bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 text-amber-700 px-6 py-4 rounded-2xl shadow-lg">
            <p class="font-bold">Catatan Admin:</p>
            <p class="text-sm mt-1">{{ $application->catatan_admin }}</p>       
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Info Pengajuan -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Status Badge -->
            <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 p-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-slate-700 text-3xl">receipt_long</span>
                        </div>
                        <h3 class="text-2xl font-extrabold text-slate-900">Status Pengajuan</h3>
                    </div>
                    @php
                        $statusColors = [
                            'pending' => 'bg-gradient-to-r from-amber-100 to-orange-100 text-amber-800',
                            'survey' => 'bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800',
                            'approved' => 'bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-800',
                            'rejected' => 'bg-gradient-to-r from-rose-100 to-pink-100 text-rose-800',
                            'completed' => 'bg-gradient-to-r from-slate-100 to-slate-200 text-slate-800',
                            'perlu_unggah_ulang' => 'bg-gradient-to-r from-rose-100 to-pink-100 text-rose-800'        
                        ];
                        $statusLabels = [
                            'pending' => 'Menunggu Verifikasi',
                            'survey' => 'Survei Lapangan',
                            'approved' => 'Disetujui',
                            'rejected' => 'Ditolak',
                            'completed' => 'Selesai',
                            'perlu_unggah_ulang' => 'Perlu Unggah Ulang'        
                        ];
                    @endphp
                    <span class="inline-flex items-center px-6 py-3 rounded-2xl text-sm font-black {{ $statusColors[$application->status] ?? 'bg-gradient-to-r from-slate-100 to-slate-200 text-slate-800' }}">
                        {{ $statusLabels[$application->status] ?? $application->status }}
                    </span>
                </div>
            </div>

            <!-- Info Nasabah -->
            <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-slate-700 text-3xl">person</span>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900">Informasi Nasabah</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <label class="text-xs font-black text-slate-500 uppercase">Nama Lengkap</label>
                            <p class="text-slate-900 font-bold mt-1">{{ $application->customer_name }}</p>
                        </div>
                        @if($application->user && $application->user->whatsapp)
                            @php
                                // Format nomor WhatsApp
                                $waNumber = $application->user->whatsapp;
                                // Hilangkan semua karakter selain angka
                                $waNumber = preg_replace('/[^0-9]/', '', $waNumber);
                                // Ganti awalan 0 dengan 62
                                if (Str::startsWith($waNumber, '0')) {
                                    $waNumber = '62' . Str::substr($waNumber, 1);
                                }
                                // Pesan WhatsApp
                                $waMessage = "Halo Bapak/Ibu " . $application->customer_name . ", kami dari tim MotoLease ingin mengonfirmasi jadwal Survei Lapangan untuk pengajuan kredit motor Anda...";
                            @endphp
                            <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode($waMessage) }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white rounded-lg px-4 py-2 flex items-center gap-2 transition-all">
                                <!-- WhatsApp SVG Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                                </svg>
                                Hubungi
                            </a>
                        @endif
                    </div>
                    <div>
                        <label class="text-xs font-black text-slate-500 uppercase">No. Telepon</label>
                        <p class="text-slate-900 font-bold mt-1">{{ $application->customer_phone }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-black text-slate-500 uppercase">Email</label>
                        <p class="text-slate-900 font-bold mt-1">{{ $application->customer_email ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-black text-slate-500 uppercase">Tanggal Pengajuan</label>
                        <p class="text-slate-900 font-bold mt-1">{{ $application->created_at->format('d F Y') }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-xs font-black text-slate-500 uppercase">Alamat</label>
                        <p class="text-slate-900 font-bold mt-1">{{ $application->customer_address }}</p>
                    </div>
                </div>
            </div>

            <!-- Info Kendaraan & Kredit -->
            <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-slate-700 text-3xl">directions_car</span>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900">Informasi Kendaraan & Kredit</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-xs font-black text-slate-500 uppercase">Motor</label>
                        <p class="text-slate-900 font-bold mt-1">{{ optional($application->motor)->model ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-black text-slate-500 uppercase">Leasing</label>
                        <p class="text-slate-900 font-bold mt-1">{{ optional($application->leasing)->name ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-black text-slate-500 uppercase">Uang Muka</label>
                        <p class="text-slate-900 font-bold mt-1">Rp {{ number_format($application->down_payment, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-black text-slate-500 uppercase">Tenor</label>
                        <p class="text-slate-900 font-bold mt-1">{{ $application->tenor }} Bulan</p>
                    </div>
                    <div>
                        <label class="text-xs font-black text-slate-500 uppercase">Angsuran/Bulan</label>
                        <p class="text-slate-900 font-black text-2xl mt-1 bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Rp {{ number_format($application->monthly_installment, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Panel Dokumen -->
            <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-slate-700 text-3xl">folder</span>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900">Dokumen Pendukung</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- KTP -->
                    <div class="border border-slate-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                        <h4 class="font-bold text-slate-900 mb-3 text-lg">KTP</h4>
                        @if($application->dokumen_ktp)
                            @if(pathinfo($application->dokumen_ktp, PATHINFO_EXTENSION) === 'pdf')
                                <a href="{{ asset('storage/' . $application->dokumen_ktp) }}" target="_blank" class="block bg-gradient-to-r from-slate-50 to-slate-100 rounded-2xl p-6 text-center hover:from-slate-100 hover:to-slate-200 transition-all">
                                    <span class="material-symbols-outlined text-5xl text-slate-400">picture_as_pdf</span>
                                    <p class="text-sm font-bold text-slate-700 mt-3">Lihat PDF</p>
                                </a>
                            @else
                                <img src="{{ asset('storage/' . $application->dokumen_ktp) }}" alt="KTP" class="w-full h-48 object-cover rounded-2xl cursor-pointer hover:opacity-90 transition-all shadow-md hover:shadow-xl" data-image-url="{{ asset('storage/' . $application->dokumen_ktp) }}" onclick="openModal(this.dataset.imageUrl)">
                            @endif
                        @else
                            <div class="bg-gradient-to-r from-slate-50 to-slate-100 rounded-2xl p-6 text-center">
                                <span class="material-symbols-outlined text-5xl text-slate-300">image_not_supported</span>
                                <p class="text-sm text-slate-500 mt-3 font-medium">Belum diunggah</p>
                            </div>
                        @endif
                    </div>

                    <!-- KK -->
                    <div class="border border-slate-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                        <h4 class="font-bold text-slate-900 mb-3 text-lg">KK</h4>
                        @if($application->dokumen_kk)
                            @if(pathinfo($application->dokumen_kk, PATHINFO_EXTENSION) === 'pdf')
                                <a href="{{ asset('storage/' . $application->dokumen_kk) }}" target="_blank" class="block bg-gradient-to-r from-slate-50 to-slate-100 rounded-2xl p-6 text-center hover:from-slate-100 hover:to-slate-200 transition-all">
                                    <span class="material-symbols-outlined text-5xl text-slate-400">picture_as_pdf</span>
                                    <p class="text-sm font-bold text-slate-700 mt-3">Lihat PDF</p>
                                </a>
                            @else
                                <img src="{{ asset('storage/' . $application->dokumen_kk) }}" alt="KK" class="w-full h-48 object-cover rounded-2xl cursor-pointer hover:opacity-90 transition-all shadow-md hover:shadow-xl" data-image-url="{{ asset('storage/' . $application->dokumen_kk) }}" onclick="openModal(this.dataset.imageUrl)">
                            @endif
                        @else
                            <div class="bg-gradient-to-r from-slate-50 to-slate-100 rounded-2xl p-6 text-center">
                                <span class="material-symbols-outlined text-5xl text-slate-300">image_not_supported</span>
                                <p class="text-sm text-slate-500 mt-3 font-medium">Belum diunggah</p>
                            </div>
                        @endif
                    </div>

                    <!-- Slip Gaji -->
                    <div class="border border-slate-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                        <h4 class="font-bold text-slate-900 mb-3 text-lg">Slip Gaji</h4>
                        @if($application->dokumen_slip_gaji)
                            @if(pathinfo($application->dokumen_slip_gaji, PATHINFO_EXTENSION) === 'pdf')
                                <a href="{{ asset('storage/' . $application->dokumen_slip_gaji) }}" target="_blank" class="block bg-gradient-to-r from-slate-50 to-slate-100 rounded-2xl p-6 text-center hover:from-slate-100 hover:to-slate-200 transition-all">
                                    <span class="material-symbols-outlined text-5xl text-slate-400">picture_as_pdf</span>
                                    <p class="text-sm font-bold text-slate-700 mt-3">Lihat PDF</p>
                                </a>
                            @else
                                <img src="{{ asset('storage/' . $application->dokumen_slip_gaji) }}" alt="Slip Gaji" class="w-full h-48 object-cover rounded-2xl cursor-pointer hover:opacity-90 transition-all shadow-md hover:shadow-xl" data-image-url="{{ asset('storage/' . $application->dokumen_slip_gaji) }}" onclick="openModal(this.dataset.imageUrl)">
                            @endif
                        @else
                            <div class="bg-gradient-to-r from-slate-50 to-slate-100 rounded-2xl p-6 text-center">
                                <span class="material-symbols-outlined text-5xl text-slate-300">image_not_supported</span>
                                <p class="text-sm text-slate-500 mt-3 font-medium">Belum diunggah</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Dokumen Opsional -->
                @if($application->dokumen_npwp || $application->dokumen_surat_kerja || $application->dokumen_rekening)
                    <div class="mt-8 pt-8 border-t border-slate-100">
                        <h4 class="font-bold text-slate-900 mb-6 text-lg">Dokumen Opsional</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- NPWP -->
                            @if($application->dokumen_npwp)
                                <div class="border border-slate-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                                    <h5 class="font-bold text-slate-700 mb-3 text-lg">NPWP</h5>
                                    @if(pathinfo($application->dokumen_npwp, PATHINFO_EXTENSION) === 'pdf')
                                        <a href="{{ asset('storage/' . $application->dokumen_npwp) }}" target="_blank" class="block bg-gradient-to-r from-slate-50 to-slate-100 rounded-2xl p-5 text-center hover:from-slate-100 hover:to-slate-200 transition-all">
                                            <span class="material-symbols-outlined text-4xl text-slate-400">picture_as_pdf</span>
                                            <p class="text-xs font-bold text-slate-700 mt-2">Lihat PDF</p>
                                        </a>
                                    @else
                                        <img src="{{ asset('storage/' . $application->dokumen_npwp) }}" alt="NPWP" class="w-full h-40 object-cover rounded-2xl cursor-pointer hover:opacity-90 transition-all shadow-md hover:shadow-xl" data-image-url="{{ asset('storage/' . $application->dokumen_npwp) }}" onclick="openModal(this.dataset.imageUrl)">
                                    @endif
                                </div>
                            @endif

                            <!-- Surat Kerja -->
                            @if($application->dokumen_surat_kerja)
                                <div class="border border-slate-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                                    <h5 class="font-bold text-slate-700 mb-3 text-lg">Surat Kerja</h5>
                                    @if(pathinfo($application->dokumen_surat_kerja, PATHINFO_EXTENSION) === 'pdf')
                                        <a href="{{ asset('storage/' . $application->dokumen_surat_kerja) }}" target="_blank" class="block bg-gradient-to-r from-slate-50 to-slate-100 rounded-2xl p-5 text-center hover:from-slate-100 hover:to-slate-200 transition-all">
                                            <span class="material-symbols-outlined text-4xl text-slate-400">picture_as_pdf</span>
                                            <p class="text-xs font-bold text-slate-700 mt-2">Lihat PDF</p>
                                        </a>
                                    @else
                                        <img src="{{ asset('storage/' . $application->dokumen_surat_kerja) }}" alt="Surat Kerja" class="w-full h-40 object-cover rounded-2xl cursor-pointer hover:opacity-90 transition-all shadow-md hover:shadow-xl" data-image-url="{{ asset('storage/' . $application->dokumen_surat_kerja) }}" onclick="openModal(this.dataset.imageUrl)">
                                    @endif
                                </div>
                            @endif

                            <!-- Rekening -->
                            @if($application->dokumen_rekening)
                                <div class="border border-slate-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                                    <h5 class="font-bold text-slate-700 mb-3 text-lg">Rekening Koran</h5>
                                    @if(pathinfo($application->dokumen_rekening, PATHINFO_EXTENSION) === 'pdf')
                                        <a href="{{ asset('storage/' . $application->dokumen_rekening) }}" target="_blank" class="block bg-gradient-to-r from-slate-50 to-slate-100 rounded-2xl p-5 text-center hover:from-slate-100 hover:to-slate-200 transition-all">
                                            <span class="material-symbols-outlined text-4xl text-slate-400">picture_as_pdf</span>
                                            <p class="text-xs font-bold text-slate-700 mt-2">Lihat PDF</p>
                                        </a>
                                    @else
                                        <img src="{{ asset('storage/' . $application->dokumen_rekening) }}" alt="Rekening Koran" class="w-full h-40 object-cover rounded-2xl cursor-pointer hover:opacity-90 transition-all shadow-md hover:shadow-xl" data-image-url="{{ asset('storage/' . $application->dokumen_rekening) }}" onclick="openModal(this.dataset.imageUrl)">
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column: Tombol Aksi -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 p-8 sticky top-24">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-slate-700 text-3xl">tune</span>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900">Aksi</h3>
                </div>

                @if(in_array($application->status, ['pending', 'perlu_unggah_ulang']))
                    <!-- ACC Button -->
                    <form method="POST" action="{{ route('admin.applications.approve', $application->id) }}" class="mb-4">
                        @csrf
                        <button type="submit" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-black py-5 rounded-2xl shadow-lg shadow-emerald-600/30 transition-all flex items-center justify-center gap-2 transform hover:scale-[1.02] duration-300">     
                            <span class="material-symbols-outlined text-2xl">check_circle</span>
                            ACC Dokumen (Lanjut Survei)
                        </button>
                    </form>

                    <!-- Tolak Button -->
                    <div x-data="{ showRejectForm: false }">
                        <button @click="showRejectForm = !showRejectForm" type="button" class="w-full bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white font-black py-5 rounded-2xl shadow-lg shadow-rose-600/30 transition-all flex items-center justify-center gap-2 mb-4 transform hover:scale-[1.02] duration-300">
                            <span class="material-symbols-outlined text-2xl">close</span>
                            Tolak / Perbaiki
                        </button>

                        <div x-show="showRejectForm" x-transition class="space-y-4">
                            <form method="POST" action="{{ route('admin.applications.reject', $application->id) }}">
                                @csrf
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Catatan untuk Nasabah</label>
                                    <textarea name="catatan_admin" rows="4" required class="w-full bg-white border border-slate-300 rounded-2xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-all resize-none" placeholder="Contoh: Foto KTP blur, mohon foto ulang di tempat terang..."></textarea>
                                </div>
                                <button type="submit" class="w-full mt-4 bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white font-bold py-4 rounded-2xl transition-all shadow-lg hover:shadow-xl">      
                                    Kirim Catatan
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="bg-gradient-to-r from-slate-50 to-slate-100 rounded-2xl p-8 text-center">
                        <span class="material-symbols-outlined text-6xl text-slate-400">lock</span>
                        <p class="text-sm font-bold text-slate-600 mt-3">Pengajuan sudah di proses</p>
                    </div>
                @endif

                <!-- Form Update Status Manual -->
                <div class="mt-8 pt-8 border-t border-slate-100">
                    <h4 class="font-bold text-slate-700 mb-4 text-lg">Update Status Manual</h4>
                    <form method="POST" action="{{ route('admin.applications.update-status', $application->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <select name="status" class="w-full bg-white border border-slate-300 rounded-2xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                                <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                <option value="survey" {{ $application->status === 'survey' ? 'selected' : '' }}>Survei Lapangan</option>
                                <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>Disetujui</option>
                                <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                <option value="perlu_unggah_ulang" {{ $application->status === 'perlu_unggah_ulang' ? 'selected' : '' }}>Perlu Unggah Ulang</option>
                                <option value="completed" {{ $application->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <textarea name="notes" rows="2" class="w-full bg-white border border-slate-300 rounded-2xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all resize-none" placeholder="Catatan internal (opsional)">{{ $application->notes }}</textarea>        
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-slate-900 to-slate-800 hover:from-slate-800 hover:to-slate-700 text-white font-bold py-4 rounded-2xl transition-all shadow-lg hover:shadow-xl transform hover:scale-[1.01] duration-300">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Image Zoom -->
    <div id="imageModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeModal()">
        <div class="relative max-w-5xl w-full">
            <button type="button" onclick="closeModal()" class="absolute -top-16 right-0 text-white hover:text-slate-200 p-3 bg-slate-900/50 rounded-full backdrop-blur hover:bg-slate-900/80 transition-all">
                <span class="material-symbols-outlined text-4xl">close</span>   
            </button>
            <img id="modalImage" src="" alt="" class="w-full rounded-3xl shadow-2xl">
        </div>
    </div>

    <script>
        function openModal(imageUrl) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageUrl;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</x-admin.layout>
