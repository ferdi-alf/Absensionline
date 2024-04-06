<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\AbsensiBulanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AbsensiBulananXIIChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $bulan = Carbon::now()->format('m-Y');

        // Ambil data jumlah tidak hadir dari tingkat X di AbsensiBulanan
        $dataJumlahTidakHadir = AbsensiBulanan::where('tingkat', 'XII')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('jurusan') // Groupping berdasarkan jurusan
            ->select('jurusan', DB::raw('sum(jumlah_tidak_hadir) as total_tidak_hadir'))
            ->pluck('total_tidak_hadir', 'jurusan'); // Pluck data total tidak hadir berdasarkan jurusan

        Artisan::call('refresh:data-bulanan');

        return $this->chart->barChart()
            ->setTitle('Diagram Data ABsen Bulan ' . $bulan . '')
            ->setSubtitle('Data Diagram Tingkat XII')
            ->addData('jumlah tidak hadir', $dataJumlahTidakHadir->values()->toArray())
            ->setLabels($dataJumlahTidakHadir->keys()->toArray())
            ->setHeight(300);
    }
}
