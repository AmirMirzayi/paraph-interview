<?php

namespace App\Jobs;

use App\Services\Logger;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessStockData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $success_count = $error_count = 0;
        foreach ($this->data as $row) {
            if (!isset($row[2]) || is_null($row[2]) || !is_numeric($row[2])) // check if is empty or title definition then pass
                continue;

            try {
                DB::collection('trading_stocks')
                    ->where('name', $row[0])
                    ->where('title', $row[1])
                    ->update([
                        '$push' => [
                            'quota' => [
                                'count' => $row[2],
                                'volume' => $row[3],
                                'value' => $row[4],
                                'yesterday' => $row[5],
                                'first' => $row[6],
                                'last_trade_amount' => $row[7],
                                'last_trade_change' => $row[8],
                                'last_trade_percent' => $row[9],
                                'closed_price' => $row[10],
                                'closed_change' => $row[11],
                                'closed_percent' => $row[12],
                                'lowest' => $row[13],
                                'highest' => $row[14],
                                'trade_date' => $row[15],
                            ],
                        ]
                    ], ['upsert' => true]);
                $success_count++;
            } catch (\Exception $ex) {
                $error_count++;
                continue;
            }
            $log = array("Successfully inserted" => $success_count, "Error at insert" => $error_count);
            Logger::Send($log);
        }
    }
}
