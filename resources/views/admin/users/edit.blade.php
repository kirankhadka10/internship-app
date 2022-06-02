<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/edit.css')}}">
    <title>Edit</title>
</head>
<body>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <b>{{$error}}</b>
    @endforeach
    @endif
    <div class="container">
        <header>
            <div class="card-header">
                <h3>
                    Edit User
                </h3>
            </div>
            <div class="card-tools">
                <a href="{{ route('admin.users.index') }}" class="btn">Show All Users</a>
            </div>
        </header>
        <main>
            <div class="card-body">
                <form action="{{ route('admin.users.update',$user->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="name">Enter Full Name</label>
                    <input type="text" name="name" id="name" value="{{$user->name}}" >
                </div>
    
                <div>
                    <label for="username">Enter New Username</label>
                    <input type="text" name="username" id="username" value="{{$user->username}}">
                </div>
               
                <div>
                    <label for="password">Enter New Password</label>
                    <input type="text" name="password" id="password">
                </div>

                <div>
                    <label for="email">Enter Email</label>
                    <input type="email" name="email" id="email" value="{{$user->email}}">
                </div>
    
                <div>
                    <label for="phone">Enter Phone Number</label>
                    <input type="text" name="phone" id="phone" value="{{$user->phone}}">
                </div>
    
                <div id="btn-div">
                    <input type="submit" class="btn btn-submit" value="Update">
                </div>
                </form>
            </div>
        </main>
    </div>

    
</body>
</html>