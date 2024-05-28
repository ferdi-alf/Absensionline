<?php

namespace App\Models;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    protected $fillable = [
        'ketua_kelas', 'no_tlp', 'wali_kelas', 'tingkat', 'jurusan',
        'ruang', 'jumlah_tidak_hadir', 'siswa_tidak_hadir',
    ];

    // Format kolom tanggal
    protected $dates = ['created_at'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
