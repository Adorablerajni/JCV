<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
   public function articles(){
        return $this->belongsToMany(Articles::class);//select * from projects where user_id =1
    }
}
