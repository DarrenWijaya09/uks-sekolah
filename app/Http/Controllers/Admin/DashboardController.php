<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Obat;
use App\Models\PenggunaanObat;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Data untuk statistik cards
        $totalSiswa = Siswa::count();
        $totalStokObat = Obat::sum('stok');
        $totalKunjungan = PenggunaanObat::whereMonth('tanggal_penggunaan', Carbon::now()->month)->count();
        $obatKadaluarsa = Obat::where('tanggal_kadaluarsa', '<=', Carbon::now()->addMonths(1))->count();

        // Persentase perubahan
        $lastMonthKunjungan = PenggunaanObat::whereMonth('tanggal_penggunaan', Carbon::now()->subMonth()->month)->count();
        $kunjunganPercentage = $lastMonthKunjungan > 0
            ? (($totalKunjungan - $lastMonthKunjungan) / $lastMonthKunjungan) * 100
            : 0;

        // Aktivitas terkini
        $aktivitasTerkini = PenggunaanObat::with(['siswa', 'obat'])
            ->latest('tanggal_penggunaan')
            ->take(3)
            ->get()
            ->map(function ($aktivitas) {
                $aktivitas->tanggal_penggunaan = Carbon::parse($aktivitas->tanggal_penggunaan);
                return $aktivitas;
            });

        // Obat dengan stok menipis
        $obatMenipis = Obat::where('stok', '>', 0)
            ->whereColumn('stok', '<=', 'stok_minimum')
            ->get();

        // Obat yang akan/sudah kadaluarsa (30 hari ke depan)
        $obatKadaluarsaDetail = Obat::where('tanggal_kadaluarsa', '<=', now()->addDays(30))
            ->where('stok', '>', 0)
            ->get();

        // Detail stok berdasarkan kategori (bukan jenis)
        $detailStok = Obat::selectRaw('kategori, SUM(stok) as total_stok')
                          ->groupBy('kategori')
                          ->get();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalStokObat',
            'detailStok',
            'totalKunjungan',
            'obatKadaluarsa',
            'kunjunganPercentage',
            'aktivitasTerkini',
            'obatMenipis',
            'obatKadaluarsaDetail'
        ));
    }
}
