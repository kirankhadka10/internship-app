<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/layout/basic.css')}}">
</head>
<body>
        <header>
            <div class="container">
                {{-- left side --}}
                <nav id="nav-right">
                    <ul>
                        <li><a href="{{ route('welcome')}}">App</a></li>
                    </ul>
                </nav>
                {{-- right side --}}
                <nav id="nav-left">
                    <ul>
                        <li><a href="{{ route('welcome') }}">Home</a></li>
                        @if (Route::has('login'))
                            @auth
                                <li><a href="{{ route('logout') }}">Logout</a></li>
                                <li><a href="{{ route('create-post') }}">Create Post</a> </li>
                                @else
                                <li><a href="{{ route('login') }}">Login</a></li>
                                @if(Route::has('register'))
                                <li><a href="{{ route('register') }}">Register</a></li>
                                @endif
                            @endauth                                                                                  
                        @endif
                        
                    </ul>
                </nav>

               
            </div>
            
        </header>
        <main>
            <div class="main-container">
                @yield('content')
            </div>
        </main>
     
        
        <footer>
          <p> &copy;Copyright, 2022</p>
        </footer>
        
    
</body>
</html>