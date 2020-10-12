<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\KonnectUser;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';
    //RouteServiceProvider::HOME

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {   if(session('user_id')){
            if( session('user_role') == 'konnectin_users'){
                return redirect('home');
            }
            else{
               return redirect('admin'); 
            }
       // return redirect('home');
        }
        return view('auth.register');
        //return view('auth.register');
    }
    
    
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user);
   
        return redirect($this->redirectPath())->with('success', 'You are registered successfully! Please Login now');

        // return $this->registered($request, $user)
        //     ?: redirect()->intended($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
       $messages = array(
            'required' => 'The :attribute field is required.',
            'kon_email.unique' => 'The Email has already been taken.',
        );
        return  Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'kon_email' => ['required', 'string', 'email', 'max:255', 'unique:konnect_users'],
            'mobile' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ],$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\KonnectUser
     */
    protected function create(array $data)
    {
        return KonnectUser::create([
            'kon_name' => $data['name'],
            'kon_email' => $data['kon_email'],
            'kon_pswrd' =>$data['password'],
            'kon_mobile' => $data['mobile'],
            'kon_unq_id'=>Hash::make($data['password']),
            'pofile_type'=>'Myself',
            'kon_access'=>'Mart',
            //'password' => Hash::make($data['password']),
        ]);
    }
}
