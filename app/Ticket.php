<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class Ticket extends Model
{
    //



    protected $fillable = ['code', 'serial_no', 'terminal_id','route_id','stack_id','ticket_type','amount'];
    public function uniqueID($mid){
        return str_pad($mid,15,0,STR_PAD_LEFT);
    }

    public function ticketCode($mid){
        return uniqid($mid);
    }

    public static function stackCode(){
        $time = time();

        DB::table('ticketseed')->insert(
            ['code' => $time]);
        $mid = DB::table("ticketseed")->max("id");
        return uniqid($mid);
    }
}
