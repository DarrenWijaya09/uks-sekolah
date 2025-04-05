@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-tzu-primary to-tzu-secondary rounded-2xl p-8 mb-10 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-[#009A44]">Edukasi Kesehatan</h1>
            <p class="text-xl md:text-2xl text-[#009A44]">Membangun Generasi Sehat dan Cerdas di Sekolah Cinta Kasih Tzu Chi</p>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
            <!-- Health Tips Column -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-tzu-primary p-6">
                    <h2 class="text-2xl font-bold text-white">Tips Hidup Sehat untuk Siswa</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tip 1 -->
                    <div class="flex items-start bg-gray-50 p-4 rounded-lg">
                        <div class="bg-tzu-secondary p-2 rounded-full mr-4">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-tzu-primary mb-1">Nutrisi Seimbang</h3>
                            <p class="text-gray-600">Konsumsi makanan bergizi dengan komposisi karbohidrat, protein, sayur, dan buah setiap hari.</p>
                        </div>
                    </div>

                    <!-- Tip 2 -->
                    <div class="flex items-start bg-gray-50 p-4 rounded-lg">
                        <div class="bg-tzu-secondary p-2 rounded-full mr-4">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-tzu-primary mb-1">Hidrasi Cukup</h3>
                            <p class="text-gray-600">Minum air putih minimal 8 gelas per hari untuk menjaga metabolisme tubuh.</p>
                        </div>
                    </div>

                    <!-- Tip 3 -->
                    <div class="flex items-start bg-gray-50 p-4 rounded-lg">
                        <div class="bg-tzu-secondary p-2 rounded-full mr-4">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-tzu-primary mb-1">Aktivitas Fisik</h3>
                            <p class="text-gray-600">Olahraga 30 menit sehari meningkatkan konsentrasi belajar dan kesehatan jantung.</p>
                        </div>
                    </div>

                    <!-- Tip 4 -->
                    <div class="flex items-start bg-gray-50 p-4 rounded-lg">
                        <div class="bg-tzu-secondary p-2 rounded-full mr-4">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-tzu-primary mb-1">Istirahat Berkualitas</h3>
                            <p class="text-gray-600">Tidur 7-8 jam membantu pertumbuhan dan pemulihan sel-sel tubuh.</p>
                        </div>
                    </div>

                    <!-- Tip 5 -->
                    <div class="flex items-start bg-gray-50 p-4 rounded-lg">
                        <div class="bg-tzu-secondary p-2 rounded-full mr-4">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-tzu-primary mb-1">Kebersihan Diri</h3>
                            <p class="text-gray-600">Cuci tangan dengan sabun mencegah penyebaran penyakit infeksi.</p>
                        </div>
                    </div>

                    <!-- Tip 6 -->
                    <div class="flex items-start bg-gray-50 p-4 rounded-lg">
                        <div class="bg-tzu-secondary p-2 rounded-full mr-4">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-tzu-primary mb-1">Makanan Sehat</h3>
                            <p class="text-gray-600">Kurangi gula dan makanan instan untuk mencegah obesitas dan diabetes.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links Column -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-tzu-secondary p-6">
                    <h2 class="text-2xl font-bold text-white">Layanan Cepat</h2>
                </div>
                <div class="p-6 space-y-4">
                    <!-- Emergency Contact -->
                    <div class="bg-red-50 p-4 rounded-lg border-l-4 border-red-500">
                        <h3 class="font-bold text-red-700 mb-2">Darurat Medis</h3>
                        <p class="text-sm text-gray-600">Hubungi UKS segera jika mengalami:</p>
                        <ul class="list-disc pl-5 text-sm text-gray-600 mt-2">
                            <li>Pendarahan berat</li>
                            <li>Sesak napas</li>
                            <li>Pingsan</li>
                        </ul>
                        <div class="mt-3 bg-white p-2 rounded text-center font-bold text-red-600">
                            Telepon UKS: (021) 1234567
                        </div>
                    </div>

                    <!-- Health Calendar -->
                    <div class="bg-blue-50 p-4 rounded-lg border-l-4 border-tzu-secondary">
                        <h3 class="font-bold text-tzu-secondary mb-2">Kalender Kesehatan</h3>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <div class="bg-tzu-primary text-white text-xs font-bold px-2 py-1 rounded mr-3">15 Apr</div>
                                <span class="text-sm">Pemeriksaan Kesehatan Rutin</span>
                            </div>
                            <div class="flex items-center">
                                <div class="bg-tzu-primary text-white text-xs font-bold px-2 py-1 rounded mr-3">22 Apr</div>
                                <span class="text-sm">Seminar Kesehatan Mental</span>
                            </div>
                            <div class="flex items-center">
                                <div class="bg-tzu-primary text-white text-xs font-bold px-2 py-1 rounded mr-3">30 Apr</div>
                                <span class="text-sm">Vaksinasi Tahunan</span>
                            </div>
                        </div>
                    </div>

                    <!-- Health Stats -->
                    <div class="bg-green-50 p-4 rounded-lg border-l-4 border-tzu-primary">
                        <h3 class="font-bold text-tzu-primary mb-3">Statistik Kesehatan</h3>
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div>
                                <div class="text-3xl font-bold text-tzu-primary">87%</div>
                                <div class="text-xs text-gray-500">Siswa Sehat</div>
                            </div>
                            <div>
                                <div class="text-3xl font-bold text-tzu-secondary">92%</div>
                                <div class="text-xs text-gray-500">Vaksinasi Lengkap</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Articles Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <!-- First Aid Article -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                         alt="Pertolongan Pertama" class="w-full h-48 object-cover">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                        <h2 class="text-2xl font-bold text-white">Pentingnya Pertolongan Pertama</h2>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 mb-4">
                        Pertolongan pertama pada kecelakaan (P3K) adalah tindakan awal yang diberikan kepada korban sebelum bantuan medis profesional tiba. Setiap siswa Tzu Chi harus memahami dasar-dasar P3K untuk situasi darurat seperti:
                    </p>
                    <ul class="list-disc pl-5 text-gray-700 mb-4 space-y-1">
                        <li>Menangani luka ringan dan pendarahan</li>
                        <li>Mengatasi mimisan</li>
                        <li>Penanganan tersedak</li>
                        <li>Pertolongan pada pingsan</li>
                    </ul>
                    <div class="bg-blue-50 p-3 rounded-lg border border-blue-100">
                        <p class="text-sm text-blue-800">UKS Tzu Chi menyelenggarakan pelatihan P3K dasar setiap bulan untuk siswa. Hubungi petugas UKS untuk informasi jadwal.</p>
                    </div>
                </div>
            </div>

            <!-- Mental Health Article -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1494412651409-8963ce7935a7?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                         alt="Kesehatan Mental" class="w-full h-48 object-cover">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                        <h2 class="text-2xl font-bold text-white">Kesehatan Mental Siswa</h2>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 mb-4">
                        Kesehatan mental sama pentingnya dengan kesehatan fisik, terutama di masa pertumbuhan. Beberapa tanda yang perlu diperhatikan:
                    </p>
                    <ul class="list-disc pl-5 text-gray-700 mb-4 space-y-1">
                        <li>Perubahan pola tidur atau makan</li>
                        <li>Kesulitan berkonsentrasi</li>
                        <li>Mudah marah atau sedih tanpa alasan jelas</li>
                        <li>Kehilangan minat pada aktivitas yang biasa disukai</li>
                    </ul>
                    <div class="bg-purple-50 p-3 rounded-lg border border-purple-100">
                        <p class="text-sm text-purple-800">Layanan konseling tersedia di UKS setiap hari kerja. Siswa dapat membuat janji melalui wali kelas atau langsung ke petugas UKS.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Video & Resources Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Video -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-tzu-primary p-6">
                    <h2 class="text-2xl font-bold text-white">Video Edukasi Kesehatan</h2>
                </div>
                <div class="p-6">
                    <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden bg-black">
                        <iframe class="w-full h-96" src="https://www.youtube.com/embed/RIPaBj4Jhvo"
                        title="Video Edukasi Kesehatan" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-xl font-semibold text-tzu-primary mb-2">Cara Menangani Luka Ringan</h3>
                        <p class="text-gray-700">Video tutorial ini menjelaskan langkah-langkah dasar dalam menangani berbagai jenis luka ringan yang sering terjadi di lingkungan sekolah, termasuk pembersihan luka, pemberian antiseptik, dan perban yang benar.</p>
                    </div>
                </div>
            </div>

            <!-- Additional Resources -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-tzu-secondary p-6">
                    <h2 class="text-2xl font-bold text-white">Sumber Belajar</h2>
                </div>
                <div class="p-6 space-y-4">
                    <!-- Resource 1 -->
                    <a href="#" class="flex items-start group">
                        <div class="bg-tzu-primary text-white p-2 rounded mr-4 group-hover:bg-tzu-secondary transition">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 group-hover:text-tzu-primary transition">Panduan Gizi Seimbang</h3>
                            <p class="text-sm text-gray-500">PDF • 2.4 MB</p>
                        </div>
                    </a>

                    <!-- Resource 2 -->
                    <a href="#" class="flex items-start group">
                        <div class="bg-tzu-primary text-white p-2 rounded mr-4 group-hover:bg-tzu-secondary transition">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 group-hover:text-tzu-primary transition">Postur Tubuh yang Benar</h3>
                            <p class="text-sm text-gray-500">PDF • 1.8 MB</p>
                        </div>
                    </a>

                    <!-- Resource 3 -->
                    <a href="#" class="flex items-start group">
                        <div class="bg-tzu-primary text-white p-2 rounded mr-4 group-hover:bg-tzu-secondary transition">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 group-hover:text-tzu-primary transition">Panduan P3K Dasar</h3>
                            <p class="text-sm text-gray-500">PDF • 3.1 MB</p>
                        </div>
                    </a>

                    <!-- Resource 4 -->
                    <a href="#" class="flex items-start group">
                        <div class="bg-tzu-primary text-white p-2 rounded mr-4 group-hover:bg-tzu-secondary transition">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 group-hover:text-tzu-primary transition">Manajemen Stres</h3>
                            <p class="text-sm text-gray-500">PDF • 2.7 MB</p>
                        </div>
                    </a>

                    <!-- Newsletter -->
                    <div class="mt-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="font-semibold text-tzu-primary mb-2">Dapatkan Update Terbaru</h3>
                        <p class="text-sm text-gray-600 mb-3">Berlangganan newsletter kesehatan bulanan kami</p>
                        <div class="flex">
                            <input type="email" placeholder="Alamat email" class="flex-grow px-3 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-tzu-primary focus:border-transparent">
                            <button class="bg-tzu-primary hover:bg-tzu-secondary text-white px-4 py-2 rounded-r-lg transition">
                                Daftar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection