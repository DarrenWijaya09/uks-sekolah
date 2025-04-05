<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanKesehatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id', 'status_kesehatan', 'catatan', 'jenis_penyakit', 'tanggal_kunjungan',
        'waktu_kunjungan', 'tindakan', 'obat_diberikan', 'periode'
    ];

    protected $table = 'laporan_kesehatan';
    protected $dates = ['tanggal_kunjungan'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // Ambil data berdasarkan periode (bulanan, triwulan, tahunan)
    public function scopePeriode($query, $periode)
    {
        $date = now();

        if ($periode === 'bulanan') {
            return $query->whereMonth('tanggal_kunjungan', $date->month)
                         ->whereYear('tanggal_kunjungan', $date->year);
        } elseif ($periode === 'triwulan') {
            return $query->whereBetween('tanggal_kunjungan', [$date->startOfQuarter(), $date->endOfQuarter()]);
        } elseif ($periode === 'tahunan') {
            return $query->whereYear('tanggal_kunjungan', $date->year);
        }

        return $query;
    }

    // Hitung tren penyakit yang sering terjadi
    public static function trenPenyakit($periode)
    {
        return self::select('jenis_penyakit', DB::raw('COUNT(*) as total'))
            ->whereNotNull('jenis_penyakit')
            ->periode($periode)
            ->groupBy('jenis_penyakit')
            ->orderByDesc('total')
            ->get();
    }

    // Total kunjungan ke UKS berdasarkan periode
    public static function totalKunjungan($periode)
    {
        return self::periode($periode)->count();
    }
}
