<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
    <div class="container">
        <div class="head">
            <h3>Login To your account</h3>
            <button type="button" name="user" id="user" class="btn role" onclick="userButtonclick('admin')">Login
                as User</button>
            <button type="button" name="admin" id="admin" class="btn role"
                onclick="adminButtonclick('user')">Login as Admin</button>
        </div>
        <div class="form">
            <form action="checkLogin" method="POST">
                @csrf
                <input type="hidden" name="role" id="role" value="admin">
                <label for="email"></label>
                <input type="email" name="email" placeholder="Enter your email" required>
                <label for="password"></label>
                <input type="password" name="password" placeholder="Enter your password" required>
                <button type="submit" name="submit">Login</button>
            </form>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('#user').attr("disabled", true);
    })

    function userButtonclick(role) {
        $('#user').attr("disabled", true);
        $('#admin').removeAttr("disabled");
        setRole(role);
    }

    function adminButtonclick(role) {
        $('#admin').attr("disabled", true);
        $('#user').removeAttr("disabled");
        setRole(role);
    }

    function setRole(getrole) {
        document.getElementById('role').value = getrole;
    }
</script>

</html>
