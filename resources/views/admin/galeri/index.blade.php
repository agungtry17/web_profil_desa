@extends('admin.layout.app')
@section('title', 'Galeri')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Galeri Foto</h2>
        <a href="{{ route('admin.galeri.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Foto</a>
    </div>

    <div class="grid grid-cols-4 gap-4">
        @forelse ($galeris as $galeri)
        <div class="border rounded overflow-hidden">
            <img src="{{ asset('storage/' . $galeri->foto) }}" class="w-full h-32 object-cover">
            <div class="p-2">
                <p class="font-medium text-sm truncate">{{ $galeri->judul }}</p>
                <p class="text-xs text-gray-500">{{ $galeri->tanggal?->format('d M Y') }}</p>
                <div class="flex justify-between mt-2 text-sm">
                    <a href="{{ route('admin.galeri.edit', $galeri) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST" onsubmit="return confirm('Yakin hapus foto ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p class="text-gray-500 col-span-4 text-center py-8">Belum ada foto.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $galeris->links() }}
    </div>
</div>
@endsection