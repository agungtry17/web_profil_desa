@extends('admin.layout.app')
@section('title', 'Tambah Layanan Publik')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-lg">
    <form action="{{ route('admin.layanan.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium mb-1">Nama Layanan</label>
            <input type="text" name="nama_layanan" value="{{ old('nama_layanan') }}" placeholder="misal: Pembuatan KTP" class="w-full border rounded px-3 py-2">
            @error('nama_layanan') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Syarat</label>
            <textarea name="syarat" rows="4" placeholder="misal: Fotokopi KK, Fotokopi Akta Lahir" class="w-full border rounded px-3 py-2">{{ old('syarat') }}</textarea>
            @error('syarat') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Alur Pengurusan</label>
            <textarea name="alur_pengurusan" rows="4" placeholder="misal: 1. Datang ke kantor desa. 2. Isi formulir..." class="w-full border rounded px-3 py-2">{{ old('alur_pengurusan') }}</textarea>
            @error('alur_pengurusan') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Estimasi Waktu</label>
            <input type="text" name="estimasi_waktu" value="{{ old('estimasi_waktu') }}" placeholder="misal: 3 hari kerja" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Biaya</label>
            <input type="text" name="biaya" value="{{ old('biaya') }}" placeholder="misal: Gratis" class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('admin.layanan.index') }}" class="px-4 py-2 border rounded">Batal</a>
        </div>
    </form>
</div>
@endsection