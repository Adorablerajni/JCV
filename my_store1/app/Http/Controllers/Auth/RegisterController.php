<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\KonnectUser;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'password' => ['required', 'string', 'min:4', 'confirmed'],
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
            'kon_pswrd' => $data['password'],
            'kon_mobile' => $data['mobile'],
            //'password' => Hash::make($data['password']),
        ]);
    }
}
