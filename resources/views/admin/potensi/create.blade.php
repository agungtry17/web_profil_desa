@extends('admin.layout.app')
@section('title', 'Tambah Potensi Desa')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-lg">
    <form action="{{ route('admin.potensi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium mb-1">Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border rounded px-3 py-2">
            @error('nama') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Jenis</label>
            <select name="jenis" class="w-full border rounded px-3 py-2">
                <option value="ekonomi">Ekonomi</option>
                <option value="umkm">UMKM</option>
                <option value="wisata">Wisata</option>
                <option value="kerajinan">Kerajinan</option>
            </select>
        </div>

        <div>
            <label class="block font-medium mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full border rounded px-3 py-2">{{ old('deskripsi') }}</textarea>
        </div>

        <div>
            <label class="block font-medium mb-1">Kontak</label>
            <input type="text" name="kontak" value="{{ old('kontak') }}" placeholder="No WA / telepon (opsional)" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Lokasi</label>
            <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Foto</label>
            <input type="file" name="foto" class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('admin.potensi.index') }}" class="px-4 py-2 border rounded">Batal</a>
        </div>
    </form>
</div>
@endsection