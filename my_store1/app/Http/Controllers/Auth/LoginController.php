<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\ValidationException;
use Auth;
use Route;



class LoginController extends Controller
{
    

   use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
         $this->middleware('guest')->except('logout');
        
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }
    // public function login(Request $request)
    // { 

    //     request()->validate([
    //       'kon_email'   => 'required|email',
    //       'kon_pswrd' => 'required|min:4',
    //     ]);
    //     \DB::enableQueryLog();
    //     $response = \DB::table('konnect_users')
    //                     ->select('*')
    //                     ->where('kon_email',request('kon_email'))->first();
    //     $quries =\DB::getQueryLog();
    //     //echo $response;
    //     //dd(count($response));
    //     if ($response == null) {
    //       return redirect( route('login'));
    //     }
    //     dd($response);
    //    //return redirect( route('login'));

    
    // }
    public function username()
    {
        return 'kon_email';
    }

   
 
   
}
