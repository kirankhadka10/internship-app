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
    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        <div class="container">
            <h1>Reset Password</h1>
            <input type="hidden" name="token" value="{{ $token }}">
          <label for="email"><b>Email</b></label>
          <input type="email" placeholder="Enter Email" name="email" required>
                @error('email')
               <div style="color: red; margin:10px; display:block;">
                {{$message}}
               </div>
                @enderror
                <br>
          <label for="password"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" required>
      
          <input type="submit" value="Confirm"/>
          <a href="{{ route('register') }}">Don't have an account? Sign Up!</a>
        </div>
      </form>
    
</body>
</html>