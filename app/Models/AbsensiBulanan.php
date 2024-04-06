<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiBulanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'ketua_kelas', 'no_tlp', 'wali_kelas', 'tingkat', 'jurusan',
        'ruang', 'jumlah_tidak_hadir', 'siswa_tidak_hadir',
    ];

    protected $dates = ['created_at'];
}
