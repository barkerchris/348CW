@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<div class="d-flex justify-content-center">
        <h1>Create post:</h1>
</div>
<div class="card m-4 w-75 mx-auto">   
    <div class="card-body"> 
        <form method="POST" action="{{ route('posts.store') }}">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" exitplaceholder="Enter title">
            </div>
            <div class="form-group">
                <label for="body">Body:</label>
                <input type="text" class="form-control" id="body" placeholder="Enter body">
            </div>
            <div class="form-group">
                <label for="files">Attachments:</label>
                <input type="file" class="form-control-file" id="files">
              </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
        </form>
    </div>
</div>
@endsection