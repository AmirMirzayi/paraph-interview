<?php

namespace App\Http\Controllers;

use App\Classes\SheetReaderFactory;
use App\Http\Requests\ExcelFileURLRequest;
use App\Http\Requests\ManualDataRequest;
use App\Jobs\ProcessStockData;
use App\Models\TradingStock;
use App\Repositories\StockQuotaRepository;
use App\Services\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Exception as ExcelException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class TradingStockController extends Controller
{
    public function __invoke(ExcelFileURLRequest $request)
    {
        $file_type = strtolower(pathinfo($request->excel_url, PATHINFO_EXTENSION));
        $reader = SheetReaderFactory::Build($file_type);

        if (is_null($reader))
            return back()->withErrors("امکان باز کردن فایل $file_type نیست."); // no reader for this file extension

        try { // download and store file
            $content = file_get_contents($request->excel_url);
            Storage::disk('local')->put("temp.$file_type", $content);
        } catch (\Exception $ex) {
            return back()->withErrors('خطا در دریافت یا ذخیره سازی فایل.'); // if network failure or file write permission denied
        }

        try {
            $spreadsheet = $reader->load(storage_path("app/temp.$file_type"));
            $sheet = $spreadsheet->getSheet(0)->toArray();
            Storage::disk('local')->delete("temp.$file_type");
        } catch (ExcelException $ex) { // if Excel file is not correct then bring back to previous page
            return back()->withErrors('فایل اکسل خراب است. قادر به واکشی اطلاعات نیستیم.');
        }
        StockQuotaRepository::Flush();
        ProcessStockData::dispatch($sheet); // put sheet on data process queue
        return back()->with('success', 'فایل دریافت شد و در صف پردازش اطلاعات قرار گرفت.');
    }

    public function index()
    {
        $data = StockQuotaRepository::Get();
        return view('stock_data', ['data' => $data]);
    }

    public function chart($id)
    {
        $data = StockQuotaRepository::Find($id);
        return view('stock_chart', ['data' => $data]);
    }

    public function manual(ManualDataRequest $request)
    {
        StockQuotaRepository::Flush();
        $item = TradingStock::find($request->id);
        $item->push('quota', $request->except(['_token', 'id']));
        return back()->with('success', 'ثبت اطلاعات معاملات صورت گرفت.');
    }

    public function trash(Request $request)
    {
        StockQuotaRepository::Flush();
        DB::collection('trading_stocks')
            ->where('_id', $request->id)
            ->update([
                '$pull' => [
                    'quota' => [
                        'trade_date' => $request->date
                    ]
                ]
            ]);
        return back()->with('success', 'حذف شد.');
    }

    public function update(ManualDataRequest $request)
    {
        StockQuotaRepository::Flush();
        DB::collection('trading_stocks')
            ->where('_id', $request->id)
            ->where('quota.trade_date', $request->date)
            ->update([
                '$set' => [
                    'quota.$' => [
                        'count' => $request->count,
                        'volume' => $request->volume,
                        'value' => $request->value,
                        'yesterday' => $request->yesterday,
                        'first' => $request->first,
                        'last_trade_amount' => $request->last_trade_amount,
                        'last_trade_change' => $request->last_trade_change,
                        'last_trade_percent' => $request->last_trade_percent,
                        'closed_price' => $request->closed_price,
                        'closed_change' => $request->closed_change,
                        'closed_percent' => $request->closed_percent,
                        'lowest' => $request->lowest,
                        'highest' => $request->highest,
                        'trade_date' => $request->trade_date
                    ]
                ]
            ]);
        $log = array("quota_change_values" => $request->except('_token'));
        Logger::Send($log);
        return redirect('data');
    }

    public function edit(Request $request)
    {
        return view('update', ['data' => $request->all()]);
    }
}
