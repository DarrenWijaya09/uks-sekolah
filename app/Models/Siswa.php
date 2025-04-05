<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kelas', 'tanggal_lahir', 'jenis_kelamin', 'alamat'];
    protected $table = 'siswa';

    public function riwayatKesehatan()
    {
        return $this->hasMany(RiwayatKesehatan::class);
    }

    public function penggunaanObat()
    {
        return $this->hasMany(PenggunaanObat::class);
    }

    public function laporanKesehatan()
    {
        return $this->hasMany(LaporanKesehatan::class);
    }
    public function catatanMedis()
    {
        return $this->hasMany(CatatanMedis::class);
    }

    public function kunjunganUKS()
    {
        return $this->hasMany(KunjunganUKS::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
