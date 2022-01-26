@extends('layouts.main')
@section('container')
<h1>Halaman {{ $title }}</h1>
    <article class="mb-3">
        <h2>
            {{ $post->title }}
        </h2>

        {{-- tag untuk escape html character --}}
        <p>{!! $post->body !!}</p>
    </article>
    <a href="/blog">back to post</a>
@endsection