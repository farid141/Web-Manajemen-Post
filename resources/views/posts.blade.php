@extends('layouts.main')

@section('container')
    
        <h1 class="mb-3 text-center">{{ $title }}</h1>

        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <form action="/posts">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{request('category')}}">
                    @endif
                    @if (request('author'))
                        <input type="hidden" name="author" value="{{request('author')}}">
                    @endif
                    <div class="input-group">
                        <input type="text" class="form-control text-decoration-none" placeholder="Search..." name="search" value="{{ request('search') }}">
                        <button class="btn btn-danger text-decoration-none" type="submit" id="button-addon2">Search</button>
                    </div>
                </form>
            </div>
        </div>

        @if ($posts->count())
            <div class="card mb-3">
                <div class="card-body text-center">
                    @if ($posts[0]->image)
                        <div style="max-height: 350px; overflow:hidden">
                            <img src="{{ asset('storage/' .$posts[0]->image) }}" class="img-fluid" alt="{{$posts[0]->category->name}}">
                        </div>
                    @else
                        <img src="https://source.unsplash.com/1200x400?{{$posts[0]->category->name}}" alt="{{$posts[0]->category->name}}" class="card-img-top">
                    @endif
                    
                    <h5 class="card-title">
                        <a href="/posts/{{$posts[0]->slug}}" class="text-dark text-decoration-none">{{$posts[0]->title}}</a>
                    </h5>
                    <small class="text-muted">
                        <p>By. 
                            <a href="/posts?author={{ $posts[0]->author->username }}" class="text-decoration-none">{{ $posts[0]->author->name }}</a> 
                            in 
                            <a href="/posts?category={{ $posts[0]->category->slug }}" class="text-decoration-none">
                                {{ $posts[0]->category->name }}
                                {{-- library carbon untuk mengatur waktu, sudah ada dalam laravel --}}
                            </a>{{$posts[0]->created_at->diffForHumans()}}
                        </p>
                    </small>
                    <p class="card-text">{{$posts[0]->excerpt}}</p>

                    <a href="/posts/{{ $posts[0]->slug}}" class="text-decoration-none btn btn-primary">more</a>
                </div>
            </div>
        
        
            <div class="container">
                <div class="row">
                    @foreach ($posts->skip(1) as $post)
                        <div class="col-md-4">
                            <div class="card">
                                
                                <div class="position-absolute px-3 py-2 text-white" style="background-color: rgba(0, 0, 0, 0.7)"><a href="/posts?category={{ $post->category->slug }}" class="text-white text-decoration-none">{{ $post->category->name }}</div></a>
                                
                                @if ($post->image)
                                    <div style="max-height: 350px; overflow: hidden">
                                        <img src="{{ asset('storage/' .$post->image) }}" class="img-fluid mt-3" alt="{{$post->category->name}}" >
                                    </div>
                                @else    
                                    <img src="https://source.unsplash.com/500x400?{{$post->category->name}}" alt="{{$post->category->name}}" class="img-fluid mt-3">
                                @endif

                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <small class="text-muted">
                                        <p>By. <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a>
                                            {{$post->created_at->diffForHumans()}}
                                        </p>
                                    </small>
                                    <p class="card-text">{{ $post->excerpt }}</p>
                                    <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read more...</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <p class="text-center fs-4">No Post Found.</p>
        @endif

        <div class="d-flex justify-content-end">
            {{ $posts->links() }}
        </div>
@endsection