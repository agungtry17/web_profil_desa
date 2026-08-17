@extends('admin.layout.app')
@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">

    <!-- Kartu ringkasan -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <div class="bg-white p-4 rounded shadow text-center">
            <p class="text-2xl font-bold text-[#1E3A5F]">{{ $stats['berita'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Berita</p>
        </div>
        <div class="bg-white p-4 rounded shadow text-center">
            <p class="text-2xl font-bold text-[#1E3A5F]">{{ $stats['perangkat'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Perangkat Desa</p>
        </div>
        <div class="bg-white p-4 rounded shadow text-center">
            <p class="text-2xl font-bold text-[#1E3A5F]">{{ $stats['potensi'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Potensi Desa</p>
        </div>
        <div class="bg-white p-4 rounded shadow text-center">
            <p class="text-2xl font-bold text-[#1E3A5F]">{{ $stats['galeri'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Foto Galeri</p>
        </div>
        <div class="bg-white p-4 rounded shadow text-center border-2 {{ $stats['pesan_baru'] > 0 ? 'border-red-300' : 'border-transparent' }}">
            <p class="text-2xl font-bold {{ $stats['pesan_baru'] > 0 ? 'text-red-600' : 'text-[#1E3A5F]' }}">{{ $stats['pesan_baru'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Pesan Belum Dibaca</p>
        </div>
    </div>

    <!-- Shortcut cepat -->
    <div class="bg-white p-4 rounded shadow flex flex-wrap gap-3">
        <a href="{{ route('admin.berita.create') }}" class="bg-[#1E3A5F] text-white text-sm px-4 py-2 rounded">+ Tambah Berita</a>
        <a href="{{ route('admin.galeri.create') }}" class="bg-[#1E3A5F] text-white text-sm px-4 py-2 rounded">+ Tambah Foto Galeri</a>
        <a href="{{ route('admin.potensi.create') }}" class="bg-[#1E3A5F] text-white text-sm px-4 py-2 rounded">+ Tambah Potensi Desa</a>
        <a href="{{ route('admin.perangkat.create') }}" class="bg-[#1E3A5F] text-white text-sm px-4 py-2 rounded">+ Tambah Perangkat Desa</a>
    </div>

    <!-- Pengingat -->
    @if (count($pengingat) > 0)
    <div class="bg-yellow-50 border border-yellow-200 rounded p-4">
        <p class="font-semibold text-yellow-800 mb-2">Perlu Dilengkapi</p>
        <ul class="text-sm text-yellow-700 list-disc list-inside space-y-1">
            @foreach ($pengingat as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Berita terbaru -->
        <div class="bg-white rounded shadow p-4">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold">Berita Terbaru</h3>
                <a href="{{ route('admin.berita.index') }}" class="text-xs text-[#1E3A5F]">Lihat semua</a>
            </div>
            <ul class="divide-y">
                @forelse ($beritaTerbaru as $b)
                <li class="py-2 text-sm flex justify-between">
                    <span class="truncate pr-2">{{ $b->judul }}</span>
                    <span class="text-gray-400 flex-shrink-0">{{ $b->tanggal_publish->format('d M') }}</span>
                </li>
                @empty
                <li class="py-2 text-sm text-gray-400">Belum ada berita.</li>
                @endforelse
            </ul>
        </div>

        <!-- Pesan terbaru -->
        <div class="bg-white rounded shadow p-4">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold">Pesan Masuk Terbaru</h3>
                <a href="{{ route('admin.pesan.index') }}" class="text-xs text-[#1E3A5F]">Lihat semua</a>
            </div>
            <ul class="divide-y">
                @forelse ($pesanTerbaru as $p)
                <li class="py-2 text-sm">
                    <div class="flex justify-between">
                        <span class="font-medium {{ $p->status === 'baru' ? 'text-red-600' : '' }}">{{ $p->nama }}</span>
                        <span class="text-gray-400 text-xs">{{ $p->created_at->format('d M') }}</span>
                    </div>
                    <p class="text-gray-500 truncate">{{ $p->pesan }}</p>
                </li>
                @empty
                <li class="py-2 text-sm text-gray-400">Belum ada pesan masuk.</li>
                @endforelse
            </ul>
        </div>
    </div>

</div>
@endsection