@extends('public.layout.app')
@section('title', 'Galeri Desa')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10" x-data="{ filter: 'Semua' }">

    <div class="text-center max-w-2xl mx-auto mb-8">
        <h1 class="text-4xl font-extrabold text-[#1E3A5F] mb-3">Galeri Desa</h1>
        <p class="text-stone-500 leading-relaxed">
            Jelajahi keindahan, kegiatan, dan budaya desa kami melalui dokumentasi visual.
        </p>
    </div>

    <div class="flex flex-wrap justify-center gap-2 mb-8">
        <button @click="filter = 'Semua'"
                :class="filter === 'Semua' ? 'bg-[#1E3A5F] text-white' : 'bg-stone-100 text-stone-600 hover:bg-stone-200'"
                class="px-5 py-2 rounded-full text-sm font-medium transition">
            Semua
        </button>
        @foreach ($kategoris as $k)
        <button @click="filter = '{{ $k }}'"
                :class="filter === '{{ $k }}' ? 'bg-[#1E3A5F] text-white' : 'bg-stone-100 text-stone-600 hover:bg-stone-200'"
                class="px-5 py-2 rounded-full text-sm font-medium transition">
            {{ $k }}
        </button>
        @endforeach
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($galeris as $g)
        <div x-show="filter === 'Semua' || filter === '{{ $g->kategori }}'"
             class="relative rounded-2xl overflow-hidden shadow-sm border border-stone-100 aspect-square group cursor-pointer">

            <img src="{{ asset('storage/' . $g->foto) }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

            <!-- Overlay judul + kategori + tanggal saat hover -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent
                        opacity-0 group-hover:opacity-100 transition duration-300
                        flex flex-col justify-end p-4">
                @if (!empty($g->kategori))
                    <span class="inline-block self-start bg-white/15 backdrop-blur text-white text-xs font-medium px-3 py-1 rounded-full mb-2">
                        {{ $g->kategori }}
                    </span>
                @endif
                <h3 class="text-white font-bold text-base leading-snug">
                    {{ $g->judul }}
                </h3>
                @if ($g->tanggal)
                    <p class="text-white/70 text-xs mt-1">
                        {{ $g->tanggal->translatedFormat('d F Y') }}
                    </p>
                @endif
            </div>
        </div>
        @empty
        <p class="text-stone-500 col-span-3 text-center">Belum ada foto.</p>
        @endforelse
    </div>

</div>
@endsection