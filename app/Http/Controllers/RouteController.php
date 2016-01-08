<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Busstop;
use App\Route;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return View("routes.index",["routes"=>Route::all(),"title"=>"Route Listings"]);
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
        $validator = Validator::make($request->all(), [
            'name'  =>  'required|min:2',
            'short_name'  =>  'required|min:2',
        ]);
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

        $route = new Route();
        foreach($all_request as $key=>$value){
            $route->$key = $value;
        }
        if($route->save()){
            return response()->json("record saved successfully");
        }
        return View("routes.index",["routes"=>Route::all(),"title"=>"Route Listings"]);
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
        $route = Route::find($id);
        return View("routes.routedetails",["title"=>"Route Details","subtitle"=>$route->name,"thisroute"=>$route,"busstops"=>Busstop::where("route_id",$route->id)->get(),"buses"=>Bus::where("route_id",$route->id)->get()]);
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

        $validator = Validator::make($request->all(), [
            'name'  =>  'required|min:2',
            'short_name'  =>  'required|min:2',
        ]);
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

        $route = Route::find($all_request['id']);
        foreach($all_request as $key=>$value){
            $route->$key = $value;
        }
        if($route->save()){
            return response()->json("record saved successfully");
        }
        return View("routes.index",["routes"=>Route::all(),"title"=>"Route Listings"]);
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
        $route    =   Route::find($id);
        /*$invoice =  DB::table("invoices")->where("company_id","=",$id)->get();

        if(count($invoice)>0){
            return response()->json("This Record cannot be deleted!<br>Bill Transactions is already existing against this company");
            exit;
        }*/
        if($route->delete()){
            Session::flash("success_message","Record Successfully deleted");
            echo "Route Successfully Deleted";
            exit;
        }
    }
    public function getBusStop($id){
        $busstop = Busstop::find($id);

    }
    public function addBusStop(Request $request){
        $input = $request->all();
        array_forget($input,"_token");

        if(isset($input['type']) && $input['type']=='edit'){ // Section to do ajax update of stations on route
            array_forget($input,"type");
            $busstop = Busstop::find($input['id']);

            foreach($input as $key=>$value){
                $busstop->$key = $value;
            }
            if($busstop->save()){
                return response()->json("Record updated successfully");
            }else{
                return response()->json("Unexpected Error! Record could not be Added");
            }
        }else{
            $busstop = new Busstop();

            foreach($input as $key=>$value){
                $busstop->$key = $value;
            }
            if($busstop->save()){
                return response()->json("record saved successfully");
            }else{
                return response()->json("Unexpected Error! Record could not be Added");
            }
        }


    }
}
