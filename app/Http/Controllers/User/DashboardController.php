<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KunjunganUKS;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $siswaId = Auth::user()->siswa->id ?? null;

        $totalKunjungan = KunjunganUKS::where('siswa_id', $siswaId)->count();

        $riwayatKunjungan = KunjunganUKS::where('siswa_id', $siswaId)
            ->orderByDesc('tanggal_kunjungan')
            ->take(5)
            ->get();

        // Ambil status kesehatan terakhir
        $statusKesehatan = null;
        if ($siswaId) {
            $siswa = \App\Models\Siswa::with(['catatanMedis' => function ($query) {
                $query->latest()->limit(1);
            }])->find($siswaId);

            $statusKesehatan = optional($siswa->catatanMedis->first())->status_kesehatan;
        }

        // Hitung jumlah jadwal pemeriksaan yang akan datang (hari ini atau setelahnya)
        $jumlahJadwal = KunjunganUKS::where('siswa_id', $siswaId)
            ->whereDate('tanggal_kunjungan', '>=', Carbon::today())
            ->count();

        return view('user.dashboard', compact(
            'totalKunjungan',
            'riwayatKunjungan',
            'statusKesehatan',
            'jumlahJadwal'
        ));
    }
}
