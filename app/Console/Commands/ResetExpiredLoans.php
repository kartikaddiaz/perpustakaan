<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Loan;
use Carbon\Carbon;

class ResetExpiredLoans extends Command
{
    protected $signature = 'loans:reset-expired';
    protected $description = 'Hapus pinjaman yang sudah lebih dari 7 hari';

    public function handle()
    {
        $expiredCount = Loan::where('created_at', '<', Carbon::now()->subDays(7))->delete();

        $this->info("Berhasil menghapus {$expiredCount} pinjaman yang sudah kadaluarsa.");
    }
}
