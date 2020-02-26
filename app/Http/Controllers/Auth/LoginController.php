<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Professor;
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
                return redirect()->route('admin');
            } else if (auth()->user()->role == 'Professor') {
         
                return redirect()->route('professor.mainIndex', compact('professor'));
            } else if (auth()->user()->role == 'Administrador Evaluacion') {
                return redirect()->route('admin');
            }
            else if (auth()->user()->role == 'Administrador Secretaria') {
                return redirect()->route('admin');
            }
              else if(auth()->user()->role =='Student')
            {
                return redirect()->route('student.mainIndex');
            }
        }
        else{

            return back()->withErrors(['email'=>'estas credenciales no coinciden ','password'=>'estas credenciales no coinciden']);
        }
    }
}
