@extends('public.layout.app')
@section('title', 'Potensi Desa')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">

    <div class="max-w-2xl mb-10">
        <h1 class="text-4xl font-extrabold text-[#1E3A5F] mb-3">Potensi &amp; Kekayaan Desa</h1>
        <p class="text-stone-500 leading-relaxed">
            Menjelajahi ragam produk unggulan UMKM, keindahan alam, dan destinasi wisata
            yang menjadi kebanggaan serta roda ekonomi masyarakat desa kami.
        </p>
    </div>

    @php
        $jenisLabel = [
            'ekonomi' => 'Ekonomi',
            'umkm' => 'UMKM',
            'wisata' => 'Wisata Alam',
            'kesenian' => 'Kesenian',
        ];
        $umkmCount = $potensis->where('jenis', 'umkm')->count();
        $besar = $potensis->first();
        $sisanya = $potensis->skip(1);
    @endphp

    @if ($potensis->isEmpty())
        <p class="text-stone-500">Belum ada data potensi desa.</p>
    @else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 auto-rows-[220px]">

        <!-- Kartu besar -->
        <a href="{{ route('potensi.show', $besar) }}" class="md:col-span-2 md:row-span-2 relative rounded-2xl overflow-hidden group block">
            @if ($besar->foto)
                <img src="{{ asset('storage/' . $besar->foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            @else
                <div class="w-full h-full bg-[#1E3A5F]"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-6 text-white">
                <span class="inline-block bg-white/15 backdrop-blur text-xs font-medium px-3 py-1 rounded-full mb-3">
                    {{ $jenisLabel[$besar->jenis] ?? ucfirst($besar->jenis) }}
                </span>
                <h2 class="text-2xl font-bold mb-2">{{ $besar->nama }}</h2>
                <p class="text-sm text-white/80 max-w-md line-clamp-2">{{ $besar->deskripsi }}</p>
            </div>
        </a>

        @foreach ($sisanya->take(2) as $item)
        <a href="{{ route('potensi.show', $item) }}" class="relative rounded-2xl overflow-hidden group block">
            @if ($item->foto)
                <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            @else
                <div class="w-full h-full bg-[#1E3A5F]"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/5 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-4 text-white">
                <span class="inline-block bg-white/15 backdrop-blur text-xs font-medium px-3 py-1 rounded-full mb-2">
                    {{ $jenisLabel[$item->jenis] ?? ucfirst($item->jenis) }}
                </span>
                <h3 class="font-bold">{{ $item->nama }}</h3>
            </div>
        </a>
        @endforeach

        <!-- Kartu statistik UMKM -->
        <div class="bg-stone-50 border border-stone-100 rounded-2xl p-6 flex flex-col justify-center">
            <div class="w-10 h-10 rounded-lg bg-[#1E3A5F]/10 flex items-center justify-center text-lg mb-4">🏪</div>
            <p class="text-2xl font-extrabold text-stone-800 mb-1">{{ $umkmCount }}+ UMKM Aktif</p>
            <p class="text-sm text-stone-500 mb-3">
                Mendukung perekonomian lokal melalui pembinaan berkelanjutan dan digitalisasi pemasaran.
            </p>
            <a href="{{ route('potensi') }}?jenis=umkm" class="text-sm font-semibold text-[#1E3A5F] hover:underline">
                Lihat Direktori &rarr;
            </a>
        </div>

        @foreach ($sisanya->skip(2) as $item)
        <a href="{{ route('potensi.show', $item) }}" class="relative rounded-2xl overflow-hidden group block">
            @if ($item->foto)
                <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            @else
                <div class="w-full h-full bg-[#1E3A5F]"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/5 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-4 text-white">
                <span class="inline-block bg-white/15 backdrop-blur text-xs font-medium px-3 py-1 rounded-full mb-2">
                    {{ $jenisLabel[$item->jenis] ?? ucfirst($item->jenis) }}
                </span>
                <h3 class="font-bold">{{ $item->nama }}</h3>
            </div>
        </a>
        @endforeach

    </div>
    @endif
</div>
@endsection