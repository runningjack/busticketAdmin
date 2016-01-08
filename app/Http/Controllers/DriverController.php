<?php

namespace App\Http\Controllers;

use App\Driver;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return View("drivers.index",["drivers"=>Driver::all(),"title"=>"Drivers' Listing"]);
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
            'firstname'  =>  'required|min:2',
            'lastname'  =>  'required|min:2',
            'middlename'  =>  'required|min:2',
            'email' =>  'required|min:5|unique:drivers',
            'phone' =>  'required|min:5|unique:drivers'
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

        $driver = new Driver();
        foreach($all_request as $key=>$value){
            $driver->$key = $value;
        }
        if($driver->save()){
            return response()->json("record saved successfully");
        }
        return View("drivers.index",["drivers"=>Driver::all(),"title"=>"Drivers' Listing"]);
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
