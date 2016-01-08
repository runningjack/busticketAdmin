<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Merchant extends Model
{
    //
    public static function uniqueID(){
        return DB::table("merchants")->max("id");
    }
}
