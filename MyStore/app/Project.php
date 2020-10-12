<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    public function user(){
    	return $this->belongsTo(User::class);//select * from project where user_id=1;
    }
}
//hasOne
//hasMany
//belongsTo
//belongsToMany
//morphMany
//morphToMany
