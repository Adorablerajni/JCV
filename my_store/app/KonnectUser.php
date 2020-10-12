<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;  // Import Hash facade


class KonnectUser extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $connection = 'mysql';
    protected $table = 'konnect_users';

    const CREATED_AT = 'creation_date';
	const UPDATED_AT = 'updation_date';
    // protected $guarded = [];
    protected $fillable = [
        'kon_name', 'kon_email', 'kon_mobile','kon_pswrd','kon_unq_id','pofile_type','kon_access',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'kon_pswrd','remember_token',];
         // 'remember_token',
    

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($kon_pswrd)
    {
        $this->attributes['kon_pswrd'] = Hash::make($kon_pswrd);
    }
     public function getAuthPassword()
    {
        return $this->kon_pswrd;
    }
}
