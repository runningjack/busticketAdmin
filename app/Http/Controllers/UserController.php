<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Toddish\Verify\Models\Role;
use Toddish\Verify\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return View("administrators.index",['users'=>User::all(),'title'=>'User Listing']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View("administrators.addnew",["permissions"=>\DB::table("permissions")->get(),"roles"=>\DB::table("roles")->where("name","<>","Moderator")->get(),"title"=>"Add New User"]);

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

        //$validation = \Toddish\Verify\Models\User::validate(\Input::all());
        $input = $request->all();
        // if($validation->fails()){

        //return \Redirect::back()->withErrors($validation)->withInput();
        // }else{


        $validator = Validator::make($request->all(), [
            'firstname' =>'required|min:3|unique:users',
            'lastname' =>'required|min:3|unique:users',
            'password' =>'required',
            'email' => 'required|unique:users',
            'username' => 'required|unique:users'
        ]);
        if ($validator->fails()) {
            return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }



        $user = new \Toddish\Verify\Models\User;
        $role = new \Toddish\Verify\Models\Role;


        $user->firstname = $input['firstname'];
        $user->lastname  = $input['lastname'];
        $user->phone    =   $input['phone'];
        $user->username = $input['username'];
        $user->email    =   $input['email'];
        $user->verified       = 0;
        $user->disabled       =   0;
        $user->password     =  ($input["password"]);
       // $user->created_by_id = \Auth::user()->id;
        //$user->created_by    = \Auth::user()->firstname ." ".\Auth::user()->lastname;



        try{
            if($user->save()){
                \DB::table('role_user')->insert(
                    ['role_id' => $input['role_id'], 'user_id' => $user->id]
                );
               /* \DB::table('dblogs')->insert(
                    ['user_id' => \Auth::user()->id, 'post_id' => $user->id,"description"=>"A new user has been committed to data store","action"=>"New user created awaits approval action",
                        "post_type"=>"user","operator"=>\Auth::user()->firstname ." ". \Auth::user()->lastname,"created_at"=>date('Y-m-d H:i:s')]
                );*/
            }


            \Session::put("message","New User added to database");
            return \Redirect::back();

        }catch(\Illuminate\Database\QueryException $e){
            \Session::put("error_message",$e->getMessage());
            return \Redirect::back();
        }catch(\PDOException $e){
            \Session::put("error_message",$e->getMessage());
            return \Redirect::back();
        }catch(\Exception $e){
            \Session::put("error_message",$e->getMessage());
            return \Redirect::back();
        }
        //}
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

        return View("administrators.edituser",["myuser"=>User::find($id),"myrole"=>\DB::table("role_user")->where("user_id",$id)->get(),"roles"=>\DB::table("roles")->get(),"title"=>"Edit User"]);
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
        $input = $request->all();
        $validator = Validator::make($input, [
            'firstname' =>'required',
            'lastname' =>'required',
            'email' => 'required',
            'username' => 'required'
        ]);
        if ($validator->fails()) {
            return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = !empty($id) ? \Toddish\Verify\Models\User::find($input['id']) : $id;
        $role =\Toddish\Verify\Models\Role::find($input['role_id']);

        $user->firstname = $input['firstname'];
        $user->lastname  = $input['lastname'];
        $user->phone    =   $input['phone'];
        $user->username = $input['username'];
        $user->email    =   $input['email'];
        $user->verified       = $input['verified'];
        $user->disabled       =   $input['disabled'];

        // $user->created_by_id = \Auth::user()->id;
        //$user->created_by    = \Auth::user()->firstname ." ".\Auth::user()->lastname;
        try{
            if($user->update()){

                $user->roles()->sync([$role->id]);

                /* \DB::table('dblogs')->insert(
                     ['user_id' => \Auth::user()->id, 'post_id' => $user->id,"description"=>"A new user has been committed to data store","action"=>"New user created awaits approval action",
                         "post_type"=>"user","operator"=>\Auth::user()->firstname ." ". \Auth::user()->lastname,"created_at"=>date('Y-m-d H:i:s')]
                 );*/
                \Session::flash("success_message","New User Record Updated Successfully");
                return \Redirect::back();
            }
        }catch(\Illuminate\Database\QueryException $e){
            \Session::flash("error_message",$e->getMessage());
            return \Redirect::back();
        }catch(\PDOException $e){
            \Session::flash("error_message",$e->getMessage());
            return \Redirect::back();
        }catch(\Exception $e){
            \Session::flash("error_message",$e->getMessage());
            return \Redirect::back();
        }
        //}
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
        $user =\App\User::find($id);
        //$invoice =  \DB::table("invoicing")->where("job_paper_size","=",$paper->name)->get();
        if($user->verified){
            return response()->json("This Record cannot be deleted!<br>User is already varified");
            exit;
        }else{

            $user->delete();
            Session::flash("success_message","Record Successfully deleted");
            echo "Record Successfully Deleted";
            exit;
        }

    }
}
