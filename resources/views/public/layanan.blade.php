@extends('public.layout.app')
@section('title', 'Layanan Publik')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">

    <div class="max-w-2xl mb-10">
        <h1 class="text-4xl font-extrabold text-[#1E3A5F] mb-3">Layanan Publik</h1>
        <p class="text-stone-500 leading-relaxed">
            Akses berbagai layanan administrasi desa secara mudah dan transparan.
            Temukan panduan langkah demi langkah untuk setiap keperluan Anda.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6" x-data="{ open: null }">
        @forelse ($layanans as $i => $l)
        <div class="bg-white rounded-2xl border border-stone-100 shadow-sm p-6 flex flex-col">
            <div class="w-12 h-12 rounded-xl bg-[#63B3ED] flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#1E3A5F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>

            <h3 class="font-bold text-lg text-stone-800 mb-2">{{ $l->nama_layanan }}</h3>
            <p class="text-sm text-stone-500 leading-relaxed mb-4 flex-1">{{ Str::limit($l->syarat, 90) }}</p>

            <div class="flex gap-3 text-xs text-stone-400 mb-4">
                @if ($l->estimasi_waktu)
                    <span>⏱ {{ $l->estimasi_waktu }}</span>
                @endif
                @if ($l->biaya)
                    <span>💰 {{ $l->biaya }}</span>
                @endif
            </div>

            <button @click="open = open === {{ $i }} ? null : {{ $i }}"
                    class="bg-[#1E3A5F] text-white font-semibold px-4 py-2.5 rounded-lg flex items-center justify-center gap-2 hover:bg-[#2C5282] transition">
                <span x-text="open === {{ $i }} ? 'Tutup Panduan' : 'Panduan'"></span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform" :class="open === {{ $i }} ? 'rotate-90' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <div x-show="open === {{ $i }}" x-collapse class="mt-4 pt-4 border-t border-stone-100 text-sm text-stone-600 space-y-3">
                <div>
                    <p class="font-semibold text-stone-700 mb-1">Syarat Lengkap</p>
                    <p class="whitespace-pre-line">{{ $l->syarat }}</p>
                </div>
                <div>
                    <p class="font-semibold text-stone-700 mb-1">Alur Pengurusan</p>
                    <p class="whitespace-pre-line">{{ $l->alur_pengurusan }}</p>
                </div>
            </div>
        </div>
        @empty
        <p class="text-stone-500 col-span-3">Belum ada data layanan publik.</p>
        @endforelse
    </div>
</div>
@endsection