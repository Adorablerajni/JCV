<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    //
    protected $guarded = [];
    //protected $fillable = ['title', 'excerpt', 'body'];
     public function path()
    {
    	return route('articles.show',$this);
    }
    public function author(){
    	return $this->belongsTo(User::class,'user_id');
    }
    public function tags()
    {
    	return $this->belongsToMany(Tag::class);
    }
}
// $article->user()
