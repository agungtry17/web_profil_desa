@extends('admin.layout.app')
@section('title', 'Edit Data Statistik')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-lg">
    <form action="{{ route('admin.statistik.update', $statistik) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div id="dusun-wrapper">
            <label class="block font-medium mb-1">Dusun</label>
            <select name="dusun_id" id="dusun_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Dusun --</option>
                @foreach ($dusuns as $dusun)
                    <option value="{{ $dusun->id }}" @selected($statistik->dusun_id == $dusun->id)>{{ $dusun->nama_dusun }}</option>
                @endforeach
            </select>
            @error('dusun_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Kategori</label>
            <select name="kategori" id="kategori" class="w-full border rounded px-3 py-2" required>
                @php
                    $kategoriLabels = [
                        'usia' => 'Usia',
                        'pekerjaan' => 'Pekerjaan',
                        'pendidikan' => 'Pendidikan',
                        'jumlah_kk' => 'Jumlah KK',
                    ];
                @endphp
                @foreach ($kategoriLabels as $value => $label)
                    <option value="{{ $value }}" @selected($statistik->kategori == $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium mb-1">Label</label>
            <input type="text" name="label" value="{{ old('label', $statistik->label) }}" class="w-full border rounded px-3 py-2">
            @error('label') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
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
            @error('tahun') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('admin.statistik.index') }}" class="px-4 py-2 border rounded">Batal</a>
        </div>
    </form>
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