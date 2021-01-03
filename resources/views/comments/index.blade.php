@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <div class="d-flex justify-content-center">
        <h1>Comments:</h1>
    </div>

    <div id="root">
        <div class="card m-4 w-75 mx-auto" v-for="comment in comments">
            <div class="card-body">
                @{{ comment }}
            </div>
        </div>
    </div>

    <script>
        var app = new Vue({
            el: "#root",
            data: {
                comments: ['hello', 'world'],
            },
            // mounted() {
            //     axios.get("{{ route('api.comments.index') }}")
            //     .then(response => {
            //         //handle success
            //         this.comments = response.data;
            //     })
            //     .catch(response => {
            //         //handle errors
            //         console.log(response);
            //         redirect()->back()->withErrors('API called failed.');
            //     })
            // },
        });
    </script>
@endsection