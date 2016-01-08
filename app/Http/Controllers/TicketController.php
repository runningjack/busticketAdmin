<?php

namespace App\Http\Controllers;

use App\Busstop;
use App\Ticket;
use App\Ticketstack;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return View("tickets.index",["title"=>"Ticket Generator","stacks"=>Ticketstack::all(),"busstops"=>Busstop::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validator = Validator::make($request->all(),
            ["terminal_id"=>"required","ticket_type"=>"required"]
        );

        if ($validator->fails()) {
            if($request->ajax()){
                return response()->json($validator->messages());
            }else{
                return \Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $input = $request->all();
        $stack = new Ticketstack();
        $stack->batch_code = Ticket::stackCode();
        $stack->created_at = date("Y-m-d H:i:s");

        $stack->save();
        $ticket = new Ticket();
        $terminal           = Busstop::where("short_name","=",trim($input['terminal_id']))->first();
        $count = $input['qty'];
        for($k=1; $k<=$count; $k++){
            $time = time();
            DB::table('ticketseed')->insert(
                ['code' => $time]);
            $mid = DB::table("ticketseed")->max("id");
            $amount   =  ($input['ticket_type'] == 1) ? $terminal->one_way_to_fare : $terminal->one_way_from_fare ;
            Ticket::insert(array("code"=>$ticket->ticketCode($mid),"serial_no"=>$ticket->uniqueID($mid),"terminal_id"=>$terminal->id,
                "stack_id"=>$stack->id,"route_id"=>$terminal->id,"amount"=>$amount,"ticket_type"=>$input['ticket_type']));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
