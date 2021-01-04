@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <div class="d-flex justify-content-center" role="banner">
        <h1>Create post:</h1>
    </div>
    
    <div class="card m-4 w-75 mx-auto" role="main">   
        <div class="card-body"> 
            <form method="POST" action="{{ route('posts.store') }}" role="form">
                @csrf
                <div class="form-group">
                    <label for="title_id">Title:</label>
                    <input type="text" class="form-control" id="title_id" name="title" placeholder="Enter title" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label for="body_id">Body:</label>
                    <textarea type="text" class="form-control" id="body_id" name="body" placeholder="Enter body" value="{{ old('body') }}" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">SUBMIT</button>
            </form>
        </div>
    </div>
@endsection