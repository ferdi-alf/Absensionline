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

        try {
            // Simpan ke tabel absensi
            Absensi::create($request->all());

            // Simpan ke tabel absensi_mingguans
            AbsensiMingguan::create($request->all());

            // Simpan data absen ke tabel absensi_bulanans
            AbsensiBulanan::create($request->all());

            DB::commit();

            return redirect()->route('absen')->with('sukses', 'Data absen berhasil dikirim.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Jika terjadi kesalahan, berikan pesan kesalahan atau lakukan tindakan lain sesuai kebutuhan
            return back()->with('error', 'Gagal menyimpan data absen. Silakan coba lagi.');
        }
    }
}
