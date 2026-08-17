@extends('public.layout.app')
@section('title', 'Berita & Informasi Desa')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">

    <div class="max-w-2xl mb-10">
        <h1 class="text-4xl font-extrabold text-[#1E3A5F] mb-3">Berita &amp; Informasi Desa</h1>
        <p class="text-stone-500 leading-relaxed">
            Dapatkan kabar terbaru, pengumuman penting, dan liputan kegiatan dari desa kami.
            Tetap terhubung dan berpartisipasi dalam pembangunan komunitas.
        </p>
    </div>

    @php
        $kategoriLabel = [
            'berita' => 'Berita',
            'kegiatan' => 'Kegiatan Desa',
            'pengumuman' => 'Pengumuman',
            'kkn' => 'Program KKN',
        ];
        $items = $beritas->items();
        $utama = $beritas->currentPage() === 1 ? ($items[0] ?? null) : null;
        $sorotan = $beritas->currentPage() === 1 ? array_slice($items, 1, 2) : [];
        $sisanya = $beritas->currentPage() === 1 ? array_slice($items, 3) : $items;
    @endphp

    @if ($beritas->isEmpty())
        <p class="text-stone-500">Belum ada berita.</p>
    @else

        @if ($utama)
        <!-- Headline + Sorotan -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-14">
            <a href="{{ route('berita.show', $utama->slug) }}" class="lg:col-span-2 bg-white rounded-2xl border border-stone-100 shadow-sm overflow-hidden group">
                <div class="relative h-72">
                    @if ($utama->foto)
                        <img src="{{ asset('storage/' . $utama->foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full bg-[#1E3A5F]"></div>
                    @endif
                    <span class="absolute top-4 left-4 bg-[#1E3A5F] text-white text-xs font-medium px-3 py-1.5 rounded-full">
                        {{ $kategoriLabel[$utama->kategori] ?? ucfirst($utama->kategori) }}
                    </span>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 text-xs text-stone-400 mb-3">
                        <span>{{ $utama->tanggal_publish->translatedFormat('d F Y') }}</span>
                        <span>&bull;</span>
                        <span>{{ $utama->penulis->name ?? 'Admin Desa' }}</span>
                    </div>
                    <h2 class="text-2xl font-bold text-stone-800 mb-2 group-hover:text-[#1E3A5F] transition">
                        {{ $utama->judul }}
                    </h2>
                    <p class="text-sm text-stone-500 leading-relaxed line-clamp-2 mb-3">
                        {{ Str::limit(strip_tags($utama->konten), 180) }}
                    </p>
                    <span class="text-sm font-semibold text-[#1E3A5F]">Baca Selengkapnya &rarr;</span>
                </div>
            </a>

            <div class="flex flex-col gap-6">
                @foreach ($sorotan as $item)
                <a href="{{ route('berita.show', $item->slug) }}" class="flex-1 bg-white rounded-2xl border border-stone-100 shadow-sm p-5 flex flex-col hover:shadow-md transition">
                    <p class="text-xs font-medium text-[#2C5282] mb-2">
                        {{ $kategoriLabel[$item->kategori] ?? ucfirst($item->kategori) }}
                    </p>
                    <h3 class="font-bold text-stone-800 mb-2 leading-snug">{{ $item->judul }}</h3>
                    <p class="text-sm text-stone-500 leading-relaxed line-clamp-3 mb-3">
                        {{ Str::limit(strip_tags($item->konten), 110) }}
                    </p>
                    <p class="text-xs text-stone-400 mt-auto pt-3 border-t border-stone-100">
                        {{ $item->tanggal_publish->translatedFormat('d M Y') }}
                    </p>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Berita Terbaru -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-stone-800">Berita Terbaru</h2>
        </div>

        @if (empty($sisanya))
            <p class="text-stone-500 text-sm">Belum ada berita lainnya.</p>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            @foreach ($sisanya as $item)
            <a href="{{ route('berita.show', $item->slug) }}" class="group">
                <div class="rounded-xl overflow-hidden h-40 mb-3">
                    @if ($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full bg-[#1E3A5F]"></div>
                    @endif
                </div>
                <p class="text-xs font-medium text-[#2C5282] mb-1">
                    {{ $kategoriLabel[$item->kategori] ?? ucfirst($item->kategori) }}
                </p>
                <h3 class="font-bold text-stone-800 leading-snug mb-1 group-hover:text-[#1E3A5F] transition">
                    {{ $item->judul }}
                </h3>
                <p class="text-sm text-stone-500 leading-relaxed line-clamp-2 mb-2">
                    {{ Str::limit(strip_tags($item->konten), 90) }}
                </p>
                <p class="text-xs text-stone-400">{{ $item->tanggal_publish->translatedFormat('d M Y') }}</p>
            </a>
            @endforeach
        </div>
        @endif

        <div class="flex justify-center">
            {{ $beritas->links() }}
        </div>

    @endif
</div>
@endsection