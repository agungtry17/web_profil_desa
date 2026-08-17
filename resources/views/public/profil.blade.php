@extends('public.layout.app')
@section('title', 'Profil Desa')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10 space-y-6">

    <!-- Hero + sidebar -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 relative rounded-2xl overflow-hidden shadow-lg h-72 md:h-96">
            @if ($profil && $profil->foto_banner)
                <img src="{{ asset('storage/' . $profil->foto_banner) }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-[#1E3A5F]"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-6 text-white">
                <h1 class="text-3xl font-bold">{{ $profil->nama_desa ?? 'Nama Desa' }}</h1>
                <p class="text-white/90 mt-1">{{ $profil->slogan ?? '' }}</p>
            </div>
        </div>

        <div class="flex flex-col gap-4 justify-between">
            <!-- Kartu Kepala Desa -->
            <div class="bg-[#1E3A5F] text-white rounded-xl p-5">
                <p class="text-[11px] uppercase tracking-widest text-white/60 font-semibold mb-2">Kepala Desa</p>
                <p class="text-lg font-semibold">{{ $profil->nama_kepala_desa ?? '-' }}</p>
                <span class="inline-flex items-center gap-1 mt-3 bg-white/10 text-xs px-3 py-1 rounded-full">
                    <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span> Aktif
                </span>
            </div>

            <!-- Kartu Statistik Singkat -->
            <div class="bg-white rounded-xl p-5 shadow-sm border border-stone-100">
                <p class="text-[11px] uppercase tracking-widest text-stone-400 font-semibold mb-3">Statistik Singkat</p>
                <div class="divide-y divide-stone-100 text-sm">
                    <div class="flex justify-between py-2">
                        <span class="text-stone-500">Populasi</span>
                        <span class="font-semibold text-stone-800">{{ number_format($profil->jumlah_penduduk ?? 0) }}</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-stone-500">Luas Wilayah</span>
                        <span class="font-semibold text-stone-800">{{ $profil->luas_wilayah ?? '-' }} km²</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-stone-500">Kepadatan</span>
                        <span class="font-semibold text-stone-800">
                            @if (($profil->luas_wilayah ?? 0) > 0)
                                {{ number_format(($profil->jumlah_penduduk ?? 0) / $profil->luas_wilayah) }}/km²
                            @else
                                -
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sejarah -->
    <div class="bg-white rounded-xl shadow-sm p-8 border border-stone-100">
        <div class="flex flex-col items-center mb-6">
            <h2 class="text-2xl font-bold text-stone-800">Sejarah Singkat</h2>
            <div class="w-12 h-1 bg-[#2C5282] mt-2 rounded"></div>
        </div>
        <div class="text-stone-600 leading-relaxed md:columns-2 md:gap-10">
            @forelse (explode("\n", trim($profil->sejarah ?? '')) as $paragraf)
                @if (trim($paragraf) !== '')
                    <p class="mb-4 break-inside-avoid-column text-justify">{{ trim($paragraf) }}</p>
                @endif
            @empty
                <p>Belum ada data sejarah desa.</p>
            @endforelse
        </div>
    </div>

    <!-- Visi & Misi -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-[#E6EEE8] rounded-xl p-6">
            <h3 class="text-lg font-bold text-stone-800 mb-2">Visi</h3>
            <p class="text-sm text-stone-600 leading-relaxed">"{{ $profil->visi ?? 'Belum ada data.' }}"</p>
        </div>

        <div class="bg-white rounded-xl p-6 border border-stone-100 shadow-sm">
            <h3 class="text-lg font-bold text-stone-800 mb-3">Misi</h3>
            <ul class="space-y-2 text-sm text-stone-600">
                @forelse (explode("\n", $profil->misi ?? '') as $poin)
                    @if (trim($poin) !== '')
                    <li class="flex gap-2">
                        <span class="text-[#2C5282] mt-0.5">✓</span>
                        <span>{{ trim($poin) }}</span>
                    </li>
                    @endif
                @empty
                    <li>Belum ada data.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Lokasi & Geografis -->
    @if ($profil && $profil->latitude && $profil->longitude)
    <div class="bg-white rounded-xl shadow-sm p-6 border border-stone-100 grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
        <div id="peta-desa" style="height: 260px;" class="rounded-lg overflow-hidden"></div>
        <div>
            <h3 class="text-lg font-bold text-stone-800 mb-2">Lokasi & Geografis</h3>
            <p class="text-sm text-stone-600 leading-relaxed whitespace-pre-line mb-4">{{ $profil->letak_geografis ?? '-' }}</p>

            @if (!empty($profil->batas_wilayah))
                <div class="mt-4 pt-4 border-t border-stone-100">
                    <p class="text-[11px] uppercase tracking-widest text-stone-400 font-semibold mb-1">Batas Wilayah</p>
                    <p class="text-sm text-stone-600 whitespace-pre-line">{{ $profil->batas_wilayah }}</p>
                </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Perangkat Desa -->
    <div>
        <div class="text-center max-w-2xl mx-auto mb-10">
            <h2 class="text-3xl font-extrabold text-[#1E3A5F]">Perangkat Desa</h2>
            <p class="text-stone-500 mt-3 text-sm leading-relaxed">
                Mengenal lebih dekat para pelayan masyarakat yang berdedikasi membangun
                desa kita menuju masa depan yang lebih baik.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($perangkats as $p)
                @php
                    $jabatan = strtolower($p->jabatan ?? '');
                    $kategori = match (true) {
                        str_contains($jabatan, 'kepala') => 'Pimpinan',
                        str_contains($jabatan, 'sekretaris') => 'Administrasi',
                        str_contains($jabatan, 'keuangan') || str_contains($jabatan, 'bendahara') => 'Keuangan',
                        str_contains($jabatan, 'kesejahteraan') || str_contains($jabatan, 'sosial') => 'Kesejahteraan',
                        str_contains($jabatan, 'dusun') => 'Kewilayahan',
                        default => 'Staf',
                    };
                @endphp
                <div class="bg-white rounded-xl border border-stone-100 shadow-sm overflow-hidden flex flex-col">
                    <div class="h-56 bg-stone-100">
                        @if ($p->foto)
                            <img src="{{ asset('storage/' . $p->foto) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-stone-400 text-sm">
                                Belum ada foto
                            </div>
                        @endif
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <span class="inline-flex items-center gap-1 self-start bg-[#63B3ED] text-[#2C5282] text-xs font-medium px-3 py-1 rounded-full mb-3">
                            {{ $kategori }}
                        </span>
                        <p class="font-bold text-stone-800">{{ $p->nama }}</p>
                        <p class="text-sm text-stone-500 mb-4">{{ $p->jabatan }}</p>
                        @if ($p->no_hp)
                        <div class="mt-auto pt-3 border-t border-stone-100 flex items-center gap-2 text-sm text-stone-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-stone-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            {{ $p->no_hp }}
                        </div>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-stone-500 col-span-4 text-center text-sm">Belum ada data perangkat desa.</p>
            @endforelse
        </div>
    </div>

</div>

@if ($profil && $profil->latitude && $profil->longitude)
@push('scripts')
<script>
    const peta = L.map('peta-desa').setView([{{ $profil->latitude }}, {{ $profil->longitude }}], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(peta);
    L.marker([{{ $profil->latitude }}, {{ $profil->longitude }}]).addTo(peta).bindPopup("{{ $profil->nama_desa }}");
</script>
@endpush
@endif
@endsection