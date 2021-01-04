@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="d-flex justify-content-center" role="banner">
        <h1>Profile:</h1>
    </div>

    <div class="card m-4 w-75 mx-auto" role="main">
        <div class="card-body">
            <p class="card-text mx-auto">
                <img src="{{ asset('/storage/images/'.$user->profilePicture->avatar) }}" class="img-thumbnail rounded mx-auto d-block" alt="{{ $user->profilePicture->description }}" style="width:200px; height:200px;">
                <p class="text-center">{{ $user->profilePicture->description }}</p>
                <h3 class="text-center">{{ $user->name }}</h3>
                <br>
                @foreach ($user->roles as $role)
                    <h3 class="text-center">{{ $role->title }}</h3>
                @endforeach
            </p>
        </div>
    </div>

    @can('update', $user)
    <div class="d-flex w-75 mx-auto">
        <a class="btn btn-primary btn-lg btn-block" href="{{ route('users.edit', ['user' => $user]) }}" role="button">EDIT</a>
    </div>
    @endcan
    
    @can('delete', $user)
    <div class="card m-4 w-75 mx-auto">
        <form method="POST" action="{{ route('users.destroy', ['user' => $user]) }}" role="form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-lg btn-block">DELETE</button>
        </form>
    </div>
    @endcan
@endsection