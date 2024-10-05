@extends('index.index')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@section('main')
    <div class="container">
        <div class="createUser">
            <h3>Create User</h3>
            <div class="box">
                <a class="button" href="#popup1">Add User</a>
            </div>
            <div id="popup1" class="overlay">
                <div class="popup">
                    <h2>Add User</h2>
                    <a class="close" href="#">&times;</a>
                    <form action="/addusers" method="POST">
                        @csrf
                        <label for="username">User Name</label>
                        <input type="text" name="username" placeholder="Enter your username" required>

                        <label for="email">Email ID</label>
                        <input type="email" name="email" placeholder="Enter your email" required>

                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Enter your password" required>

                        <button type="submit" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="listusers">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listUser as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email_id }}</td>
                            <td class="actions">
                                <a href="{{ url('/edituser/' .$user->id) }}" class="edit-btn">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ url('/deleteUser/' .$user->id) }}" class="edit-btn">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
