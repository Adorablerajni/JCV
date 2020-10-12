<?php
 
namespace App;
 
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticate;
 
class Admin extends Authenticate
{
    use Notifiable;
    protected $connection = 'mysql2';
 
    protected $guard = 'konnect_login';
    
 	const CREATED_AT = 'creation_date';
	const UPDATED_AT = 'updation_date';
    protected $fillable = [
        'login_name','login_uname', 'login_email','login_mobile', 'login_pass',
    ];
 
    protected $hidden = [];
        //'password', 'remember_token',
    
}