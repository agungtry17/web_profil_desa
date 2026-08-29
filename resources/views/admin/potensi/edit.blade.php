@extends('admin.layout.app')
@section('title', 'Edit Potensi Desa')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-lg">
    <form action="{{ route('admin.potensi.update', $potensi) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium mb-1">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $potensi->nama) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Jenis</label>
            <select name="jenis" class="w-full border rounded px-3 py-2">
                @foreach (['ekonomi', 'umkm', 'wisata', 'kesenian'] as $j)
                    <option value="{{ $j }}" @selected($potensi->jenis == $j)>{{ ucfirst($j) }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full border rounded px-3 py-2">{{ old('deskripsi', $potensi->deskripsi) }}</textarea>
        </div>

        <div>
            <label class="block font-medium mb-1">Kontak</label>
            <input type="text" name="kontak" value="{{ old('kontak', $potensi->kontak) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Lokasi</label>
            <input type="text" name="lokasi" value="{{ old('lokasi', $potensi->lokasi) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Foto</label>
            @if ($potensi->foto)
                <img src="{{ asset('storage/' . $potensi->foto) }}" class="w-24 mb-2 rounded">
            @endif
            <input type="file" name="foto" class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('admin.potensi.index') }}" class="px-4 py-2 border rounded">Batal</a>
        </div>
    </form>
</div>
@endsection