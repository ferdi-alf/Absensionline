<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Models\AbsensiBulanan;
use App\Models\AbsensiMingguan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

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
            'ketua_kelas' => 'required|min:3',
            'no_tlp' => 'required|numeric|min:10',
            'wali_kelas' => 'required|min:5',
            'tingkat' => 'required',
            'jurusan' => 'required',
            'ruang' => 'required|min:2',
            'jumlah_tidak_hadir' => 'required|numeric',
            'siswa_tidak_hadir' => 'required|min:5'
        ], [
            'ketua_kelas.required' => 'ketua kelas wajib di isi',
            'ketua_kelas.min' => 'nama ketua kela terlalu pendek',
            'no_tlp.numeric' => 'nomor hp harus berupa angka',
            'no_tlp.required' => 'momor hp kelas wajib di isi',
            'no_tlp.min' => 'nomor telepon terlalu pendek',
            'wali_kelas.required' => 'wali_kelas kelas wajib di isi',
            'wali_kelas.min' => 'nama wali kelas terlalu pendek',
            'tingkat.required' => 'tingkat kelas wajib di isi',
            'jurusan.required' => 'jurusan kelas wajib di isi',
            'ruang.required' => 'ruang kelas wajib di isi',
            'ruang.min' => 'pengisian ruang tertalu pendek',
            'jumlah_tidak_hadir.numeric' => 'jumlah tidak hadir harus berupa angka',
            'jumlah_tidak_hadir.required' => 'jumlah tidak hadir wajib wajib diisi atau jika masuk semua tulis angka "0"',
            'siswa_tidak_hadir.required' => 'siswa tidak hadir wajib di isi atau jika masuk semua tulis "Nihil"',
            'siswa_tidak_hadir.min' => 'siswa tidak hadir terlalu pendek'
        ]);
        try {


            $key = $request->tingkat . '_' . $request->jurusan;

            if (Cache::has($key)) {
                return back()->with('error', 'Sudah ada data Absen dari tingkat dan jurusan yang sama, hanya bisa mengabsen 24jam sekali ;)');
            }

            Cache::put($key, true, now()->addHours(24));

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

            return redirect()->back()->with('sukses', 'Data absen berhasil dikirim. semoga kamu jujur dalam mengabsen temanmu 😁👌');
        } catch (\Exception $e) {
            DB::rollBack();

            // Jika terjadi kesalahan, berikan pesan kesalahan atau lakukan tindakan lain sesuai kebutuhan
            return back()->with('error', 'Gagal menyimpan data absen. Silakan coba lagi.');
        }
    }
}
