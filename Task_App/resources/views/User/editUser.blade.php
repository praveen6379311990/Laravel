@extends('index.index')
<link rel="stylesheet" href="{{ asset('css/userEdit.css') }}">
@section('main')
    <div class="edit_user">
        <h3>Edit User</h3>
        @foreach ($getUserData as $user)
            <form action="/edituserData/{{$user->id}}" method="POST">
                @csrf
                <label for="username">User Name</label>
                <input type="text" name="username" placeholder="Enter your username" value={{ $user->name }} required>

                <label for="email">Email ID</label>
                <input type="email" name="email" placeholder="Enter your email" value={{ $user->email_id }} required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>

                <button type="submit" name="submit">Submit</button>
            </form>
        @endforeach
    </div>
@endsection
