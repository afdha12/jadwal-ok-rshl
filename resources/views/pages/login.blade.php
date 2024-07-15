<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login Form Design | CodeLab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    @include('sweetalert::alert')

    <div class="wrapper">
        <div class="title p-3">
            <img src="img/logo.jpg" width="150" alt="">
        </div>
        <form action="{{ route('auth') }}" method="post">
            @csrf
            <div class="field">
                <input type="text" name="username" class="form-control"
                    id="username" autofocus required value="{{ old('username') }}">
                <label>Username</label>
                {{-- @error('username')
                    <div class="invalid-feedbaack">
                        {{ $message }}
                    </div>
                @enderror --}}
            </div>
            <div class="field">
                <input type="password" name="password" class="form-control" id="password" required>
                <label>Password</label>
            </div>
            {{-- <div class="content">
                <div class="checkbox">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Remember me</label>
                </div>
                <div class="pass-link">
                    <a href="#">Forgot password?</a>
                </div>
            </div> --}}
            <div class="field mt-5">
                <input type="submit" value="Login">
            </div>
            {{-- <div class="signup-link">
                Not a member? <a href="#">Signup now</a>
            </div> --}}
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
