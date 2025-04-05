@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-500">
            <h2 class="text-2xl font-bold text-white">Riwayat Penggunaan Obat</h2>
            <p class="mt-1 text-blue-100">Laporan penggunaan obat per bulan</p>
        </div>

        <!-- Filter Section -->
        <div class="p-6 border-b">
            <form action="{{ route('admin.penggunaan-obat.riwayat') }}" method="GET" class="flex gap-4">
                <select name="month" class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    @foreach(range(1, 12) as $month)
                        <option value="{{ $month }}" {{ request('month', date('m')) == $month ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                        </option>
                    @endforeach
                </select>
                <select name="year" class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    @foreach(range(date('Y'), date('Y')-5) as $year)
                        <option value="{{ $year }}" {{ request('year', date('Y')) == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Filter
                </button>
            </form>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
            <div class="bg-white rounded-lg shadow p-6 border">
                <h3 class="text-lg font-semibold text-gray-700">Total Penggunaan</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $totalPenggunaan }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 border">
                <h3 class="text-lg font-semibold text-gray-700">Obat Terbanyak Digunakan</h3>
                <p class="text-xl font-bold text-gray-900">{{ $mostUsedMedicine->nama ?? '-' }} ({{ $mostUsedMedicine->total ?? 0 }})</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 border">
                <h3 class="text-lg font-semibold text-gray-700">Total Siswa</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $totalSiswa }}</p>
            </div>
        </div>

        <!-- Table -->
        <div class="p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Obat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($penggunaan as $p)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($p->tanggal_penggunaan)->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $p->siswa->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $p->obat->nama_obat }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $p->jumlah }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $penggunaan->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
