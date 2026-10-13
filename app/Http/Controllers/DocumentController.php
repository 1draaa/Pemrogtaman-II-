<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Motor;
use App\Models\Leasing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function create(Request $request)
    {
        $motor = Motor::find($request->motor_id) ?? Motor::where('slug', 'honda-beat-street-cbs')->first();
        
        if (!$motor) {
            $motor = Motor::create([
                'name' => 'Honda Beat Street CBS',
                'slug' => 'honda-beat-street-cbs',
                'brand' => 'Honda',
                'type' => 'Matic',
                'year' => 2023,
                'price' => 15500000,
                'odometer' => 3200,
                'tax_status' => 'Hidup',
                'grade' => 'A',
                'image' => 'https://images.unsplash.com/photo-1558618666-fcd2585cd64?q=80&w=2070&auto=format&fit=crop',
                'is_available' => true
            ]);
        }

        $minDp = $motor->price * 0.1;
        $maxDp = $motor->price * 0.6;

        $request->validate([
            'motor_id' => 'nullable|integer',
            'dp' => 'nullable|numeric|min:' . $minDp . '|max:' . $maxDp,
            'tenor' => 'nullable|integer',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $leasing = Leasing::where('slug', 'adira-finance')->first();
        
        if (!$leasing) {
            $leasing = Leasing::create([
                'name' => 'Adira Finance',
                'slug' => 'adira-finance',
                'interest_rate' => 8.00,
                'is_active' => true
            ]);
        }

        $downPayment = $request->dp ?? 0;
        $tenor = $request->tenor ?? 12;
        $pokokHutang = $motor->price - $downPayment;
        $totalBunga = $pokokHutang * 0.08 * ($tenor / 12);
        $monthlyInstallment = ($pokokHutang + $totalBunga) / $tenor;

        $application = Application::where('user_id', Auth::id())
            ->latest()
            ->first();

        if (!$application) {
            $application = Application::create([
                'user_id' => Auth::id(),
                'application_number' => 'APP-' . strtoupper(uniqid()),
                'motor_id' => $motor->id,
                'leasing_id' => $leasing->id,
                'customer_name' => Auth::user()->name,
                'customer_phone' => Auth::user()->whatsapp ?? '-',
                'customer_email' => Auth::user()->email,
                'customer_address' => '-',
                'down_payment' => $downPayment,
                'tenor' => $tenor,
                'monthly_installment' => $monthlyInstallment,
                'status' => 'pending'
            ]);
        } else {
            $application->update([
                'motor_id' => $motor->id,
                'down_payment' => $downPayment,
                'tenor' => $tenor,
                'monthly_installment' => $monthlyInstallment,
            ]);
        }

        return redirect()->route('customer.dokumen');
    }

    public function index()
    {
        $application = Application::where('user_id', Auth::id())
            ->latest()
            ->first();

        $documentStatuses = [
            'ktp' => $this->getDocumentStatus($application?->dokumen_ktp, $application?->status),
            'kk' => $this->getDocumentStatus($application?->dokumen_kk, $application?->status),
            'slip_gaji' => $this->getDocumentStatus($application?->dokumen_slip_gaji, $application?->status),
            'npwp' => $this->getDocumentStatus($application?->dokumen_npwp, $application?->status),
            'surat_kerja' => $this->getDocumentStatus($application?->dokumen_surat_kerja, $application?->status),
            'rekening' => $this->getDocumentStatus($application?->dokumen_rekening, $application?->status),
        ];

        return view('customer.dokumen', compact('application', 'documentStatuses'));
    }

    private function getDocumentStatus(?string $documentPath, ?string $applicationStatus): string
    {
        if (empty($documentPath)) {
            return 'pending';
        }

        if ($applicationStatus === 'perlu_unggah_ulang') {
            return 'rejected';
        }

        if (in_array($applicationStatus, ['survey', 'approved', 'rejected', 'completed'])) {
            return 'verified';
        }

        return 'pending';
    }

    public function store(Request $request)
    {
        $request->validate([
            'ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'slip_gaji' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'npwp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'surat_kerja' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'rekening' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $motor = Motor::where('slug', 'honda-beat-street-cbs')->first();
        
        if (!$motor) {
            $motor = Motor::create([
                'name' => 'Honda Beat Street CBS',
                'slug' => 'honda-beat-street-cbs',
                'brand' => 'Honda',
                'type' => 'Matic',
                'year' => 2023,
                'price' => 15500000,
                'odometer' => 3200,
                'tax_status' => 'Hidup',
                'grade' => 'A',
                'image' => 'https://images.unsplash.com/photo-1558618666-fcd2585cd64?q=80&w=2070&auto=format&fit=crop',
                'is_available' => true
            ]);
        }

        $leasing = Leasing::where('slug', 'adira-finance')->first();
        
        if (!$leasing) {
            $leasing = Leasing::create([
                'name' => 'Adira Finance',
                'slug' => 'adira-finance',
                'interest_rate' => 8.00,
                'is_active' => true
            ]);
        }

        $application = Application::where('user_id', Auth::id())
            ->latest()
            ->first();

        if (!$application) {
            $application = Application::create([
                'user_id' => Auth::id(),
                'application_number' => 'APP-' . strtoupper(uniqid()),
                'motor_id' => $motor->id,
                'leasing_id' => $leasing->id,
                'customer_name' => Auth::user()->name,
                'customer_phone' => Auth::user()->whatsapp,
                'customer_email' => Auth::user()->email,
                'customer_address' => '-',
                'down_payment' => 0,
                'tenor' => 12,
                'monthly_installment' => 0,
                'status' => 'pending'
            ]);
        }

        $documentData = [];

        if ($request->hasFile('ktp')) {
            $documentData['dokumen_ktp'] = $request->file('ktp')->store('documents', 'public');
        }

        if ($request->hasFile('kk')) {
            $documentData['dokumen_kk'] = $request->file('kk')->store('documents', 'public');
        }

        if ($request->hasFile('slip_gaji')) {
            $documentData['dokumen_slip_gaji'] = $request->file('slip_gaji')->store('documents', 'public');
        }

        if ($request->hasFile('npwp')) {
            $documentData['dokumen_npwp'] = $request->file('npwp')->store('documents', 'public');
        }

        if ($request->hasFile('surat_kerja')) {
            $documentData['dokumen_surat_kerja'] = $request->file('surat_kerja')->store('documents', 'public');
        }

        if ($request->hasFile('rekening')) {
            $documentData['dokumen_rekening'] = $request->file('rekening')->store('documents', 'public');
        }

        $application->update($documentData);

        $requiredDocsUploaded = $application->dokumen_ktp && $application->dokumen_kk && $application->dokumen_slip_gaji;
        if ($requiredDocsUploaded && $application->status === 'pending') {
            $application->update(['status' => 'pending']);
        }

        return redirect()->back()->with('success', 'Dokumen berhasil diunggah!');
    }
}
