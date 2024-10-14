<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>
    <div class="container">
        @if (\Session::has('msg'))
            <div class="alert alert-success">
                <p style="color:#007bff">{!! \Session::get('msg') !!}</p>
            </div>
        @endif
        <h3>Create Admin Account</h3>
        <div class="form">
            <form action="/submitRegister" method="POST">
                @csrf
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Enter your username" required>
                <label for="email">Email ID</label>
                <input type="email" name="email" placeholder="Enter your email" required>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
        <a href="/login">Login</a>
    </div>
</body>

</html>
