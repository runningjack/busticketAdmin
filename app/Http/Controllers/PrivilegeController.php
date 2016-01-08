<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Toddish\Verify\Models\Permission;
use Toddish\Verify\Models\Role;
use Illuminate\Support\Facades\Validator;

class PrivilegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return View("privileges.index",['roles'=>Role::all(),'permissions'=>Permission::all(),'title'=>'Roles and Privileges']);
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
            'name' =>'required|min:3|unique:roles',
            'description' =>'required',
            'level'=>'required'
        ]);
        if ($validator->fails()) {
            return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        $role = new Role();

        $input = $request->all();
        array_forget($input,"_token");
        foreach($input as $key=>$val){
            $role->$key = $val;
        }
        if($role->save()){

            \Session::flash("success_message","Role Successfully Created");
            $request->session()->flash('success_message', 'Role Successfully Created');
            return \Redirect::back();
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
    public function update(Request $request, $id="")
    {
        //
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'description' =>'required',
            'level'=>'required'
        ]);
        if ($validator->fails()) {
            return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        $input = $request->all();
        array_forget($input,"_token");
        $role = Role::find($input['id']);
        foreach($input as $key=>$val){
            $role->$key = $val;
        }
        if($role->update()){
            $role->permissions()->sync([2,3,4,6,7,8,10,11,12,14,15,16,18,19,20,22,23,24,26,27,28]);
            \Session::flash("success_message","Role Successfully Updated");
            return \Redirect::back();
        }
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
