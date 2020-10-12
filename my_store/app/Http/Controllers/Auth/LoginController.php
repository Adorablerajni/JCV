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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo ='/home';
    // RouteServiceProvider::HOME

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
    {   if(session('user_id')){
            if( session('user_role') == 'konnectin_users'){
                return redirect('home');
            }
        }
        return view('auth.login');
        //return view('auth.login');
    }
    public function login(Request $request)
    {       

        request()->validate(
            [
               'kon_email' => 'required|email',
               'kon_pswrd' => 'required|min:6',
           ],
           [
            'kon_email.required'=> 'Your Email is Required', // custom message
            'kon_email.email'=> 'The Email must be valid email address', // custom message
            'kon_pswrd.min'=> 'Password Should be Minimum of 6 Character', // custom message
            'kon_pswrd.required'=> 'Your Password is Required' // custom message
           ]);
        \DB::enableQueryLog();
        $check = \DB::table('konnect_users')
                        ->select('*')
                        ->where('kon_email',request('kon_email'))
                        ->where('kon_pswrd',request('kon_pswrd'))->count();
        $quries =\DB::getQueryLog();
        if ($check == null) {
          return redirect( route('login'))->with('failure', 'You are not registered! Please Register first');
        }
        elseif($check ==1){
              $user = \DB::table('konnect_users')
                        ->select('*')
                        ->where('kon_email',request('kon_email'))
                        ->where('kon_pswrd',request('kon_pswrd'))->first();
            
            $request->session()->regenerate();
            $request->session()->put('user_id',$user->id);
            $request->session()->put('user_name',$user->kon_name);
            $request->session()->put('user_role','konnectin_users');
            return redirect()->intended($this->redirectPath());
           
        }
      
       //return redirect( route('login'));

    
    }
    // public function username()
    // {
    //     return 'kon_email';
    // }
    // protected function getCredentials(Request $request)
    // {
    //     return $request->only($this->loginUsername(), 'kon_pswrd');
    // }

    // public function loginUsername()
    // {
    //     return property_exists($this, 'kon_email') ? $this->kon_email : 'kon_email';
    // }
    // protected function guard()
    // {
    //     return Auth::guard('user');
    // }
    
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
         return redirect('/login');

        // if ($response = $this->loggedOut($request)) {
        //     return $response;
        // }

        // return $request->wantsJson()
        //     ? new Response('', 204)
        //     : redirect('/');
    }

   
 
   
}
