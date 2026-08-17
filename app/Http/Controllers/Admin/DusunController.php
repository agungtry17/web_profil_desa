<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dusun;
use Illuminate\Http\Request;

class DusunController extends Controller
{
    public function index()
    {
        $dusuns = Dusun::latest()->paginate(15);
        return view('admin.dusun.index', compact('dusuns'));
    }

    public function create()
    {
        return view('admin.dusun.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dusun' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Dusun::create($validated);

        return redirect()->route('admin.dusun.index')->with('success', 'Dusun berhasil ditambahkan.');
    }

    public function edit(Dusun $dusun)
    {
        return view('admin.dusun.edit', compact('dusun'));
    }

    public function update(Request $request, Dusun $dusun)
    {
        $validated = $request->validate([
            'nama_dusun' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $dusun->update($validated);

        return redirect()->route('admin.dusun.index')->with('success', 'Dusun berhasil diperbarui.');
    }

    public function destroy(Dusun $dusun)
    {
        $dusun->delete();
        return redirect()->route('admin.dusun.index')->with('success', 'Dusun berhasil dihapus.');
    }
}