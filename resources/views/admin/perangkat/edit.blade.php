@extends('admin.layout.app')
@section('title', 'Edit Perangkat Desa')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-lg">
    <form action="{{ route('admin.perangkat.update', $perangkat) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium mb-1">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $perangkat->nama) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Jabatan</label>
            <input type="text" name="jabatan" value="{{ old('jabatan', $perangkat->jabatan) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $perangkat->no_hp) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Urutan Tampil</label>
            <input type="number" name="urutan" value="{{ old('urutan', $perangkat->urutan) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Biografi & Pengalaman</label>
            <textarea name="biografi" rows="4" class="w-full border rounded px-3 py-2">{{ old('biografi', $perangkat->biografi ?? '') }}</textarea>
        </div>

        <div>
            <label class="block font-medium mb-1">Tahun Mulai Menjabat</label>
            <input type="text" name="tahun_menjabat" value="{{ old('tahun_menjabat', $perangkat->tahun_menjabat ?? '') }}" placeholder="misal: 2020" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $perangkat->email ?? '') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">LinkedIn (opsional)</label>
            <input type="text" name="linkedin" value="{{ old('linkedin', $perangkat->linkedin ?? '') }}" placeholder="linkedin.com/in/username" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Riwayat Karir & Pendidikan</label>
            <textarea name="riwayat_karir" rows="5" placeholder="Tulis bebas, misal:&#10;2020-Sekarang: Kepala Desa&#10;2012-2020: Sekretaris Desa" class="w-full border rounded px-3 py-2">{{ old('riwayat_karir', $perangkat->riwayat_karir ?? '') }}</textarea>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('admin.perangkat.index') }}" class="px-4 py-2 border rounded">Batal</a>
        </div>
    </form>
</div>
@endsection