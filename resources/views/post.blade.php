@extends('layouts.main')
@section('container')
<h1>Halaman {{ $title }}</h1>
    <article class="mb-3">
        <h2>
            {{ $post["title"] }}
        </h2>
        <h5>by: {{ $post["author"] }}</h5>
        <p>{{ $post["body"] }}</p>
    </article>
    <a href="/blog">back to post</a>
@endsection