<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('petugas_uks', function (Blueprint $table) {
            $table->string('nip')->after('nama');
            $table->string('spesialisasi')->after('jabatan');
            $table->text('alamat')->after('kontak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('petugas_uks', function (Blueprint $table) {
            $table->dropColumn(['nip', 'spesialisasi', 'alamat']);
        });
    }
};
