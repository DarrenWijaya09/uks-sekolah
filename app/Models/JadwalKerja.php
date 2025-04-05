<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalKerja extends Model
{
    protected $table = 'jadwal_kerja';
    protected $primaryKey = 'id';

    protected $fillable = [
        'petugas_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruangan'
    ];

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(PetugasUKS::class, 'petugas_id');
    }
}