<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kunjungan extends Model
{
    protected $table = 'kunjungan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'petugas_id',
        'tanggal',
        'waktu',
        'kegiatan',
        'jenis',
        'catatan',
        'dokumen'
    ];

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(PetugasUKS::class, 'petugas_id');
    }

    public function getDokumenUrlAttribute()
    {
        return $this->dokumen ? asset('storage/' . $this->dokumen) : null;
    }
}