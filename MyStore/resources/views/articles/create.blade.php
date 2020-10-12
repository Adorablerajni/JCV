@extends ('layout')
@section('header')
 
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="#">SimpleWork</a></h1>
		</div>
		<div id="menu">
			<ul>
				<li class="current_page_item"><a href="#" accesskey="1" title="">Homepage</a></li>
				<li><a href="#" accesskey="2" title="">Our Clients</a></li>
				<li><a href="/about" accesskey="3" title="">About Us</a></li>
				<li><a href="/articles" accesskey="4" title="">Articles</a></li>
				<li><a href="#" accesskey="5" title="">Contact Us</a></li>
			</ul>
		</div>
	</div>
@endsection
@section('content')
<div id="wrapper">
	<div id="page" class="container">
		<h3>Add Article</h3>
		<div id="content">
			<form method="POST" action="/articles">
				@csrf
			  <div class="form-group">
			    <label for="title">Title</label>
			    <input type="text" class="form-control" name="title" id="title" aria-describedby="title" placeholder="">
			    @error('title')
			   <span class="text-danger">{{ $message }}</span>
			   @enderror
			  </div>
			  <div class="form-group">
			    <label for="excerpt">Excerpt</label>
			    <textarea class="form-control" name="excerpt" id="excerpt"></textarea>
			    @error('excerpt')
			   <span class="text-danger">{{ $message }}</span>
			   @enderror
			  </div>
			  <div class="form-group">
			    <label  for="body">Body</label>
			    <textarea class="form-control"  name="body" id="body"></textarea>
			    @error('body')
			   <span class="text-danger">{{ $message }}</span>
			   @enderror
			  </div>
			  <div class="form-group">
			    <label  for="body">Tags</label>
			    <select name="tags[]" class="form-control"   id="tags" multiple>
			    	@foreach($tags as $tag)
			    	<option value="{{$tag->id}}">{{ $tag->name}}</option>
			    	@endforeach
			    </select>
			    @error('tags')
			   <span class="text-danger">{{ $message }}</span>
			   @enderror
			  </div>
			  <button type="submit" class="btn btn-primary">Submit</button>
			</form>
		
	</div>
</div>
@endsection