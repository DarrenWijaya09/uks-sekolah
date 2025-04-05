@extends('layouts.app')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-tzu-primary mb-6">Dashboard Kesehatan Siswa</h1>

            <!-- Cards Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Kunjungan UKS Card -->
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-tzu-primary">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Total Kunjungan</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $totalKunjungan }}</h3>
                        </div>
                        <div class="p-3 rounded-full bg-tzu-secondary bg-opacity-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-tzu-secondary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                    </div>
                    <a href=""
                        class="mt-4 inline-flex items-center text-sm font-medium text-tzu-primary hover:underline">
                        Lihat riwayat
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Status Kesehatan Card -->
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-tzu-secondary">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Status Kesehatan</p>
                            <h3 class="text-2xl font-bold text-gray-800"> {{ $statusKesehatan ?? 'Belum Ada Data' }}</h3>
                        </div>
                        <div class="p-3 rounded-full bg-tzu-primary bg-opacity-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-tzu-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <a href="#"
                        class="mt-4 inline-flex items-center text-sm font-medium text-tzu-secondary hover:underline">
                        Detail kesehatan
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Jadwal Pemeriksaan Card -->
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-gray-400">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500">Jadwal Pemeriksaan</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $jumlahJadwal }}</h3>
                        </div>
                        <div class="p-3 rounded-full bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <a href="#"
                        class="mt-4 inline-flex items-center text-sm font-medium text-gray-600 hover:underline">
                        Lihat jadwal
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Two Columns Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Riwayat Kunjungan UKS -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-tzu-primary">Riwayat Kunjungan UKS</h2>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @forelse($riwayatKunjungan as $kunjungan)
                                <div class="px-6 py-4 hover:bg-gray-50 transition">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="font-medium text-gray-800">{{ ucfirst($kunjungan->tindakan) }}</h3>
                                            <p class="text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->translatedFormat('d F Y • H:i') }} WIB
                                            </p>
                                        </div>
                                        <span class="px-2 py-1 text-xs rounded-full bg-tzu-primary bg-opacity-10 text-tzu-primary">
                                            Selesai
                                        </span>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-600">{{ $kunjungan->keluhan }}</p>
                                </div>
                            @empty
                                <div class="px-6 py-4 text-gray-500 text-sm">Belum ada riwayat kunjungan.</div>
                            @endforelse
                        </div>

                        <div class="px-6 py-4 border-t border-gray-200 text-center">
                            <a href="#" class="text-sm font-medium text-tzu-primary hover:underline">Lihat semua
                                riwayat</a>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Notifikasi -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-tzu-primary">Notifikasi Kesehatan</h2>
                        </div>
                        <div class="divide-y divide-gray-200">
                            <!-- Notifikasi Item -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 p-2 rounded-full bg-red-100 text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-gray-800">Vaksinasi Tahunan</h3>
                                        <p class="mt-1 text-sm text-gray-600">Jadwal vaksinasi tahunan pada 25 Oktober 2023
                                        </p>
                                        <p class="mt-1 text-xs text-gray-500">2 hari lagi</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Notifikasi Item -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 p-2 rounded-full bg-blue-100 text-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-gray-800">Pemeriksaan Gigi</h3>
                                        <p class="mt-1 text-sm text-gray-600">Jadwal pemeriksaan gigi rutin pada 1 November
                                            2023</p>
                                        <p class="mt-1 text-xs text-gray-500">1 minggu lagi</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Notifikasi Item -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 p-2 rounded-full bg-green-100 text-green-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-gray-800">Hasil Pemeriksaan</h3>
                                        <p class="mt-1 text-sm text-gray-600">Hasil pemeriksaan rutin sudah tersedia</p>
                                        <p class="mt-1 text-xs text-gray-500">Baru saja</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-4 border-t border-gray-200 text-center">
                            <a href="#" class="text-sm font-medium text-tzu-primary hover:underline">Lihat semua
                                notifikasi</a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="mt-6 bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-tzu-primary">Tautan Cepat</h2>
                        </div>
                        <div class="p-4">
                            <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition mb-2">
                                <div class="p-2 rounded-full bg-tzu-primary bg-opacity-10 text-tzu-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <span class="ml-3 text-gray-800">Formulir Kunjungan UKS</span>
                            </a>
                            <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition mb-2">
                                <div class="p-2 rounded-full bg-tzu-secondary bg-opacity-10 text-tzu-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="ml-3 text-gray-800">Kalender Kesehatan</span>
                            </a>
                            <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition">
                                <div class="p-2 rounded-full bg-gray-100 text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span class="ml-3 text-gray-800">Laporan Kesehatan</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
