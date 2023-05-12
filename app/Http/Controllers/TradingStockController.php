<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessStockData;
use App\Models\TradingStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class TradingStockController extends Controller
{
    public function __invoke()
    {
//        DB::collection('users')
//            ->where('name', 'dude')
//            ->update([
//                '$push' => [
//                    'activity' => 'nothing',
//                    'job' => 'interview'
//                ]
//            ], ['upsert' => true]);
////
//


//        $content = file_get_contents('https://quiz.paraf.app/job/ws9h5q2af1lwrcl1.xlsx');

//        Storage::disk('local')->put('gg.xlsx',$content);


        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        try {
            $spreadsheet = $reader->load(storage_path('app/gg.xlsx'));
            $g = $spreadsheet->getSheet(0)->toArray();
        } catch (Exception $ex) {
            dd('catch it'); // if Excel file is not correct then bring back to previous page
        }

        ProcessStockData::dispatch($g);

        return response()->json(TradingStock::all());

    }
}
