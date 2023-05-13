<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'App\Http\Controllers'],function () {
    Route::post("load_excel","TradingStockController")->name("load_excel");
    Route::get("data","TradingStockController@index")->name("data");
    Route::get("chart/{id}","TradingStockController@chart")->name("chart");
    Route::post("manual","TradingStockController@manual")->name("manual");
    Route::post("trash","TradingStockController@trash")->name("delete_details");
    Route::post("update","TradingStockController@update");
    Route::get("edit","TradingStockController@edit");
});
