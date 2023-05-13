<?php

namespace App\Services;

use App\Jobs\SendLog;

class Logger
{
    public static function Send($data){
        SendLog::dispatch($data);
    }
}
