<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class TradingStock extends Model
{
//    use HasFactory;
    protected $connection = 'mongodb';


    protected $fillable =[
      'id','title'
    ];
}
