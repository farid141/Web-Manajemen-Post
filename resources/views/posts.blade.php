@extends('layouts.main')
@section('container')
    <h1>Halaman {{ $title }}</h1>
    <article class="mb-3">
        @foreach ($posts as $post)
            <h2>
                <a href="/posts/{{ $post->slug }}">
                    {{ $post->title }}
                </a>
            </h2>
        {{-- <h5>by: {{ $post["author"] }}</h5> --}}
        <p>{{ $post->excerpt }}</p>
        @endforeach
    </article>
@endsection