<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify Email</title>
</head>
<body>
    <div class="container">
        <main>
            <p>Hello {{ $username }}, Thank you for signing up. Your account has been verified. Cheers!</p>
            {{-- <form action="{{ route('verification.verify') }}" method="POST">
                @csrf
                <input type="submit" value="Verify">
            </form> --}}
        </main>
    </div>
</body>
</html>