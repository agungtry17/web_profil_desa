@extends('admin.layout.app')
@section('title', 'Edit Foto')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-lg">
    <form action="{{ route('admin.galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium mb-1">Judul</label>
            <input type="text" name="judul" value="{{ old('judul', $galeri->judul) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Kategori</label>
            <input type="text" name="kategori" value="{{ old('kategori', $galeri->kategori) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $galeri->tanggal?->format('Y-m-d')) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Foto</label>
            <img src="{{ asset('storage/' . $galeri->foto) }}" class="w-32 mb-2 rounded">
            <input type="file" name="foto" class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('admin.galeri.index') }}" class="px-4 py-2 border rounded">Batal</a>
        </div>
    </form>
</div>
@endsection