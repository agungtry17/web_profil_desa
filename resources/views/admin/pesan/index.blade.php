@extends('admin.layout.app')
@section('title', 'Pesan Masuk')

@section('content')
<div class="bg-white rounded-xl border border-stone-100 shadow-sm overflow-hidden">

    <div class="p-4 border-b border-stone-100 flex items-center justify-between">
        <p class="text-sm text-stone-500">
            {{ $pesans->total() }} pesan total
            @php $belumDibaca = \App\Models\PesanKontak::where('status', 'baru')->count(); @endphp
            @if ($belumDibaca > 0)
                &middot; <span class="text-red-600 font-medium">{{ $belumDibaca }} belum dibaca</span>
            @endif
        </p>
    </div>

    @if ($pesans->isEmpty())
        <p class="text-center text-stone-500 text-sm py-10">Belum ada pesan masuk.</p>
    @else
        <div class="divide-y divide-stone-100">
            @foreach ($pesans as $pesan)
            <a href="{{ route('admin.pesan.show', $pesan) }}"
               class="flex items-start gap-4 p-4 hover:bg-stone-50 transition {{ $pesan->status === 'baru' ? 'bg-[#63B3ED]/40' : '' }}">

                <div class="w-10 h-10 rounded-full bg-[#1E3A5F] text-white flex items-center justify-center text-sm font-semibold flex-shrink-0">
                    {{ strtoupper(substr($pesan->nama, 0, 1)) }}
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between gap-2">
                        <p class="font-semibold text-stone-800 truncate {{ $pesan->status === 'baru' ? '' : 'font-medium' }}">
                            {{ $pesan->nama }}
                        </p>
                        <span class="text-xs text-stone-400 flex-shrink-0">{{ $pesan->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm text-stone-500 truncate">{{ $pesan->email }}</p>
                    <p class="text-sm text-stone-600 mt-1 line-clamp-2">{{ $pesan->pesan }}</p>
                </div>

                @if ($pesan->status === 'baru')
                    <span class="w-2 h-2 rounded-full bg-[#2C5282] flex-shrink-0 mt-2"></span>
                @endif
            </a>
            @endforeach
        </div>

        <div class="p-4 border-t border-stone-100">
            {{ $pesans->links() }}
        </div>
    @endif
</div>
@endsection