<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;

class ProfilDesaController extends Controller
{
    public function edit()
    {
        $profil = ProfilDesa::first() ?? new ProfilDesa();
        return view('admin.profil-desa.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_desa' => 'required|string|max:255',
            'slogan' => 'nullable|string|max:255',
            'sambutan' => 'nullable|string',
            'sejarah' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'letak_geografis' => 'nullable|string',
            'batas_wilayah' => 'nullable|string',
            'nama_kepala_desa' => 'nullable|string|max:255',
            'jumlah_penduduk' => 'nullable|integer|min:0',
            'luas_wilayah' => 'nullable|numeric|min:0',
            'alamat_kantor' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'foto_banner' => 'nullable|image|max:2048',
            'logo' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('foto_banner')) {
            $validated['foto_banner'] = $request->file('foto_banner')->store('profil', 'public');
        }

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('profil', 'public');
        }
        
        $profil = ProfilDesa::first();

        if ($profil) {
            $profil->update($validated);
        } else {
            ProfilDesa::create($validated);
        }

        return redirect()->route('admin.profil-desa.edit')->with('success', 'Profil desa berhasil diperbarui.');
    }
}