@extends('layouts.app')

@section('title', 'Edit Comment')

@section('content')
    <div class="d-flex justify-content-center" role="banner">
        <h1>Edit comment:</h1>
    </div>
    
    <div class="card m-4 w-75 mx-auto" role="main">   
        <div class="card-body"> 
            <form method="POST" action="{{ route('comments.update', ['comment' => $comment]) }}" role="form">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="body_id">Body:</label>
                    <input type="text" class="form-control" id="body_id" name="body" placeholder="Enter body" value="{{ $comment->body }}">
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">SUBMIT</button>
            </form>
        </div>
    </div>
@endsection