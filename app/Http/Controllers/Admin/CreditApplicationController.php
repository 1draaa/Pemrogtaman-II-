<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreditApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->role !== 'admin') {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $applications = Application::with(['user', 'motor', 'leasing'])
            ->latest()
            ->paginate(10);

        return view('admin.applications.index', compact('applications'));
    }

    public function show(int $id)
    {
        $application = Application::with(['user', 'motor', 'leasing'])
            ->findOrFail($id);

        return view('admin.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, int $id)
    {
        $request->validate([
            'status' => 'required|in:pending,survey,approved,rejected,completed,perlu_unggah_ulang',
            'notes' => 'nullable|string',
            'catatan_admin' => 'nullable|string'
        ]);

        $application = Application::findOrFail($id);
        $application->update([
            'status' => $request->input('status'),
            'notes' => $request->input('notes'),
            'catatan_admin' => $request->input('catatan_admin')
        ]);

        return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    public function approve(int $id)
    {
        $application = Application::findOrFail($id);
        $application->update([
            'status' => 'approved',
            'catatan_admin' => null
        ]);

        return redirect()->back()->with('success', 'Dokumen diterima! Pengajuan disetujui.');
    }

    public function reject(Request $request, int $id)
    {
        $request->validate([
            'catatan_admin' => 'required|string|min:10'
        ]);

        $application = Application::findOrFail($id);
        $application->update([
            'status' => 'perlu_unggah_ulang',
            'catatan_admin' => $request->input('catatan_admin')
        ]);

        return redirect()->back()->with('success', 'Dokumen ditolak. Nasabah akan melihat catatan Anda.');
    }
}
