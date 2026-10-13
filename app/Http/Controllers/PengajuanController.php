<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\Leasing;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'motor_id' => 'required|integer|exists:motors,id',
            'dp' => 'required|numeric',
            'tenor' => 'required|integer',
        ]);

        $motor = Motor::findOrFail($request->motor_id);
        $leasings = Leasing::where('is_active', true)->get();
        
        $dp = $request->dp;
        $tenor = $request->tenor;

        return view('customer.pengajuan.create', compact('motor', 'leasings', 'dp', 'tenor'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'motor_id' => 'required|integer|exists:motors,id',
            'leasing_id' => 'required|integer|exists:leasings,id',
            'dp' => 'required|numeric',
            'tenor' => 'required|integer|min:12|max:60',
        ]);

        $motor = Motor::findOrFail($request->motor_id);
        $leasing = Leasing::findOrFail($request->leasing_id);
        
        $dp = $request->dp;
        $tenor = $request->tenor;
        $pokokHutang = $motor->price - $dp;
        $totalBunga = $pokokHutang * ($leasing->interest_rate / 100) * ($tenor / 12);
        $cicilanBulanan = round(($pokokHutang + $totalBunga) / $tenor);

        $application = Application::create([
            'application_number' => 'APP-' . strtoupper(uniqid()),
            'user_id' => Auth::id(),
            'motor_id' => $request->motor_id,
            'leasing_id' => $request->leasing_id,
            'customer_name' => Auth::user()->name,
            'customer_phone' => Auth::user()->whatsapp ?? '-',
            'customer_email' => Auth::user()->email,
            'customer_address' => '-',
            'down_payment' => $dp,
            'tenor' => $tenor,
            'monthly_installment' => $cicilanBulanan,
            'status' => 'pending',
        ]);

        return redirect()->route('customer.dokumen')->with('success', 'Pengajuan berhasil dibuat, silakan lengkapi dokumen.');
    }
}
