@extends('layouts.app')

@section('title', 'Add Attachments')

@section('content')
    <div class="d-flex justify-content-center">
        <h1>Add attachments:</h1>
    </div>
    
    <div class="card m-4 w-75 mx-auto">   
        <div class="card-body"> 
            <form method="POST" action="{{ route('attachments.store', ['id' => $id, 'type' => $type]) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="files_id">Choose Files:</label>
                    <input type="file" class="form-control-file" id="files_id" name="file[]" multiple>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">SUBMIT</button>
            </form>
        </div>
    </div>
@endsection