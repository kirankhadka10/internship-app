<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up!</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/auth/register.css') }}">
</head>
<body>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <b>{{$error}}</b>
    @endforeach
    @endif
    <form action="{{ route('custom.register') }}" method="POST">      
        @csrf
        <div class="container">
            <h1>Sign Up!</h1>
            <label for="name"><b>Enter Your Name</b></label>
            <input type="text" placeholder="Enter your name" id="name" name="name" value="{{ old('name') }}">

            <label for="username"><b>Enter Your Username</b></label>
            <input type="text" placeholder="Enter your username" id="username" name="username" value="{{ old('username') }}">

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" value="{{ old('email') }}">
        
            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" value="{{ old('password') }}">

            <label for="phone"><b>Enter Your Phone Number</b></label>
            <input type="number" placeholder="Enter your phone number" id="phone" name="phone" value="{{ old('phone') }}">
            
            <input type="submit" value="Register"/>
            <a href="{{ route('login')}}">Already have an account? Login.</a>
            <a href="{{ route('home') }}">Cancel</a>
        </div>
      </form>
     
    
</body>
</html>