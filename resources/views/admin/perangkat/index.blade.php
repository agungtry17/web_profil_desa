@extends('admin.layout.app')
@section('title', 'Perangkat Desa')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Struktur Perangkat Desa</h2>
        <a href="{{ route('admin.perangkat.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Perangkat</a>
    </div>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b">
                <th class="py-2">Urutan</th>
                <th class="py-2">Foto</th>
                <th class="py-2">Nama</th>
                <th class="py-2">Jabatan</th>
                <th class="py-2">No HP</th>
                <th class="py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($perangkats as $p)
            <tr class="border-b">
                <td class="py-2">{{ $p->urutan }}</td>
                <td class="py-2">
                    @if ($p->foto)
                        <img src="{{ asset('storage/' . $p->foto) }}" class="w-12 h-12 object-cover rounded-full">
                    @else
                        <div class="w-12 h-12 bg-gray-200 rounded-full"></div>
                    @endif
                </td>
                <td class="py-2">{{ $p->nama }}</td>
                <td class="py-2">{{ $p->jabatan }}</td>
                <td class="py-2">{{ $p->no_hp }}</td>
                <td class="py-2 space-x-2">
                    <a href="{{ route('admin.perangkat.edit', $p) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('admin.perangkat.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="py-4 text-center text-gray-500">Belum ada data perangkat desa.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $perangkats->links() }}</div>
</div>
@endsection