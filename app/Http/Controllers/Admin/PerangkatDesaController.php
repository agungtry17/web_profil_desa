<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerangkatDesa;
use Illuminate\Http\Request;

class PerangkatDesaController extends Controller
{
    public function index()
    {
        $perangkats = PerangkatDesa::orderBy('urutan')->paginate(15);
        return view('admin.perangkat.index', compact('perangkats'));
    }

    public function create()
    {
        return view('admin.perangkat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'urutan' => 'nullable|integer',
            'biografi' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'linkedin' => 'nullable|string|max:255',
            'tahun_menjabat' => 'nullable|string|max:255',
            'riwayat_karir' => 'nullable|string',
        ]);

        PerangkatDesa::create($validated);

        return redirect()->route('admin.perangkat.index')->with('success', 'Perangkat desa berhasil ditambahkan.');
    }

    public function edit(PerangkatDesa $perangkat)
    {
        return view('admin.perangkat.edit', compact('perangkat'));
    }

    public function update(Request $request, PerangkatDesa $perangkat)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
            'no_hp' => 'nullable|string|max:20',
            'urutan' => 'nullable|integer',
            'biografi' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'linkedin' => 'nullable|string|max:255',
            'tahun_menjabat' => 'nullable|string|max:255',
            'riwayat_karir' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('perangkat', 'public');
        }

        $perangkat->update($validated);

        return redirect()->route('admin.perangkat.index')->with('success', 'Perangkat desa berhasil diperbarui.');
    }

    public function destroy(PerangkatDesa $perangkat)
    {
        $perangkat->delete();
        return redirect()->route('admin.perangkat.index')->with('success', 'Perangkat desa berhasil dihapus.');
    }
}