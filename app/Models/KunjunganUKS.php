<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KunjunganUKS extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_u_k_s';

    protected $fillable = ['siswa_id', 'tanggal_kunjungan', 'keluhan', 'tindakan'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
