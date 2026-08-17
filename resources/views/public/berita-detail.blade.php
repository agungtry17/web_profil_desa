@extends('public.layout.app')
@section('title', $berita->judul)

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <a href="{{ route('berita') }}" class="text-sm text-[#1E3A5F] hover:underline">&larr; Kembali ke Berita</a>

    <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded capitalize inline-block mt-4">{{ $berita->kategori }}</span>
    <h1 class="text-2xl font-bold mt-2">{{ $berita->judul }}</h1>
    <p class="text-sm text-gray-500 mt-1">{{ $berita->tanggal_publish->format('d M Y') }} &bull; oleh {{ $berita->penulis->name ?? '-' }}</p>

    @if ($berita->foto)
        <img src="{{ asset('storage/' . $berita->foto) }}" class="w-full rounded mt-4">
    @endif

    <div class="prose max-w-none mt-6 whitespace-pre-line text-gray-700">
        {{ $berita->konten }}
    </div>
</div>
@endsection