<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_kesehatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->string('status_kesehatan');
            $table->text('catatan')->nullable();
            $table->string('jenis_penyakit')->nullable();
            $table->date('tanggal_kunjungan');
            $table->time('waktu_kunjungan');
            $table->string('tindakan')->nullable();
            $table->string('obat_diberikan')->nullable();
            $table->enum('periode', ['bulanan', 'triwulan', 'tahunan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kesehatan');
    }
};
