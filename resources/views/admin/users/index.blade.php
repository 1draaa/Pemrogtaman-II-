<x-admin.layout :title="'Manajemen User'" :headerTitle="'Manajemen User'">
    @if(session('success'))
        <div class="mb-8 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl shadow-lg">
            <p class="font-bold">{{ session('success') }}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="mb-8 bg-gradient-to-r from-rose-50 to-pink-50 border border-rose-200 text-rose-700 px-6 py-4 rounded-2xl shadow-lg">
            <p class="font-bold">{{ session('error') }}</p>
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-end items-start md:items-center gap-6 mb-10">
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-2xl font-black hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl">
            <span class="material-symbols-outlined text-2xl">person_add</span>
            Tambah User Baru
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-slate-50 to-slate-100">
                    <tr>
                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase tracking-wider">Nama</th>
                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase tracking-wider">Email</th>
                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase tracking-wider">Telepon</th>
                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase tracking-wider">Role</th>
                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase tracking-wider">Tanggal Daftar</th>
                        <th class="text-left px-8 py-5 text-sm font-black text-slate-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50 transition-all duration-300">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                                        <span class="text-base font-black text-slate-700">{{ substr($user->name, 0, 2) }}</span>
                                    </div>
                                    <p class="font-bold text-slate-900">{{ $user->name }}</p>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-slate-700 font-semibold">{{ $user->email }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-slate-700 font-semibold">{{ $user->phone ?? '-' }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="inline-flex items-center px-4 py-2 rounded-2xl text-sm font-black {{ $user->role === 'admin' ? 'bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800' : 'bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-800' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-slate-600 font-semibold">{{ $user->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="p-3 bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-800 rounded-xl transition-all duration-300 shadow-sm hover:shadow">
                                        <span class="material-symbols-outlined text-xl">edit</span>
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-3 bg-rose-100 hover:bg-rose-200 text-rose-600 hover:text-rose-800 rounded-xl transition-all duration-300 shadow-sm hover:shadow">
                                                <span class="material-symbols-outlined text-xl">delete</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                        <span class="material-symbols-outlined text-5xl text-slate-400">group</span>
                                    </div>
                                    <p class="text-xl font-bold text-slate-700 mb-2">Belum ada user terdaftar</p>
                                    <p class="text-slate-500">Tambahkan user pertama Anda!</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="px-8 py-6 border-t border-slate-100 bg-slate-50">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</x-admin.layout>
