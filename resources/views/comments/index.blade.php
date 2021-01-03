@extends('layouts.app')

@section('title', 'Comments')

@section('content')
    <div class="d-flex justify-content-center">
        <h1>Comments:</h1>
    </div>

    {{-- <div class="card m-4 w-75 mx-auto">   
        <div class="card-body"> 
            <div class="form-group">
                <label for="body_id">Body:</label>
                <textarea type="text" class="form-control" id="body_id" name="body" placeholder="Enter body" value="{{ old('body') }}" rows="3" v-model="newCommentBody"></textarea>
            </div>
            <button @click="createComment" class="btn btn-primary btn-lg btn-block">SUBMIT</button>
        </div>
    </div> --}}

    <div id="root">
        <div class="card m-4 w-75 mx-auto" v-for="comment in comments">
            <div class="card-body">
                @{{ comment.body }}
            </div>
        </div>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0-0/axios.js"></script>
    <script>
        var app = new Vue({
            el: "#root",
            data: {
                comments: [],
                newCommentBody: '',
            },
            mounted() {
                axios.get("{{ route('api.comments.index') }}")
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