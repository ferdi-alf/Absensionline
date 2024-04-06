<?php

namespace App\Exports;

use App\Models\AbsensiMingguan;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbsensiMingguanExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return AbsensiMingguan::select('id', 'created_at', 'ketua_kelas', 'no_tlp', 'wali_kelas', 'tingkat', 'jurusan', 'ruang', 'jumlah_tidak_hadir', 'siswa_tidak_hadir')
            ->get();
    }

    public function headings(): array
    {
        // Tentukan judul kolom
        return [
            'no',
            'waktu',
            'Ketua Kelas',
            'Nomor HP',
            'Wali Kelas',
            'Tingkat',
            'Jurusan',
            'Ruang',
            'Jumlah Tidak Hadir',
            'Siswa Tidak Hadir',
        ];
    }
}
