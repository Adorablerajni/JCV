<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Auth;
use Route;

class AdminLoginController extends Controller
{
    protected $redirectTo ='/admin';
    public function __construct()
    {
      //$this->middleware('guest:admin', ['except' => ['logout']]);
      //$this->middleware('guest')->except('logout');
    }
    
    public function showLoginForm()
    {
        if(session('user_id')){
            return redirect(route('admin.dashboard'));
        }
        return view('auth.admin_login');
    }
    
    
    public function login(Request $request)
    {   
        request()->validate(
            [
               'login_email' => 'required|email',
               'login_pass' => 'required|min:3',
           ],
           [
            'login_email.required'=> 'Your Email is Required', // custom message
            'login_email.email'=> 'The Email must be valid email address', // custom message
            'login_pass.min'=> 'Password Should be Minimum of 6 Character', // custom message
            'login_pass.required'=> 'Your Password is Required' // custom message
           ]);
        \DB::enableQueryLog();
        $check = \DB::table('konnect_login')
                        ->select('*')
                        ->where('login_email',request('login_email'))
                        ->where('login_pass',request('login_pass'))->count();
        $quries =\DB::getQueryLog();
       // ddd($quries);
        if ($check == null) {
          return redirect( route('admin.login'))->with('failure', 'Your account not found Please check details!');
        }
        elseif($check ==1){
              $user = \DB::table('konnect_login')
                        ->select('*')
                        ->where('login_email',request('login_email'))
                        ->where('login_pass',request('login_pass'))->first();
            
            $request->session()->regenerate();
            $request->session()->put('user_id',$user->login_id);
            $request->session()->put('user_name',$user->login_name);
            $request->session()->put('user_role',$user->login_user_type);
            return redirect(route('admin.dashboard'));
           
        }
    //   // Validate the form data
    //   $this->validate($request, [
    //     'email'   => 'required|email',
    //     'password' => 'required|min:6'
    //   ]);
      
    //   // Attempt to log the user in
    //   if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
    //     // if successful, then redirect to their intended location
    //     return redirect()->intended(route('admin.dashboard'));
    //   } 
    //   // if unsuccessful, then redirect back to the login with the form data
    //   //return redirect()->back()->withInput($request->only('email', 'remember'));
    //   throw ValidationException::withMessages([
    //         $this->username() => [trans('auth.failed')],
    //     ]);
    }
    
   public function logout(Request $request)
    {
        ///$this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
         return redirect(route('admin.login'));

        // if ($response = $this->loggedOut($request)) {
        //     return $response;
        // }

        // return $request->wantsJson()
        //     ? new Response('', 204)
        //     : redirect('/');
    }
}