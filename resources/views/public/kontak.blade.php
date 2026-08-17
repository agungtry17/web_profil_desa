@extends('public.layout.app')
@section('title', 'Kontak')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-14">

    <h1 class="text-4xl font-extrabold text-stone-900 mb-6">Hubungi Kami</h1>

    <div class="text-stone-600 space-y-1 mb-10">
        <p>{{ $profil->alamat_kantor ?? '-' }}</p>
        <p>Telepon: {{ $profil->no_telepon ?? '-' }}</p>
        <p>Email: {{ $profil->email ?? '-' }}</p>
    </div>

    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-[#1E3A5F] text-sm rounded-lg px-4 py-3 mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-stone-100 shadow-sm p-8">
        <form method="POST" action="{{ route('kontak.store') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block font-semibold text-stone-800 mb-2">Nama</label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                       placeholder="Masukkan nama Anda"
                       class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-sm
                              placeholder:text-stone-400 focus:outline-none focus:ring-2 focus:ring-[#1E3A5F] focus:bg-white transition">
                @error('nama') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold text-stone-800 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       placeholder="Masukkan alamat email Anda"
                       class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-sm
                              placeholder:text-stone-400 focus:outline-none focus:ring-2 focus:ring-[#1E3A5F] focus:bg-white transition">
                @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold text-stone-800 mb-2">Pesan</label>
                <textarea name="pesan" rows="6"
                          placeholder="Tulis pesan Anda di sini..."
                          class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-sm
                                 placeholder:text-stone-400 focus:outline-none focus:ring-2 focus:ring-[#1E3A5F] focus:bg-white transition resize-y">{{ old('pesan') }}</textarea>
                @error('pesan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit"
                    class="inline-flex items-center gap-2 bg-[#1E3A5F] text-white text-sm font-bold tracking-wide uppercase px-6 py-3 rounded-lg hover:opacity-90 transition">
                Kirim Pesan
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L18 12M18 12L13 7M18 12L13 17" />
                </svg>
            </button>
        </form>
    </div>

</div>
@endsection