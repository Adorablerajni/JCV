<?php
 
namespace App;
 
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticate;
 
class KonnectLogin extends Authenticate
{
    use Notifiable;
    protected $connection = 'mysql';
 
    protected $guard = 'konnect_login';
    
 	const CREATED_AT = 'creation_date';
	const UPDATED_AT = 'updation_date';
    protected $fillable = [
        'login_name','login_uname', 'login_email','login_mobile', 'login_pass',
    ];
 
    protected $hidden = [ 'login_pass','remember_token',];
        //'password', 'remember_token',
    
}