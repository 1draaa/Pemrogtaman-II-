<x-layouts::customer :title="__('Dokumen')">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <div class="min-h-screen bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 py-10" x-data="documentManager()">
            <h1 class="text-3xl font-black text-slate-900 mb-8">{{ __('Dokumen Saya') }}</h1>
            
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-8 bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Alert if status is perlu_unggah_ulang -->
            @if(optional($application)->status === 'perlu_unggah_ulang' && optional($application)->catatan_admin)
                <div class="mb-8 bg-rose-50 border border-rose-200 rounded-2xl p-6 flex items-start gap-4">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-rose-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-rose-800">{{ __('Dokumen Perlu Diperbaiki') }}</h3>
                        <p class="text-sm text-rose-700 mt-1">{{ optional($application)->catatan_admin }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Dokumen 1: KTP -->
                    <div class="bg-white shadow-sm rounded-2xl p-6 border" :class="documents.ktp.status === 'verified' ? 'border-emerald-200' : documents.ktp.status === 'rejected' ? 'border-rose-200' : 'border-slate-200'">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-bold text-slate-900 mb-1">{{ __('KTP') }} <span class="text-red-500">*</span></h3>
                                <p class="text-xs text-slate-500">{{ __('Kartu Tanda Penduduk') }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                  :class="documents.ktp.status === 'verified' ? 'bg-emerald-100 text-emerald-800' : documents.ktp.status === 'rejected' ? 'bg-rose-100 text-rose-800' : 'bg-amber-100 text-amber-800'">
                                <span x-text="documents.ktp.status === 'verified' ? 'Terverifikasi' : documents.ktp.status === 'rejected' ? 'Ditolak' : 'Menunggu'"></span>
                            </span>
                        </div>
                        
                        <!-- Preview if uploaded -->
                        <template x-if="documents.ktp.file || documents.ktp.existingPath">
                            <div class="mb-4">
                                <div class="relative bg-slate-100 rounded-xl p-4 flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-slate-900 truncate" x-text="documents.ktp.fileName || 'Dokumen telah diunggah'"></p>
                                        <p class="text-xs text-slate-500" x-text="documents.ktp.fileSize ? formatFileSize(documents.ktp.fileSize) : ''"></p>
                                    </div>
                                    <button type="button" @click="removeDocument('ktp')" class="p-1 text-slate-400 hover:text-rose-600 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </template>

                        <!-- Upload Button -->
                        <div x-show="!documents.ktp.file && !documents.ktp.existingPath">
                            <label class="flex items-center justify-center w-full h-24 border-2 border-dashed rounded-xl cursor-pointer transition-colors"
                                   :class="documents.ktp.status === 'rejected' ? 'border-rose-300 hover:border-rose-400 bg-rose-50' : 'border-slate-300 hover:border-primary bg-slate-50'">
                                <input type="file" name="ktp" class="hidden" accept=".pdf,.jpg,.jpeg,.png" @change="handleFileUpload('ktp', $event)">
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto mb-2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="text-sm font-medium text-slate-600">{{ __('Klik untuk unggah') }}</p>
                                    <p class="text-xs text-slate-400 mt-1">{{ __('PDF/JPG/PNG, max 2MB') }}</p>
                                </div>
                            </label>
                        </div>

                        <template x-if="documents.ktp.file || documents.ktp.existingPath">
                            <button type="button" @click="removeDocument('ktp')" 
                                    class="mt-4 w-full border border-slate-300 hover:border-slate-400 text-slate-700 font-medium py-2 rounded-lg transition-colors">
                                {{ __('Ubah Dokumen') }}
                            </button>
                        </template>
                    </div>

                    <!-- Dokumen 2: KK -->
                    <div class="bg-white shadow-sm rounded-2xl p-6 border" :class="documents.kk.status === 'verified' ? 'border-emerald-200' : documents.kk.status === 'rejected' ? 'border-rose-200' : 'border-slate-200'">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-bold text-slate-900 mb-1">{{ __('KK') }} <span class="text-red-500">*</span></h3>
                                <p class="text-xs text-slate-500">{{ __('Kartu Keluarga') }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                  :class="documents.kk.status === 'verified' ? 'bg-emerald-100 text-emerald-800' : documents.kk.status === 'rejected' ? 'bg-rose-100 text-rose-800' : 'bg-amber-100 text-amber-800'">
                                <span x-text="documents.kk.status === 'verified' ? 'Terverifikasi' : documents.kk.status === 'rejected' ? 'Ditolak' : 'Menunggu'"></span>
                            </span>
                        </div>
                        
                        <template x-if="documents.kk.file || documents.kk.existingPath">
                            <div class="mb-4">
                                <div class="relative bg-slate-100 rounded-xl p-4 flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-slate-900 truncate" x-text="documents.kk.fileName || 'Dokumen telah diunggah'"></p>
                                        <p class="text-xs text-slate-500" x-text="documents.kk.fileSize ? formatFileSize(documents.kk.fileSize) : ''"></p>
                                    </div>
                                    <button type="button" @click="removeDocument('kk')" class="p-1 text-slate-400 hover:text-rose-600 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </template>

                        <div x-show="!documents.kk.file && !documents.kk.existingPath">
                            <label class="flex items-center justify-center w-full h-24 border-2 border-dashed rounded-xl cursor-pointer transition-colors"
                                   :class="documents.kk.status === 'rejected' ? 'border-rose-300 hover:border-rose-400 bg-rose-50' : 'border-slate-300 hover:border-primary bg-slate-50'">
                                <input type="file" name="kk" class="hidden" accept=".pdf,.jpg,.jpeg,.png" @change="handleFileUpload('kk', $event)">
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto mb-2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="text-sm font-medium text-slate-600">{{ __('Klik untuk unggah') }}</p>
                                    <p class="text-xs text-slate-400 mt-1">{{ __('PDF/JPG/PNG, max 2MB') }}</p>
                                </div>
                            </label>
                        </div>

                        <template x-if="documents.kk.file || documents.kk.existingPath">
                            <button type="button" @click="removeDocument('kk')" 
                                    class="mt-4 w-full border border-slate-300 hover:border-slate-400 text-slate-700 font-medium py-2 rounded-lg transition-colors">
                                {{ __('Ubah Dokumen') }}
                            </button>
                        </template>
                    </div>

                    <!-- Dokumen 3: Slip Gaji -->
                    <div class="bg-white shadow-sm rounded-2xl p-6 border" :class="documents.slip_gaji.status === 'verified' ? 'border-emerald-200' : documents.slip_gaji.status === 'rejected' ? 'border-rose-200' : 'border-slate-200'">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-bold text-slate-900 mb-1">{{ __('Slip Gaji') }} <span class="text-red-500">*</span></h3>
                                <p class="text-xs text-slate-500">{{ __('Bukti Penghasilan') }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                  :class="documents.slip_gaji.status === 'verified' ? 'bg-emerald-100 text-emerald-800' : documents.slip_gaji.status === 'rejected' ? 'bg-rose-100 text-rose-800' : 'bg-amber-100 text-amber-800'">
                                <span x-text="documents.slip_gaji.status === 'verified' ? 'Terverifikasi' : documents.slip_gaji.status === 'rejected' ? 'Ditolak' : 'Menunggu'"></span>
                            </span>
                        </div>
                        
                        <template x-if="documents.slip_gaji.file || documents.slip_gaji.existingPath">
                            <div class="mb-4">
                                <div class="relative bg-slate-100 rounded-xl p-4 flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-slate-900 truncate" x-text="documents.slip_gaji.fileName || 'Dokumen telah diunggah'"></p>
                                        <p class="text-xs text-slate-500" x-text="documents.slip_gaji.fileSize ? formatFileSize(documents.slip_gaji.fileSize) : ''"></p>
                                    </div>
                                    <button type="button" @click="removeDocument('slip_gaji')" class="p-1 text-slate-400 hover:text-rose-600 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </template>

                        <div x-show="!documents.slip_gaji.file && !documents.slip_gaji.existingPath">
                            <label class="flex items-center justify-center w-full h-24 border-2 border-dashed rounded-xl cursor-pointer transition-colors"
                                   :class="documents.slip_gaji.status === 'rejected' ? 'border-rose-300 hover:border-rose-400 bg-rose-50' : 'border-slate-300 hover:border-primary bg-slate-50'">
                                <input type="file" name="slip_gaji" class="hidden" accept=".pdf,.jpg,.jpeg,.png" @change="handleFileUpload('slip_gaji', $event)">
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto mb-2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="text-sm font-medium text-slate-600">{{ __('Klik untuk unggah') }}</p>
                                    <p class="text-xs text-slate-400 mt-1">{{ __('PDF/JPG/PNG, max 2MB') }}</p>
                                </div>
                            </label>
                        </div>

                        <template x-if="documents.slip_gaji.file || documents.slip_gaji.existingPath">
                            <button type="button" @click="removeDocument('slip_gaji')" 
                                    class="mt-4 w-full border border-slate-300 hover:border-slate-400 text-slate-700 font-medium py-2 rounded-lg transition-colors">
                                {{ __('Ubah Dokumen') }}
                            </button>
                        </template>
                    </div>

                    <!-- Dokumen 4: NPWP -->
                    <div class="bg-white shadow-sm rounded-2xl p-6 border" :class="documents.npwp.status === 'verified' ? 'border-emerald-200' : documents.npwp.status === 'rejected' ? 'border-rose-200' : 'border-slate-200'">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-bold text-slate-900 mb-1">{{ __('NPWP') }}</h3>
                                <p class="text-xs text-slate-500">{{ __('Nomor Pokok Wajib Pajak') }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                  :class="documents.npwp.status === 'verified' ? 'bg-emerald-100 text-emerald-800' : documents.npwp.status === 'rejected' ? 'bg-rose-100 text-rose-800' : 'bg-amber-100 text-amber-800'">
                                <span x-text="documents.npwp.status === 'verified' ? 'Terverifikasi' : documents.npwp.status === 'rejected' ? 'Ditolak' : 'Opsional'"></span>
                            </span>
                        </div>
                        
                        <template x-if="documents.npwp.file || documents.npwp.existingPath">
                            <div class="mb-4">
                                <div class="relative bg-slate-100 rounded-xl p-4 flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-slate-900 truncate" x-text="documents.npwp.fileName || 'Dokumen telah diunggah'"></p>
                                        <p class="text-xs text-slate-500" x-text="documents.npwp.fileSize ? formatFileSize(documents.npwp.fileSize) : ''"></p>
                                    </div>
                                    <button type="button" @click="removeDocument('npwp')" class="p-1 text-slate-400 hover:text-rose-600 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </template>

                        <div x-show="!documents.npwp.file && !documents.npwp.existingPath">
                            <label class="flex items-center justify-center w-full h-24 border-2 border-dashed rounded-xl cursor-pointer transition-colors"
                                   :class="documents.npwp.status === 'rejected' ? 'border-rose-300 hover:border-rose-400 bg-rose-50' : 'border-slate-300 hover:border-primary bg-slate-50'">
                                <input type="file" name="npwp" class="hidden" accept=".pdf,.jpg,.jpeg,.png" @change="handleFileUpload('npwp', $event)">
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto mb-2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="text-sm font-medium text-slate-600">{{ __('Klik untuk unggah') }}</p>
                                    <p class="text-xs text-slate-400 mt-1">{{ __('PDF/JPG/PNG, max 2MB') }}</p>
                                </div>
                            </label>
                        </div>

                        <template x-if="documents.npwp.file || documents.npwp.existingPath">
                            <button type="button" @click="removeDocument('npwp')" 
                                    class="mt-4 w-full border border-slate-300 hover:border-slate-400 text-slate-700 font-medium py-2 rounded-lg transition-colors">
                                {{ __('Ubah Dokumen') }}
                            </button>
                        </template>
                    </div>

                    <!-- Dokumen 5: Surat Keterangan Kerja -->
                    <div class="bg-white shadow-sm rounded-2xl p-6 border" :class="documents.surat_kerja.status === 'verified' ? 'border-emerald-200' : documents.surat_kerja.status === 'rejected' ? 'border-rose-200' : 'border-slate-200'">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-bold text-slate-900 mb-1">{{ __('Surat Kerja') }}</h3>
                                <p class="text-xs text-slate-500">{{ __('Surat Keterangan Kerja') }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                  :class="documents.surat_kerja.status === 'verified' ? 'bg-emerald-100 text-emerald-800' : documents.surat_kerja.status === 'rejected' ? 'bg-rose-100 text-rose-800' : 'bg-amber-100 text-amber-800'">
                                <span x-text="documents.surat_kerja.status === 'verified' ? 'Terverifikasi' : documents.surat_kerja.status === 'rejected' ? 'Ditolak' : 'Opsional'"></span>
                            </span>
                        </div>
                        
                        <template x-if="documents.surat_kerja.file || documents.surat_kerja.existingPath">
                            <div class="mb-4">
                                <div class="relative bg-slate-100 rounded-xl p-4 flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-slate-900 truncate" x-text="documents.surat_kerja.fileName || 'Dokumen telah diunggah'"></p>
                                        <p class="text-xs text-slate-500" x-text="documents.surat_kerja.fileSize ? formatFileSize(documents.surat_kerja.fileSize) : ''"></p>
                                    </div>
                                    <button type="button" @click="removeDocument('surat_kerja')" class="p-1 text-slate-400 hover:text-rose-600 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </template>

                        <div x-show="!documents.surat_kerja.file && !documents.surat_kerja.existingPath">
                            <label class="flex items-center justify-center w-full h-24 border-2 border-dashed rounded-xl cursor-pointer transition-colors"
                                   :class="documents.surat_kerja.status === 'rejected' ? 'border-rose-300 hover:border-rose-400 bg-rose-50' : 'border-slate-300 hover:border-primary bg-slate-50'">
                                <input type="file" name="surat_kerja" class="hidden" accept=".pdf,.jpg,.jpeg,.png" @change="handleFileUpload('surat_kerja', $event)">
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto mb-2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="text-sm font-medium text-slate-600">{{ __('Klik untuk unggah') }}</p>
                                    <p class="text-xs text-slate-400 mt-1">{{ __('PDF/JPG/PNG, max 2MB') }}</p>
                                </div>
                            </label>
                        </div>

                        <template x-if="documents.surat_kerja.file || documents.surat_kerja.existingPath">
                            <button type="button" @click="removeDocument('surat_kerja')" 
                                    class="mt-4 w-full border border-slate-300 hover:border-slate-400 text-slate-700 font-medium py-2 rounded-lg transition-colors">
                                {{ __('Ubah Dokumen') }}
                            </button>
                        </template>
                    </div>

                    <!-- Dokumen 6: Rekening Koran -->
                    <div class="bg-white shadow-sm rounded-2xl p-6 border" :class="documents.rekening.status === 'verified' ? 'border-emerald-200' : documents.rekening.status === 'rejected' ? 'border-rose-200' : 'border-slate-200'">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-bold text-slate-900 mb-1">{{ __('Rekening Koran') }}</h3>
                                <p class="text-xs text-slate-500">{{ __('3 Bulan Terakhir') }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                  :class="documents.rekening.status === 'verified' ? 'bg-emerald-100 text-emerald-800' : documents.rekening.status === 'rejected' ? 'bg-rose-100 text-rose-800' : 'bg-amber-100 text-amber-800'">
                                <span x-text="documents.rekening.status === 'verified' ? 'Terverifikasi' : documents.rekening.status === 'rejected' ? 'Ditolak' : 'Opsional'"></span>
                            </span>
                        </div>
                        
                        <template x-if="documents.rekening.file || documents.rekening.existingPath">
                            <div class="mb-4">
                                <div class="relative bg-slate-100 rounded-xl p-4 flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-slate-900 truncate" x-text="documents.rekening.fileName || 'Dokumen telah diunggah'"></p>
                                        <p class="text-xs text-slate-500" x-text="documents.rekening.fileSize ? formatFileSize(documents.rekening.fileSize) : ''"></p>
                                    </div>
                                    <button type="button" @click="removeDocument('rekening')" class="p-1 text-slate-400 hover:text-rose-600 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </template>

                        <div x-show="!documents.rekening.file && !documents.rekening.existingPath">
                            <label class="flex items-center justify-center w-full h-24 border-2 border-dashed rounded-xl cursor-pointer transition-colors"
                                   :class="documents.rekening.status === 'rejected' ? 'border-rose-300 hover:border-rose-400 bg-rose-50' : 'border-slate-300 hover:border-primary bg-slate-50'">
                                <input type="file" name="rekening" class="hidden" accept=".pdf,.jpg,.jpeg,.png" @change="handleFileUpload('rekening', $event)">
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto mb-2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="text-sm font-medium text-slate-600">{{ __('Klik untuk unggah') }}</p>
                                    <p class="text-xs text-slate-400 mt-1">{{ __('PDF/JPG/PNG, max 2MB') }}</p>
                                </div>
                            </label>
                        </div>

                        <template x-if="documents.rekening.file || documents.rekening.existingPath">
                            <button type="button" @click="removeDocument('rekening')" 
                                    class="mt-4 w-full border border-slate-300 hover:border-slate-400 text-slate-700 font-medium py-2 rounded-lg transition-colors">
                                {{ __('Ubah Dokumen') }}
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Simpan Semua Button -->
                <div class="mt-10 flex justify-end">
                    <button type="submit" class="px-8 py-3 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-xl shadow-lg shadow-slate-900/10 transition-all">
                        {{ __('Simpan Semua Dokumen') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function documentManager() {
            return {
                documents: {
                    ktp: { 
                        file: null, 
                        fileName: null, 
                        fileSize: null, 
                        status: '{{ $documentStatuses['ktp'] ?? 'pending' }}',
                        existingPath: '{{ optional($application)->dokumen_ktp ?? "" }}'
                    },
                    kk: { 
                        file: null, 
                        fileName: null, 
                        fileSize: null, 
                        status: '{{ $documentStatuses['kk'] ?? 'pending' }}',
                        existingPath: '{{ optional($application)->dokumen_kk ?? "" }}'
                    },
                    slip_gaji: { 
                        file: null, 
                        fileName: null, 
                        fileSize: null, 
                        status: '{{ $documentStatuses['slip_gaji'] ?? 'pending' }}',
                        existingPath: '{{ optional($application)->dokumen_slip_gaji ?? "" }}'
                    },
                    npwp: { 
                        file: null, 
                        fileName: null, 
                        fileSize: null, 
                        status: '{{ $documentStatuses['npwp'] ?? 'pending' }}',
                        existingPath: '{{ optional($application)->dokumen_npwp ?? "" }}'
                    },
                    surat_kerja: { 
                        file: null, 
                        fileName: null, 
                        fileSize: null, 
                        status: '{{ $documentStatuses['surat_kerja'] ?? 'pending' }}',
                        existingPath: '{{ optional($application)->dokumen_surat_kerja ?? "" }}'
                    },
                    rekening: { 
                        file: null, 
                        fileName: null, 
                        fileSize: null, 
                        status: '{{ $documentStatuses['rekening'] ?? 'pending' }}',
                        existingPath: '{{ optional($application)->dokumen_rekening ?? "" }}'
                    }
                },
                get hasRejectedDocuments() {
                    return Object.values(this.documents).some(doc => doc.status === 'rejected');
                },
                handleFileUpload(docType, event) {
                    const file = event.target.files[0];
                    if (file) {
                        if (file.size > 2 * 1024 * 1024) {
                            alert('Ukuran file terlalu besar. Maksimal 2MB.');
                            return;
                        }
                        this.documents[docType].file = file;
                        this.documents[docType].fileName = file.name;
                        this.documents[docType].fileSize = file.size;
                        this.documents[docType].status = 'pending';
                        this.documents[docType].existingPath = null;
                    }
                },
                removeDocument(docType) {
                    this.documents[docType].file = null;
                    this.documents[docType].fileName = null;
                    this.documents[docType].fileSize = null;
                    this.documents[docType].status = 'pending';
                    this.documents[docType].existingPath = null;
                },
                formatFileSize(bytes) {
                    if (bytes === 0) return '0 Bytes';
                    const k = 1024;
                    const sizes = ['Bytes', 'KB', 'MB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                }
            }
        }
    </script>
</x-layouts::customer>
