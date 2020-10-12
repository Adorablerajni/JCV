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
		<div id="content">
			<div class="title">
				<h2>{{ $article->title}}</h2>
				<span class="byline">{{ $article->excerpt }}</span> </div>
			<p><img src="/images/banner.jpg" alt="" height="200px"  width="300px" /> </p>
			<p>{!! $article->body !!}</p>
			<p>
				@foreach($article->tags as $tag)
				<a href="/articles?tag={{ $tag->name }}">{{ $tag->name }}</a>|
				@endforeach
			</p>
		</div>
		
	</div>
</div>
@endsection