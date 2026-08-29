@extends('public.layout.app')
@section('title', 'Beranda')

@section('content')

<!-- Hero -->
<div class="relative h-[560px] overflow-hidden">
    @if ($profil && $profil->foto_banner)
        <img src="{{ asset('storage/' . $profil->foto_banner) }}" class="absolute inset-0 w-full h-full object-cover">
    @else
        <div class="absolute inset-0 bg-[#1E3A5F]"></div>
    @endif
    <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/40 to-black/60"></div>

    <div class="relative max-w-6xl mx-auto px-4 h-full flex flex-col items-center justify-center text-center text-white">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">
            Selamat Datang di {{ $profil->nama_desa ?? 'Desa Kami' }}
        </h1>
        <p class="max-w-2xl text-white/85 leading-relaxed mb-8">
            {{ $profil->slogan ?? 'Membangun masa depan melalui tradisi dan inovasi, menghubungkan masyarakat, memberdayakan ekonomi lokal, dan memajukan tata kelola desa.' }}
        </p>
        <div class="flex gap-3">
            <a href="{{ route('profil') }}" class="bg-white text-[#1E3A5F] font-semibold px-6 py-3 rounded-lg hover:bg-white/90 transition">
                Jelajahi Desa
            </a>
            <a href="{{ route('layanan') }}" class="border border-white text-white font-semibold px-6 py-3 rounded-lg hover:bg-white/10 transition">
                Layanan Publik
            </a>
        </div>
    </div>
</div>

<!-- Stat Cards -->
<div class="max-w-6xl mx-auto px-4 -mt-16 relative z-10 mb-16">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-md p-6 text-center">
            <div class="w-12 h-12 rounded-full bg-[#63B3ED] text-[#1E3A5F] flex items-center justify-center mx-auto mb-3 text-xl">
                👥
            </div>
            <p class="text-2xl font-extrabold text-stone-800">{{ number_format($profil->jumlah_penduduk ?? 0) }}</p>
            <p class="text-xs uppercase tracking-widest text-stone-400 font-semibold mt-1">Total Penduduk</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 text-center">
            <div class="w-12 h-12 rounded-full bg-[#63B3ED] text-[#1E3A5F] flex items-center justify-center mx-auto mb-3 text-xl">
                🗺️
            </div>
            <p class="text-2xl font-extrabold text-stone-800">{{ $profil->luas_wilayah ?? '-' }} Ha</p>
            <p class="text-xs uppercase tracking-widest text-stone-400 font-semibold mt-1">Luas Wilayah</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 text-center">
            <div class="w-12 h-12 rounded-full bg-[#63B3ED] text-[#1E3A5F] flex items-center justify-center mx-auto mb-3 text-xl">
                🏪
            </div>
            <p class="text-2xl font-extrabold text-stone-800">{{ $umkmCount }}</p>
            <p class="text-xs uppercase tracking-widest text-stone-400 font-semibold mt-1">UMKM Aktif</p>
        </div>
    </div>
</div>

<!-- Sekilas Profil -->
<div class="max-w-6xl mx-auto px-4 mb-20">
    <div class="grid md:grid-cols-2 gap-10 items-center">
        <div class="rounded-2xl overflow-hidden shadow-md aspect-[4/3]">
            @if ($profil && $profil->foto_banner)
                <img src="{{ asset('storage/' . $profil->foto_banner) }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-[#1E3A5F]"></div>
            @endif
        </div>
        <div>
            <span class="inline-block bg-[#63B3ED] text-[#1E3A5F] text-xs font-semibold px-3 py-1 rounded-full mb-4">
                Sekilas Profil
            </span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-stone-800 mb-4">
                {{ $profil->nama_desa ?? 'Desa Kami' }}
            </h2>
            <p class="text-stone-600 leading-relaxed mb-6">
                {{ \Illuminate\Support\Str::limit(strip_tags($profil->sejarah ?? 'Belum ada deskripsi profil desa.'), 280) }}
            </p>
            <a href="{{ route('profil') }}" class="inline-flex items-center gap-2 bg-[#1E3A5F] text-white font-semibold px-5 py-3 rounded-lg hover:opacity-90 transition">
                Selengkapnya &rarr;
            </a>
        </div>
    </div>
</div>

<!-- Berita Terbaru -->
<div class="bg-stone-50 py-16">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-extrabold text-stone-800 mb-2">Berita Terbaru</h2>
            <p class="text-stone-500 text-sm">Informasi dan kabar terkini seputar desa.</p>
        </div>

        @if ($beritas->isEmpty())
            <p class="text-center text-stone-500 text-sm">Belum ada berita yang tersedia.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($beritas->take(3) as $berita)
                <a href="{{ route('berita.show', $berita) }}" class="bg-white rounded-xl border border-stone-100 shadow-sm overflow-hidden hover:shadow-md transition flex flex-col">
                    <div class="h-44 bg-stone-100">
                        @if ($berita->foto)
                            <img src="{{ asset('storage/' . $berita->foto) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-[#1E3A5F]"></div>
                        @endif
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        @if ($berita->kategori)
                        <span class="inline-block bg-[#63B3ED] text-[#2C5282] text-xs font-medium px-3 py-1 rounded-full mb-3 self-start">
                            {{ $berita->kategori }}
                        </span>
                        @endif
                        <h3 class="font-bold text-stone-800 mb-2 line-clamp-2">{{ $berita->judul }}</h3>
                        <p class="text-xs text-stone-400 mt-auto pt-3">
                            {{ $berita->tanggal_publish?->translatedFormat('d F Y') }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('berita') }}" class="inline-flex items-center gap-2 bg-[#1E3A5F] text-white font-semibold px-5 py-3 rounded-lg hover:opacity-90 transition">
                    Lihat Semua Berita &rarr;
                </a>
            </div>
        @endif
    </div>
</div>

@endsection