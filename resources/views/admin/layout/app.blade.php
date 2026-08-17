<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-50 font-sans antialiased">
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-[#1E3A5F] text-white flex-shrink-0 flex flex-col">
            <div class="p-5 border-b border-white/10">
                <p class="font-bold text-lg leading-tight">Desa Randugunting</p>
                <p class="text-[11px] uppercase tracking-widest text-white/50 font-semibold mt-0.5">Portal Administrasi</p>
            </div>

            <nav class="flex-1 py-4 space-y-1 text-sm overflow-y-auto">
                @php
                    $menu = [
                        ['route' => 'admin.dashboard', 'label' => 'Dashboard'],
                        ['route' => 'admin.profil-desa.edit', 'label' => 'Profil Desa'],
                        ['route' => 'admin.perangkat.index', 'label' => 'Perangkat Desa'],
                        ['route' => 'admin.dusun.index', 'label' => 'Dusun'],
                        ['route' => 'admin.statistik.index', 'label' => 'Statistik Penduduk'],
                        ['route' => 'admin.potensi.index', 'label' => 'Potensi Desa'],
                        ['route' => 'admin.berita.index', 'label' => 'Berita'],
                        ['route' => 'admin.layanan.index', 'label' => 'Layanan Publik'],
                        ['route' => 'admin.galeri.index', 'label' => 'Galeri'],
                        ['route' => 'admin.pesan.index', 'label' => 'Pesan Masuk'],
                    ];
                @endphp

                @foreach ($menu as $item)
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-3 px-5 py-2.5 transition
                              {{ request()->routeIs(str_replace('.edit', '.*', $item['route'])) || request()->routeIs($item['route'].'*')
                                    ? 'bg-white/10 text-white font-medium border-r-2 border-white'
                                    : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="p-4 border-t border-white/10 flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-white/15 flex items-center justify-center text-sm font-semibold flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-[11px] text-white/50">Admin Utama</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="border-t border-white/10">
                @csrf
                <button type="submit" class="w-full text-left px-5 py-3 text-sm text-white/70 hover:bg-white/5 hover:text-white transition">
                    Logout
                </button>
            </form>
        </aside>

        <!-- Main content -->
        <div class="flex-1 min-w-0 flex flex-col">
            <header class="bg-white border-b border-stone-200 px-6 py-4">
                <h1 class="text-xl font-bold text-stone-800">@yield('title', 'Admin')</h1>
            </header>
            <main class="p-6 flex-1">
                @if (session('success'))
                    <div class="mb-4 bg-green-50 border border-green-200 text-[#1E3A5F] text-sm px-4 py-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>