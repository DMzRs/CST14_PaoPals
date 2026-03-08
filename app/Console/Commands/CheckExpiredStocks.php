<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StockIn;
use Carbon\Carbon;

class CheckExpiredStocks extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'stocks:check-expired';

    /**
     * The console command description.
     */
    protected $description = 'Automatically mark stocks as expired when expiration date has passed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        $updated = StockIn::where('expirationDate', '<', $today)
            ->where('status', '!=', 'Expired')
            ->update(['status' => 'Expired']);

        $this->info("{$updated} stock items marked as expired.");

        return Command::SUCCESS;
    }
}