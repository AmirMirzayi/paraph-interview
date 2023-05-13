<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class Logger
{
    public static function Send($data){
        Http::post(config('app.paraf_logger_url'),[
            "message"  => "interview project",
            "datetime" => Carbon::now(),
            "data"     => $data
        ]);
    }
}
