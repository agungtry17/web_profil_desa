@extends('public.layout.app')
@section('title', $potensi->nama)

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">

    <a href="{{ route('potensi') }}" class="inline-flex items-center gap-1 text-sm text-[#1E3A5F] font-medium hover:underline mb-6">
        &larr; Kembali ke Potensi Desa
    </a>

    @php
        $jenisLabel = [
            'ekonomi' => 'Ekonomi',
            'umkm' => 'UMKM',
            'wisata' => 'Wisata Alam',
            'kesenian' => 'Kesenian',
        ];
    @endphp

    <div class="rounded-2xl overflow-hidden mb-6 h-72 md:h-96">
        @if ($potensi->foto)
            <img src="{{ asset('storage/' . $potensi->foto) }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-[#1E3A5F]"></div>
        @endif
    </div>

    <span class="inline-block bg-[#63B3ED] text-[#2C5282] text-xs font-medium px-3 py-1 rounded-full mb-3">
        {{ $jenisLabel[$potensi->jenis] ?? ucfirst($potensi->jenis) }}
    </span>

    <h1 class="text-3xl font-extrabold text-[#1E3A5F] mb-4">{{ $potensi->nama }}</h1>

    <div class="text-stone-600 leading-relaxed whitespace-pre-line mb-8">
        {{ $potensi->deskripsi ?? 'Belum ada deskripsi.' }}
    </div>

    @if ($potensi->lokasi || $potensi->kontak)
    <div class="bg-white rounded-xl border border-stone-100 shadow-sm p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
        @if ($potensi->lokasi)
        <div>
            <p class="text-[11px] uppercase tracking-widest text-stone-400 font-semibold mb-1">Lokasi</p>
            <p class="text-stone-700">{{ $potensi->lokasi }}</p>
        </div>
        @endif
        @if ($potensi->kontak)
        <div>
            <p class="text-[11px] uppercase tracking-widest text-stone-400 font-semibold mb-1">Kontak</p>
            <p class="text-stone-700">{{ $potensi->kontak }}</p>
        </div>
        @endif
    </div>
    @endif

</div>
@endsection