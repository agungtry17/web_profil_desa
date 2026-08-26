@extends('admin.layout.app')
@section('title', 'Edit Data Statistik')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-lg">
    <form action="{{ route('admin.statistik.update', $statistik) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium mb-1">Dusun</label>
            <select name="dusun_id" class="w-full border rounded px-3 py-2">
                @foreach ($dusuns as $dusun)
                    <option value="{{ $dusun->id }}" @selected($statistik->dusun_id == $dusun->id)>{{ $dusun->nama_dusun }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium mb-1">Kategori</label>
            <select name="kategori" class="w-full border rounded px-3 py-2">
                @foreach (['usia', 'pekerjaan', 'pendidikan', 'jumlah_penduduk'] as $kat)
                    <option value="{{ $kat }}" @selected($statistik->kategori == $kat)>{{ ucfirst($kat) }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium mb-1">Label</label>
            <input type="text" name="label" value="{{ old('label', $statistik->label) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">Jumlah Laki-laki</label>
                <input type="number" name="jumlah_laki" value="{{ old('jumlah_laki', $statistik->jumlah_laki) }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Jumlah Perempuan</label>
                <input type="number" name="jumlah_perempuan" value="{{ old('jumlah_perempuan', $statistik->jumlah_perempuan) }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div>
            <label class="block font-medium mb-1">Tahun</label>
            <input type="number" name="tahun" value="{{ old('tahun', $statistik->tahun) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('admin.statistik.index') }}" class="px-4 py-2 border rounded">Batal</a>
        </div>
    </form>
</div>
@endsection