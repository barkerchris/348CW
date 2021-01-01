@extends('layouts.app')

@section('title', 'Post')

@section('content')
<div class="d-flex justify-content-center">
    <h1>Post {{ $post->id }}:</h1>
</div>
    <div class="card m-4 w-75 mx-auto">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">
                <img src="{{ asset('/storage/images/'.$post->user->profilePicture->avatar) }}" class="img-thumbnail" alt="{{ $post->user->profilePicture->description }}" style="width:50px; height:50px;">
                {{ $post->user->name }}   {{ $post->created_at->diffForHumans() }}
            </h6>
            <p class="card-text">{{ $post->body }}</p>
        </div>
        <div class="card-footer text-muted">
            Attachments
        </div>
    </div>
    <div class="d-flex w-75 mx-auto">
        <a class="btn btn-primary btn-lg btn-block" href="{{ route('posts.edit', ['post' => $post]) }}" role="button">EDIT</a>
    </div>
    <div class="card m-4 w-75 mx-auto">
        <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-lg btn-block">DELETE</button>
        </form>
    </div>
@endsection