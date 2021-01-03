@extends('layouts.app')

@section('title', 'Post')

@section('content')
    <div class="d-flex justify-content-center">
        <h1>Post {{ $post->id }}:</h1>
    </div>

    <div class="container">
        <div class="row mt-2">
            <div class="col">
                @can('update', $post)
                    <div class="d-flex">
                        <a class="btn btn-primary btn-lg btn-block" href="{{ route('attachments.create', ['id' => $post->id, 'type' => Post::class]) }}" role="button">ADD ATTACHMENTS</a>
                    </div>
                @endcan    
            </div>
            <div class="col">
                @can('update', $post)
                    <div class="d-flex">
                        <a class="btn btn-primary btn-lg btn-block" href="{{ route('posts.edit', ['post' => $post]) }}" role="button">EDIT POST</a>
                    </div>
                @endcan
            </div>
            <div class="col">
                @can('delete', $post)
                    <div class="card mx-auto">
                        <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg btn-block">DELETE POST</button>
                        </form>
                    </div>
                @endcan
            </div>
        </div>
    </div>

    <div class="card m-4">
        <div class="card-body">
            <h4 class="card-title">{{ $post->title }}</h4>
            <h6 class="card-subtitle text-muted">
                <a href="{{ route('users.show', ['user' => $post->user]) }}">
                    <img src="{{ asset('/storage/images/'.$post->user->profilePicture->avatar) }}" class="img-thumbnail" alt="{{ $post->user->profilePicture->description }}" style="width:50px; height:50px;">
                    {{ $post->user->name }}
                </a>
                {{ $post->created_at->diffForHumans() }}
            </h6>
            <p class="card-text mt-3">{{ $post->body }}</p>
        </div>

        @if($post->attachments->isNotEmpty())
            <div class="card-footer text-muted">
                Attachments:<br>
                @foreach($post->attachments as $attachment)
                    <div class="d-inline-flex">
                        <a href="{{ route('attachments.show', ['attachment' => $attachment]) }}">
                            <h5>{{ $attachment->file }}</h5>
                        </a>
                        @can('delete', $post)
                            <form method="POST" action="{{ route('attachments.destroy', ['id' => $post->id, 'type' => Post::class, 'attachment' => $attachment]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger p-0 ml-4">DELETE</button>
                            </form>
                        @endcan
                    </div>
                    <br>
                @endforeach
            </div>
        @endif
    </div>

    {{-- <div class="d-flex m-4">
        <a class="btn btn-primary btn-lg btn-block" href="{{ route('comments.page', ['post' => $post]) }}" role="button">VIEW COMMENTS</a>
    </div> --}}

    <div id="root">
        <div class="card m-4 w-75 mx-auto" v-for="comment in comments">
            <div class="card-body">
                @{{ comment.body }}
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0-0/axios.js"></script>
    <script>
        var app = new Vue({
            el: "#root",
            data: {
                comments: [],
                newCommentBody: '',
            },
            mounted() {
                axios.get("{{ route('api.comments.index', ['post' => $post]) }}")
                .then(response => {
                    this.comments = response.data;
                })
                .catch(response => {
                    console.log(response);
                })
            },
            methods: {
                createComment: function() {
                    axios.post("{{ route('api.comments.store') }}", {
                        body: this.newCommentBody
                    })
                    .then(response => {
                        this.comments.push(response.data);
                        this.newCommentBody = '';
                    })
                    .catch(response => {
                        console.log(response);
                    })
                }
            }
        });
    </script>
@endsection