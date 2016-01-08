<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Account extends Model
{
    //
    public static function uniqueID(){
        return DB::table("accounts")->max("id");
    }
}
