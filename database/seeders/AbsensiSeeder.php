<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('absensis')->insert([
            'ketua_kelas' => 'Nugraha ABi S',
            'no_tlp' => '088286062042',
            'wali_kelas' => 'pak Paisal',
            'tingkat' => 'X',
            'jurusan' => 'RPL',
            'ruang' => 'B3',
            'jumlah_tidak_hadir' => '3',
            'siswa_tidak_hadir' => 'Lala(a),Beni(i),Yantok(s)',
        ]);
    }
}
