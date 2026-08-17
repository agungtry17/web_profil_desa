<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $profil->nama_desa ?? 'Website Desa')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-stone-50 antialiased text-stone-800">

    <!-- Navbar -->
    <div x-data="{ mobileOpen: false }" class="sticky top-0 z-50">
        <header class="bg-[#1E3A5F] text-white shadow-md">
            <div class="max-w-6xl mx-auto px-4">
                <div class="flex justify-between items-center h-16">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-lg tracking-tight">
                        @if ($profil && $profil->logo)
                            <img src="{{ asset('storage/' . $profil->logo) }}" class="w-8 h-8 rounded-full object-cover">
                        @else
                            <span class="w-8 h-8 rounded-full bg-[#63B3ED] text-emerald-950 flex items-center justify-center text-sm">
                                {{ strtoupper(substr($profil->nama_desa ?? 'D', 0, 1)) }}
                            </span>
                        @endif
                        {{ $profil->nama_desa ?? 'Website Desa' }}
                    </a>

                    <nav class="hidden md:flex items-center gap-1 text-sm font-medium">
                        @php
                            $navItems = [
                                'home' => 'Beranda',
                                'profil' => 'Profil',
                                'statistik' => 'Statistik',
                                'potensi' => 'Potensi',
                                'berita' => 'Berita',
                                'layanan' => 'Layanan',
                                'galeri' => 'Galeri',
                                'kontak' => 'Kontak',
                            ];
                        @endphp
                        @foreach ($navItems as $route => $label)
                            <a href="{{ route($route) }}"
                               class="px-3 py-2 rounded-md transition {{ request()->routeIs($route) ? 'bg-[#2C5282] text-white' : 'text-[#EBF4FF] hover:bg-[#2C5282]/60' }}">
                                {{ $label }}
                            </a>
                        @endforeach
                    </nav>

                    <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 rounded hover:bg-[#2C5282]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div x-show="mobileOpen" x-cloak class="md:hidden bg-[#2C5282] px-4 py-3 space-y-1">
                @foreach ($navItems as $route => $label)
                    <a href="{{ route($route) }}" class="block px-3 py-2 rounded {{ request()->routeIs($route) ? 'bg-[#2C5282]' : 'hover:bg-[#2C5282]/60' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </header>
    </div>

    <!-- Flash message -->
    @if (session('success'))
        <div class="max-w-6xl mx-auto mt-4 px-4">
            <div class="bg-[#EBF4FF] border border-emerald-200 text-[#2C5282] px-4 py-3 rounded-lg flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Content -->
    <main class="min-h-[60vh]">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#0F1F33] text-stone-300 mt-16">
        <div class="max-w-6xl mx-auto px-4 py-12 grid md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-white font-bold text-lg mb-2">{{ $profil->nama_desa ?? 'Website Desa' }}</h3>
                <p class="text-sm text-stone-400 text-justify">Portal informasi resmi yang menghadirkan transparansi, kemudahan akses layanan publik, dan keterbukaan data bagi seluruh warga desa.</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3 text-sm uppercase tracking-wide">Tautan</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('profil') }}" class="hover:text-white">Profil Desa</a></li>
                    <li><a href="{{ route('layanan') }}" class="hover:text-white">Layanan Publik</a></li>
                    <li><a href="{{ route('berita') }}" class="hover:text-white">Berita</a></li>
                    <li><a href="{{ route('kontak') }}" class="hover:text-white">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3 text-sm uppercase tracking-wide">Kontak</h4>
                <ul class="space-y-1 text-sm text-stone-400">
                    <li>{{ $profil->alamat_kantor ?? '-' }}</li>
                    <li>{{ $profil->no_telepon ?? '-' }}</li>
                    <li>{{ $profil->email ?? '-' }}</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-stone-800 py-4 text-center text-xs text-stone-500">
            &copy; {{ date('Y') }} {{ $profil->nama_desa ?? 'Website Desa' }}. Dibuat untuk program kerja KKN.
        </div>
    </footer>

    @stack('scripts')
</body>
</html>