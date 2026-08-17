@extends('admin.layout.app')
@section('title', 'Edit Berita')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-2xl">
    <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium mb-1">Judul</label>
            <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" class="w-full border rounded px-3 py-2">
            @error('judul') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Kategori</label>
            <select name="kategori" class="w-full border rounded px-3 py-2">
                @foreach (['berita', 'kegiatan', 'pengumuman', 'kkn'] as $kat)
                    <option value="{{ $kat }}" @selected($berita->kategori == $kat)>{{ ucfirst($kat) }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium mb-1">Tanggal Publish</label>
            <input type="date" name="tanggal_publish" value="{{ old('tanggal_publish', $berita->tanggal_publish) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Foto</label>
            @if ($berita->foto)
                <img src="{{ asset('storage/' . $berita->foto) }}" class="w-32 mb-2 rounded">
            @endif
            <input type="file" name="foto" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Konten</label>
            <textarea name="konten" rows="8" class="w-full border rounded px-3 py-2">{{ old('konten', $berita->konten) }}</textarea>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('admin.berita.index') }}" class="px-4 py-2 border rounded">Batal</a>
        </div>
    </form>
</div>
@endsection