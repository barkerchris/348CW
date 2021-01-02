@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="d-flex justify-content-center">
        <h1>Edit profile:</h1>
    </div>

    <div class="card m-4 w-75 mx-auto">   
        <div class="card-body">
            <img src="{{ asset('/storage/images/'.$user->profilePicture->avatar) }}" class="img-thumbnail rounded mx-auto d-block" alt="{{ $user->profilePicture->description }}" style="width:200px; height:200px;">
            <form method="POST" action="{{ route('profilePictures.update', ['profilePicture' => $user->profilePicture]) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="image_id">Choose Image:</label>
                    <input type="file" class="form-control-file" id="image_id" name="image">
                </div>
                <div class="form-group">
                    <label for="description_id">Image Description:</label>
                    <input type="text" class="form-control" id="description_id" name="description" placeholder="Enter description" value="{{ $user->profilePicture->description }}">
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">SUBMIT</button>
            </form>
            <br>
            <form method="POST" action="{{ route('users.update', ['user' => $user]) }}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name_id">Name:</label>
                    <input type="text" class="form-control" id="name_id" name="name" placeholder="Enter name" value="{{ $user->name }}">
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">SUBMIT</button>
            </form>
            <br>
            <div class="d-flex justify-content-center">
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
        </div>
    </div>
@endsection