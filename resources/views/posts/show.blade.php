@extends('layouts.app')

@section('title', 'Post')

@section('content')
    <div class="d-flex justify-content-center" role="banner">
        <h1>Post {{ $post->id }}:</h1>
    </div>

    <div class="card m-4 w-75 mx-auto" role="main">
        <div class="card-header">
            <div class="row my-2">
                @can('update', $post)
                    <div class="col">
                        <div class="d-flex">
                            <a class="btn btn-primary btn-lg btn-block" href="{{ route('attachments.create', ['id' => $post->id, 'type' => Post::class]) }}" role="button">ADD ATTACHMENTS</a>
                        </div>
                    </div>
                @endcan
                
                @can('update', $post)
                    <div class="col">
                        <div class="d-flex">
                            <a class="btn btn-primary btn-lg btn-block" href="{{ route('posts.edit', ['post' => $post]) }}" role="button">EDIT POST</a>
                        </div>
                    </div>
                @endcan

                @can('delete', $post)
                    <div class="col">
                        <div class="card mx-auto">
                            <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-lg btn-block">DELETE POST</button>
                            </form>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
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

    <div id="com">
        <div class="d-flex justify-content-center" role="complementary">
            <h1>Comments:</h1>
        </div>

        <div class="card m-4 w-75 mx-auto">   
            <div class="card-body" role="form"> 
                <h4>Body:</h4>
                <input type="text" class="form-control" id="input" placeholder="Enter body" v-model="newCommentBody">
                <button @click="createComment" class="btn btn-primary btn-lg btn-block mt-4">SUBMIT</button>
            </div>
        </div>

        @foreach($post->comments as $comment)
            <div class="card m-4 w-75 mx-auto">
                <div class="card-header">
                    <div class="row my-2">
                        @can('update', $comment)
                            <div class="col">
                                <div class="d-flex">
                                    <a class="btn btn-primary btn-lg btn-block" href="{{ route('attachments.create', ['id' => $comment->id, 'type' => Comment::class]) }}" role="button">ADD ATTACHMENTS</a>
                                </div>
                            </div>
                        @endcan
                        
                        @can('update', $comment)
                            <div class="col">
                                <div class="d-flex">
                                    <a class="btn btn-primary btn-lg btn-block" href="{{ route('comments.edit', ['comment' => $comment]) }}" role="button">EDIT COMMENT</a>
                                </div>
                            </div>
                        @endcan

                        @can('delete', $comment)
                            <div class="col">
                                <div class="card mx-auto">
                                    <form method="POST" action="{{ route('comments.destroy', ['comment' => $comment]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-lg btn-block">DELETE COMMENT</button>
                                    </form>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="{{ route('users.show', ['user' => $comment->user]) }}">
                            <img src="{{ asset('/storage/images/'.$comment->user->profilePicture->avatar) }}" class="img-thumbnail" alt="{{ $comment->user->profilePicture->description }}" style="width:50px; height:50px;">
                            {{ $comment->user->name }}
                        </a>
                    </h4>
                    <h6 class="card-subtitle text-muted">
                        {{ $comment->created_at->diffForHumans() }}
                    </h6>
                    <p class="card-text mt-3">{{ $comment->body }}</p>
                    {{-- @can('update', $comment)
                        <div class="d-flex">
                            <a class="btn btn-primary btn-lg btn-block" href="{{ route('attachments.create', ['id' => $comment->id, 'type' => Comment::class]) }}" role="button">ADD ATTACHMENTS</a>
                        </div>
                    @endcan --}}
                </div>
                @if($comment->attachments->isNotEmpty())
                    <div class="card-footer text-muted">
                        Attachments:<br>
                        @foreach($comment->attachments as $attachment)
                            <div class="d-inline-flex">
                                <a href="{{ route('attachments.show', ['attachment' => $attachment]) }}">
                                    <h5>{{ $attachment->file }}</h5>
                                </a>
                                @can('delete', $comment)
                                    <form method="POST" action="{{ route('attachments.destroy', ['id' => $comment->id, 'type' => Comment::class, 'attachment' => $attachment]) }}">
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
        @endforeach
    </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0-0/axios.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script>
            var com = new Vue({
                el: "#com",
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
                        axios.post("{{ route('api.comments.store', ['user' => auth()->user(), 'post' => $post]) }}",
                        {
                            body: this.newCommentBody,
                        })
                        .then(response => {
                            console.log(response);
                            this.comments.push(response.data);
                            this.newCommentBody = '';
                        })
                        .catch(response => {
                            console.log(response);
                        });
                    }
                }
            });
        </script>
@endsection