<!doctype html>

<title>website</title>
<link rel="stylesheet" href="/app.css">

<body>
  @foreach($posts as $post)
      <article>
          {!! $post->title !!}
      </article>
  @endforeach
</body>
