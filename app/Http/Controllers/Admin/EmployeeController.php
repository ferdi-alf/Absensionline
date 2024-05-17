<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Employee;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Exports\AbsensiExport;
use App\Models\AbsensiBulanan;
use App\Models\AbsensiMingguan;
use App\Charts\AbsensiBulananChart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Charts\AbsensiBulananXIChart;
use App\Exports\AbsensiBulananExport;
use App\Charts\AbsensiBulananXIIChart;
use App\Exports\AbsensiMingguanExport;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;



class EmployeeController extends Controller
{

    function timezone()
    {
        $localTime = now()->setTimezone(Config::get('app.timezone'));
        echo 'sukses',  $localTime;
    }

    // untuk tampil ke halaman admin
    public function index()
    {
        $startOfDay = now()->startOfDay();
        $endOfDay = now()->endOfDay();
        $totalAbsenHariIni = Absensi::whereBetween('created_at', [$startOfDay, $endOfDay])->count();

        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
        $totalAbsenBulanIni = AbsensiBulanan::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
        $totalAbsenMingguIni = AbsensiMingguan::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        $totalHakAksesAdmin = User::count();
        $totalHakAksesGuru = Employee::count();

        $time = Carbon::now();
        $existingData = Absensi::whereDate('created_at', $time)
            ->select('tingkat', 'jurusan')
            ->get()
            ->toArray();



        $allCombinasi = [];
        $tingkatList = ['X', 'XI', 'XII'];
        $jurusanList = [
            'DPIB 1', 'DPIB 2', 'TP 1', 'TP 2', 'TP 3', 'TKR 1', 'TKR 2', 'TKR 3', 'TKR Industri',
            'TSM 1', 'TSM 2', 'TAV 1', 'TAV 2', 'TAV 3', 'TITL 1', 'TITL 2', 'TITL 3', 'TITL 4', 'TITL Industri',
            'TKJ 1', 'TKJ 2', 'TKJ 3', 'TKJ ACP', 'RPL'
        ];

        foreach ($tingkatList as $tingkat) {
            foreach ($jurusanList as $jurusan) {
                $allCombinasi[] = ['tingkat' => $tingkat, 'jurusan' => $jurusan];
            }
        }

        $missingData = array_filter($allCombinasi, function ($combinasi) use ($existingData) {
            foreach ($existingData as $data) {
                if ($data['tingkat'] === $combinasi['tingkat'] && $data['jurusan'] === $combinasi['jurusan']) {
                    return false;
                }
            }
            return true;
        });

        $totalMissing = count($missingData);

        Artisan::call('refresh:data-bulanan');
        Artisan::call('refresh:data-harian');
        return view('admin', compact('totalAbsenHariIni', 'totalAbsenBulanIni', 'totalAbsenMingguIni', 'totalHakAksesAdmin', 'totalHakAksesGuru', 'missingData', 'totalMissing'));
    }
    public function absensiHari(Request $request)
    {
        // Ambil data absensi untuk hari ini
        $startOfDay = now()->startOfDay();
        $endOfDay = now()->endOfDay();

        if ($request->has('search')) {
            $searchTerm = '%' . $request->search . '%';

            $absenhari = Absensi::whereBetween('created_at', [$startOfDay, $endOfDay])
                ->where(function ($query) use ($searchTerm) {
                    $query->where('ketua_kelas', 'LIKE', $searchTerm)
                        ->orWhere('no_tlp', 'LIKE', $searchTerm)
                        ->orWhere('wali_kelas', 'LIKE', $searchTerm)
                        ->orWhere('tingkat', 'LIKE', $searchTerm)
                        ->orWhere('jurusan', 'LIKE', $searchTerm)
                        ->orWhere('ruang', 'LIKE', $searchTerm)
                        ->orWhere('jumlah_tidak_hadir', 'LIKE', $searchTerm)
                        ->orWhere('siswa_tidak_hadir', 'LIKE', $searchTerm);
                })
                ->paginate(10);
        } else {
            $absenhari = Absensi::whereBetween('created_at', [$startOfDay, $endOfDay])->paginate(10);
        }

        // Refresh data absensi harian
        Artisan::call('refresh:data-harian');

        return view('absen.absen', compact('absenhari'));
    }

    // menampilkan data asben berdasarkan minggu ini
    public function absensiMingguIni(Request $request)
    {
        // Ambil data absensi untuk minggu ini
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        if ($request->has('search')) {
            $searchTerm = '%' . $request->search . '%';

            $absenMingguan = AbsensiMingguan::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                ->where(function ($query) use ($searchTerm) {
                    $query->where('ketua_kelas', 'LIKE', $searchTerm)
                        ->orWhere('no_tlp', 'LIKE', $searchTerm)
                        ->orWhere('wali_kelas', 'LIKE', $searchTerm)
                        ->orWhere('tingkat', 'LIKE', $searchTerm)
                        ->orWhere('jurusan', 'LIKE', $searchTerm)
                        ->orWhere('ruang', 'LIKE', $searchTerm)
                        ->orWhere('jumlah_tidak_hadir', 'LIKE', $searchTerm)
                        ->orWhere('siswa_tidak_hadir', 'LIKE', $searchTerm);
                })
                ->paginate(10);
        } else {
            $absenMingguan = AbsensiMingguan::whereBetween('created_at', [$startOfWeek, $endOfWeek])->paginate(10);
        }

        // Refresh data absensi mingguan
        Artisan::call('refresh:data-mingguan');

        return view('absen.absenMinggu', compact('absenMingguan'));
    }

    // menampilkan data asben berdasarkan bulan ini 
    public function absensiBulanIni(Request $request)
    {
        // Ambil data absensi untuk bulan ini
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        if ($request->has('search')) {
            $searchTerm = '%' . $request->search . '%';

            $absenBulanan = AbsensiBulanan::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->where(function ($query) use ($searchTerm) {
                    $query->where('ketua_kelas', 'LIKE', $searchTerm)
                        ->orWhere('no_tlp', 'LIKE', $searchTerm)
                        ->orWhere('wali_kelas', 'LIKE', $searchTerm)
                        ->orWhere('tingkat', 'LIKE', $searchTerm)
                        ->orWhere('jurusan', 'LIKE', $searchTerm)
                        ->orWhere('ruang', 'LIKE', $searchTerm)
                        ->orWhere('jumlah_tidak_hadir', 'LIKE', $searchTerm)
                        ->orWhere('siswa_tidak_hadir', 'LIKE', $searchTerm);
                })
                ->paginate(10);
        } else {
            $absenBulanan = AbsensiBulanan::whereBetween('created_at', [$startOfMonth, $endOfMonth])->paginate(10);
        }

        // Refresh data absensi bulanan
        Artisan::call('refresh:data-bulanan');

        return view('absen.dataAbsensiBulanan', compact('absenBulanan'));
    }



    // CRUD Guru
    // tentang tambah data
    // menampilkan form tambah data
    public function aksesGuru()
    {
        $data = Employee::all();
        return view('hakaksesGuru', compact('data'));
    }
    public function tambahdata()
    {
        return view('tambahdata');
    }

    // request POST tambah data ke database
    public function insertdata(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'tingkat' => 'required|in:X,XI,XII',
            'jurusan' => 'required|in:DPIB 1,DPIB 2,TP 1,TP 2,TP 3,TKR 1,TKR 2,TKR 3,TSM 1,TSM 2,TSM 3,TAV 1,TAV 2,TAV 3,TITL 1,TITL 2,TITL 3,TITL 4,TKJ 1,TKJ 2,TKJ 3,TKJ 4,RPL',
            'password' => ['required', 'min:6'],
        ], [
            'nama.required' => 'Nama Wajib Di isi',
            'username.required' => 'Username Wajib Di isi',
            'tingkat.required' => 'Tingkat Wajib Di pilih',
            'jurusan.required' => 'jurusan Wajib Di Pilih',
            'password.required' => 'pasword Wajib Di isi',
            'password.min' => 'pengisian password harus lebih dari 6 Karakter',
        ]);
        $data = Employee::create($request->all());
        return redirect()->route('aksesGuru')->with('success', 'Berhasil Menambahkan Data');
    }
    // end sesi tambah


    // tentang update data
    // menampilkan data yang akan di update
    public function tampildata($id)
    {
        $data = Employee::find($id);
        // dd($data);
        return view('tampildata', compact('data'));
    }

    // request POST update data
    public function updatedata(Request $request, $id)
    {
        $data = Employee::find($id);
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'tingkat' => 'required|in:X,XI,XII',
            'jurusan' => 'required|in:DPIB 1,DPIB 2,TP 1,TP 2,TP 3,TKR 1,TKR 2,TKR 3,TSM 1,TSM 2,TSM 3,TAV 1,TAV 2,TAV 3,TITL 1,TITL 2,TITL 3,TITL 4,TKJ 1,TKJ 2,TKJ 3,TKJ 4,RPL',
            'password' => $request->filled('password') ? 'min:6' : '',
        ], [
            'password.min' => 'pengisian password harus lebih dari 6 huruf atau angka',
        ]);

        // Buat array data untuk diupdate, tanpa kolom 'password' jika tidak diisi
        $updateData = $request->filled('password')
            ? $request->all()
            : $request->except('password');

        // Update data berdasarkan input yang diberikan
        $data->update($updateData);
        return redirect()->route('aksesGuru')->with('success', 'Berhasil update data');
    }
    // end sesi update


    // tentang hapus data
    // delete/hapus data
    public function deleteGuru($id)
    {
        $employee = new Employee();
        $employee->deleteGuru($id);
        return redirect()->route('aksesGuru')->with('success', 'Berhasil Menambahkan Data');
    }
    // end sesi delete
    // end CRUD Guru


    // CRUD Admin
    public function aksesAdmin()
    {
        $admin = User::all();
        return view('hakaksesAdmin', compact('admin'));
    }
    // get halaman tambah akses admin
    public function tambahdataAdmin()
    {
        return view('tambahdata-Admin');
    }
    // request post menambah data admin
    public function insertdataAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required|in:admin,guru piket',
            'password' => ['required', 'min:8'],
        ], [
            'name.required' => 'Username wajib diisi',
            'role.required' => 'role harus di pilih',
            'role.in' => 'role hanya bisa berisi admin atau guru piket',
            'password.required' => 'Password wajib di isi',
            'password.min' => 'Password harus berisi setidaknya 8 karakter'
        ]);
        $admin = User::create($request->all());
        return redirect()->route('aksesAdmin')->with('success', 'Berhasil menambah data Admin');
    }


    // menampilkan data yang akan di update berdasarkan id
    public function tampildataAdmin($id)
    {
        $admin = User::find($id);
        return view('tampildata-Admin', compact('admin'));
    }

    public function updatetdataAdmin(Request $request, $id)
    {
        $admin = User::find($id);
        //validasi input admin
        $request->validate([
            'name' => 'required',
            'password' => $request->filled('password') ? 'min:8' : '',
        ], [
            'password.min' => 'password harus di isi setidaknya 8 karakter',
        ]);

        $updateDataAdmin = $request->filled('password')
            ? $request->all()
            : $request->except('password');

        $admin->update($updateDataAdmin);
        return redirect()->route('aksesAdmin')->with('success', 'Berhasil Update Data');
    }

    // delete hak akses admin
    public function deleteAdmin($id)
    {
        $user = new User();
        $user->deleteAdmin($id);
        return redirect()->route('aksesAdmin')->with('success', 'Berhasil Hapus Data');
    }
    // End CRUD Admin

    // tentang export Pdf,Exce
    // export data pdf harian
    public function exportpdf()
    {
        $absenhari = Absensi::all();
        view()->share('absenhari', $absenhari);
        $pdf =  FacadePdf::loadview('dataAbsensi-pdf')->setPaper('A3', 'landscape');
        $dateToday = Carbon::now()->format('d-m-Y');
        $namafilepdf = 'data-absensi(' . $dateToday . ').pdf';
        return $pdf->download($namafilepdf);
    }

    // export data pdf mingguan
    public function exportpdfMingguan()
    {
        $absenMingguan = AbsensiMingguan::all();
        view()->share('absenMingguan', $absenMingguan);

        $pdf =  FacadePdf::loadview('dataAbsensiMinggu-pdf')->setPaper('A3', 'landscape');
        $namafilepdf = 'data-absensi-mingguan.pdf';

        return $pdf->download($namafilepdf);
    }

    // export data pdf bulanan
    public function exportpdfBulanan()
    {
        $absensibulanan = AbsensiBulanan::all();
        view()->share('absensibulanan', $absensibulanan);

        $pdf =  FacadePdf::loadview('dataAbsensiBulanan-pdf')->setPaper('A3', 'landscape');
        $dateToday = Carbon::now()->format('m-Y');
        $namafilepdf = 'dataAbsen-Bulan(' . $dateToday . ').pdf';
        return $pdf->download($namafilepdf);
    }

    public function exportexcel()
    {
        $dateToday = Carbon::now()->format('d-m-Y');
        $namafile = 'data-absensi(' . $dateToday . ').xlsx';

        return Excel::download(new AbsensiExport, $namafile);
    }

    public function exportexcelMingguan()
    {
        $namefile = 'data-absensi-mingguan.xlsx';
        return Excel::download(new AbsensiMingguanExport, $namefile);
    }

    public function exportexcelBulanan()
    {
        $dateToday = Carbon::now()->format('m-Y');
        $namefile = 'data-Absensi-Bulan(' . $dateToday . ').xlsx';

        return Excel::download(new AbsensiBulananExport, $namefile);
    }
    // end sesi export Pdf, Excel

    // sesi diagram data
    public function diagramDataX(AbsensiBulananChart $chart)
    {
        $data['chart'] = $chart->build();
        return view('chart.dataChart-X', $data);
    }

    public function diagramDataXI(AbsensiBulananXIChart $chart)
    {
        $data['chart'] = $chart->build();
        return view('chart.dataChart-XI', $data);
    }

    public function diagramDataXII(AbsensiBulananXIIChart $chart)
    {
        $data['chart'] = $chart->build();
        return view('chart.dataChart-XII', $data);
    }
    // end sei diagram data
}