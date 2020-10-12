<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articles;
use App\Tag;
class ArticlesController extends Controller
{
    //
    public function index(){
        if (request('tag')) {
            $articles = Tag::where('name',request('tag'))->firstOrFail()->articles;
            //return $articles;
        }else{
            $articles =  Articles::latest()->get();
        }
    	
    	return view('articles.index',['articles'=>$articles]);
    }
    public function show(Articles $article){
    	
    	return view('articles.show',['article'=>$article]);
    }
    public function create(){
        $tags = Tag::all();
    	return view('articles.create',compact('tags'));
    }
    public function store(){
        $this->validateArticle();    	
        $article = new Articles(request(['title','excerpt','body']));
    	$article->user_id =2;
        $article->save();
        $article->tags()->attach(request('strip_tags(str)'))  ;

    	return redirect(route('articles.index'));
    }
    public function edit(Articles $article)
    {
    	return view('articles.edit',compact('article'));
    }
    public function update(Articles $article)
    {
        
        $article->update($this->validateArticle());
        
        return redirect($article->path());
    }
    public function validateArticle(){
        return  request()->validate([
            'title'=>'required',
            'excerpt'=>'required',
            'body'=>'required',
            'tags'=>'exists:tags,id',
        ]);
    }
}
