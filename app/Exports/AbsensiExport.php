<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbsensiExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Absensi::select('id', 'created_at', 'ketua_kelas', 'no_tlp', 'wali_kelas', 'tingkat', 'jurusan', 'ruang', 'jumlah_tidak_hadir', 'siswa_tidak_hadir')
            ->get();
    }
}
