@extends('layouts.basic')
<style>
.card-content{
    margin-bottom: 15px;
}

.card-content label{
    margin-bottom: 10px;
}
.card-content input{
    
}
.card-content title{
    align-self: center;

}

.post-title{
    margin-top: 10px;
}

.card-content textarea{
    padding: 20px;
    margin-top: 10px;
    width: 50%;
    font-size: 15px;
}

.btn{
        padding: 10px 10px;
        border: none;
        border-radius: 4px;
        background: coral;
    }
</style>
@section('content')

<div class="card">
    <div class="card-header">
        <h2>Create a new post</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('save-post') }}" method="POST">
            @csrf

            <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">

            <div class="card-content">
                <label for="title" id="title">Post title</label> <br>
                <input type="text" name="title" class="post-title" id="title">
            </div>
            
    
            <div class="card-content">
                <label for="body">Post Body</label> <br>
                <textarea name="body" id="body"></textarea>
            </div>
            
            <input type="submit" class="btn" value="Save Post">
        </form>
    </div>
   
</div>

@endsection