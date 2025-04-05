<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatKesehatan extends Model
{
    use HasFactory;

    protected $fillable = ['siswa_id', 'catatan', 'tanggal_kunjungan', 'diagnosa', 'pengobatan'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
