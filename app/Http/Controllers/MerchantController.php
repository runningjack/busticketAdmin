<?php

namespace App\Http\Controllers;

use App\Account;
use App\Busstop;
use App\Merchant;
use App\Route;
use App\Ticket;
use App\Ticketstack;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return View("merchants.index",["merchants"=>Merchant::all(),"title"=>"Merchant"]);
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
        $rules = [
            'c_fname'  =>  'required|min:2',
            'c_lname'  =>  'required|min:2',
            'address'  =>  'required|min:2',
            'city'  =>  'required|min:2',
            'sate'  =>  'required|min:2',
            'phone'  =>  'required|min:2|unique:merchants',
            'email'  =>  'required|min:5|unique:merchants',
        ];
        $messages =[

        ];
        $validator = Validator::make($request->all(), [
            'c_fname'  =>  'required|min:2',
            'c_lname'  =>  'required|min:2',
            'address'  =>  'required|min:2',
            'city'  =>  'required|min:2',
            'state'  =>  'required|min:2',
            'phone'  =>  'required|min:2|unique:merchants',

        ]);
        $validator->setAttributeNames(['c_fname'=>"Contcat First Name","c_lname"=>"Contact Last Name"]);
        //$validator->setAttributeName()
        if ($validator->fails()) {
            if($request->ajax()){
                return response()->json($validator->messages());
            }else{
                return \Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $all_request = $request->all();
        array_forget($all_request,"_token");
        $mid = Merchant::uniqueID()+1;
        $merchant = new Merchant();
        foreach($all_request as $key=>$value){
            $merchant->$key = $value;
        }
        $merchant->merch_id = $mid;

        if($merchant->save()){
            return response()->json("record saved successfully");
        }
        return View("merchants.index",["merchants"=>Merchant::all(),"title"=>"Merchant"]);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
        $merchant = Merchant::find($id);
        /*$mybuses = DB::table('accounts')
            ->join('merchants', 'merchants.id', '=', 'accounts.merchant_id')
            ->join('busstops', 'accounts.station_id', '=', 'busstops.id')
            ->select('busstops.*', 'accounts.id','accounts.balance')->where("merchants.id","=","accounts.merchant_id")
            ->get();*/

        $mybuses = DB::table('accounts')
            ->join('busstops', function ($join) use ($id) {
                $join->on('accounts.station_id', '=', 'busstops.id')
                    ->where('accounts.merchant_id', '=', $id);
            })->get();
        return View("merchants.merchantdetails",["title"=>"Merchant Details","subtitle"=>$merchant->c_fname,"merchant"=>$merchant,"busstops"=>Busstop::all(),"mybusstops"=>$mybuses]);
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

    public function addBusStop(Request $request,$id){
        $input = $request->all();
        $agent   = Merchant::find($id);

        if(isset($input['type']) && ($input['type']=='genticket')){
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
            //$input = $request->all();
            $stack = new Ticketstack();
            $stack->batch_code = Ticket::stackCode();
            $stack->created_at = date("Y-m-d H:i:s");

            $stack->save();
            $ticket            = new Ticket();
            $terminal          = Busstop::where("id","=",trim($input['terminal_id']))->first();
            $count             = $input['qty'];
            $account = Account::where("app_id","=",$input['app_id'])->first();

            for($k=1; $k<=$count; $k++){
                $time = time();

                DB::table('ticketseed')->insert(['code' => $time]);
                $mid = DB::table("ticketseed")->max("id");
                //$amount   =  ($input['ticket_type'] == 1) ? $terminal->one_way_to_fare : $terminal->one_way_from_fare ;
                $amount = 1000;
                Ticket::insert(array("code"=>$ticket->ticketCode($mid),"account_id"=>$account->id,"app_id"=>$input['app_id'],"agent_id"=>$id,"serial_no"=>$ticket->uniqueID($mid),"terminal_id"=>$terminal->id,
                    "stack_id"=>$stack->id,"route_id"=>$input['route_id'],"amount"=>$amount,"ticket_type"=>$input['ticket_type']));

            }

            $account->balance   += $amount * $input['qty'];
            $agent->balance     += $amount * $input['qty'];
            $account->update();
            $agent->update();
        }else{

            $account = new Account();
            $mid = Account::uniqueID()+1;
            $terminal_id = DB::table("busstops")->where("short_name","=",$input['short_name'])->pluck("id");
            $account->merchant_id = $input['merchant_id'];
            $account->busstop_id = $terminal_id;

            $m = $account->merchant_id + $mid;
            $realid =uniqid($m);
            $realid = substr($realid,-1,5);
            $realid = $realid.str_pad($mid,5,0,STR_PAD_LEFT);
            $account->account_id = uniqid($m);
            if($account->save()){
                return response()->json("record saved successfully");
            }

        }
    }

    public function routeAutocomplete($name){
        $routes = DB::table("busstops")->where("short_name","LIKE","%".$name."%")->orWhere("name","LIKE","%".$name."%")->pluck("short_name");
        return json_encode($routes);
    }


}
