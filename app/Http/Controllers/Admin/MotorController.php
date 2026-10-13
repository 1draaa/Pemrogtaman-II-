<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Motor;
use App\Models\MotorGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MotorController extends Controller
{
    public function create()
    {
        return view('admin.motors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string',
            'name' => 'required|string',
            'type' => 'required|in:Moge,Matic,Manual,Sport,Cub,Adventure,Cruiser',
            'year' => 'required|integer',
            'price' => 'required|integer',
            'odometer' => 'required|integer',
            'tax_status' => 'required|string',
            'bahan_bakar' => 'required|in:Bensin,Listrik,Hybrid',
            'grade_kondisi' => 'required|in:Grade A,Grade B,Grade C',
            'is_available' => 'nullable|boolean',
            'description' => 'nullable|string',
            'tag_promosi' => 'nullable|string',
            'fotos' => 'nullable|array',
            'fotos.*' => 'image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $validated['slug'] = Str::slug($validated['name'] . '-' . $validated['year']);
        $validated['is_available'] = $request->has('is_available');

        $motor = Motor::create($validated);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('motors', 'public');
                MotorGallery::create([
                    'motor_id' => $motor->id,
                    'foto_path' => $path
                ]);
            }
            
            $firstFoto = $motor->galleries()->first();
            if ($firstFoto) {
                $motor->update(['image' => $firstFoto->foto_path]);
            }
        }

        return redirect()->route('admin.dashboard')->with(['success' => 'Motor berhasil ditambahkan!', 'active_tab' => 'stok']);
    }

    public function edit(Motor $motor)
    {
        return view('admin.motors.edit', compact('motor'));
    }

    public function update(Request $request, Motor $motor)
    {
        $validated = $request->validate([
            'brand' => 'required|string',
            'name' => 'required|string',
            'type' => 'required|in:Moge,Matic,Manual,Sport,Cub,Adventure,Cruiser',
            'year' => 'required|integer',
            'price' => 'required|integer',
            'odometer' => 'required|integer',
            'tax_status' => 'required|string',
            'bahan_bakar' => 'required|in:Bensin,Listrik,Hybrid',
            'grade_kondisi' => 'required|in:Grade A,Grade B,Grade C',
            'is_available' => 'nullable|boolean',
            'description' => 'nullable|string',
            'tag_promosi' => 'nullable|string',
            'fotos' => 'nullable|array',
            'fotos.*' => 'image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $validated['slug'] = Str::slug($validated['name'] . '-' . $validated['year']);
        $validated['is_available'] = $request->has('is_available');

        $motor->update($validated);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('motors', 'public');
                MotorGallery::create([
                    'motor_id' => $motor->id,
                    'foto_path' => $path
                ]);
            }
            
            if (!$motor->image) {
                $firstFoto = $motor->galleries()->first();
                if ($firstFoto) {
                    $motor->update(['image' => $firstFoto->foto_path]);
                }
            }
        }

        return redirect()->route('admin.dashboard')->with(['success' => 'Motor berhasil diperbarui!', 'active_tab' => 'stok']);
    }

    public function destroy(Motor $motor)
    {
        foreach ($motor->galleries as $gallery) {
            if ($gallery->foto_path) {
                Storage::disk('public')->delete($gallery->foto_path);
            }
        }
        if ($motor->image) {
            Storage::disk('public')->delete($motor->image);
        }
        $motor->delete();
        return redirect()->route('admin.dashboard')->with(['success' => 'Motor berhasil dihapus!', 'active_tab' => 'stok']);
    }

    public function destroyGallery(Motor $motor, MotorGallery $gallery)
    {
        if ($gallery->motor_id !== $motor->id) {
            abort(403);
        }

        if ($gallery->foto_path) {
            Storage::disk('public')->delete($gallery->foto_path);
        }

        $gallery->delete();

        // Update motor image if this was the main image
        if ($motor->image === $gallery->foto_path) {
            $newFirstGallery = $motor->galleries()->where('id', '!=', $gallery->id)->first();
            $motor->update(['image' => $newFirstGallery ? $newFirstGallery->foto_path : null]);
        }

        return redirect()->back()->with(['success' => 'Foto berhasil dihapus!']);
    }
}
