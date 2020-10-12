<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if(!session('user_id')){
            return redirect('login');
        }
        if( session('user_role') != 'konnectin_users')
        {
                return redirect('admin');
        }
        return view('home');
        //return view('home');
    }
}
