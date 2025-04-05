<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class JadwalUKS extends Model
{
    use HasFactory;

    protected $fillable = ['kegiatan', 'deskripsi', 'waktu'];
    protected $table = "jadwal_uks";

    public function petugasUKS()
    {
        return $this->belongsTo(PetugasUKS::class);
    }
}
