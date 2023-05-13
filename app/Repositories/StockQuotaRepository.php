<?php

namespace App\Repositories;

use App\Models\TradingStock;
use Illuminate\Support\Facades\Cache;

class StockQuotaRepository
{
    public static function Get()
    {
        return Cache::remember("stock_quota", 6000, fn() => TradingStock::all());
    }

    public static function Flush()
    {
        Cache::forget("stock_quota");
    }

    public static function Find($id)
    {
        $data = self::Get();
        return $data->find($id);
    }
}
