<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;

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
   
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        
    }
    public function username()
    {
        return 'username';
    }

    public function login(Request $request){

        $credentials= $this->validate($request,[

            'username'=>'required|string',
            'password'=>'required|string'
        ]);

        if(Auth::attempt($credentials))
        {
            if (auth()->user()->role == 'Administrador') {
                return redirect('admin');
            } else if (auth()->user()->role == 'Professor') {
                return redirect('professor');
            } else if (auth()->user()->role == 'Administrador Evaluacion') {
                return redirect('admin');
            }
              else if(auth()->user()->role =='Student')
            {
                return redirect('student');
            }
        }
        else{

            return back()->withErrors(['email'=>'estas credenciales no coinciden ','password'=>'estas credenciales no coinciden']);
        }
    }
}
