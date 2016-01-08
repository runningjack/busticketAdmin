<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Route;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return View("buses.index",["buses"=>Bus::all(),"title"=>"Buses' Listing","routes"=>Route::all()]);
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

        $input = $request->all();
        array_forget($input,"_token");
        if(isset($input['type']) && $input['type']=='edit'){
            $validator = Validator::make($request->all(), [
                'name'  =>  'required|min:2',
                'model'  =>  'required|min:2',
                'plate_no'  =>  'required|min:2',
                'chases_no' =>  'required|min:5',

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
            array_forget($input,"type");
            $bus = Bus::find($input['id']);
            foreach($input as $key=>$value){
                $bus->$key = $value;
            }
            if($bus->update()){
                return response()->json("record update successfully");
            }
        }else{

            $validator = Validator::make($request->all(), [
                'name'  =>  'required|min:2',
                'model'  =>  'required|min:2',
                'plate_no'  =>  'required|min:2',
                'chases_no' =>  'required|min:5|unique:buses',

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
            $bus = new Bus();
            foreach($input as $key=>$value){
                $bus->$key = $value;
            }
            if($bus->save()){
                return response()->json("record saved successfully");
            }
        }

        return View("buses.index",["buses"=>Bus::all(),"title"=>"Buses' Listing"]);
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
