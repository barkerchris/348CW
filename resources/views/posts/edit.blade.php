@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="d-flex justify-content-center" role="banner">
        <h1>Edit post:</h1>
    </div>
    
    <div class="card m-4 w-75 mx-auto" role="main">   
        <div class="card-body"> 
            <form method="POST" action="{{ route('posts.update', ['post' => $post]) }}" role="form">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="title_id">Title:</label>
                    <input type="text" class="form-control" id="title_id" name="title" placeholder="Enter title" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label for="body_id">Body:</label>
                    <input type="text" class="form-control" id="body_id" name="body" placeholder="Enter body" value="{{ $post->body }}">
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">SUBMIT</button>
            </form>
        </div>
    </div>
@endsection