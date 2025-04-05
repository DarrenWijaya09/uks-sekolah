@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6 min-h-screen bg-[#F5F5F5]">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-[#009A44]">Manajemen Tenaga Kesehatan</h1>
                <p class="text-[#4A4A4A] mt-1">Kelola data petugas UKS Sekolah Cinta Kasih Tzu Chi</p>
            </div>
            <a href="{{ route('admin.petugas-uks.create') }}"
                class="bg-[#009A44] hover:bg-[#00823A] text-white px-6 py-3 rounded-lg flex items-center transition-colors duration-200 shadow-md">
                <i class="fas fa-plus mr-2"></i>Tambah Petugas
            </a>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl p-6 shadow-sm border-t-4 border-[#009A44]">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-[#009A44]/10 mr-4">
                        <i class="fas fa-user-nurse text-[#009A44] text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-[#4A4A4A]">Total Petugas</p>
                        <h3 class="text-2xl font-bold text-[#00A3AF]">{{ $petugas->count() }}</h3>
                    </div>
                </div>
            </div>

            @php
                $totalKunjungan = App\Models\Kunjungan::count();
            @endphp

            <div class="bg-white rounded-xl p-6 shadow-sm border-t-4 border-[#00A3AF]">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-[#00A3AF]/10 mr-4">
                        <i class="fas fa-calendar-check text-[#00A3AF] text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-[#4A4A4A]">Total Kunjungan</p>
                        <h3 class="text-2xl font-bold text-[#009A44]">{{ $totalKunjungan }}</h3>
                    </div>
                </div>
            </div>


            <div class="bg-white rounded-xl p-6 shadow-sm border-t-4 border-[#4A4A4A]">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-[#4A4A4A]/10 mr-4">
                        <i class="fas fa-stethoscope text-[#4A4A4A] text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-[#4A4A4A]">Spesialisasi</p>
                        <h3 class="text-2xl font-bold text-[#00A3AF]">{{ $petugas->unique('spesialisasi')->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-xl p-4 shadow-sm mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Cari petugas..."
                            class="w-full pl-10 pr-4 py-2 border border-[#00A3AF]/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#009A44]/50">
                        <i class="fas fa-search absolute left-3 top-3 text-[#00A3AF]"></i>
                    </div>
                </div>
                <select id="jabatanFilter"
                    class="border border-[#00A3AF]/30 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#009A44]/50 text-[#4A4A4A]">
                    <option value="">Semua Jabatan</option>
                    <option value="Dokter">Semua Dokter</option>
                    <option value="Perawat">Semua Perawat</option>
                    <option value="Bidan">Semua Bidan</option>
                    <!-- Add specific job positions if needed -->
                </select>
                <button id="filterButton"
                    class="bg-[#00A3AF] hover:bg-[#008B9A] text-white px-4 py-2 rounded-lg flex items-center justify-center transition-colors duration-200">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
                <button id="resetButton"
                    class="bg-[#F5F5F5] hover:bg-gray-200 text-[#4A4A4A] px-4 py-2 rounded-lg flex items-center justify-center border border-[#00A3AF]/30 transition-colors duration-200">
                    <i class="fas fa-sync-alt mr-2"></i>Reset
                </button>
            </div>
        </div>

        <!-- Petugas Cards -->
        <div id="petugasContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($petugas as $p)
                <div class="petugas-card bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 border-l-4 border-[#009A44]"
                    data-nama="{{ strtolower($p->nama) }}" data-jabatan="{{ strtolower($p->jabatan) }}"
                    data-spesialisasi="{{ strtolower($p->spesialisasi) }}">
                    <div class="p-6">
                        <div class="flex items-start mb-4">
                            <div class="bg-[#009A44] p-3 rounded-full mr-4 flex-shrink-0">
                                <i class="fas fa-user-md text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-[#4A4A4A]">{{ $p->nama }}</h3>
                                <p class="text-sm font-medium text-[#00A3AF]">{{ $p->jabatan }}</p>
                                <div class="mt-1">
                                    <span
                                        class="inline-block bg-[#00A3AF]/10 text-[#00A3AF] text-xs px-2 py-1 rounded-full">
                                        {{ $p->spesialisasi }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3 mt-4">
                            <div class="flex items-center text-sm text-[#4A4A4A]">
                                <div class="w-8 text-[#00A3AF]">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <span>{{ $p->nip ?: 'N/A' }}</span>
                            </div>
                            <div class="flex items-center text-sm text-[#4A4A4A]">
                                <div class="w-8 text-[#00A3AF]">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <span>{{ $p->kontak }}</span>
                            </div>
                            <div class="flex items-center text-sm text-[#4A4A4A]">
                                <div class="w-8 text-[#00A3AF]">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <span class="truncate">{{ Str::limit($p->alamat, 30) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#F5F5F5] px-6 py-3 flex justify-between items-center">
                        <a href="{{ route('admin.petugas-uks.show', $p->id) }}"
                            class="text-[#00A3AF] hover:text-[#009A44] font-medium text-sm flex items-center">
                            <i class="fas fa-eye mr-2"></i>Detail
                        </a>
                        <div class="flex items-center space-x-4">
                            <span class="text-xs bg-white px-2 py-1 rounded-full text-[#4A4A4A] shadow-sm">
                                <i class="fas fa-calendar-check mr-1"></i>
                                {{ $p->kunjungan->count() }} Kunjungan
                            </span>
                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.petugas-uks.edit', $p->id) }}"
                                class="px-3 py-1 bg-[#00A3AF] text-white text-sm rounded-lg flex items-center hover:bg-[#009A44] transition-colors">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty State -->
        <div id="emptyState" class="hidden text-center py-12">
            <div class="mx-auto max-w-md">
                <i class="fas fa-user-md text-[#00A3AF] text-5xl mb-4"></i>
                <h3 class="text-xl font-bold text-[#4A4A4A] mb-2">Tidak ada petugas ditemukan</h3>
                <p class="text-[#4A4A4A] mb-4">Coba gunakan kata kunci atau filter yang berbeda</p>
                <button id="resetEmptyButton"
                    class="bg-[#00A3AF] hover:bg-[#008B9A] text-white px-6 py-2 rounded-lg inline-flex items-center transition-colors duration-200">
                    <i class="fas fa-sync-alt mr-2"></i>Reset Pencarian
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const jabatanFilter = document.getElementById('jabatanFilter');
            const filterButton = document.getElementById('filterButton');
            const resetButton = document.getElementById('resetButton');
            const resetEmptyButton = document.getElementById('resetEmptyButton');
            const petugasContainer = document.getElementById('petugasContainer');
            const emptyState = document.getElementById('emptyState');
            const petugasCards = document.querySelectorAll('.petugas-card');

            // Function to filter petugas
            function filterPetugas() {
                const searchTerm = searchInput.value.toLowerCase();
                const jabatanValue = jabatanFilter.value.toLowerCase();

                let hasVisibleItems = false;

                petugasCards.forEach(card => {
                    const nama = card.dataset.nama;
                    const jabatan = card.dataset.jabatan;
                    const spesialisasi = card.dataset.spesialisasi;

                    // Search filter (name or specialization)
                    const matchesSearch = searchTerm === '' ||
                        nama.includes(searchTerm) ||
                        spesialisasi.includes(searchTerm);

                    // Job position filter (matches any variation)
                    let matchesJabatan = true;
                    if (jabatanValue !== '') {
                        if (jabatanValue === 'dokter') {
                            matchesJabatan = jabatan.includes('dokter');
                        } else if (jabatanValue === 'perawat') {
                            matchesJabatan = jabatan.includes('perawat');
                        } else if (jabatanValue === 'bidan') {
                            matchesJabatan = jabatan.includes('bidan');
                        } else {
                            matchesJabatan = jabatan === jabatanValue;
                        }
                    }

                    if (matchesSearch && matchesJabatan) {
                        card.classList.remove('hidden');
                        hasVisibleItems = true;
                    } else {
                        card.classList.add('hidden');
                    }
                });

                // Show empty state if no cards visible
                if (hasVisibleItems) {
                    emptyState.classList.add('hidden');
                    petugasContainer.classList.remove('hidden');
                } else {
                    emptyState.classList.remove('hidden');
                    petugasContainer.classList.add('hidden');
                }
            }

            // Event listeners
            searchInput.addEventListener('input', filterPetugas);
            filterButton.addEventListener('click', filterPetugas);

            // Reset filters
            function resetFilters() {
                searchInput.value = '';
                jabatanFilter.value = '';
                filterPetugas();
            }

            resetButton.addEventListener('click', resetFilters);
            resetEmptyButton.addEventListener('click', resetFilters);

            // Initial filter (in case page loads with values)
            filterPetugas();
        });
    </script>
@endsection
