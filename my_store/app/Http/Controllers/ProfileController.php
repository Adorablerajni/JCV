<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    //
    private $username;

    public function __construct(Request $request){
    	$this->username = $request->username;
    }
    public function show(){
        // $path = public_path().$this->username;
        // \File::makeDirectory($path, $mode = 0777, true, true);
    	$user = User::where('username','=',$this->username)->first();
    	return view('profiles.show')->with('user',$user);
    }
}
