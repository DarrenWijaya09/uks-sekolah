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
        Schema::create('catatan_medis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id'); // Pastikan ini unsignedBigInteger
            $table->string('keluhan');
            $table->text('diagnosa')->nullable();
            $table->text('pengobatan')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_medis');
    }
};
