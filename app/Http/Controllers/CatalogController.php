<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Motor::with('galleries')->where('is_available', true);

        if ($request->filled('merek')) {
            $query->whereIn('brand', $request->input('merek'));
        }

        if ($request->filled('tahun_min')) {
            $query->where('year', '>=', $request->input('tahun_min'));
        }

        if ($request->filled('tahun_max')) {
            $query->where('year', '<=', $request->input('tahun_max'));
        }

        if ($request->filled('km_max')) {
            $query->where('odometer', '<=', $request->input('km_max'));
        }

        $motors = $query->latest()->paginate(12)->withQueryString();

        return view('katalog', compact('motors'));
    }

    public function show(int $id)
    {
        $motor = Motor::with('galleries')->findOrFail($id);
        return view('katalog.show', compact('motor'));
    }
}
