@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="d-flex justify-content-center">
        <h1>Posts:</h1>
    </div>

    @can('create', App\Post::class)
        <div class="d-flex w-75 mx-auto">
            <a class="btn btn-primary btn-lg btn-block" href="{{ route('posts.create') }}" role="button">CREATE</a>
        </div>
    @endcan

    @if(count($posts) > 0)
        @foreach ($posts as $post)
            <div class="card m-4 w-75 mx-auto">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->title }}</a></h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <a href="{{ route('users.show', ['user' => $post->user]) }}">
                            <img src="{{ asset('/storage/images/'.$post->user->profilePicture->avatar) }}" class="img-thumbnail" alt="{{ $post->user->profilePicture->description }}" style="width:50px; height:50px;">
                            {{ $post->user->name }}
                        </a>
                        {{ $post->created_at->diffForHumans() }}
                    </h6>
                    <p class="card-text">{{ $post->body }}</p>
                </div>
            </div>
        @endforeach
    @else
        <div class="d-flex justify-content-center">
            <h2>No posts</h2>
        </div>
    @endif
    
    <div class="pagination justify-content-center">
        {{ $posts->links() }}
    </div>
@endsection