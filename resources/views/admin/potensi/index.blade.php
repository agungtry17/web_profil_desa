@extends('admin.layout.app')
@section('title', 'Potensi Desa')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Potensi Desa</h2>
        <a href="{{ route('admin.potensi.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Potensi</a>
    </div>

    <div class="grid grid-cols-3 gap-4">
        @forelse ($potensis as $p)
        <div class="border rounded overflow-hidden">
            @if ($p->foto)
                <img src="{{ asset('storage/' . $p->foto) }}" class="w-full h-32 object-cover">
            @else
                <div class="w-full h-32 bg-gray-200"></div>
            @endif
            <div class="p-3">
                <span class="text-xs uppercase text-gray-500">{{ $p->jenis }}</span>
                <p class="font-medium">{{ $p->nama }}</p>
                <p class="text-sm text-gray-600">{{ Str::limit($p->deskripsi, 60) }}</p>
                <div class="flex justify-between mt-2 text-sm">
                    <a href="{{ route('admin.potensi.edit', $p) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('admin.potensi.destroy', $p) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p class="text-gray-500 col-span-3 text-center py-8">Belum ada data potensi desa.</p>
        @endforelse
    </div>

    <div class="mt-4">{{ $potensis->links() }}</div>
</div>
@endsection