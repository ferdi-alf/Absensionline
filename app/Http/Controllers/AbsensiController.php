<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

        $validasi = $request->validate([
            'ketua_kelas' => 'required|min:3',
            'no_tlp' => 'required|numeric|min:10',
            'wali_kelas' => 'required|min:5',
            'tingkat' => 'required|in:X,XI,XII',
            'jurusan' => 'required|in:DPIB 1,DPIB 2,TP 1,TP 2,TP 3,TKR 1,TKR 2,TKR 3,TKR Industri,TSM 1,TSM 2,TSM 3,TSM Industri,TAV 1,TAV 2,TAV 3,TITL 1,TITL 2,TITL 3,TITL 4,TITL Industri,TKJ 1,TKJ 2,TKJ 3,TKJ 4,TKJ ACP,RPL',
            'ruang' => 'required|min:2',
            'jumlah_tidak_hadir' => 'required|numeric',
            'siswa_tidak_hadir' => 'required|min:5'
        ], [
            'ketua_kelas.required' => 'ketua kelas wajib di isi',
            'ketua_kelas.min' => 'nama ketua kela terlalu pendek',
            'no_tlp.numeric' => 'nomor hp harus berupa angka',
            'no_tlp.required' => 'nomor hp kelas wajib di isi',
            'no_tlp.min' => 'nomor telepon terlalu pendek',
            'wali_kelas.required' => 'wali_kelas kelas wajib di isi',
            'wali_kelas.min' => 'nama wali kelas terlalu pendek',
            'tingkat.required' => 'tingkat kelas wajib di isi',
            'jurusan.required' => 'jurusan kelas wajib di isi',
            'ruang.required' => 'ruang kelas wajib di isi',
            'ruang.min' => 'pengisian ruang tertalu pendek',
            'jumlah_tidak_hadir.numeric' => 'jumlah tidak hadir harus berupa angka',
            'jumlah_tidak_hadir.required' => 'jumlah tidak hadir wajib diisi atau jika masuk semua tulis angka "0"',
            'siswa_tidak_hadir.required' => 'siswa tidak hadir wajib di isi atau jika masuk semua tulis "Nihil"',
            'siswa_tidak_hadir.min' => 'siswa tidak hadir terlalu pendek'
        ]);

        try {
            $dataDuplikatAbsensi = Absensi::where('tingkat', $request->tingkat)
                ->where('jurusan', $request->jurusan)
                ->first();

            if ($dataDuplikatAbsensi) {
                $waktuTunggu = $this->hitungWaktuTunggu($dataDuplikatAbsensi);
                $formattedWaktuTunggu = $this->formatWaktuTunggu($waktuTunggu);

                return redirect()->back()->with('error', "Absen tingkat {$request->tingkat} dan jurusan {$request->jurusan} sudah ada. Tolong tunggu {$formattedWaktuTunggu} lagi untuk mengirim data absen lagi ya gaiss😁👌");
            }

            // Simpan ke tabel absensi
            $absensi = new Absensi();
            $absensi->ketua_kelas = $validasi['ketua_kelas'];
            $absensi->no_tlp = $validasi['no_tlp'];
            $absensi->wali_kelas = $validasi['wali_kelas'];
            $absensi->tingkat = $validasi['tingkat'];
            $absensi->jurusan = $validasi['jurusan'];
            $absensi->ruang = $validasi['ruang'];
            $absensi->jumlah_tidak_hadir = $validasi['jumlah_tidak_hadir'];
            $absensi->siswa_tidak_hadir = $validasi['siswa_tidak_hadir'];
            $absensi->save();

            $absensiMingguan = new AbsensiMingguan();
            $absensiMingguan->ketua_kelas = $validasi['ketua_kelas'];
            $absensiMingguan->no_tlp = $validasi['no_tlp'];
            $absensiMingguan->wali_kelas = $validasi['wali_kelas'];
            $absensiMingguan->tingkat = $validasi['tingkat'];
            $absensiMingguan->jurusan = $validasi['jurusan'];
            $absensiMingguan->ruang = $validasi['ruang'];
            $absensiMingguan->jumlah_tidak_hadir = $validasi['jumlah_tidak_hadir'];
            $absensiMingguan->siswa_tidak_hadir = $validasi['siswa_tidak_hadir'];
            $absensiMingguan->save();

            $absensiBulanan = new AbsensiBulanan();
            $absensiBulanan->ketua_kelas = $validasi['ketua_kelas'];
            $absensiBulanan->no_tlp = $validasi['no_tlp'];
            $absensiBulanan->wali_kelas = $validasi['wali_kelas'];
            $absensiBulanan->tingkat = $validasi['tingkat'];
            $absensiBulanan->jurusan = $validasi['jurusan'];
            $absensiBulanan->ruang = $validasi['ruang'];
            $absensiBulanan->jumlah_tidak_hadir = $validasi['jumlah_tidak_hadir'];
            $absensiBulanan->siswa_tidak_hadir = $validasi['siswa_tidak_hadir'];
            $absensiBulanan->save();

            DB::commit();

            return redirect()->back()->with('sukses', 'Data absen berhasil dikirim. semoga kamu jujur dalam mengabsen temanmu 😁👌');
        } catch (\Exception $e) {
            DB::rollBack();


            return back()->with('error', 'Gagal menyimpan data absen. Silakan refresh website ini dan coba lagi.');
        }
    }

    private function hitungWaktuTunggu($dataDuplikatAbsensi)
    {
        $timestampTerbaru = null;

        if ($dataDuplikatAbsensi) {
            $timestampTerbaru = $dataDuplikatAbsensi->created_at;
        }

        if ($timestampTerbaru) {
            $waktuTunggu = $timestampTerbaru->addDay()->diff(Carbon::now());
            return $waktuTunggu;
        }

        return null;
    }

    private function formatWaktuTunggu($waktuTunggu)
    {
        $jam = $waktuTunggu->h;
        $menit = $waktuTunggu->i;
        $detik = $waktuTunggu->s;

        $formattedWaktuTunggu = "{$jam} jam {$menit} menit {$detik} detik";

        return $formattedWaktuTunggu;
    }
}