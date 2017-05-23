<?php

namespace App\Http\Controllers\Auth;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * The user has been authenticated.This function redirects user to appropriate page after logging in
     * Method copied from "Illumunate\Foundation\Auth\AuthenticateUsers.php"
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return view
     */
    protected function authenticated($request, $user)
    {
        
        return authorize($user);
    }

    public function login(Request $request)
    {

        $errors = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($errors->fails()) {

            return redirect('login')
                ->withErrors($errors)
                ->withInput();
        }

        $ldap = ldap_connect('ldap://etsu.edu');
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);

        if($ldap)
        {
            $username = explode("@",$request->get('email'))[0];

            $status =   @ldap_bind($ldap, $username . "@ETSU", $request->get('password')); //get from the form

            $user = User::where('email', $request->get('email'))->first(); //get from the database

            if($status && $user)
            {
                ldap_unbind($ldap);
                Auth::login($user);
                return redirect('/home'); //laravel specific routing (Laravel uses MVC)
            }
            else
            {
                return redirect('login')
                ->withErrors($errors = array("messages" => "Invalid Credentials"))
                ->withInput();
            }
        }
    }

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
    $this->middleware('guest', ['except' => 'logout']);
    }
}