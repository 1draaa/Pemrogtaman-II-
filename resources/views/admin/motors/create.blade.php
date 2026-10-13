<x-admin.layout :title="'Tambah Unit Motor'" :headerTitle="'Tambah Unit Motor Baru'">
    <a href="{{ route('admin.dashboard') }}#stok" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-slate-900 mb-10">
        <span class="material-symbols-outlined">arrow_back</span>
        Kembali ke Manajemen Stok
    </a>

    <form 
        action="{{ isset($motor) ? route('admin.motors.update', $motor) : route('admin.motors.store') }}" 
        method="POST" 
        enctype="multipart/form-data"
        class="bg-white rounded-3xl shadow-2xl border border-slate-200 p-10"
    >
        @csrf
        @if(isset($motor))
            @method('PUT')
        @endif

        @if ($errors->any())
            <div class="mb-8 bg-gradient-to-r from-rose-50 to-pink-50 border border-rose-200 rounded-2xl p-6">
                <div class="flex items-center gap-3 text-rose-800 font-extrabold mb-4">
                    <span class="material-symbols-outlined text-2xl">error</span>
                    Ada kesalahan dalam pengisian form
                </div>
                <ul class="text-base text-rose-700 list-disc list-inside space-y-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Kolom Kiri: Info Dasar -->
            <div class="space-y-8">
                <h3 class="text-2xl font-extrabold text-slate-900">Informasi Dasar</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Merek</label>
                        <select name="brand" class="w-full px-5 py-4 border border-slate-200 bg-slate-50 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-900 font-semibold" required>
                            <option value="">Pilih Merek</option>
                            <option value="Honda" {{ (isset($motor) && $motor->brand === 'Honda') ? 'selected' : '' }}>Honda</option>
                            <option value="Yamaha" {{ (isset($motor) && $motor->brand === 'Yamaha') ? 'selected' : '' }}>Yamaha</option>
                            <option value="Suzuki" {{ (isset($motor) && $motor->brand === 'Suzuki') ? 'selected' : '' }}>Suzuki</option>
                            <option value="Kawasaki" {{ (isset($motor) && $motor->brand === 'Kawasaki') ? 'selected' : '' }}>Kawasaki</option>
                            <option value="Ducati" {{ (isset($motor) && $motor->brand === 'Ducati') ? 'selected' : '' }}>Ducati</option>
                            <option value="Piaggio" {{ (isset($motor) && $motor->brand === 'Piaggio') ? 'selected' : '' }}>Piaggio</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Model</label>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ isset($motor) ? $motor->name : old('name') }}"
                            class="w-full px-5 py-4 border border-slate-200 bg-slate-50 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-900 font-semibold"
                            placeholder="Contoh: Beat Street CBS"
                            required
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Tipe</label>
                        <select name="type" class="w-full px-5 py-4 border border-slate-200 bg-slate-50 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-900 font-semibold" required>
                            <option value="">Pilih Tipe</option>
                            <option value="Matic" {{ (isset($motor) && $motor->type === 'Matic') ? 'selected' : '' }}>Matic</option>
                            <option value="Manual" {{ (isset($motor) && $motor->type === 'Manual') ? 'selected' : '' }}>Manual</option>
                            <option value="Cub" {{ (isset($motor) && $motor->type === 'Cub') ? 'selected' : '' }}>Bebek</option>
                            <option value="Sport" {{ (isset($motor) && $motor->type === 'Sport') ? 'selected' : '' }}>Sport</option>
                            <option value="Moge" {{ (isset($motor) && $motor->type === 'Moge') ? 'selected' : '' }}>Moge</option>
                            <option value="Adventure" {{ (isset($motor) && $motor->type === 'Adventure') ? 'selected' : '' }}>Adventure</option>
                            <option value="Cruiser" {{ (isset($motor) && $motor->type === 'Cruiser') ? 'selected' : '' }}>Cruiser</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Tahun</label>
                        <input 
                            type="number" 
                            name="year" 
                            value="{{ isset($motor) ? $motor->year : old('year') }}"
                            class="w-full px-5 py-4 border border-slate-200 bg-slate-50 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-900 font-semibold"
                            placeholder="2024"
                            required
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Odometer (km)</label>
                        <input 
                            type="number" 
                            name="odometer" 
                            value="{{ isset($motor) ? $motor->odometer : old('odometer') }}"
                            class="w-full px-5 py-4 border border-slate-200 bg-slate-50 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-900 font-semibold"
                            placeholder="5000"
                            required
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Status Pajak</label>
                        <input 
                            type="text" 
                            name="tax_status" 
                            value="{{ isset($motor) ? $motor->tax_status : old('tax_status') }}"
                            class="w-full px-5 py-4 border border-slate-200 bg-slate-50 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-900 font-semibold"
                            placeholder="Hidup"
                            required
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Bahan Bakar</label>
                        <select name="bahan_bakar" class="w-full px-5 py-4 border border-slate-200 bg-slate-50 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-900 font-semibold" required>
                            <option value="Bensin" {{ (isset($motor) && $motor->bahan_bakar === 'Bensin') ? 'selected' : '' }}>Bensin</option>
                            <option value="Listrik" {{ (isset($motor) && $motor->bahan_bakar === 'Listrik') ? 'selected' : '' }}>Listrik</option>
                            <option value="Hybrid" {{ (isset($motor) && $motor->bahan_bakar === 'Hybrid') ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Grade Kondisi</label>
                        <select name="grade_kondisi" class="w-full px-5 py-4 border border-slate-200 bg-slate-50 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-900 font-semibold" required>
                            <option value="">Pilih Grade</option>
                            <option value="Grade A" {{ (isset($motor) && $motor->grade_kondisi === 'Grade A') ? 'selected' : '' }}>A (Sangat Baik)</option>
                            <option value="Grade B" {{ (isset($motor) && $motor->grade_kondisi === 'Grade B') ? 'selected' : '' }}>B (Baik)</option>
                            <option value="Grade C" {{ (isset($motor) && $motor->grade_kondisi === 'Grade C') ? 'selected' : '' }}>C (Cukup)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Harga & Media -->
            <div class="space-y-8">
                <h3 class="text-2xl font-extrabold text-slate-900">Harga & Media</h3>
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-3">Harga Tunai (Rp)</label>
                    <input 
                        type="number" 
                        name="price" 
                        value="{{ isset($motor) ? $motor->price : old('price') }}"
                        class="w-full px-5 py-4 border border-slate-200 bg-slate-50 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-900 font-semibold text-xl"
                        placeholder="15500000"
                        required
                    >
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Status Unit</label>
                        <select name="is_available" class="w-full px-5 py-4 border border-slate-200 bg-slate-50 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-900 font-semibold">
                            <option value="1" {{ (isset($motor) && $motor->is_available) ? 'selected' : '' }}>Tersedia</option>
                            <option value="0" {{ (isset($motor) && !$motor->is_available) ? 'selected' : '' }}>Terjual</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-3">Tag Promosi</label>
                        <input 
                            type="text" 
                            name="tag_promosi" 
                            value="{{ isset($motor) ? $motor->tag_promosi : old('tag_promosi') }}"
                            class="w-full px-5 py-4 border border-slate-200 bg-slate-50 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-900 font-semibold"
                            placeholder="Baru Masuk"
                        >
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-3">Deskripsi Motor</label>
                    <textarea 
                        name="description" 
                        rows="4"
                        class="w-full px-5 py-4 border border-slate-200 bg-slate-50 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 text-slate-900 font-semibold"
                        placeholder="Deskripsi unit motor, kondisi, fitur, dll..."
                    >{{ isset($motor) ? $motor->description : old('description') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-3">Upload Foto Unit</label>
                    <div class="border-3 border-dashed border-slate-300 rounded-2xl p-8 text-center" id="upload-container">
                        <input 
                            type="file" 
                            name="fotos[]" 
                            multiple
                            accept="image/*"
                            class="hidden"
                            id="foto_input"
                        >
                        <label for="foto_input" class="cursor-pointer" id="upload-label">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-slate-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-lg font-bold text-slate-700">Klik untuk upload foto</p>
                            <p class="text-sm text-slate-500 mt-2">Bisa pilih lebih dari 1 foto. Max 10MB per foto, format JPG/PNG</p>
                        </label>
                        <div id="fotos_preview" class="grid grid-cols-3 gap-4 mt-6"></div>
                    </div>
                    @if(isset($motor) && $motor->galleries->count() > 0)
                        <div class="mt-6">
                            <p class="text-sm font-bold text-slate-700 mb-4">Foto saat ini:</p>
                            <div class="grid grid-cols-3 gap-4">
                                @foreach($motor->galleries as $gallery)
                                    <div class="relative group">
                                        <img 
                                            src="{{ asset('storage/' . $gallery->foto_path) }}" 
                                            alt="Foto Motor" 
                                            class="w-full h-24 object-cover rounded-2xl border-2 border-slate-200 shadow-sm"
                                        >
                                        <button 
                                            type="button"
                                            class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity bg-red-500 text-white p-1.5 rounded-full hover:bg-red-600 transition"
                                            onclick="deleteGallery({{ $motor->id }}, {{ $gallery->id }})"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                                @if($motor->image && !$motor->galleries->contains('foto_path', $motor->image))
                                    <img 
                                        src="{{ asset('storage/' . $motor->image) }}" 
                                        alt="Foto Motor" 
                                        class="w-full h-24 object-cover rounded-2xl border-2 border-slate-200 shadow-sm"
                                    >
                                @endif
                            </div>
                        </div>
                    @elseif(isset($motor) && $motor->image)
                        <div class="mt-6">
                            <p class="text-sm font-bold text-slate-700 mb-4">Foto saat ini:</p>
                            <img 
                                src="{{ asset('storage/' . $motor->image) }}" 
                                alt="{{ $motor->name }}" 
                                class="w-full h-52 object-cover rounded-2xl border-2 border-slate-200 shadow-sm"
                            >
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-10 pt-8 border-t border-slate-200 flex gap-6">
            <a href="{{ route('admin.dashboard') }}#stok" class="flex-1 bg-slate-100 text-slate-700 py-5 rounded-2xl font-extrabold text-xl hover:bg-slate-200 transition-all duration-300 text-center shadow-sm hover:shadow">
                Batal
            </a>
            <button type="submit" class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-5 rounded-2xl font-extrabold text-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                {{ isset($motor) ? 'Perbarui Data Motor' : 'Simpan Data Motor' }}
            </button>
        </div>
    </form>

    <!-- Hidden form for deleting gallery photos -->
    <form id="delete-gallery-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function deleteGallery(motorId, galleryId) {
            if (confirm('Yakin ingin menghapus foto ini?')) {
                const form = document.getElementById('delete-gallery-form');
                form.action = `/admin/motors/${motorId}/galleries/${galleryId}`;
                form.submit();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const fotoInput = document.getElementById('foto_input');
            const fotosPreview = document.getElementById('fotos_preview');
            const uploadLabel = document.getElementById('upload-label');

            if (fotoInput) {
                fotoInput.addEventListener('change', function() {
                    fotosPreview.innerHTML = '';
                    const files = this.files;
                    
                    if (files.length > 0) {
                        uploadLabel.classList.add('hidden');
                        
                        Array.from(files).forEach((file, index) => {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.alt = 'Preview Foto ' + (index + 1);
                                img.className = 'w-full h-24 object-cover rounded-2xl border-2 border-slate-200 shadow-sm';
                                fotosPreview.appendChild(img);
                            };
                            reader.readAsDataURL(file);
                        });
                    } else {
                        uploadLabel.classList.remove('hidden');
                    }
                });
            }
        });
    </script>
</x-admin.layout>
