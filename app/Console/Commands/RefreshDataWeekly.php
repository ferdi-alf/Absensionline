<?php

namespace App\Console\Commands;


use App\Models\AbsensiMingguan;
use Illuminate\Console\Command;

class RefreshDataMingguan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:data-mingguan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh data absensi mingguan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Logika untuk menghapus data absensi yang lebih tua dari satu minggu
        AbsensiMingguan::where('created_at', '<', now()->subWeek())->delete();

        // Informasi log
        $this->info('Data absensi mingguan berhasil diperbarui.');
    }
}
