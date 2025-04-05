<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sekolah Cinta Kasih Tzu Chi') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-tzu-primary {
            background-color: #009A44;
        }

        .bg-tzu-secondary {
            background-color: #00A3AF;
        }

        .text-tzu-primary {
            color: #009A44;
        }

        .text-tzu-secondary {
            color: #00A3AF;
        }

        .border-tzu-primary {
            border-color: #009A44;
        }

        .hover\:bg-tzu-primary:hover {
            background-color: #00823A;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-700">
    <div class="min-h-screen flex flex-col">
        <!-- Header/Navigation -->
        <header class="bg-tzu-primary text-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center space-x-4">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <img class="h-10 w-auto" src="{{ asset('assets/image/tzu-chi.png') }}" alt="Logo Tzu Chi">
                            <span class="ml-2 text-xl font-semibold">Cinta Kasih Tzu Chi</span>
                        </div>

                        <!-- Navigation Links -->
                        <nav class="hidden md:flex space-x-8">
                            <a href="{{ route('user.dashboard') }}"
                                class="px-3 py-2 rounded-md text-sm font-medium hover:bg-white hover:bg-opacity-20 transition">Beranda</a>
                            <a href="{{ route('user.edukasi-kesehatan.index') }}"
                                class="px-3 py-2 rounded-md text-sm font-medium hover:bg-white hover:bg-opacity-20 transition">Edukasi</a>
                            <a href="{{ route('user.konsultasi.index') }}"
                                class="px-3 py-2 rounded-md text-sm font-medium hover:bg-white hover:bg-opacity-20 transition">Konsultasi</a>
                            <a href=""
                                class="px-3 py-2 rounded-md text-sm font-medium hover:bg-white hover:bg-opacity-20 transition">Peringatan</a>
                        </nav>
                    </div>

                    <!-- Right Side Of Navbar -->
                    <div class="hidden md:flex items-center space-x-4">
                        @auth
                            <!-- Tampilkan untuk user yang sudah login -->
                            <div class="relative group" x-data="{ open: false }" @mouseenter="open = true"
                                @mouseleave="open = false" @click.away="open = false">
                                <button class="flex items-center space-x-1 text-sm hover:text-gray-200 focus:outline-none"
                                    @click="open = !open">
                                    <span>{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                                    x-show="open" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95">
                                    <a href="{{ route('profile.edit') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-tzu-primary hover:text-white">Profil</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-tzu-primary hover:text-white">
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <!-- Tampilkan untuk guest -->
                            <a href="{{ route('login') }}"
                                class="px-3 py-1 rounded-md text-sm font-medium hover:bg-white hover:bg-opacity-20 transition">Masuk</a>
                            <a href="{{ route('register') }}"
                                class="px-3 py-1 rounded-md text-sm font-medium bg-tzu-secondary hover:bg-opacity-90 transition">Daftar</a>
                        @endauth
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden flex items-center">
                        <button type="button"
                            class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-white hover:bg-white hover:bg-opacity-20 focus:outline-none">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <a href="{{ route('user.dashboard') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium hover:bg-white hover:bg-opacity-20">Beranda</a>
                    <a href="{{ route('user.edukasi-kesehatan.index') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium hover:bg-white hover:bg-opacity-20">Edukasi</a>
                    <a href="{{ route('user.konsultasi.index') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium hover:bg-white hover:bg-opacity-20">Konsultasi</a>
                    <a href=""
                        class="block px-3 py-2 rounded-md text-base font-medium hover:bg-white hover:bg-opacity-20">Peringatan</a>

                    @auth
                        <a href="{{ route('profile.edit') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium hover:bg-white hover:bg-opacity-20">Profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-3 py-2 rounded-md text-base font-medium hover:bg-white hover:bg-opacity-20">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium hover:bg-white hover:bg-opacity-20">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium hover:bg-white hover:bg-opacity-20">Daftar</a>
                    @endauth
                </div>
            </div>
        </header>

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <h2 class="text-xl font-semibold text-tzu-primary">
                        {{ $header }}
                    </h2>
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-tzu-primary text-white py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Tentang Kami</h3>
                        <p class="text-sm">Sekolah Cinta Kasih Tzu Chi mengedepankan pendidikan karakter dan kesehatan
                            holistik.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                        <ul class="text-sm space-y-2">
                            <li>Email: info@tzu-chi.sch.id</li>
                            <li>Telepon: (021) 12345678</li>
                            <li>Alamat: Jl. Pantai Indah Kapuk, Jakarta Utara</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                        <ul class="text-sm space-y-2">
                            <li><a href="#" class="hover:underline">Kebijakan Privasi</a></li>
                            <li><a href="#" class="hover:underline">Syarat & Ketentuan</a></li>
                            <li><a href="#" class="hover:underline">Peta Situs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 pt-6 border-t border-white border-opacity-20 text-center text-sm">
                    <p>&copy; {{ date('Y') }} Sekolah Cinta Kasih Tzu Chi. Semua hak dilindungi.</p>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // Mobile menu toggle
        document.querySelector('[aria-controls="mobile-menu"]').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>

</html>
