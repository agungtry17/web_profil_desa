@extends('admin.layout.app')
@section('title', 'Tambah Data Statistik')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-lg">
    @if ($dusuns->isEmpty())
        <p class="text-red-600 mb-4">Belum ada data Dusun. Tambahkan dusun terlebih dahulu sebelum mengisi statistik.</p>
        <a href="{{ route('admin.dusun.create') }}" class="text-blue-600">+ Tambah Dusun</a>
    @else
    <form action="{{ route('admin.statistik.store') }}" method="POST" class="space-y-4">
        @csrf

        <div id="dusun-wrapper">
            <label class="block font-medium mb-1">Dusun</label>
            <select name="dusun_id" id="dusun_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Dusun --</option>
                @foreach ($dusuns as $dusun)
                    <option value="{{ $dusun->id }}">{{ $dusun->nama_dusun }}</option>
                @endforeach
            </select>
            @error('dusun_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Kategori</label>
            <select name="kategori" id="kategori" class="w-full border rounded px-3 py-2">
                <option value="usia">Usia</option>
                <option value="pekerjaan">Pekerjaan</option>
                <option value="pendidikan">Pendidikan</option>
                <option value="jumlah_kk">Jumlah KK</option>
            </select>
        </div>

        <div>
            <label class="block font-medium mb-1">Label</label>
            <input type="text" name="label" value="{{ old('label') }}" placeholder='misal: "0-5 tahun" atau "Petani"' class="w-full border rounded px-3 py-2">
            @error('label') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">Jumlah Laki-laki</label>
                <input type="number" name="jumlah_laki" value="{{ old('jumlah_laki', 0) }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Jumlah Perempuan</label>
                <input type="number" name="jumlah_perempuan" value="{{ old('jumlah_perempuan', 0) }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div>
            <label class="block font-medium mb-1">Tahun</label>
            <input type="number" name="tahun" value="{{ old('tahun', date('Y')) }}" class="w-full border rounded px-3 py-2">
            @error('tahun') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('admin.statistik.index') }}" class="px-4 py-2 border rounded">Batal</a>
        </div>
    </form>
    @endif
</div>

@push('scripts')
<script>
    const kategoriSelect = document.getElementById('kategori');
    const dusunWrapper = document.getElementById('dusun-wrapper');
    const dusunSelect = document.getElementById('dusun_id');

    if (kategoriSelect && dusunWrapper && dusunSelect) {
        function toggleDusun() {
            if (kategoriSelect.value === 'pekerjaan') {
                dusunWrapper.style.display = 'none';
                dusunSelect.value = '';
            } else {
                dusunWrapper.style.display = 'block';
            }
        }

        kategoriSelect.addEventListener('change', toggleDusun);
        toggleDusun();
    }
</script>
@endpush
@endsection