@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Siswa -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Siswa</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalSiswa) }}</h3>
                </div>
                <div class="bg-blue-50 rounded-lg p-3">
                    <svg class="w-6 h-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-3-3h-2m-4 0H9a3 3 0 00-3 3v2m4-18h2a3 3 0 013 3v2M7 7H4a3 3 0 00-3 3v2" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Stok Obat -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Stok Obat</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalStokObat) }}</h3>
                    <div class="mt-2 space-y-1">
                        @foreach($detailStok as $stok)
                        <p class="text-xs text-gray-500">
                            <span class="capitalize">{{ $stok->kategori }}</span>: {{ number_format($stok->total_stok) }}
                        </p>
                        @endforeach
                    </div>
                </div>
                <div class="bg-green-50 rounded-lg p-3">
                    <svg class="w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Kunjungan UKS -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Kunjungan Bulan Ini</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalKunjungan) }}</h3>
                </div>
                <div class="bg-purple-50 rounded-lg p-3">
                    <svg class="w-6 h-6 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="{{ $kunjunganPercentage >= 0 ? 'text-green-500' : 'text-red-500' }} font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="{{ $kunjunganPercentage >= 0
                                ? 'M5 10l7-7m0 0l7 7m-7-7v18'
                                : 'M19 14l-7 7m0 0l-7-7m7 7V3' }}" />
                    </svg>
                    {{ number_format(abs($kunjunganPercentage), 1) }}%
                </span>
                <span class="text-gray-400 ml-2">vs bulan lalu</span>
            </div>
        </div>

        <!-- Obat Kadaluarsa -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Obat Kadaluarsa</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($obatKadaluarsa) }}</h3>
                </div>
                <div class="bg-red-50 rounded-lg p-3">
                    <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-red-500 font-medium">Perlu perhatian segera</span>
            </div>
        </div>
    </div>

    <!-- Grafik dan Tabel -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Aktivitas Terkini -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h4 class="text-lg font-semibold text-gray-900">Aktivitas Terkini</h4>
                <p class="text-sm text-gray-500 mt-1">Daftar kunjungan UKS terbaru</p>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($aktivitasTerkini as $aktivitas)
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">{{ $aktivitas->siswa->nama }}</p>
                            <p class="text-sm text-gray-500">{{ $aktivitas->keterangan }} - Diberikan {{ $aktivitas->obat->nama }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ $aktivitas->tanggal_penggunaan->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 text-sm">Belum ada aktivitas</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Stok Obat Menipis -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h4 class="text-lg font-semibold text-gray-900">Monitoring Stok Obat</h4>
                <p class="text-sm text-gray-500 mt-1">Obat yang memerlukan perhatian khusus</p>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <th class="pb-3">Nama Obat</th>
                                <th class="pb-3">Sisa Stok</th>
                                <th class="pb-3">Status Stok</th>
                                <th class="pb-3">Kadaluarsa</th>
                                <th class="pb-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @php
                                $mergedObats = collect();

                                // Merge obat menipis
                                foreach($obatMenipis as $obat) {
                                    $mergedObats->push([
                                        'id' => $obat->id,
                                        'nama' => $obat->nama_obat,
                                        'stok' => $obat->stok,
                                        'stok_status' => $obat->stok <= ($obat->stok_minimum / 2) ? 'Kritis' : 'Menipis',
                                        'tanggal_kadaluarsa' => $obat->tanggal_kadaluarsa,
                                    ]);
                                }

                                // Merge obat kadaluarsa yang belum masuk list
                                foreach($obatKadaluarsaDetail as $obat) {
                                    if (!$mergedObats->contains('id', $obat->id)) {
                                        $mergedObats->push([
                                            'id' => $obat->id,
                                            'nama' => $obat->nama_obat,
                                            'stok' => $obat->stok,
                                            'stok_status' => $obat->stok <= $obat->stok_minimum ? 'Menipis' : 'Normal',
                                            'tanggal_kadaluarsa' => $obat->tanggal_kadaluarsa,
                                        ]);
                                    }
                                }
                            @endphp

                            @forelse($mergedObats as $obat)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3">
                                    <span class="font-medium text-gray-900">{{ $obat['nama'] }}</span>
                                </td>
                                <td class="py-3">
                                    <span class="font-medium {{ $obat['stok'] === 0 ? 'text-red-600' : 'text-gray-900' }}">
                                        {{ number_format($obat['stok']) }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <span class="px-2 py-1 text-xs rounded-full {{
                                        $obat['stok_status'] === 'Kritis' ? 'bg-red-100 text-red-600' :
                                        ($obat['stok_status'] === 'Menipis' ? 'bg-yellow-100 text-yellow-600' :
                                        'bg-green-100 text-green-600')
                                    }}">
                                        {{ $obat['stok_status'] }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    @php
                                        $kadaluarsa = \Carbon\Carbon::parse($obat['tanggal_kadaluarsa']);
                                        $today = \Carbon\Carbon::today();
                                        $daysUntilExpired = $today->diffInDays($kadaluarsa, false);
                                    @endphp

                                    <span class="px-2 py-1 text-xs rounded-full {{
                                        $daysUntilExpired < 0 ? 'bg-red-100 text-red-600' :
                                        ($daysUntilExpired <= 30 ? 'bg-yellow-100 text-yellow-600' :
                                        'bg-green-100 text-green-600')
                                    }}">
                                        @if($daysUntilExpired < 0)
                                            Kadaluarsa {{ abs($daysUntilExpired) }} hari lalu
                                        @elseif($daysUntilExpired == 0)
                                            Kadaluarsa hari ini
                                        @else
                                            {{ $daysUntilExpired }} hari lagi
                                        @endif
                                    </span>
                                </td>
                                <td class="py-3">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.obat.edit', $obat['id']) }}"
                                           class="px-3 py-1 text-xs bg-blue-100 text-blue-600 rounded-full hover:bg-blue-200">
                                            Update Stok
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-gray-500">
                                    Tidak ada obat yang memerlukan perhatian khusus
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
