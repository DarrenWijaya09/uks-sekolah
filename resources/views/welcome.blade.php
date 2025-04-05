<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>UKS - Sekolah Cinta Kasih Tzu Chi</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        .hero-overlay {
            background: linear-gradient(45deg, rgba(0, 154, 68, 0.9) 0%, rgba(0, 163, 175, 0.85) 100%);
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
        }

        .nav-link {
            @apply text-white hover:text-white/90 transition-colors duration-300;
        }

        /* Animasi untuk mobile menu */
        #mobile-menu {
            transition: all 0.3s ease-in-out;
        }

        #mobile-menu.show {
            display: block;
            animation: slideDown 0.3s ease-in-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-[#F5F5F5]">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-[#009A44] to-[#00A3AF] text-white shadow-lg fixed w-full z-50">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center h-20">
                <!-- Logo dan Nama -->
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('assets/image/tzu-chi.png') }}" alt="Logo" class="h-14 w-auto">
                    <div class="flex flex-col">
                        <span class="text-xl font-bold">UKS Tzu Chi</span>
                        <span class="text-sm text-white/80">Sekolah Cinta Kasih</span>
                    </div>
                </div>

                <!-- Menu Desktop -->
                <div class="hidden lg:flex items-center space-x-8">
                    <div class="flex space-x-6">
                        <a href="#beranda" class="nav-link group">
                            <span class="relative inline-block py-2">
                                Beranda
                                <span
                                    class="absolute bottom-0 left-0 w-full h-0.5 bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                            </span>
                        </a>
                        <a href="#layanan" class="nav-link group">
                            <span class="relative inline-block py-2">
                                Layanan
                                <span
                                    class="absolute bottom-0 left-0 w-full h-0.5 bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                            </span>
                        </a>
                        <a href="#program" class="nav-link group">
                            <span class="relative inline-block py-2">
                                Program
                                <span
                                    class="absolute bottom-0 left-0 w-full h-0.5 bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                            </span>
                        </a>
                        <a href="#artikel" class="nav-link group">
                            <span class="relative inline-block py-2">
                                Artikel
                                <span
                                    class="absolute bottom-0 left-0 w-full h-0.5 bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                            </span>
                        </a>
                        <a href="#kontak" class="nav-link group">
                            <span class="relative inline-block py-2">
                                Kontak
                                <span
                                    class="absolute bottom-0 left-0 w-full h-0.5 bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                            </span>
                        </a>
                    </div>

                    <!-- Auth Buttons -->
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="bg-white text-[#009A44] px-5 py-2.5 rounded-lg font-medium hover:bg-[#F5F5F5] hover:shadow-lg transition-all duration-300 flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                        </path>
                                    </svg>
                                    <span>Dashboard</span>
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="bg-white text-[#009A44] px-5 py-2.5 rounded-lg font-medium hover:bg-[#F5F5F5] hover:shadow-lg transition-all duration-300 flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    <span>Login</span>
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden">
                    <button id="mobile-menu-button" class="text-white p-2 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="lg:hidden hidden pb-6">
                <div class="flex flex-col space-y-4">
                    <a href="#beranda" class="text-white hover:text-gray-200 py-2">Beranda</a>
                    <a href="#layanan" class="text-white hover:text-gray-200 py-2">Layanan</a>
                    <a href="#program" class="text-white hover:text-gray-200 py-2">Program</a>
                    <a href="#artikel" class="text-white hover:text-gray-200 py-2">Artikel</a>
                    <a href="#kontak" class="text-white hover:text-gray-200 py-2">Kontak</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="bg-white text-[#009A44] px-4 py-2 rounded-lg text-center">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="bg-white text-[#009A44] px-4 py-2 rounded-lg text-center">
                                Login
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Swiper -->
    <div class="swiper-container relative h-screen" id="beranda">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide relative">
                <div class="hero-overlay absolute inset-0"></div>
                <img src="{{ asset('assets/image/hero1.jpg') }}" alt="Hero 1" class="w-full h-full object-cover">
                <div class="absolute inset-0 flex items-center justify-center text-center px-4">
                    <div data-aos="fade-up">
                        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">Selamat Datang di UKS<br>Sekolah
                            Cinta Kasih Tzu Chi</h1>
                        <p class="text-xl text-white mb-8">Melayani dengan Cinta Kasih untuk Kesehatan Siswa</p>
                        <a href="#layanan"
                            class="bg-[#00A3AF] text-white px-8 py-3 rounded-full hover:bg-white hover:text-[#009A44] transition-colors inline-block">
                            Jelajahi Layanan Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <!-- Statistik Section -->
    <div class="bg-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div data-aos="fade-up" class="card-hover">
                    <div class="text-4xl font-bold text-[#009A44] mb-2">1000+</div>
                    <p class="text-[#4A4A4A]">Siswa Terlayani</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="100" class="card-hover">
                    <div class="text-4xl font-bold text-[#009A44] mb-2">20</div>
                    <p class="text-[#4A4A4A]">Tenaga Medis</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="200" class="card-hover">
                    <div class="text-4xl font-bold text-[#009A44] mb-2">24/7</div>
                    <p class="text-[#4A4A4A]">Pelayanan Darurat</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="300" class="card-hover">
                    <div class="text-4xl font-bold text-[#009A44] mb-2">100%</div>
                    <p class="text-[#4A4A4A]">Kepuasan Pelayanan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Layanan Section -->
    <section id="layanan" class="py-16 bg-[#F5F5F5]">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-[#009A44] mb-12" data-aos="fade-up">Layanan UKS</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Pertolongan Pertama -->
                <div class="bg-white p-8 rounded-xl shadow-md card-hover" data-aos="fade-up">
                    <div class="text-4xl mb-4">🏥</div>
                    <h3 class="text-xl font-semibold text-[#009A44] mb-3">Pertolongan Pertama</h3>
                    <p class="text-[#4A4A4A]">Penanganan cepat untuk kecelakaan dan kondisi darurat di sekolah dengan
                        standar prosedur medis yang tepat.</p>
                    <ul class="mt-4 space-y-2 text-[#4A4A4A]">
                        <li>• Penanganan cedera ringan</li>
                        <li>• Pertolongan pertama pada kecelakaan</li>
                        <li>• Penanganan kondisi darurat</li>
                    </ul>
                </div>

                <!-- Pemeriksaan Kesehatan -->
                <div class="bg-white p-8 rounded-xl shadow-md card-hover" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-4xl mb-4">👨‍⚕️</div>
                    <h3 class="text-xl font-semibold text-[#009A44] mb-3">Pemeriksaan Kesehatan</h3>
                    <p class="text-[#4A4A4A]">Pemeriksaan kesehatan rutin dan berkala untuk memantau kondisi kesehatan
                        siswa.</p>
                    <ul class="mt-4 space-y-2 text-[#4A4A4A]">
                        <li>• Pemeriksaan fisik rutin</li>
                        <li>• Skrining kesehatan</li>
                        <li>• Pemantauan tumbuh kembang</li>
                    </ul>
                </div>

                <!-- Konsultasi Kesehatan -->
                <div class="bg-white p-8 rounded-xl shadow-md card-hover" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-4xl mb-4">💬</div>
                    <h3 class="text-xl font-semibold text-[#009A44] mb-3">Konsultasi Kesehatan</h3>
                    <p class="text-[#4A4A4A]">Layanan konsultasi kesehatan dengan tenaga medis profesional untuk siswa
                        dan staff.</p>
                    <ul class="mt-4 space-y-2 text-[#4A4A4A]">
                        <li>• Konsultasi gizi</li>
                        <li>• Konseling kesehatan mental</li>
                        <li>• Edukasi kesehatan</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Section -->
    <section id="program" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-[#009A44] mb-12" data-aos="fade-up">Program Unggulan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Program Kesehatan Rutin -->
                <div class="bg-[#F5F5F5] p-8 rounded-xl card-hover" data-aos="fade-right">
                    <h3 class="text-2xl font-semibold text-[#009A44] mb-4">Program Kesehatan Rutin</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <span class="text-[#00A3AF] mr-3">✓</span>
                            <div>
                                <h4 class="font-semibold mb-1">Pemeriksaan Berkala</h4>
                                <p class="text-[#4A4A4A]">Pemeriksaan kesehatan rutin setiap semester untuk memantau
                                    kesehatan siswa</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <span class="text-[#00A3AF] mr-3">✓</span>
                            <div>
                                <h4 class="font-semibold mb-1">Program Imunisasi</h4>
                                <p class="text-[#4A4A4A]">Pelaksanaan program imunisasi sesuai dengan jadwal yang
                                    ditentukan</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <span class="text-[#00A3AF] mr-3">✓</span>
                            <div>
                                <h4 class="font-semibold mb-1">Skrining Kesehatan</h4>
                                <p class="text-[#4A4A4A]">Pemeriksaan kesehatan menyeluruh untuk deteksi dini masalah
                                    kesehatan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Program Edukasi -->
                <div class="bg-[#F5F5F5] p-8 rounded-xl card-hover" data-aos="fade-left">
                    <h3 class="text-2xl font-semibold text-[#009A44] mb-4">Program Edukasi Kesehatan</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <span class="text-[#00A3AF] mr-3">✓</span>
                            <div>
                                <h4 class="font-semibold mb-1">Penyuluhan Kesehatan</h4>
                                <p class="text-[#4A4A4A]">Program edukasi rutin tentang kesehatan dan gaya hidup sehat
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <span class="text-[#00A3AF] mr-3">✓</span>
                            <div>
                                <h4 class="font-semibold mb-1">Pelatihan P3K</h4>
                                <p class="text-[#4A4A4A]">Pelatihan pertolongan pertama untuk siswa dan staff sekolah
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <span class="text-[#00A3AF] mr-3">✓</span>
                            <div>
                                <h4 class="font-semibold mb-1">Kampanye Kesehatan</h4>
                                <p class="text-[#4A4A4A]">Program kampanye kesehatan berkala untuk meningkatkan
                                    kesadaran</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Artikel Section -->
    <section id="artikel" class="py-16 bg-[#F5F5F5]">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-[#009A44] mb-12" data-aos="fade-up">Artikel Kesehatan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Artikel 1 -->
                <div class="bg-white rounded-xl overflow-hidden card-hover" data-aos="fade-up">
                    <img src="{{ asset('assets/image/sarapan-sehat.jpeg') }}" alt="Artikel 1"
                        class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-[#009A44] mb-3">Pentingnya Sarapan Sehat</h3>
                        <p class="text-[#4A4A4A] mb-4">Tips memilih menu sarapan sehat dan bergizi untuk mendukung
                            aktivitas belajar.</p>
                        <a href="#" class="text-[#00A3AF] hover:text-[#009A44] transition-colors">Baca
                            selengkapnya →</a>
                    </div>
                </div>

                <!-- Artikel 2 -->
                <div class="bg-white rounded-xl overflow-hidden card-hover" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('assets/image/kebersihan.webp') }}" alt="Artikel 2"
                        class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-[#009A44] mb-3">Menjaga Kebersihan Diri</h3>
                        <p class="text-[#4A4A4A] mb-4">Panduan lengkap menjaga kebersihan diri untuk mencegah penyakit
                            di lingkungan sekolah.</p>
                        <a href="#" class="text-[#00A3AF] hover:text-[#009A44] transition-colors">Baca
                            selengkapnya →</a>
                    </div>
                </div>

                <!-- Artikel 3 -->
                <div class="bg-white rounded-xl overflow-hidden card-hover" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{ asset('assets/image/olahraga.jpeg') }}" alt="Artikel 3"
                        class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-[#009A44] mb-3">Olahraga dan Kesehatan Mental</h3>
                        <p class="text-[#4A4A4A] mb-4">Manfaat olahraga rutin untuk kesehatan fisik dan mental siswa.
                        </p>
                        <a href="#" class="text-[#00A3AF] hover:text-[#009A44] transition-colors">Baca
                            selengkapnya →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-[#009A44] mb-12" data-aos="fade-up">Hubungi Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Form Kontak -->
                <div class="bg-[#F5F5F5] p-8 rounded-xl" data-aos="fade-right">
                    <form class="space-y-6">
                        <div>
                            <label class="block text-[#4A4A4A] mb-2">Nama Lengkap</label>
                            <input type="text"
                                class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-[#009A44]">
                        </div>
                        <div>
                            <label class="block text-[#4A4A4A] mb-2">Email</label>
                            <input type="email"
                                class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-[#009A44]">
                        </div>
                        <div>
                            <label class="block text-[#4A4A4A] mb-2">Pesan</label>
                            <textarea rows="4"
                                class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-[#009A44]"></textarea>
                        </div>
                        <button
                            class="bg-[#009A44] text-white px-6 py-3 rounded-lg hover:bg-[#00A3AF] transition-colors">
                            Kirim Pesan
                        </button>
                    </form>
                </div>

                <!-- Informasi Kontak -->
                <div class="bg-[#F5F5F5] p-8 rounded-xl" data-aos="fade-left">
                    <h3 class="text-2xl font-semibold text-[#009A44] mb-6">Informasi Kontak</h3>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="text-[#00A3AF] mr-4">📍</div>
                            <div>
                                <h4 class="font-semibold mb-1">Alamat</h4>
                                <p class="text-[#4A4A4A]">Jl. Kamal Raya Outer Ring Road No.20, Cengkareng, Jakarta
                                    Barat</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="text-[#00A3AF] mr-4">📞</div>
                            <div>
                                <h4 class="font-semibold mb-1">Telepon</h4>
                                <p class="text-[#4A4A4A]">(021) XXX-XXXX</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="text-[#00A3AF] mr-4">📧</div>
                            <div>
                                <h4 class="font-semibold mb-1">Email</h4>
                                <p class="text-[#4A4A4A]">uks@tzuchi.sch.id</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="text-[#00A3AF] mr-4">⏰</div>
                            <div>
                                <h4 class="font-semibold mb-1">Jam Operasional</h4>
                                <p class="text-[#4A4A4A]">Senin - Jumat: 07:00 - 15:00</p>
                                <p class="text-[#4A4A4A]">Sabtu: 07:00 - 12:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#009A44] text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <img src="{{ asset('assets/image/tzu-chi.png') }}" alt="Logo" class="h-16 w-auto mb-4">
                    <p class="text-white/90">Melayani dengan cinta kasih untuk kesehatan optimal siswa Sekolah Cinta
                        Kasih Tzu Chi.</p>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-white/90 hover:text-white">Pertolongan Pertama</a></li>
                        <li><a href="#" class="text-white/90 hover:text-white">Pemeriksaan Kesehatan</a></li>
                        <li><a href="#" class="text-white/90 hover:text-white">Konsultasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-4">Program</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-white/90 hover:text-white">Kesehatan Rutin</a></li>
                        <li><a href="#" class="text-white/90 hover:text-white">Edukasi Kesehatan</a></li>
                        <li><a href="#" class="text-white/90 hover:text-white">Pelatihan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-4">Sosial Media</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white hover:text-[#00A3AF]">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-[#00A3AF]">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-[#00A3AF]">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/20 pt-8 text-center">
                <p class="text-white/90">&copy; {{ date('Y') }} UKS Sekolah Cinta Kasih Tzu Chi. All rights
                    reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Fungsi utama yang akan dijalankan setelah DOM siap
        function initializeAll() {
            // Initialize AOS dengan error handling
            try {
                AOS.init({
                    duration: 800,
                    once: true,
                    easing: 'ease-in-out'
                });
            } catch (e) {
                console.error('AOS initialization error:', e);
            }

            // Initialize Swiper dengan retry mechanism
            function initSwiper(retry = 0) {
                if (typeof Swiper !== 'undefined') {
                    try {
                        new Swiper('.swiper-container', {
                            loop: true,
                            pagination: {
                                el: '.swiper-pagination',
                                clickable: true
                            },
                            autoplay: {
                                delay: 5000,
                                disableOnInteraction: false
                            }
                        });
                        console.log('Swiper initialized successfully');
                    } catch (e) {
                        console.error('Swiper init error:', e);
                        if (retry < 3) setTimeout(() => initSwiper(retry + 1), 500);
                    }
                } else if (retry < 3) {
                    setTimeout(() => initSwiper(retry + 1), 500);
                } else {
                    console.warn('Swiper failed to load after retries');
                }
            }
            initSwiper();

            // Smooth scroll dengan offset untuk fixed header
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        window.scrollTo({
                            top: target.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Mobile menu toggle dengan improved handling
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', (e) => {
                    e.stopPropagation();
                    mobileMenu.classList.toggle('hidden');
                    mobileMenu.classList.toggle('show');
                });

                // Close mobile menu when clicking outside
                document.addEventListener('click', (e) => {
                    if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                        mobileMenu.classList.add('hidden');
                        mobileMenu.classList.remove('show');
                    }
                });
            }
        }

        // Jalankan fungsi utama ketika DOM siap
        document.addEventListener('DOMContentLoaded', initializeAll);

        // Fallback jika DOMContentLoaded tidak terpicu
        setTimeout(initializeAll, 1000);
    </script>

    @if (session('force_refresh'))
        <script>
            // Enhanced force refresh mechanism
            (function() {
                // Clear browser cache
                if ('caches' in window) {
                    caches.keys().then(function(names) {
                        for (let name of names) caches.delete(name);
                    });
                }

                // Force reload dengan parameter cache busting
                const reloadWithCacheBust = () => {
                    const url = new URL(window.location.href);
                    url.searchParams.set('_', Date.now());
                    window.location.href = url.toString();
                };

                // Cek jika Swiper sudah terload
                const checkSwiperLoaded = (attempt = 0) => {
                    if (typeof Swiper !== 'undefined') return;

                    if (attempt < 3) {
                        setTimeout(() => checkSwiperLoaded(attempt + 1), 500);
                    } else {
                        reloadWithCacheBust();
                    }
                };

                // Eksekusi pengecekan
                checkSwiperLoaded();

                // Fallback timeout
                setTimeout(() => {
                    if (typeof Swiper === 'undefined') {
                        reloadWithCacheBust();
                    }
                }, 1500);
            })();
        </script>
    @endIf
</body>

</html>
