<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PetugasUKS extends Model
{
    protected $table = 'petugas_uks';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'spesialisasi',
        'kontak',
        'alamat',
        'status_aktif'
    ];

    protected $casts = [
        'status_aktif' => 'boolean'
    ];

    public function jadwal(): HasMany
    {
        return $this->hasMany(JadwalKerja::class, 'petugas_id');
    }

    public function kunjungan(): HasMany
    {
        return $this->hasMany(Kunjungan::class, 'petugas_id');
    }
}