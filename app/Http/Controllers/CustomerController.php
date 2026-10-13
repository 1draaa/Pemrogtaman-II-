<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $application = Application::where('user_id', Auth::id())
            ->with(['motor.galleries', 'leasing'])
            ->latest()
            ->first();

        $documents = [
            'ktp' => [
                'status' => $this->getDocumentStatus($application?->dokumen_ktp, $application?->status),
                'uploaded' => !empty($application?->dokumen_ktp)
            ],
            'kk' => [
                'status' => $this->getDocumentStatus($application?->dokumen_kk, $application?->status),
                'uploaded' => !empty($application?->dokumen_kk)
            ],
            'slip_gaji' => [
                'status' => $this->getDocumentStatus($application?->dokumen_slip_gaji, $application?->status),
                'uploaded' => !empty($application?->dokumen_slip_gaji)
            ]
        ];

        $hasRejectedDocuments = $application?->status === 'perlu_unggah_ulang';

        // Logic untuk 5 steps: 1.Berkas Terkirim, 2.Verifikasi Admin, 3.Survei Lapangan, 4.Persetujuan Leasing, 5.Selesai
        $currentStep = -1;
        $persentase_progres = 0;
        if ($application) {
            $status = $application->status;
            
            $steps = [
                'pending' => 0,
                'verifikasi_admin' => 1,
                'survey' => 2,
                'approved' => 3,
                'completed' => 4
            ];
            $currentStep = $steps[$status] ?? 0;
            
            $persentase_progres_arr = [0 => 0, 1 => 25, 2 => 50, 3 => 75, 4 => 100];
            $persentase_progres = $persentase_progres_arr[$currentStep] ?? 0;
        }

        return view('customer.dashboard', compact('application', 'documents', 'hasRejectedDocuments', 'currentStep', 'persentase_progres'));
    }

    public function pengajuan()
    {
        $applications = Application::where('user_id', Auth::id())->with('motor.galleries')->latest()->get();
        return view('customer.pengajuan', compact('applications'));
    }

    private function getDocumentStatus(?string $documentPath, ?string $applicationStatus): string
    {
        if (empty($documentPath)) {
            return 'pending';
        }

        if ($applicationStatus === 'perlu_unggah_ulang') {
            return 'rejected';
        }

        if (\in_array($applicationStatus, ['survey', 'approved', 'rejected', 'completed'])) {
            return 'verified';
        }

        return 'pending';
    }

    public function destroy(int $id)
    {
        $application = Application::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $application->delete();

        return redirect()->back()->with('success', 'Pengajuan berhasil dihapus.');
    }

    public function profile()
    {
        return view('customer.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }

    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        /** @var User $user */
        $user = Auth::user();
        Auth::logout();
        
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Akun Anda berhasil dihapus.');
    }
}
