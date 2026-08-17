@extends('admin.layout.app')
@section('title', 'Berita')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Daftar Berita</h2>
        <a href="{{ route('admin.berita.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Berita</a>
    </div>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b">
                <th class="py-2">Judul</th>
                <th class="py-2">Kategori</th>
                <th class="py-2">Tanggal</th>
                <th class="py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($beritas as $berita)
            <tr class="border-b">
                <td class="py-2">{{ $berita->judul }}</td>
                <td class="py-2">{{ $berita->kategori }}</td>
                <td class="py-2">{{ $berita->tanggal_publish }}</td>
                <td class="py-2 space-x-2">
                    <a href="{{ route('admin.berita.edit', $berita) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('admin.berita.destroy', $berita) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus berita ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="py-4 text-center text-gray-500">Belum ada berita.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $beritas->links() }}
    </div>
</div>
@endsection