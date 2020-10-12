<?php
 
namespace App;
 
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticate;
 
class KonnectLogin extends Authenticate
{
    use Notifiable;
    protected $connection = 'mysql';
 
    protected $table = 'konnect_login';
    
 	const CREATED_AT = 'creation_date';
	const UPDATED_AT = 'updation_date';
	protected $guarded = [];
    // protected $fillable = [
    //     'login_name','login_uname', 'login_email','login_mobile', 'login_pass',
    //     'login_contact_person','login_city','login_state','login_user_type','login_registration_date',
    // ];
 
    protected $hidden = [ 'login_pass','remember_token',];
        //'password', 'remember_token',
    
}