@extends('admin.layout.app')
@section('title', 'Tambah Berita')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-2xl">
    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium mb-1">Judul</label>
            <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border rounded px-3 py-2">
            @error('judul') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Kategori</label>
            <select name="kategori" class="w-full border rounded px-3 py-2">
                <option value="berita">Berita</option>
                <option value="kegiatan">Kegiatan</option>
                <option value="pengumuman">Pengumuman</option>
                <option value="kkn">KKN</option>
            </select>
            @error('kategori') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Tanggal Publish</label>
            <input type="date" name="tanggal_publish" value="{{ old('tanggal_publish') }}" class="w-full border rounded px-3 py-2">
            @error('tanggal_publish') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Foto</label>
            <input type="file" name="foto" class="w-full border rounded px-3 py-2">
            @error('foto') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Konten</label>
            <textarea name="konten" rows="8" class="w-full border rounded px-3 py-2">{{ old('konten') }}</textarea>
            @error('konten') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('admin.berita.index') }}" class="px-4 py-2 border rounded">Batal</a>
        </div>
    </form>
</div>
@endsection