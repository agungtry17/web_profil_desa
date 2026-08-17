@extends('admin.layout.app')
@section('title', 'Layanan Publik')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Layanan Publik</h2>
        <a href="{{ route('admin.layanan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Layanan</a>
    </div>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b">
                <th class="py-2">Nama Layanan</th>
                <th class="py-2">Estimasi Waktu</th>
                <th class="py-2">Biaya</th>
                <th class="py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($layanans as $l)
            <tr class="border-b">
                <td class="py-2">{{ $l->nama_layanan }}</td>
                <td class="py-2">{{ $l->estimasi_waktu }}</td>
                <td class="py-2">{{ $l->biaya }}</td>
                <td class="py-2 space-x-2">
                    <a href="{{ route('admin.layanan.edit', $l) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('admin.layanan.destroy', $l) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus layanan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="py-4 text-center text-gray-500">Belum ada layanan publik.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $layanans->links() }}</div>
</div>
@endsection