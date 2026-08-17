@extends('admin.layout.app')
@section('title', 'Dusun')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Daftar Dusun</h2>
        <a href="{{ route('admin.dusun.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Dusun</a>
    </div>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b">
                <th class="py-2">Nama Dusun</th>
                <th class="py-2">Deskripsi</th>
                <th class="py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dusuns as $dusun)
            <tr class="border-b">
                <td class="py-2">{{ $dusun->nama_dusun }}</td>
                <td class="py-2">{{ Str::limit($dusun->deskripsi, 60) }}</td>
                <td class="py-2 space-x-2">
                    <a href="{{ route('admin.dusun.edit', $dusun) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('admin.dusun.destroy', $dusun) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus dusun ini? Data statistik terkait ikut terhapus.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="3" class="py-4 text-center text-gray-500">Belum ada dusun.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $dusuns->links() }}</div>
</div>
@endsection