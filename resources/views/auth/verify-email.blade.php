@extends('layouts.basic')

<style>
    .btn{
        padding: 10px 10px;
        border: none;
        border-radius: 4px;
        background: coral;
    }
    .btn:hover{
        cursor: pointer;
        background: rgb(247, 102, 49);
    }
    
.main-container{
    margin: auto;
    width: 60%;
}

#form-content{
    display: flex;
    justify-content: center;
}

.form-item{
    align-self: center;
    margin-right: 10px;
}

</style>

@section('content')
<main>
   <div class="main-container">
    <div>
        <h3>Please click the verification link in the email sent to you to verify your account</h3>
    </div>

    <form id="form-content" action="{{ route('verification.resend') }}" method="POST">
        @csrf
        <p class="form-item">Didn't got the email ?</p>
        <input class="form-item btn" type="submit"  value="Resend email">
    </form>
   </div>
</main>

@endsection

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
</head>
<body>
    <H1>please click the verification link in the email sent to you to verify your account</H1>

    <form action="{{ route('verification.resend') }}" method="POST">
        @csrf
    <input type="submit" value="Resend the verification link?">
    </form>
</body>
</html> --}}