<?php

namespace App\Charts;


use Carbon\Carbon;
use App\Models\AbsensiBulanan;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AbsensiBulananChart
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
        $dataJumlahTidakHadir = AbsensiBulanan::where('tingkat', 'X')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('jurusan') // Groupping berdasarkan jurusan
            ->select('jurusan', DB::raw('sum(jumlah_tidak_hadir) as total_tidak_hadir'))
            ->pluck('total_tidak_hadir', 'jurusan'); // Pluck data total tidak hadir berdasarkan jurusan

        return $this->chart->barChart()
            ->setTitle('Diagram Data Absen Bulan ' . $bulan . '')
            ->setSubtitle('Data Diagram Tingkat X')
            ->addData('Jumlah Tidak Hadir', $dataJumlahTidakHadir->values()->toArray()) // Convert collection to array
            ->setLabels($dataJumlahTidakHadir->keys()->toArray()) // Convert collection to array
            ->setHeight(300);
    }
}
