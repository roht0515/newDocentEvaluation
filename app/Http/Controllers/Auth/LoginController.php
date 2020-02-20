<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

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
    *
    /

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    use AuthenticatesUsers;
   
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
        
    }
    public function username()
    {
        return 'username';
    }

    public function login(){

        $credentials= $this->validate(request(),[

            'email'=>'required|string',
            'password'=>'required|string'
        ]);

        if(Auth::attempt($credentials))
        {
            return 'has iniciado correctamente';
        }
        else{

            return back()->withErrors(['email'=>'estas credenciales no coinciden ','password'=>'estas credenciales no coinciden']);
        }
    }
}
