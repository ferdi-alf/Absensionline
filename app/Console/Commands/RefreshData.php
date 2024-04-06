<?php

namespace App\Console\Commands;

use App\Models\Absensi;
use Illuminate\Console\Command;

class RefreshDataHarian extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:data-harian';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh data absensi harian';

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
        // Logika untuk menghapus data absensi yang dibuat sebelum pukul 00:00 WIB
        Absensi::where('created_at', '<', now('Asia/Jakarta')->startOfDay())->delete();

        // Informasi log
        $this->info('Data absensi harian berhasil diperbarui.');
    }
}
