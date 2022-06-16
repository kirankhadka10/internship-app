@extends('layouts.basic')

@section('content')
    @foreach ($posts as $post)
    <div class="card">
        <div class="card-header">
           <h2> {{ $post->title }} </h2>
           <p>{{ $post->user->name }}</p>
        </div>
        <div class="card-body">
            <p>{{ $post->body }}</p>
            <h5> Posted on: {{ $post->created_at }}</h5>
        </div>

        <div class="card-footer">
            <a href="/post/{{ $post->id }}">Read More</a>
        </div>
    </div>
    <hr>
    @endforeach

    {{-- <table>
        <thead>
            <tr>
                <td>Last Login</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user )
            <tr>
                <td>{{ $user->last_login_at}}</td>
            </tr>
            @endforeach
        </tbody>
    </table> --}}
@endsection