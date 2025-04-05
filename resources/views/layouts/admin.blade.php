<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'UKS Manager') }} | Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@hotwired/turbo@7.0.0/dist/turbo.es2017-umd.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/web-component@6.1.15/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.15/index.global.min.js'></script>
    <style>
        .turbo-progress-bar {
            background: linear-gradient(to right, #009A44, #00A3AF);
        }

        /* Tambahkan animasi untuk transisi halaman */
        .page-transition-enter {
            opacity: 0;
            transform: translateY(10px);
        }

        .page-transition-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 300ms, transform 300ms;
        }

        .page-transition-exit {
            opacity: 1;
        }

        .page-transition-exit-active {
            opacity: 0;
            transition: opacity 300ms;
        }

        /* Prevent FOUC (Flash of Unstyled Content) */
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Tambahkan script ini -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let isNavigating = false;

            document.addEventListener('turbo:click', function() {
                isNavigating = true;
            });

            document.addEventListener('turbo:load', function() {
                if (isNavigating) {
                    window.Alpine && window.Alpine.start();
                    isNavigating = false;
                }
            });

            document.addEventListener('turbo:before-render', function(event) {
                const currentState = localStorage.getItem('sidebarOpen');
                if (currentState) {
                    const newElement = event.detail.newBody;
                    const sidebarContainer = newElement.querySelector('[x-data]');
                    if (sidebarContainer) {
                        sidebarContainer.setAttribute('x-init', `
                            $nextTick(() => {
                                sidebarOpen = ${currentState === 'true'};
                            });
                        `);
                    }
                }
            });
        });
    </script>
</head>

<body class="bg-[#F5F5F5] font-sans antialiased">
    <!-- Main Container -->
    <div class="min-h-screen flex" x-data="{
        sidebarOpen: localStorage.getItem('sidebarOpen') === 'true',
        isNavigating: false,
        init() {
            if (localStorage.getItem('sidebarOpen') === null) {
                this.sidebarOpen = true;
                localStorage.setItem('sidebarOpen', 'true');
            }

            // Tambahkan listener untuk animasi halaman
            document.addEventListener('turbo:visit', () => {
                this.isNavigating = true;
            });

            document.addEventListener('turbo:load', () => {
                this.isNavigating = false;
            });
        },
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
            localStorage.setItem('sidebarOpen', this.sidebarOpen);
        }
    }" x-init="init()" x-cloak>
        <!-- Sidebar -->
        <aside class="fixed h-full transform transition-all duration-300 ease-in-out z-50 cursor-pointer"
            :class="{ 'w-72': sidebarOpen, 'w-20 hover:bg-[#009A44]/10': !sidebarOpen }"
            @click="if (!sidebarOpen) toggleSidebar()">
            <div class="h-full bg-gradient-to-b from-[#009A44] to-[#00A3AF] text-[#FFFFFF] shadow-xl">
                <!-- Toggle button for desktop -->
                <button @click.stop="toggleSidebar()"
                    class="hidden lg:flex absolute -right-3 top-10 bg-white p-1.5 rounded-full shadow-md border border-gray-200">
                    <svg class="w-4 h-4 text-gray-600 transition-transform duration-300"
                        :class="{ 'rotate-180': !sidebarOpen }" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <div class="p-6" :class="{ 'px-4': !sidebarOpen }">
                    <h2 class="text-2xl font-bold tracking-tight transition-opacity duration-300"
                        :class="{ 'opacity-0 invisible': !sidebarOpen, 'opacity-100 visible': sidebarOpen }">
                        UKS Manager
                    </h2>
                    <h2 class="text-2xl font-bold tracking-tight absolute top-6 transition-opacity duration-300"
                        :class="{ 'opacity-100 visible': !sidebarOpen, 'opacity-0 invisible': sidebarOpen }">
                        UKS
                    </h2>
                    <p class="text-white/80 text-sm mt-1 font-medium transition-opacity duration-300"
                        :class="{ 'opacity-0 invisible': !sidebarOpen, 'opacity-100 visible': sidebarOpen }">
                        Admin Dashboard
                    </p>
                </div>

                <nav class="mt-8">
                    <div class="px-4 space-y-2">
                        <!-- Navigation Items -->
                        <a href="{{ route('admin.dashboard') }}" data-turbo="true" @click.stop
                            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group overflow-hidden
                                  {{ request()->routeIs('admin.dashboard') ? 'bg-[#FFFFFF]/10 text-[#FFFFFF] shadow-sm' : 'hover:bg-[#FFFFFF]/5 text-[#FFFFFF]' }}">
                            <svg class="w-5 h-5 text-white transition-transform duration-300 flex-shrink-0"
                                :class="{ 'group-hover:scale-110': !sidebarOpen }" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7m-9 13V10m4 0v10m1-9h3m-3 4h3m-3 4h3M4 12h3m-3 4h3m-3 4h3" />
                            </svg>
                            <span class="font-medium ml-3 whitespace-nowrap transition-all duration-300 overflow-hidden"
                                :class="{ 'w-0 opacity-0': !sidebarOpen, 'w-auto opacity-100': sidebarOpen }">
                                Dashboard
                            </span>
                        </a>

                        <a href="{{ route('admin.siswa.index') }}" data-turbo="true" @click.stop
                            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group overflow-hidden
                                  {{ request()->routeIs('siswa.*') ? 'bg-[#FFFFFF]/10 text-[#FFFFFF] shadow-sm' : 'hover:bg-[#FFFFFF]/5 text-[#FFFFFF]' }}">
                            <svg class="w-5 h-5 text-white transition-transform duration-300 flex-shrink-0"
                                :class="{ 'group-hover:scale-110': !sidebarOpen }" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a4 4 0 00-4-4h-1m-6 6H3v-2a4 4 0 014-4h1m4-8a4 4 0 110-8 4 4 0 010 8zm6 0a4 4 0 110-8 4 4 0 010 8z" />
                            </svg>
                            <span class="font-medium ml-3 whitespace-nowrap transition-all duration-300 overflow-hidden"
                                :class="{ 'w-0 opacity-0': !sidebarOpen, 'w-auto opacity-100': sidebarOpen }">
                                Data Siswa
                            </span>
                        </a>

                        <a href="{{ route('admin.obat.index') }}" data-turbo="true" @click.stop
                            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group overflow-hidden
                                  {{ request()->routeIs('obat.*') ? 'bg-[#FFFFFF]/10 text-[#FFFFFF] shadow-sm' : 'hover:bg-[#FFFFFF]/5 text-[#FFFFFF]' }}">
                            <svg class="w-5 h-5 text-white transition-transform duration-300 flex-shrink-0"
                                :class="{ 'group-hover:scale-110': !sidebarOpen }" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 7h6m-3 0v10m-7-5h14a2 2 0 012 2v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4a2 2 0 012-2z" />
                            </svg>
                            <span class="font-medium ml-3 whitespace-nowrap transition-all duration-300 overflow-hidden"
                                :class="{ 'w-0 opacity-0': !sidebarOpen, 'w-auto opacity-100': sidebarOpen }">
                                Manajemen Obat
                            </span>
                        </a>

                        <a href="{{ route('admin.laporan-kesehatan.index') }}" data-turbo="true" @click.stop
                            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group overflow-hidden
                                  {{ request()->routeIs('laporan.*') ? 'bg-[#FFFFFF]/10 text-[#FFFFFF] shadow-sm' : 'hover:bg-[#FFFFFF]/5 text-[#FFFFFF]' }}">
                            <svg class="w-5 h-5 text-white transition-transform duration-300 flex-shrink-0"
                                :class="{ 'group-hover:scale-110': !sidebarOpen }" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3v18h18M5 13h4v6H5v-6zm6-8h4v14h-4V5zm6 6h4v8h-4v-8z" />
                            </svg>
                            <span class="font-medium ml-3 whitespace-nowrap transition-all duration-300 overflow-hidden"
                                :class="{ 'w-0 opacity-0': !sidebarOpen, 'w-auto opacity-100': sidebarOpen }">
                                Laporan & Rekapitulasi
                            </span>
                        </a>

                        <a href="{{ route('admin.jadwal-uks.index') }}" data-turbo="true" @click.stop
                            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group overflow-hidden
                              {{ request()->routeIs('jadwal-uks.*') ? 'bg-[#FFFFFF]/10 text-[#FFFFFF] shadow-sm' : 'hover:bg-[#FFFFFF]/5 text-[#FFFFFF]' }}">
                            <svg class="w-5 h-5 text-white transition-transform duration-300 flex-shrink-0"
                                :class="{ 'group-hover:scale-110': !sidebarOpen }" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3M3 10h18M5 10v10h14V10M8 14h4" />
                            </svg>
                            <span class="font-medium ml-3 whitespace-nowrap transition-all duration-300 overflow-hidden"
                                :class="{ 'w-0 opacity-0': !sidebarOpen, 'w-auto opacity-100': sidebarOpen }">
                                Jadwal UKS
                            </span>
                        </a>

                        <a href="{{ route('admin.petugas-uks.index') }}" data-turbo="true" @click.stop
                            class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group overflow-hidden
                                {{ request()->routeIs('petugas-uks.*') ? 'bg-[#FFFFFF]/10 text-[#FFFFFF] shadow-sm' : 'hover:bg-[#FFFFFF]/5 text-[#FFFFFF]' }}">
                            <svg class="w-5 h-5 text-white transition-transform duration-300 flex-shrink-0"
                                :class="{ 'group-hover:scale-110': !sidebarOpen }" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 11c0-2.485 1.514-4.5 4-4.5s4 2.015 4 4.5V15M8 15v-4a4 4 0 118 0v4M5 15h14m-9 5v-3m4 3v-3" />
                            </svg>
                            <span class="font-medium ml-3 whitespace-nowrap transition-all duration-300 overflow-hidden"
                                :class="{ 'w-0 opacity-0': !sidebarOpen, 'w-auto opacity-100': sidebarOpen }">
                                Petugas UKS
                            </span>
                        </a>
                    </div>
                </nav>
            </div>
        </aside>

        <!-- Overlay for mobile -->
        <div @click="toggleSidebar()" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden" x-show="sidebarOpen"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        </div>

        <!-- Main Content -->
        <div class="flex-1 transition-all duration-300"
            :class="{
                'lg:ml-72': sidebarOpen,
                'lg:ml-20': !sidebarOpen,
                'opacity-50': isNavigating
            }"
            @click="if (window.innerWidth >= 1024 && sidebarOpen) toggleSidebar()">
            <!-- Header -->
            <header class="bg-[#FFFFFF] shadow-sm sticky top-0 z-40 border-b border-[#F5F5F5]" @click.stop>
                <div class="flex items-center justify-between px-8 py-4">
                    <div class="flex items-center">
                        <button @click="toggleSidebar()" class="lg:hidden text-[#4A4A4A] hover:text-[#009A44] mr-4">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </button>
                        <div>
                            <h2 class="font-bold text-xl text-[#4A4A4A]">Unit Kesehatan Sekolah Cinta Kasih Tzu Chi
                            </h2>
                            <h1 class="text-xl font-semibold text-[#009A44]">@yield('title')</h1>
                        </div>
                    </div>

                    <!-- User Menu -->
                    <div class="flex items-center" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center space-x-3 hover:bg-[#F5F5F5] rounded-full pr-4 py-1.5 transition-colors duration-200">
                            <div
                                class="w-9 h-9 rounded-full bg-gradient-to-br from-[#009A44] to-[#00A3AF] text-[#FFFFFF] flex items-center justify-center text-sm font-medium">
                                {{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 1)) : '?' }}
                            </div>
                            <span
                                class="hidden md:inline font-medium text-[#4A4A4A]">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</span>
                            <svg class="w-4 h-4 text-[#4A4A4A]" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            class="absolute right-6 top-16 mt-2 w-56 bg-[#FFFFFF] rounded-xl shadow-lg py-2 border border-[#F5F5F5]">
                            <a href="#"
                                class="flex items-center px-4 py-2.5 text-sm text-[#4A4A4A] hover:bg-[#F5F5F5]">
                                <svg class="w-4 h-4 mr-3 text-[#4A4A4A]" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A9 9 0 0112 15a9 9 0 016.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center w-full px-4 py-2.5 text-sm text-[#4A4A4A] hover:bg-[#F5F5F5]">
                                    <svg class="w-4 h-4 mr-3 text-[#4A4A4A]" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h6a2 2 0 012 2v1" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="p-8 bg-[#F5F5F5] min-h-[calc(100vh-4rem)]">
                @if (session('success'))
                    <div class="mb-6 p-4 bg-[#009A44]/10 border border-[#009A44]/20 text-[#009A44] rounded-xl flex items-center"
                        @click.stop>
                        <svg class="w-5 h-5 mr-3 text-[#009A44]" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m2 9a9 9 0 110-18 9 9 0 010 18z" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-[#FFFFFF] border-t border-[#F5F5F5] py-6 px-8">
                <p class="text-sm text-[#4A4A4A] text-center">
                    &copy; {{ date('Y') }} UKS Manager. All rights reserved.
                </p>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        document.addEventListener('turbo:load', () => {
            window.Alpine && window.Alpine.start();
        });
    </script>
</body>

</html>
