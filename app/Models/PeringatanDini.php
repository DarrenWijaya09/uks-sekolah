<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PeringatanDini extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'peringatan_dini';

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'kategori'
    ];

    /**
     * Kategori yang tersedia untuk peringatan dini.
     *
     * @var array
     */
    public const KATEGORI = [
        'wabah' => 'Wabah Penyakit',
        'vaksinasi' => 'Vaksinasi',
        'kesehatan umum' => 'Kesehatan Umum'
    ];

    /**
     * Casting atribut untuk properti model.
     *
     * @var array
     */
    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Accessor untuk format tanggal yang lebih mudah dibaca.
     *
     * @return Attribute
     */
    protected function tanggalFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tanggal->format('d F Y'),
        );
    }

    /**
     * Scope untuk filter berdasarkan kategori.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $kategori
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Scope untuk filter peringatan dini terbaru.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTerbaru($query)
    {
        return $query->orderBy('tanggal', 'desc');
    }
}