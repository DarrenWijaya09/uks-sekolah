@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6 bg-gradient-to-br from-[#F5F5F5] to-[#FFFFFF] min-h-screen">
    <!-- Header Section -->
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-bold text-[#009A44] mb-2">Laporan Kesehatan Siswa</h2>
        <p class="text-[#4A4A4A]">Monitoring kesehatan siswa periode 2023/2024</p>
    </div>

    <!-- Filter Section -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <form method="GET" action="{{ route('admin.laporan-kesehatan.index') }}">
            <div class="flex flex-col md:flex-row items-center gap-4">
                <label class="text-[#4A4A4A] font-medium">Pilih Periode:</label>
                <select name="periode" onchange="this.form.submit()"
                    class="w-full md:w-48 p-2 border border-[#E0E0E0] rounded-lg focus:border-[#009A44] focus:ring-[#009A44]">
                    <option value="bulanan" {{ $periode == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                    <option value="triwulan" {{ $periode == 'triwulan' ? 'selected' : '' }}>Triwulan</option>
                    <option value="tahunan" {{ $periode == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                </select>
            </div>
        </form>
    </div>

    <!-- Main Content -->
    <div class="space-y-6">

        <!-- Chart Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-[#00A3AF] mb-4">Grafik Tren Penyakit</h3>
            <canvas id="healthChart" class="w-full h-64"></canvas>
        </div>

        <!-- Kunjungan UKS & Penggunaan Obat Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Kunjungan UKS -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-[#009A44] p-4 flex items-center">
                    <i class="fas fa-hospital text-white text-xl mr-3"></i>
                    <h3 class="text-white font-semibold text-lg">Kunjungan UKS</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[#F5F5F5]">
                            <tr>
                                <th class="p-3 text-left text-[#4A4A4A] text-sm">Nama Siswa</th>
                                <th class="p-3 text-left text-[#4A4A4A] text-sm">Kelas</th>
                                <th class="p-3 text-left text-[#4A4A4A] text-sm">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#E0E0E0]">
                            @foreach ($siswaUKS as $siswa)
                            <tr class="hover:bg-[#F5F5F5] transition-colors">
                                <td class="p-3 text-[#4A4A4A]">{{ $siswa->nama }}</td>
                                <td class="p-3 text-[#00A3AF]">{{ $siswa->kelas }}</td>
                                <td class="p-3 text-[#4A4A4A]">
                                    {{ optional($siswa->kunjunganUKS->first())->tanggal_kunjungan
                                        ? \Carbon\Carbon::parse($siswa->kunjunganUKS->first()->tanggal_kunjungan)->format('d M Y')
                                        : 'Tidak ada kunjungan' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="bg-[#F5F5F5] p-3 text-[#4A4A4A] text-sm flex justify-between items-center">
                    <span>Total Kunjungan: {{ $siswaUKS->total() }} siswa</span>
                    {{ $siswaUKS->links() }}
                </div>
            </div>

            <!-- Penggunaan Obat -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-[#00A3AF] p-4 flex items-center">
                    <i class="fas fa-pills text-white text-xl mr-3"></i>
                    <h3 class="text-white font-semibold text-lg">Penggunaan Obat</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[#F5F5F5]">
                            <tr>
                                <th class="p-3 text-left text-[#4A4A4A] text-sm">Nama Siswa</th>
                                <th class="p-3 text-left text-[#4A4A4A] text-sm">Kelas</th>
                                <th class="p-3 text-left text-[#4A4A4A] text-sm">Nama Obat</th>
                                <th class="p-3 text-left text-[#4A4A4A] text-sm">Dosis</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#E0E0E0]">
                            @foreach ($siswaPenggunaanObat as $data)
                            <tr class="hover:bg-[#F5F5F5] transition-colors">
                                <td class="p-3 text-[#4A4A4A]">{{ optional($data->siswa)->nama ?? 'Tidak ada' }}</td>
                                <td class="p-3 text-[#009A44]">{{ optional($data->siswa)->kelas ?? 'Tidak ada' }}</td>
                                <td class="p-3 text-[#4A4A4A]">{{ optional($data->obat)->nama_obat ?? 'N/A' }}</td>
                                <td class="p-3 text-[#4A4A4A]">
                                    {{ $data->jumlah }}{{ optional($data->obat)->satuan ?? '' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="bg-[#F5F5F5] p-3 text-[#4A4A4A] text-sm flex justify-between items-center">
                    <span>Total Obat Terpakai: {{ $siswaPenggunaanObat->total() }} jenis</span>
                    {{ $siswaPenggunaanObat->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('healthChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Kasus Penyakit',
                    data: [12, 19, 3, 5, 2, 3],
                    borderColor: '#009A44',
                    tension: 0.4,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#4A4A4A'
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: '#F5F5F5'
                        }
                    },
                    y: {
                        grid: {
                            color: '#F5F5F5'
                        }
                    }
                }
            }
        });
    </script>
</div>
@endsection
