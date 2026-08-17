<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - {{ $profil->nama_desa ?? 'Website Desa' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="relative min-h-screen flex items-center justify-center px-4">

    <!-- Background -->
    <div class="fixed inset-0 -z-10">
        @if ($profil && $profil->foto_banner)
            <img src="{{ asset('storage/' . $profil->foto_banner) }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-[#1E3A5F]"></div>
        @endif
        <div class="absolute inset-0 bg-[#0F1F33]/80"></div>
    </div>

    <div class="w-full max-w-md">
        <div class="bg-stone-50 rounded-2xl shadow-2xl p-8">

            <div class="flex flex-col items-center mb-6">
                @if ($profil && $profil->logo)
                    <img src="{{ asset('storage/' . $profil->logo) }}" class="w-16 h-16 rounded-xl object-cover mb-4">
                @else
                    <div class="w-16 h-16 rounded-xl bg-[#1E3A5F] flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21h18M4 21V8l8-5 8 5v13M9 21v-6h6v6" />
                        </svg>
                    </div>
                @endif
                <h1 class="text-2xl font-extrabold text-stone-800">{{ $profil->nama_desa ?? 'Website Desa' }}</h1>
                <p class="text-sm text-stone-500 mt-1">Portal Administrasi</p>
            </div>

            @if (session('status'))
                <div class="mb-4 text-sm text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-lg px-4 py-2">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 text-sm text-red-700 bg-red-50 border border-red-200 rounded-lg px-4 py-2">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-stone-500 uppercase tracking-wide mb-1.5">Username atau Email</label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-stone-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="w-full border border-stone-200 rounded-lg pl-10 pr-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1E3A5F]"
                               placeholder="Masukkan email">
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label class="block text-xs font-semibold text-stone-500 uppercase tracking-wide">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-[#1E3A5F] hover:underline">Lupa Sandi?</a>
                        @endif
                    </div>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-stone-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <input id="password" type="password" name="password" required
                               class="w-full border border-stone-200 rounded-lg pl-10 pr-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1E3A5F]"
                               placeholder="Masukkan kata sandi">
                    </div>
                </div>

                <label class="flex items-center gap-2 text-sm text-stone-600">
                    <input type="checkbox" name="remember" class="rounded border-stone-300 text-[#1E3A5F] focus:ring-[#1E3A5F]">
                    Ingat saya
                </label>

                <button type="submit" class="w-full bg-[#1E3A5F] hover:bg-[#2C5282] text-white font-semibold py-3 rounded-lg flex items-center justify-center gap-2 transition">
                    Masuk
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </form>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-white/90 text-sm hover:underline flex items-center justify-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Beranda Publik
            </a>
        </div>
    </div>

</body>
</html>