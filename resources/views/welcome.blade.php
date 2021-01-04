@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="d-flex justify-content-center" role="banner">
        <h1>Welcome:</h1>
    </div>

    <div class="card m-4 w-75 mx-auto" role="main">
        <div class="card-body">
            <h5 class="card-title">{{ config('app.name') }}</h5>
            <p class="card-text">
                Welcome! This is my Laravel project for the 348 Coursework.
                It is a site where Lecturers (and Admins) can make posts with attachments 
                (like uploading the day's slides) and Students are free to comment on 
                these posts, and also upload attachments of their own. Each User has a profile
                picture which the User can upload.
            </p>
        </div>
    </div>
@endsection