  <div class="blog-post">
  	<a href="/posts/{{  $post->id }}">
    	<h2 class="blog-post-title">{{ $post->title }}</h2>
  	</a>
    <p class="blog-post-meta">
    {{ $post->created_at->toFormattedDateString()  }} 
    by {{ $post->user->name }}</p>
    
    <div class="text-justify">
    	<p>{!! $post->body !!}</p>
    </div>

  </div><!-- /.blog-post -->