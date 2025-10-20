<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Loan;
use Carbon\Carbon;

class ResetWeeklyLoans extends Command
{
    protected $signature = 'loans:reset-weekly';
    protected $description = 'Reset pinjaman aktif yang sudah lebih dari 7 hari dan update stock buku';

    public function handle()
    {
        $expiredLoans = Loan::where('status', 'active')
            ->where('created_at', '<', Carbon::now()->subDays(7))
            ->get();

        foreach ($expiredLoans as $loan) {
            $loan->status = 'expired'; // tandai expired
            $loan->save();

            // Tambah stock buku kembali
            if($loan->book) {
                $loan->book->increment('stock');
            }
        }

        $this->info('Pinjaman mingguan berhasil direset!');
    }
}
