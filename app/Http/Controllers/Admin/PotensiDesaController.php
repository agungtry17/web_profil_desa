<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PotensiDesa;
use Illuminate\Http\Request;

class PotensiDesaController extends Controller
{
    public function index()
    {
        $potensis = PotensiDesa::latest()->paginate(12);
        return view('admin.potensi.index', compact('potensis'));
    }

    public function create()
    {
        return view('admin.potensi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:ekonomi,umkm,wisata,kerajinan',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
            'kontak' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('potensi', 'public');
        }

        PotensiDesa::create($validated);

        return redirect()->route('admin.potensi.index')->with('success', 'Potensi desa berhasil ditambahkan.');
    }

    public function edit(PotensiDesa $potensi)
    {
        return view('admin.potensi.edit', compact('potensi'));
    }

    public function update(Request $request, PotensiDesa $potensi)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:ekonomi,umkm,wisata,kerajinan',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
            'kontak' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('potensi', 'public');
        }

        $potensi->update($validated);

        return redirect()->route('admin.potensi.index')->with('success', 'Potensi desa berhasil diperbarui.');
    }

    public function destroy(PotensiDesa $potensi)
    {
        $potensi->delete();
        return redirect()->route('admin.potensi.index')->with('success', 'Potensi desa berhasil dihapus.');
    }
}