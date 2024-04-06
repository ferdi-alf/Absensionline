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
        Schema::create('absensi_mingguans', function (Blueprint $table) {
            $table->id();
            $table->string('ketua_kelas');
            $table->string('no_tlp');
            $table->string('wali_kelas');
            $table->enum('tingkat', ['X', 'XI', 'XII']);
            $table->enum(
                'jurusan',
                [
                    'DPIB 1', 'DPIB 2', 'TP 1', 'TP 2', 'TP 3', 'TKR 1', 'TKR 2', 'TKR 3', 'TKR Industri',
                    'TSM 1', 'TSM 2', 'TSM 3', 'TSM Industri', 'TAV 1', 'TAV 2', 'TAV 3', 'TITL 1', 'TITL 2', 'TITL 3', 'TITL 4', 'TITL Industri',
                    'TKJ 1', 'TKJ 2', 'TKJ 3', 'TKJ 4', 'TKJ ACP', 'RPL'
                ]
            );
            $table->string('ruang');
            $table->string('jumlah_tidak_hadir');
            $table->string('siswa_tidak_hadir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_mingguans');
    }
};