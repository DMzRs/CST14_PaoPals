<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CheckExpiredStocks extends Command
{
    protected $signature = 'stocks:check-expired';
    protected $description = 'Automatically mark stocks as expired, log StockOut, and record activity';

    public function handle()
    {
        $today = Carbon::today();

        DB::transaction(function () use ($today) {

            $expiredStocks = StockIn::where('expirationDate', '<', $today)
                ->where('status', '!=', 'Expired')
                ->get();

            $count = 0;

            foreach ($expiredStocks as $stock) {
                $expiredQty = $stock->remainingStock;

                // Create StockOut if there is remaining stock
                if ($expiredQty > 0) {
                    StockOut::create([
                        'stockinId' => $stock->id,
                        'quantity' => $expiredQty,
                        'dateUsed' => Carbon::now(),
                        'cause' => 'Expired',
                    ]);

                    $stock->remainingStock = 0;
                }

                $stock->status = 'Expired';
                $stock->save();

                // Log activity
                ActivityLog::create([
                    'user_id' => null, // system user
                    'action' => 'Stock Expired',
                    'description' => "StockIn ID {$stock->id} marked expired. Quantity affected: {$expiredQty}.",
                    'module' => 'Inventory',
                    'record_id' => $stock->id,
                    'ip_address' => null, // optional
                    'user_agent' => 'System Cron Job',
                ]);

                $count++;
            }

            $this->info("{$count} stock items marked as expired, logged in StockOut, and recorded in ActivityLog.");
        });

        return Command::SUCCESS;
    }
}