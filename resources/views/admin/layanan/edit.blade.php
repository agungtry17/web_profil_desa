@extends('admin.layout.app')
@section('title', 'Edit Layanan Publik')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-lg">
    <form action="{{ route('admin.layanan.update', $layanan) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium mb-1">Nama Layanan</label>
            <input type="text" name="nama_layanan" value="{{ old('nama_layanan', $layanan->nama_layanan) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Syarat</label>
            <textarea name="syarat" rows="4" class="w-full border rounded px-3 py-2">{{ old('syarat', $layanan->syarat) }}</textarea>
        </div>

        <div>
            <label class="block font-medium mb-1">Alur Pengurusan</label>
            <textarea name="alur_pengurusan" rows="4" class="w-full border rounded px-3 py-2">{{ old('alur_pengurusan', $layanan->alur_pengurusan) }}</textarea>
        </div>

        <div>
            <label class="block font-medium mb-1">Estimasi Waktu</label>
            <input type="text" name="estimasi_waktu" value="{{ old('estimasi_waktu', $layanan->estimasi_waktu) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium mb-1">Biaya</label>
            <input type="text" name="biaya" value="{{ old('biaya', $layanan->biaya) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('admin.layanan.index') }}" class="px-4 py-2 border rounded">Batal</a>
        </div>
    </form>
</div>
@endsection