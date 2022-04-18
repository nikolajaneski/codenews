<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @forelse ($posts as $post)
        <h3><strong><a href="{{ route('post', ['id' => $post->id]) }}" >{{ $post->title }}</a></strong></h3>

        <p>{{ $post->getExcerpt() }}</p>
    @empty
        No posts.
    @endforelse
</body>
</html>