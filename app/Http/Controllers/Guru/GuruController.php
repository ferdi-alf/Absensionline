<?php

namespace App\Http\Controllers\Guru;

use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Models\AbsensiBulanan;
use App\Models\AbsensiMingguan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{

    public function index()
    {
        return view('guru');
    }

    public function absenHarianGuru(Request $request)
    {
        // Ambil informasi tingkat dan jurusan dari guru yang login
        $tingkat = Auth::guard('guru')->user()->tingkat;
        $jurusan = Auth::guard('guru')->user()->jurusan;

        // Mulai query builder untuk data absensi sesuai dengan tingkat dan jurusan yang diajar oleh guru
        $query = Absensi::where('tingkat', $tingkat)->where('jurusan', $jurusan);

        // Cek apakah ada parameter pencarian
        if ($request->has('search')) {
            $searchTerm = '%' . $request->search . '%';

            // Tambahkan kondisi pencarian ke query builder
            $query->where(function ($subquery) use ($searchTerm) {
                $subquery->where('ketua_kelas', 'LIKE', $searchTerm)
                    ->orWhere('no_tlp', 'LIKE', $searchTerm)
                    ->orWhere('wali_kelas', 'LIKE', $searchTerm)
                    ->orWhere('tingkat', 'LIKE', $searchTerm)
                    ->orWhere('jurusan', 'LIKE', $searchTerm)
                    ->orWhere('ruang', 'LIKE', $searchTerm)
                    ->orWhere('jumlah_tidak_hadir', 'LIKE', $searchTerm)
                    ->orWhere('siswa_tidak_hadir', 'LIKE', $searchTerm)
                    ->paginate(5);
                // Tambahkan kolom-kolom lain yang ingin Anda cari
            });
        }

        // Lakukan query dan paginasi
        $absensi = $query->paginate(5);

        return view('absen.absen-Guru', ['absensi' => $absensi]);
    }

    public function absenMingguanGuru(Request $request)
    {
        // Ambil informasi tingkat dan jurusan dari guru yang login
        $tingkat = Auth::guard('guru')->user()->tingkat;
        $jurusan = Auth::guard('guru')->user()->jurusan;

        // Mulai query builder untuk data absensi sesuai dengan tingkat dan jurusan yang diajar oleh guru
        $query = AbsensiMingguan::where('tingkat', $tingkat)->where('jurusan', $jurusan);

        // Cek apakah ada parameter pencarian
        if ($request->has('search')) {
            $searchTerm = '%' . $request->search . '%';

            // Tambahkan kondisi pencarian ke query builder
            $query->where(function ($subquery) use ($searchTerm) {
                $subquery->where('ketua_kelas', 'LIKE', $searchTerm)
                    ->orWhere('no_tlp', 'LIKE', $searchTerm)
                    ->orWhere('wali_kelas', 'LIKE', $searchTerm)
                    ->orWhere('tingkat', 'LIKE', $searchTerm)
                    ->orWhere('jurusan', 'LIKE', $searchTerm)
                    ->orWhere('ruang', 'LIKE', $searchTerm)
                    ->orWhere('jumlah_tidak_hadir', 'LIKE', $searchTerm)
                    ->orWhere('siswa_tidak_hadir', 'LIKE', $searchTerm)
                    ->paginate(5);
                // Tambahkan kolom-kolom lain yang ingin Anda cari
            });
        }

        // Lakukan query dan paginasi
        $absensiMingguan = $query->paginate(5);

        return view('absen.absenMingguan-Guru', ['absensiMingguan' => $absensiMingguan]);
    }

    // tampil data absen bulanan dari guru
    public function absenBulananGuru(Request $request)
    {
        // Ambil informasi tingkat dan jurusan dari guru yang login
        $tingkat = Auth::guard('guru')->user()->tingkat;
        $jurusan = Auth::guard('guru')->user()->jurusan;

        // Mulai query builder untuk data absensi sesuai dengan tingkat dan jurusan yang diajar oleh guru
        $query = AbsensiBulanan::where('tingkat', $tingkat)->where('jurusan', $jurusan);

        // Cek apakah ada parameter pencarian
        if ($request->has('search')) {
            $searchTerm = '%' . $request->search . '%';

            // Tambahkan kondisi pencarian ke query builder
            $query->where(function ($subquery) use ($searchTerm) {
                $subquery->where('ketua_kelas', 'LIKE', $searchTerm)
                    ->orWhere('no_tlp', 'LIKE', $searchTerm)
                    ->orWhere('wali_kelas', 'LIKE', $searchTerm)
                    ->orWhere('tingkat', 'LIKE', $searchTerm)
                    ->orWhere('jurusan', 'LIKE', $searchTerm)
                    ->orWhere('ruang', 'LIKE', $searchTerm)
                    ->orWhere('jumlah_tidak_hadir', 'LIKE', $searchTerm)
                    ->orWhere('siswa_tidak_hadir', 'LIKE', $searchTerm)
                    ->paginate(5);
                // Tambahkan kolom-kolom lain yang ingin Anda cari
            });
        }

        // Lakukan query dan paginasi
        $absensiBulanan = $query->paginate(5);

        return view('absen.absenBulanan-Guru', ['absensiBulanan' => $absensiBulanan]);
    }
}