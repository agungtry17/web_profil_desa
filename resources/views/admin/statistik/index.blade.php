@extends('admin.layout.app')
@section('title', 'Statistik Penduduk')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Data Statistik Penduduk</h2>
        <a href="{{ route('admin.statistik.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Data</a>
    </div>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b">
                <th class="py-2">Dusun</th>
                <th class="py-2">Kategori</th>
                <th class="py-2">Label</th>
                <th class="py-2">L</th>
                <th class="py-2">P</th>
                <th class="py-2">Tahun</th>
                <th class="py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($statistiks as $s)
            <tr class="border-b">
                <td class="py-2">{{ $s->dusun->nama_dusun ?? '- (Semua Dusun)' }}</td>
                <td class="py-2 capitalize">{{ $s->kategori }}</td>
                <td class="py-2">{{ $s->label }}</td>
                <td class="py-2">{{ $s->jumlah_laki }}</td>
                <td class="py-2">{{ $s->jumlah_perempuan }}</td>
                <td class="py-2">{{ $s->tahun }}</td>
                <td class="py-2 space-x-2">
                    <a href="{{ route('admin.statistik.edit', $s) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('admin.statistik.destroy', $s) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="py-4 text-center text-gray-500">Belum ada data statistik.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $statistiks->links() }}</div>
</div>
@endsection