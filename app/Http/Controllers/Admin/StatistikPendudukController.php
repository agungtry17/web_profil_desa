<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatistikPenduduk;
use App\Models\Dusun;
use Illuminate\Http\Request;

class StatistikPendudukController extends Controller
{
    public function index()
    {
        $statistiks = StatistikPenduduk::with('dusun')->latest()->paginate(15);
        return view('admin.statistik.index', compact('statistiks'));
    }

    public function create()
    {
        $dusuns = Dusun::all();
        return view('admin.statistik.create', compact('dusuns'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dusun_id' => 'required|exists:dusuns,id',
            'kategori' => 'required|in:usia,pekerjaan,pendidikan,jumlah_penduduk',
            'label' => 'required|string|max:255',
            'jumlah_laki' => 'nullable|integer|min:0',
            'jumlah_perempuan' => 'nullable|integer|min:0',
            'tahun' => 'required|digits:4',
        ]);

        StatistikPenduduk::create($validated);

        return redirect()->route('admin.statistik.index')->with('success', 'Data statistik berhasil ditambahkan.');
    }

    public function edit(StatistikPenduduk $statistik)
    {
        $dusuns = Dusun::all();
        return view('admin.statistik.edit', compact('statistik', 'dusuns'));
    }

    public function update(Request $request, StatistikPenduduk $statistik)
    {
        $validated = $request->validate([
            'dusun_id' => 'required|exists:dusuns,id',
            'kategori' => 'required|in:usia,pekerjaan,pendidikan,jumlah_penduduk',
            'label' => 'required|string|max:255',
            'jumlah_laki' => 'nullable|integer|min:0',
            'jumlah_perempuan' => 'nullable|integer|min:0',
            'tahun' => 'required|digits:4',
        ]);

        $statistik->update($validated);

        return redirect()->route('admin.statistik.index')->with('success', 'Data statistik berhasil diperbarui.');
    }

    public function destroy(StatistikPenduduk $statistik)
    {
        $statistik->delete();
        return redirect()->route('admin.statistik.index')->with('success', 'Data statistik berhasil dihapus.');
    }
}