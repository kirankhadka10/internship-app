@extends('layouts.basic')

@section('content')

<div class="card">
    <div class="card-header">
       <h2> {{ $post->title }} </h2>
    </div>
    <div class="card-body">
        <p>{{ $post->body }}</p>
        <h5> Posted on: {{ $post->created_at }}</h5>
    </div>
</div>

@endsection