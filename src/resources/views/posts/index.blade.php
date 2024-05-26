<!DOCTYPE html>
<html>
    <head>
         <meta charset="UTF-8">
    </head>
    <body>
        <h1>"BLOG TITLE"</h1>
        <a href="/posts/create">create</a>
	<div class='posts'>
		@foreach ($posts as $post)
		    	<h2 class='title'>
                    <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                </h2>
		    	<p class="body">{{ $post->body }}</p>
                <small>{{ $post->user->name }}</small>
		@endforeach
	</div>
    </body>
</html>