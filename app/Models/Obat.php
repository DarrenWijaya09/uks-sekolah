<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat';

    protected $fillable = [
        'nama_obat',
        'kategori',
        'jenis', // Tambahkan jenis ke fillable
        'stok',
        'stok_minimum',
        'tanggal_kadaluarsa',
        'keterangan'
    ];

    // Mengubah string tanggal menjadi objek Carbon
    protected $casts = [
        'tanggal_kadaluarsa' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relasi dengan PenggunaanObat
    public function penggunaanObat()
    {
        return $this->hasMany(PenggunaanObat::class);
    }

    // Method untuk cek stok rendah
    public function isLowStock()
    {
        return $this->stok <= $this->stok_minimum && $this->stok > 0;
    }

    // Method untuk cek stok habis
    public function isOutOfStock()
    {
        return $this->stok <= 0;
    }

    // Scope untuk filter stok rendah
    public function scopeLowStock($query)
    {
        return $query->whereColumn('stok', '<=', 'stok_minimum')
                    ->where('stok', '>', 0);
    }

    // Scope untuk filter stok habis
    public function scopeOutOfStock($query)
    {
        return $query->where('stok', '<=', 0);
    }

    // Scope untuk filter berdasarkan kategori
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // Scope untuk mencari berdasarkan nama
    public function scopeSearch($query, $search)
    {
        return $query->where('nama_obat', 'like', "%{$search}%");
    }

    // Method untuk mengurangi stok
    public function kurangiStok($jumlah)
    {
        if ($this->stok >= $jumlah) {
            $this->decrement('stok', $jumlah);
            return true;
        }
        return false;
    }

    // Method untuk menambah stok
    public function tambahStok($jumlah)
    {
        $this->increment('stok', $jumlah);
        return true;
    }
}
