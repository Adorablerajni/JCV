<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth:admin');
    }
    /**
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(!session('user_id')){
            return redirect(route('admin.login'));
        }
        if( session('user_role') == 'konnectin_users')
        {
                return redirect(route('home'));
        }
        return view('admin');
    }
}