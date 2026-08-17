<?php

namespace App\Http\Controllers;

use App\Models\ProfilDesa;
use App\Models\Berita;
use App\Models\PesanKontak;
use App\Models\PerangkatDesa;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $profil = ProfilDesa::first();
        $beritas = Berita::latest('tanggal_publish')->take(5)->get();
        $umkmCount = \App\Models\PotensiDesa::where('jenis', 'umkm')->count();
        $layanans = \App\Models\LayananPublik::latest()->take(4)->get();

        return view('public.home', compact('profil', 'beritas', 'umkmCount', 'layanans'));
    }

    public function kontak()
    {
        $profil = ProfilDesa::first();
        return view('public.kontak', compact('profil'));
    }

    public function kontakStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pesan' => 'required|string',
        ]);

        $validated['status'] = 'baru';
        PesanKontak::create($validated);

        return redirect()->route('kontak')->with('success', 'Pesan Anda berhasil dikirim. Terima kasih!');
    }

    public function profil()
    {
        $profil = ProfilDesa::first();
        $perangkats = PerangkatDesa::orderBy('urutan')->get();
        return view('public.profil', compact('profil', 'perangkats'));
    }

    public function statistik(Request $request)
    {
        $tahun = $request->get('tahun', \App\Models\StatistikPenduduk::max('tahun'));

        $usia = \App\Models\StatistikPenduduk::where('kategori', 'usia')
            ->where('tahun', $tahun)
            ->get()
            ->groupBy('label')
            ->map(function ($group) {
                return (object) [
                    'label' => $group->first()->label,
                    'jumlah_laki' => $group->sum('jumlah_laki'),
                    'jumlah_perempuan' => $group->sum('jumlah_perempuan'),
                ];
            })
            ->values();

        $pendidikan = \App\Models\StatistikPenduduk::where('kategori', 'pendidikan')
            ->where('tahun', $tahun)
            ->get()
            ->groupBy('label')
            ->map(function ($group) {
                return (object) [
                    'label' => $group->first()->label,
                    'jumlah_laki' => $group->sum('jumlah_laki'),
                    'jumlah_perempuan' => $group->sum('jumlah_perempuan'),
                ];
            })
            ->values();

        $pekerjaan = \App\Models\StatistikPenduduk::where('kategori', 'pekerjaan')
            ->where('tahun', $tahun)
            ->get()
            ->groupBy('label')
            ->map(function ($group) {
                return (object) [
                    'label' => $group->first()->label,
                    'jumlah_laki' => $group->sum('jumlah_laki'),
                    'jumlah_perempuan' => $group->sum('jumlah_perempuan'),
                ];
            })
            ->values();

        $kesehatan = \App\Models\StatistikPenduduk::where('kategori', 'kesehatan')
            ->where('tahun', $tahun)
            ->get()
            ->groupBy('label')
            ->map(function ($group) {
                return (object) [
                    'label' => $group->first()->label,
                    'jumlah_laki' => $group->sum('jumlah_laki'),
                    'jumlah_perempuan' => $group->sum('jumlah_perempuan'),
                ];
            })
            ->values();

        $perDusun = \App\Models\Dusun::with(['statistikPenduduk' => function ($q) use ($tahun) {
            $q->where('tahun', $tahun);
        }])->get()->map(function ($dusun) {
            return (object) [
                'nama_dusun' => $dusun->nama_dusun,
                'total' => $dusun->statistikPenduduk->where('kategori', 'usia')->sum(fn($s) => $s->jumlah_laki + $s->jumlah_perempuan),
            ];
        })->filter(fn($d) => $d->total > 0)->values();

        $totalLaki = $usia->sum('jumlah_laki');
        $totalPerempuan = $usia->sum('jumlah_perempuan');
        $totalPenduduk = $totalLaki + $totalPerempuan;

        $profil = ProfilDesa::first();
        $kepadatan = ($profil && $profil->luas_wilayah > 0)
            ? round($totalPenduduk / $profil->luas_wilayah)
            : null;

        $tahunTersedia = \App\Models\StatistikPenduduk::select('tahun')->distinct()->orderByDesc('tahun')->pluck('tahun');

        return view('public.statistik', compact(
            'usia', 'pendidikan', 'pekerjaan', 'kesehatan', 'perDusun',
            'totalLaki', 'totalPerempuan', 'totalPenduduk', 'kepadatan', 'tahun', 'tahunTersedia'
        ));
    }

    public function potensi()
    {
        $potensis = \App\Models\PotensiDesa::latest()->get();
        return view('public.potensi', compact('potensis'));
    }

    public function berita()
    {
        $beritas = Berita::latest('tanggal_publish')->paginate(9);
        return view('public.berita', compact('beritas'));
    }
    public function beritaDetail(Berita $berita) { return view('public.berita-detail', compact('berita')); }
    
    public function layanan()
    {
        $layanans = \App\Models\LayananPublik::latest()->get();
        return view('public.layanan', compact('layanans'));
    }
    
    public function galeri()
    {
        $galeris = \App\Models\Galeri::latest('tanggal')->get();
        $kategoris = $galeris->pluck('kategori')->filter()->unique()->values();
        return view('public.galeri', compact('galeris', 'kategoris'));
    }
}