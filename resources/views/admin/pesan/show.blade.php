@extends('admin.layout.app')
@section('title', 'Detail Pesan')

@section('content')
<div class="max-w-3xl">
    <a href="{{ route('admin.pesan.index') }}" class="text-sm text-[#1E3A5F] hover:underline mb-4 inline-block">
        &larr; Kembali ke Pesan Masuk
    </a>

    <div class="bg-white rounded-xl border border-stone-100 shadow-sm p-6">
        <div class="flex items-start justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-full bg-[#1E3A5F] text-white flex items-center justify-center font-semibold flex-shrink-0">
                    {{ strtoupper(substr($pesan->nama, 0, 1)) }}
                </div>
                <div>
                    <p class="font-bold text-stone-800">{{ $pesan->nama }}</p>
                    <p class="text-sm text-stone-500">{{ $pesan->email }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.pesan.destroy', $pesan) }}"
                  onsubmit="return confirm('Hapus pesan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="text-red-600 border border-red-200 hover:bg-red-50 text-sm font-medium px-4 py-2 rounded-lg transition">
                    Hapus
                </button>
            </form>
        </div>

        <div class="flex items-center gap-3 text-xs text-stone-400 mb-6 pb-6 border-b border-stone-100">
            <span>{{ $pesan->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
            <span>&middot;</span>
            <span class="inline-block px-2 py-0.5 rounded-full {{ $pesan->status === 'baru' ? 'bg-[#63B3ED] text-[#2C5282]' : 'bg-stone-100 text-stone-500' }}">
                {{ $pesan->status === 'baru' ? 'Baru' : 'Sudah Dibaca' }}
            </span>
        </div>

        <div class="text-stone-700 leading-relaxed whitespace-pre-line">
            {{ $pesan->pesan }}
        </div>
    </div>
</div>
@endsection