@extends('admin.layout.app')
@section('title', 'Profil Desa')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-3xl">
    <form action="{{ route('admin.profil-desa.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium mb-1">Nama Desa</label>
            <input type="text" name="nama_desa" value="{{ old('nama_desa', $profil->nama_desa) }}" class="w-full border rounded px-3 py-2">
            @error('nama_desa') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Slogan</label>
            <input type="text" name="slogan" value="{{ old('slogan', $profil->slogan) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Sambutan Kepala Desa</label>
            <textarea name="sambutan" rows="4" class="w-full border rounded px-3 py-2">{{ old('sambutan', $profil->sambutan) }}</textarea>
        </div>

        <div>
            <label class="block font-medium mb-1">Sejarah Desa</label>
            <textarea name="sejarah" rows="6" class="w-full border rounded px-3 py-2">{{ old('sejarah', $profil->sejarah) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">Visi</label>
                <textarea name="visi" rows="4" class="w-full border rounded px-3 py-2">{{ old('visi', $profil->visi) }}</textarea>
            </div>
            <div>
                <label class="block font-medium mb-1">Misi</label>
                <textarea name="misi" rows="4" class="w-full border rounded px-3 py-2">{{ old('misi', $profil->misi) }}</textarea>
            </div>
        </div>

        <div>
            <label class="block font-medium mb-1">Letak Geografis</label>
            <textarea name="letak_geografis" rows="3" class="w-full border rounded px-3 py-2">{{ old('letak_geografis', $profil->letak_geografis) }}</textarea>
        </div>

        <div>
            <label class="block font-medium mb-1">Batas Wilayah</label>
            <textarea name="batas_wilayah" rows="3" class="w-full border rounded px-3 py-2">{{ old('batas_wilayah', $profil->batas_wilayah) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">Nama Kepala Desa</label>
                <input type="text" name="nama_kepala_desa" value="{{ old('nama_kepala_desa', $profil->nama_kepala_desa) }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Jumlah Penduduk</label>
                <input type="number" name="jumlah_penduduk" value="{{ old('jumlah_penduduk', $profil->jumlah_penduduk) }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">Luas Wilayah (km²)</label>
                <input type="number" step="0.01" name="luas_wilayah" value="{{ old('luas_wilayah', $profil->luas_wilayah) }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">No Telepon</label>
                <input type="text" name="no_telepon" value="{{ old('no_telepon', $profil->no_telepon) }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $profil->email) }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Alamat Kantor</label>
                <input type="text" name="alamat_kantor" value="{{ old('alamat_kantor', $profil->alamat_kantor) }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">Latitude</label>
                <input type="text" name="latitude" value="{{ old('latitude', $profil->latitude) }}" placeholder="misal: -6.9667" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Longitude</label>
                <input type="text" name="longitude" value="{{ old('longitude', $profil->longitude) }}" placeholder="misal: 110.4167" class="w-full border rounded px-3 py-2">
            </div>
        </div>
        
        <div>
            <label class="block font-medium mb-1">Logo Desa</label>
            @if ($profil->logo)
                <img src="{{ asset('storage/' . $profil->logo) }}" class="w-16 h-16 object-cover rounded-full mb-2">
            @endif
            <input type="file" name="logo" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Foto Banner</label>
            @if ($profil->foto_banner)
                <img src="{{ asset('storage/' . $profil->foto_banner) }}" class="w-full h-40 object-cover rounded mb-2">
            @endif
            <input type="file" name="foto_banner" accept="image/*" class="w-full border rounded px-3 py-2">
            <p class="text-xs text-stone-500 mt-1">Disarankan ukuran 1600 x 600 piksel (rasio lebar), format JPG/PNG, maksimal 2MB.</p>
            @error('foto_banner') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
        
        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Profil Desa</button>
        </div>
    </form>
</div>
@endsection