<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananPublik;
use Illuminate\Http\Request;

class LayananPublikController extends Controller
{
    public function index()
    {
        $layanans = LayananPublik::latest()->paginate(15);
        return view('admin.layanan.index', compact('layanans'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'syarat' => 'required|string',
            'alur_pengurusan' => 'required|string',
            'estimasi_waktu' => 'nullable|string|max:255',
            'biaya' => 'nullable|string|max:255',
        ]);

        LayananPublik::create($validated);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan publik berhasil ditambahkan.');
    }

    public function edit(LayananPublik $layanan)
    {
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, LayananPublik $layanan)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'syarat' => 'required|string',
            'alur_pengurusan' => 'required|string',
            'estimasi_waktu' => 'nullable|string|max:255',
            'biaya' => 'nullable|string|max:255',
        ]);

        $layanan->update($validated);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan publik berhasil diperbarui.');
    }

    public function destroy(LayananPublik $layanan)
    {
        $layanan->delete();
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan publik berhasil dihapus.');
    }
}