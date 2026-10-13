<?php

namespace App\Http\Controllers;

use App\Models\SavedSimulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimulationController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Silakan login terlebih dahulu untuk menyimpan simulasi.'], 401);
        }

        $validated = $request->validate([
            'motor_name' => 'required|string',
            'price' => 'required|numeric',
            'dp' => 'required|numeric',
            'tenor' => 'required|integer',
            'monthly_installment' => 'required|numeric',
        ]);

        $simulation = Auth::user()->savedSimulations()->create($validated);

        return response()->json([
            'message' => 'Simulasi kredit berhasil disimpan!',
            'simulation' => $simulation
        ]);
    }

    public function index()
    {
        $simulations = Auth::user()->savedSimulations()->latest()->get();
        return view('dashboard', compact('simulations'));
    }

    public function destroy(SavedSimulation $savedSimulation)
    {
        if ($savedSimulation->user_id !== Auth::id()) {
            abort(403);
        }

        $savedSimulation->delete();

        return back()->with('status', 'Simulasi berhasil dihapus.');
    }
}
