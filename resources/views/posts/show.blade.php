@extends('layouts.app')

@section('title', '{{ $post->id }}')

@section('content')
    <div class="card m-4 w-75 mx-auto">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $post->user->name }}   {{ $post->created_at->diffForHumans() }}</h6>
            <p class="card-text">{{ $post->body }}</p>
        </div>
        <div class="card-footer text-muted">
            Attachments
        </div>
    </div>
    <div class="d-flex w-75 mx-auto">
        <form method="POST"
            action="{{ route('posts.destroy', ['post' => $post]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection