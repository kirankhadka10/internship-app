<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Admin</title>
</head>
<style>
    body{
        box-sizing: border-box;
        font-family: sans-serif;
        margin: 0px;
        background-image: url('https://images.unsplash.com/photo-1519681393784-d120267933ba?crop=entropy&cs=tinysrgb&fm=jpg&ixlib=rb-1.2.1&q=60&raw_url=true&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8YW5pbWF0ZWR8ZW58MHx8MHx8&auto=format&fit=crop&w=500');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }
    body a{
        text-decoration: none;
        color: black;
    }
    
    #top-bar{
        background: coral ;
        color: white;
    }
    #main-header{
        display: flex;
        justify-content: space-between;
        margin: auto;
        width: 50%;
    }

    #nav-link{
        margin-top: 5px;
    }

    .container{
        width: 50%;
        margin:auto;
    }

    table{
        margin-top: 20px;
    }
    table, thead, td{
        border: 1px solid white;
        border-collapse: collapse;
    }

    thead td{
        background: hsl(180, 96%, 46%);
    }
    tbody tr td{
        background: hsl(180, 66%, 74%);
    }
    thead td{
        font-weight: bold;
    }
    table td{
        padding: 10px 20px;
        text-align: center
    }

    .btn{
        padding: 5px 10px;
        border-radius: 5px;
        background: salmon;
        color: white;
        font-size: 14px;
        margin: 5px;
    }
    .btn:hover{
        cursor: pointer;
        background: rgb(223, 79, 63);
    }

    #editbtn, #deletebtn{
        display: inline-block;
    }
    #btn-layout{
        display: grid;
    }

    
    #editbtn{
    }
   
    #deletebtn{
        float: right;    
    }
    .card-tools{
        display: flex;
    }

    .card-tools h3 a{
        margin-right: 10px;
    }
</style>


<body>
    <div id="top-bar">
        <header id="main-header">
            <div class="card-header">
                <h3>
                    Users
                </h3>
            </div>

            <div class="card-tools">

                <h3>
                    <a href="{{ route('welcome')}}" style="color: white">Home</a>
                </h3>

                <h3>
                    <a href="{{ route('logout') }}" style="color: white">Logout</a>
                </h3>
              
            </div>
        </header>
    </div>
    <main>
        <div class="container">
            <table>
                <thead>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Role</td>
                        <td>Last Login</td>
                        <td colspan="2">Actions</td>
                </thead>
                <tbody>
                    @foreach ($users as $user )
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->last_login_at->timezone('Asia/Kathmandu')->format('Y/m/d h:i:s A')}}</td>
                            <td id="btn-layout" >
                                <a href="{{ route('admin.users.edit', $user->id)}}" id="editbtn" class="btn">Edit</a>
                                
                                <a href="#" onclick="confirmDelete({{ $user->id }})" id="deletebtn" class="btn" > Delete 
                                </a>
    
                                <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST">
    
                                @csrf    
                                @method('DELETE')
    
                                </form>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
    <script src="{{ asset('js/delete.js')}}"></script>
</body>
</html>