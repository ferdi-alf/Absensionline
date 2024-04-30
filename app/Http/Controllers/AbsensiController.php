<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\AbsensiBulanan;
use Illuminate\Http\Request;
use App\Models\AbsensiMingguan;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function absen()
    {
        return view('index');
    }

    public function insertabsen(Request $request)
    {
        DB::beginTransaction();

        $request->validate([
            'ketua_kelas' => 'required',
            'no_tlp' => 'required|numeric',
            'wali_kelas' => 'required',
            'tingkat' => 'required',
            'jurusan' => 'required',
            'ruang' => 'required',
            'jumlah_tidak_hadir' => 'numeric',
        ], [
            'ketua_kelas.required' => 'ketua kelas wajib di isi',
            'no_tlp.numeric' => 'nomor hp harus berupa angka',
            'no_tlp.required' => 'momor hp kelas wajib di isi',
            'wali_kelas.required' => 'wali_kelas kelas wajib di isi',
            'tingkat.required' => 'tingkat kelas wajib di isi',
            'jurusan.required' => 'jurusan kelas wajib di isi',
            'ruang.required' => 'ruang kelas wajib di isi',
            'jumlah_tidak_hadir.numeric' => 'jumlah tidak hadir harus berupa angka',
        ]);
        try {
            // Simpan ke tabel absensi
            // Simpan ke tabel absensi
            Absensi::create([
                'ketua_kelas' => $request->ketua_kelas,
                'no_tlp' => $request->no_tlp,
                'wali_kelas' => $request->wali_kelas,
                'tingkat' => $request->tingkat,
                'jurusan' => $request->jurusan,
                'ruang' => $request->ruang,
                'jumlah_tidak_hadir' => $request->jumlah_tidak_hadir,
                'siswa_tidak_hadir' => $request->siswa_tidak_hadir,
            ]);


            // Simpan ke tabel absensi_mingguans
            AbsensiMingguan::create([
                'ketua_kelas' => $request->ketua_kelas,
                'no_tlp' => $request->no_tlp,
                'wali_kelas' => $request->wali_kelas,
                'tingkat' => $request->tingkat,
                'jurusan' => $request->jurusan,
                'ruang' => $request->ruang,
                'jumlah_tidak_hadir' => $request->jumlah_tidak_hadir,
                'siswa_tidak_hadir' => $request->siswa_tidak_hadir,
            ]);

            // Simpan data absen ke tabel absensi_bulanans
            AbsensiBulanan::create([
                'ketua_kelas' => $request->ketua_kelas,
                'no_tlp' => $request->no_tlp,
                'wali_kelas' => $request->wali_kelas,
                'tingkat' => $request->tingkat,
                'jurusan' => $request->jurusan,
                'ruang' => $request->ruang,
                'jumlah_tidak_hadir' => $request->jumlah_tidak_hadir,
                'siswa_tidak_hadir' => $request->siswa_tidak_hadir,
            ]);

            DB::commit();

            return redirect()->back()->with('sukses', 'Data absen berhasil dikirim.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Jika terjadi kesalahan, berikan pesan kesalahan atau lakukan tindakan lain sesuai kebutuhan
            return back()->with('error', 'Gagal menyimpan data absen. Silakan coba lagi.');
        }
    }
}