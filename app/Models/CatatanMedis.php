<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CatatanMedis extends Model
{
    use HasFactory;

    protected $table = 'catatan_medis';

    protected $fillable = ['siswa_id', 'keluhan', 'diagnosa', 'pengobatan', 'status_kesehatan' ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
