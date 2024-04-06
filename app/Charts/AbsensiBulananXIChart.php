<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\AbsensiBulanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AbsensiBulananXIChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $startOfMont = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $bulan = Carbon::now()->format('m-Y');

        // Ambil data jumlah tidak hadir dari tingkat X di AbsensiBulanan
        $dataJumlahTidakHadir = AbsensiBulanan::where('tingkat', 'XI')
            ->whereBetween('created_at', [$startOfMont, $endOfMonth])
            ->groupBy('jurusan') // Groupping berdasarkan jurusan
            ->select('jurusan', DB::raw('sum(jumlah_tidak_hadir) as total_tidak_hadir'))
            ->pluck('total_tidak_hadir', 'jurusan'); // Pluck data total tidak hadir berdasarkan jurusan

        Artisan::call('refresh:data-bulanan');

        return $this->chart->barChart()
            ->setTitle('Diagram Data Absen Bulan ' . $bulan . '')
            ->setSubtitle('Data Diagram Tingkat XI')
            ->addData('Jumlah Tidak Hadir', $dataJumlahTidakHadir->values()->toArray()) // Convert collection to array
            ->setLabels($dataJumlahTidakHadir->keys()->toArray()) // Convert collection to array
            ->setHeight(300);
    }
}
