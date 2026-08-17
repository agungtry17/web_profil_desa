@extends('public.layout.app')
@section('title', 'Statistik Penduduk')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10 space-y-6">

    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-2">
        <div>
            <h1 class="text-3xl font-extrabold text-[#1E3A5F]">Statistik Penduduk</h1>
            <p class="text-stone-500 text-sm mt-1">Data demografi dan analitik profil desa.</p>
        </div>

        @if (isset($tahunTersedia) && $tahunTersedia->count() > 1)
        <form method="GET" class="flex items-center gap-2">
            <label class="text-sm text-stone-500">Tahun:</label>
            <select name="tahun" onchange="this.form.submit()"
                class="border border-stone-200 rounded-lg text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#2C5282]">
                @foreach ($tahunTersedia as $t)
                    <option value="{{ $t }}" @selected($t == $tahun)>{{ $t }}</option>
                @endforeach
            </select>
        </form>
        @endif
    </div>

    <!-- Kartu ringkasan -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl border border-stone-100 shadow-sm p-5">
            <p class="text-[11px] uppercase tracking-widest text-stone-400 font-semibold mb-3">Total Penduduk</p>
            <p class="text-3xl font-extrabold text-stone-800">{{ number_format($totalPenduduk) }}</p>
            <p class="text-xs text-stone-400 mt-1">Jiwa pada tahun {{ $tahun }}</p>
        </div>

        <div class="bg-white rounded-xl border border-stone-100 shadow-sm p-5">
            <p class="text-[11px] uppercase tracking-widest text-stone-400 font-semibold mb-3">Kepadatan</p>
            <p class="text-3xl font-extrabold text-stone-800">
                {{ $kepadatan ? number_format($kepadatan) : '-' }}
                <span class="text-sm font-normal text-stone-400">jiwa/km²</span>
            </p>
            <p class="text-xs text-stone-400 mt-1">Berdasarkan luas wilayah desa</p>
        </div>

        <div class="bg-[#1E3A5F] rounded-xl p-5 text-white">
            <p class="text-[11px] uppercase tracking-widest text-white/60 font-semibold mb-3">Data Tahun</p>
            <p class="text-3xl font-extrabold">{{ $tahun }}</p>
            <p class="text-xs text-white/60 mt-1">Sumber: data terbaru terekap</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Distribusi Usia -->
        <div class="lg:col-span-2 bg-white rounded-xl border border-stone-100 shadow-sm p-6">
            <h2 class="text-lg font-bold text-stone-800 mb-5">Distribusi Usia</h2>

            @if ($usia->isEmpty())
                <p class="text-sm text-stone-500">Belum ada data usia untuk tahun ini.</p>
            @else
                <div class="space-y-5">
                    @foreach ($usia as $item)
                        @php
                            $jumlah = $item->jumlah_laki + $item->jumlah_perempuan;
                            $persen = $totalPenduduk > 0 ? round(($jumlah / $totalPenduduk) * 100) : 0;
                        @endphp
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-stone-700">{{ $item->label }}</span>
                                <span class="font-semibold text-stone-800">{{ $persen }}%</span>
                            </div>
                            <div class="w-full h-2 bg-stone-100 rounded-full overflow-hidden">
                                <div class="h-full bg-[#1E3A5F] rounded-full" style="width: {{ $persen }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Berdasarkan Jenis Kelamin -->
        <div class="bg-white rounded-xl border border-stone-100 shadow-sm p-6 flex flex-col">
            <h2 class="text-lg font-bold text-stone-800 mb-5">Berdasarkan Jenis Kelamin</h2>

            @php
                $persenLaki = $totalPenduduk > 0 ? round(($totalLaki / $totalPenduduk) * 100) : 0;
            @endphp

            <div class="flex-1 flex items-center justify-center py-4">
                <div class="w-40 h-40 rounded-full border-[10px] border-[#1E3A5F] flex items-center justify-center text-center"
                     style="background: conic-gradient(#1E3A5F {{ $persenLaki * 3.6 }}deg, #E6EEE8 0deg);">
                    <div class="w-28 h-28 bg-white rounded-full flex flex-col items-center justify-center">
                        <span class="text-2xl font-extrabold text-stone-800">{{ $persenLaki }}%</span>
                        <span class="text-xs text-stone-500">Laki-laki</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 mt-2">
                <div class="bg-stone-50 rounded-lg p-3 text-center">
                    <p class="text-xs text-stone-500">Laki-laki</p>
                    <p class="text-lg font-bold text-stone-800">{{ number_format($totalLaki) }}</p>
                </div>
                <div class="bg-stone-50 rounded-lg p-3 text-center">
                    <p class="text-xs text-stone-500">Perempuan</p>
                    <p class="text-lg font-bold text-stone-800">{{ number_format($totalPerempuan) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pendidikan Terakhir -->
    <div class="bg-white rounded-xl border border-stone-100 shadow-sm p-6">
        <h2 class="text-lg font-bold text-stone-800 mb-5">Pendidikan Terakhir</h2>

        @if ($pendidikan->isEmpty())
            <p class="text-sm text-stone-500">Belum ada data pendidikan untuk tahun ini.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-stone-400 uppercase text-[11px] tracking-widest border-b border-stone-100">
                            <th class="py-3 font-semibold">Tingkat Pendidikan</th>
                            <th class="py-3 font-semibold">Jumlah (Jiwa)</th>
                            <th class="py-3 font-semibold">Persentase</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @php $totalPendidikan = $pendidikan->sum(fn($p) => $p->jumlah_laki + $p->jumlah_perempuan); @endphp
                        @foreach ($pendidikan as $item)
                            @php
                                $jumlah = $item->jumlah_laki + $item->jumlah_perempuan;
                                $persen = $totalPendidikan > 0 ? round(($jumlah / $totalPendidikan) * 100) : 0;
                            @endphp
                            <tr>
                                <td class="py-3 text-stone-700">{{ $item->label }}</td>
                                <td class="py-3 text-stone-700">{{ number_format($jumlah) }}</td>
                                <td class="py-3 text-stone-700">{{ $persen }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <!-- Sebaran per Dusun -->
    @if ($perDusun->isNotEmpty())
    <div class="bg-white rounded-xl border border-stone-100 shadow-sm p-6">
        <h2 class="text-lg font-bold text-stone-800 mb-5">Sebaran Penduduk per Dusun</h2>
        <div class="space-y-4">
            @php $maxDusun = $perDusun->max('total'); @endphp
            @foreach ($perDusun as $d)
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="text-stone-700">Dusun {{ $d->nama_dusun }}</span>
                    <span class="font-semibold text-stone-800">{{ number_format($d->total) }} jiwa</span>
                </div>
                <div class="w-full h-2 bg-stone-100 rounded-full overflow-hidden">
                    <div class="h-full bg-[#2C5282] rounded-full" style="width: {{ $maxDusun > 0 ? round(($d->total / $maxDusun) * 100) : 0 }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Pekerjaan & Kesehatan -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white rounded-xl border border-stone-100 shadow-sm p-6">
            <h2 class="text-lg font-bold text-stone-800 mb-5">Mata Pencaharian</h2>
            @if ($pekerjaan->isEmpty())
                <p class="text-sm text-stone-500">Belum ada data pekerjaan untuk tahun ini.</p>
            @else
                @php $totalPekerjaan = $pekerjaan->sum(fn($p) => $p->jumlah_laki + $p->jumlah_perempuan); @endphp
                <div class="space-y-4">
                    @foreach ($pekerjaan as $item)
                        @php
                            $jumlah = $item->jumlah_laki + $item->jumlah_perempuan;
                            $persen = $totalPekerjaan > 0 ? round(($jumlah / $totalPekerjaan) * 100) : 0;
                        @endphp
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-stone-700">{{ $item->label }}</span>
                                <span class="font-semibold text-stone-800">{{ number_format($jumlah) }} ({{ $persen }}%)</span>
                            </div>
                            <div class="w-full h-2 bg-stone-100 rounded-full overflow-hidden">
                                <div class="h-full bg-[#2C5282] rounded-full" style="width: {{ $persen }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="bg-white rounded-xl border border-stone-100 shadow-sm p-6">
            <h2 class="text-lg font-bold text-stone-800 mb-5">Data Kesehatan</h2>
            @if ($kesehatan->isEmpty())
                <p class="text-sm text-stone-500">Belum ada data kesehatan untuk tahun ini.</p>
            @else
                <div class="grid grid-cols-2 gap-3">
                    @foreach ($kesehatan as $item)
                    <div class="bg-stone-50 rounded-lg p-4 text-center">
                        <p class="text-2xl font-extrabold text-stone-800">{{ number_format($item->jumlah_laki + $item->jumlah_perempuan) }}</p>
                        <p class="text-xs text-stone-500 mt-1">{{ $item->label }}</p>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>
@endsection