<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenggunaanObat extends Model
{
    use HasFactory;

    protected $fillable = ['siswa_id', 'obat_id', 'jumlah', 'tanggal_penggunaan', 'keterangan'];
    protected $table = 'penggunaan_obat';

    protected $dates = [
        'tanggal_penggunaan',
        'created_at',
        'updated_at'
    ];

    // atau bisa juga menggunakan casts
    protected $casts = [
        'tanggal_penggunaan' => 'datetime',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}
