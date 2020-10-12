@extends('layout')
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
	<div id="header-featured">
		<div id="banner-wrapper">
			<div id="banner" class="container">
				<h2>Maecenas luctus lectus</h2>
				<p>This is <strong>SimpleWork</strong>, a free, fully standards-compliant CSS template designed by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>. The photos in this template are from <a href="http://fotogrph.com/"> Fotogrph</a>. This free template is released under the <a href="http://templated.co/license">Creative Commons Attribution</a> license, so you're pretty much free to do whatever you want with it (even use it commercially) provided you give us credit for it. Have fun :) </p>
				<a href="#" class="button">Etiam posuere</a> </div>
		</div>
	</div>
</div>
@endsection

@section('content')
<div id="wrapper">
	<div id="page" class="container">
		<div id="sidebar">
			<ul class="style1">
				@forelse($articles as $article)
				<li class="first">
					<a href="{{$article->path() }}">
						<h3>{{ $article->title}}</h3>
					</a>
					<p><a href="/articles/{{$article->id}}/edit">{{ $article->excerpt}}</a></p>
				</li>
				@empty
					<p> No relevent articles </p>
				@endforelse
			</ul>
			
		</div>
	</div>
</div>
@endsection