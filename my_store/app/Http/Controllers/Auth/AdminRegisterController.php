<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\KonnectLogin;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminRegisterController extends Controller
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
    protected $redirectTo = '/admin/login';
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
    {
        return view('auth.admin_register');
    }
    
    
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        
        // ddd($request->all());
        $this->validator($request->all())->validate();
        $files =$request->file('login_logo');
        $imageName = date('Y-m-d').'-'.time().'.'.$files ->extension();  
        $response = $files->move(public_path('uploads'), $imageName);
        $path ='uploads/'.$imageName;
         
        event(new Registered($user = $this->create($request->all() ,  $path )));

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
            'login_name.required' => 'The Organization Name is required.',
            'login_uname.required' => 'The Username field is required.',
            'login_email.required' => 'The Email field is required.',
            'login_mobile.required' => 'The Mobile field is required.',
            'login_mobile.regex' => 'The Mobile 10 digit length.',
            'login_mobile.size' => 'The Mobile 10 digit length.',
            'login_uname.unique' => 'The User name  has already been taken.',
            'login_email.unique' => 'The Email has already been taken.',
        );
        return  Validator::make($data, [
            'login_name' => ['required', 'string', 'max:255'],
            'login_uname' => ['required', 'string',  'max:255', 'unique:konnect_login'],
            'login_email' => ['required', 'string', 'email', 'max:255', 'unique:konnect_login'],
            'login_mobile' => ['required', 'string','regex:/[0-9]{9}/', 'size:10'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'login_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\KonnectLogin
     */
    protected function create(array $data ,$path='')
    {
        return KonnectLogin::create([
            'login_name' => $data['login_name'],
            'login_email' => $data['login_email'],
            'login_uname' => $data['login_uname'],
            'login_pass' =>$data['password'],
            'login_mobile' => $data['login_mobile'],
            'login_city'=>$data['city'],
            'login_state'=>$data['state'],
            'login_website'=>$data['website'],
            'login_user_type'=>$data['user_type'],
            'categoryType'=>'Mart',
            'type_of_provider'=>$data['type_of_provider'],
            'login_registration_date'=>date('Y-m-d'),
            'login_contact_person'=>$data['contact_person'],
            'user_id'=>$data['user_id'],
            'login_logo'=>$path,
            //'password' => Hash::make($data['password']),
        ]);
    }
}
