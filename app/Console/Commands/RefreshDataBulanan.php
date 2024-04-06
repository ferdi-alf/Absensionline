<?php

namespace App\Console\Commands;

use App\Models\AbsensiBulanan;
use Illuminate\Console\Command;

class RefreshDataBulanan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:data-bulanan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'command merefresh data bulanan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Logika untuk menghapus data absensi yang lebih tua dari satu bulan
        AbsensiBulanan::where('created_at', '<', now()->subMonth())->delete();

        // Informasi log
        $this->info('Data absensi bulanan berhasil diperbarui.');
    }
}
