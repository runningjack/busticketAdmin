<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Toddish\Verify\Helpers\Verify;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getLogin(){
        return View('auth.login');
    }

    public function getLogout(){
        Auth::logout();
        return View('auth.login');
    }

    public function postLogin(Request $request){
        try
        {
            $input =$request->all();
            $credentials = array(
                'email' => $input['email'],
                'password' => $input['password']
            );
            $email = $input['email'];
            $password = $input['password'];
            /* Auth::attempt(array(
                 'identifier' => 'admin',
                 'password' => 'admin'
             ));*/
           // Auth::();
            switch (Auth::verify(array('email' => $email,'verified'=>1, 'password' => $password),true))
            {
                case Verify::SUCCESS:
                    return Redirect::intended('/dashboard');
                    break;
                case Verify::INVALID_CREDENTIALS:
                    \Session::flash("error_message","Invalid Credentials");
                    return Redirect::back();
                    break;
                case Verify::UNVERIFIED:
                    \Session::flash("error_message","Unverified User");
                    return Redirect::back();
                    break;
                case Verify::DISABLED:
                    \Session::flash("error_message","User Disabled");
                    return Redirect::back();
                    break;
            }
            /*if (Auth::attempt(array('email' => $email,'verified'=>1, 'password' => $password),true))
            {
                $user = User::find(Auth::user()->id);
                if ($user->verified) {
                    //return Redirect::to($redirect);
                    return Redirect::intended('backend/dashboard/index');
                } else {
                    // Redirect to homepage
                    // return Redirect::to('your_default_logged_in_page')->with('success', 'You have logged in successfully');
                }
            }*/
        }
        catch (Exception $e)
        {
            \Session::flash("error_message",$e->getMessage());
            return \Redirect::back();
        }
    }
}
