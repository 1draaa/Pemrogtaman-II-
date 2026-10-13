<x-admin.layout :title="'Daftar Pengajuan'" :headerTitle="'Daftar Pengajuan Kredit'">
    @if(session('success'))
        <div class="mb-8 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl shadow-lg">
            <p class="font-bold">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-slate-50 to-slate-100">
                    <tr>
                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase tracking-wider">No. Pengajuan</th>
                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase tracking-wider">Nasabah</th>
                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase tracking-wider">Motor</th>
                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase tracking-wider">Tenor</th>
                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase tracking-wider">Status</th>
                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase tracking-wider">Tanggal</th>
                        <th class="text-right px-8 py-5 text-sm font-black text-slate-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($applications as $app)
                        <tr class="hover:bg-slate-50 transition-all duration-300">
                            <td class="px-8 py-5">
                                <span class="font-bold text-slate-900 text-lg">{{ $app->application_number }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <div>
                                    <p class="font-bold text-slate-900">{{ $app->customer_name }}</p>
                                    <p class="text-sm text-slate-500 font-medium">{{ $app->customer_phone }}</p>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <p class="font-bold text-slate-900">{{ optional($app->motor)->name ?? '-' }}</p>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-slate-700 font-semibold text-lg">{{ $app->tenor }} Bulan</span>
                            </td>
                            <td class="px-8 py-5">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-gradient-to-r from-amber-100 to-orange-100 text-amber-800',
                                        'survey' => 'bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800',
                                        'approved' => 'bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-800',
                                        'rejected' => 'bg-gradient-to-r from-rose-100 to-pink-100 text-rose-800',
                                        'completed' => 'bg-gradient-to-r from-slate-100 to-slate-200 text-slate-800'
                                    ];
                                    $statusLabels = [
                                        'pending' => 'Menunggu',
                                        'survey' => 'Survei',
                                        'approved' => 'Disetujui',
                                        'rejected' => 'Ditolak',
                                        'completed' => 'Selesai'
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-4 py-2 rounded-2xl text-sm font-black {{ $statusColors[$app->status] ?? 'bg-gradient-to-r from-slate-100 to-slate-200 text-slate-800' }}">
                                    {{ $statusLabels[$app->status] ?? $app->status }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-slate-600 font-semibold">{{ $app->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <a href="{{ route('admin.applications.show', $app->id) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-slate-900 to-slate-800 text-white font-bold rounded-2xl hover:from-slate-800 hover:to-slate-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                                    Review Berkas
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-8 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                        <span class="material-symbols-outlined text-5xl text-slate-400">description</span>
                                    </div>
                                    <p class="text-xl font-bold text-slate-700 mb-2">Belum ada pengajuan kredit</p>
                                    <p class="text-slate-500">Tunggu nasabah mengajukan kredit!</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($applications->hasPages())
            <div class="px-8 py-6 border-t border-slate-100 bg-slate-50">
                {{ $applications->links() }}
            </div>
        @endif
    </div>
</x-admin.layout>
