@extends('admin.layout.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Kelola Berita</h1>
        <a href="{{ route('admin.berita.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Tambah Berita
        </a>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-3">Judul</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($beritas as $berita)
                    <tr class="border-b">
                        <td class="p-3">{{ $berita->judul }}</td>
                        <td class="p-3 capitalize">{{ $berita->kategori }}</td>
                        <td class="p-3">{{ $berita->tanggal_publish->format('d M Y') }}</td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.berita.edit', $berita) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.berita.destroy', $berita) }}" method="POST" onsubmit="return confirm('Yakin hapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="p-3 text-center text-gray-500">Belum ada berita.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $beritas->links() }}</div>
</div>
@endsection