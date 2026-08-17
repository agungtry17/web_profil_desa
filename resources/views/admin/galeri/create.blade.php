@extends('admin.layout.app')
@section('title', 'Tambah Foto')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-lg">
    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium mb-1">Judul</label>
            <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border rounded px-3 py-2">
            @error('judul') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Kategori</label>
            <input type="text" name="kategori" value="{{ old('kategori') }}" placeholder="misal: Kegiatan KKN" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Foto</label>
            <input type="file" name="foto" class="w-full border rounded px-3 py-2">
            @error('foto') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('admin.galeri.index') }}" class="px-4 py-2 border rounded">Batal</a>
        </div>
    </form>
</div>
@endsection