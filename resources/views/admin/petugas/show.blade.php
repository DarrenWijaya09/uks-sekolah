@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white rounded-xl shadow-md overflow-hidden border-t-4 border-[#009A44]">
        <!-- Header Section -->
        <div class="bg-white px-6 py-4 border-b border-[#F5F5F5]">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-[#009A44]">
                    <i class="fas fa-user-md mr-2"></i>Detail Petugas UKS
                </h2>
                <a href="{{ route('admin.petugas-uks.index') }}"
                   class="px-4 py-2 border border-[#00A3AF] text-[#00A3AF] rounded-lg hover:bg-[#00A3AF] hover:text-white transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="p-6">
            <!-- Informasi Petugas -->
            <div class="bg-[#F5F5F5] rounded-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-[#4A4A4A] mb-4 pb-2 border-b border-[#00A3AF]/30">
                    <i class="fas fa-info-circle text-[#00A3AF] mr-2"></i>Informasi Petugas
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-3">
                        <p class="text-[#4A4A4A]">
                            <span class="font-medium text-[#00A3AF]">Nama:</span> {{ $petugas->nama }}
                        </p>
                        <p class="text-[#4A4A4A]">
                            <span class="font-medium text-[#00A3AF]">NIP:</span> {{ $petugas->nip ?? '-' }}
                        </p>
                        <p class="text-[#4A4A4A]">
                            <span class="font-medium text-[#00A3AF]">Jabatan:</span> {{ $petugas->jabatan }}
                        </p>
                    </div>
                    <div class="space-y-3">
                        <p class="text-[#4A4A4A]">
                            <span class="font-medium text-[#00A3AF]">Spesialisasi:</span> {{ $petugas->spesialisasi }}
                        </p>
                        <p class="text-[#4A4A4A]">
                            <span class="font-medium text-[#00A3AF]">Kontak:</span> {{ $petugas->kontak }}
                        </p>
                        <p class="text-[#4A4A4A]">
                            <span class="font-medium text-[#00A3AF]">Alamat:</span> {{ $petugas->alamat }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Jadwal Kerja -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-[#4A4A4A] mb-4 pb-2 border-b border-[#00A3AF]/30">
                    <i class="fas fa-calendar-alt text-[#00A3AF] mr-2"></i>Jadwal Kerja
                </h3>
                <div class="bg-white rounded-lg border border-[#F5F5F5] overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-[#009A44] text-white">
                            <tr>
                                <th class="px-4 py-3 text-left">Hari</th>
                                <th class="px-4 py-3 text-left">Jam Kerja</th>
                                <th class="px-4 py-3 text-left">Ruangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#F5F5F5]">
                            @foreach($petugas->jadwal as $jadwal)
                            <tr class="hover:bg-[#F5F5F5]">
                                <td class="px-4 py-3">{{ $jadwal->hari }}</td>
                                <td class="px-4 py-3">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                                <td class="px-4 py-3">{{ $jadwal->ruangan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Riwayat Kunjungan -->
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-[#4A4A4A] pb-2 border-b border-[#00A3AF]/30">
                        <i class="fas fa-history text-[#00A3AF] mr-2"></i>Riwayat Kunjungan
                    </h3>
                    <div class="bg-[#009A44] text-white px-3 py-1 rounded-full text-sm">
                        Total: {{ $petugas->kunjungan->count() }} Kunjungan
                    </div>
                </div>

                <div class="bg-white rounded-lg border border-[#F5F5F5] overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-[#00A3AF] text-white">
                            <tr>
                                <th class="px-4 py-3 text-left">Tanggal</th>
                                <th class="px-4 py-3 text-left">Kegiatan</th>
                                <th class="px-4 py-3 text-left">Jenis</th>
                                <th class="px-4 py-3 text-left">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#F5F5F5]">
                            @foreach($petugas->kunjungan as $kunjungan)
                            <tr class="hover:bg-[#F5F5F5]">
                                <td class="px-4 py-3">{{ $kunjungan->tanggal }}</td>
                                <td class="px-4 py-3">{{ $kunjungan->kegiatan }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs
                                        {{ $kunjungan->jenis == 'rutin' ? 'bg-[#009A44]/10 text-[#009A44]' : 'bg-[#00A3AF]/10 text-[#00A3AF]' }}">
                                        {{ ucfirst($kunjungan->jenis) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">{{ $kunjungan->catatan ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection