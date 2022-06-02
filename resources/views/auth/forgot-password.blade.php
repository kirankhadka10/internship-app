<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
   <link rel="stylesheet" type="text/css" href="{{ asset('css/auth/login.css') }}">
</head>
<body>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <b>{{$error}}</b>
    @endforeach
    @endif
    <div style="color: white;">
        {{Session::get('error')}}
    </div>
    <form action="{{ route('password.email', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="container">
            <h1>Set Up New Password</h1>
          <label for="email"><b>Email</b></label>
          <input type="email" placeholder="Enter your email" name="email" required>
                @error('email')
               <div style="color: red;font-size:12px; margin:10px; display:block;">
                {{$message}}
               </div>
                @enderror
                <br>   
          <input type="submit" value="Request Password Change"/>
          <a href="{{ route('register') }}">Don't have an account? Sign Up!</a>
        </div>
      </form>
    
</body>
</html>