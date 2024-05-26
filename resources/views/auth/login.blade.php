<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional CSS styles can be added here */
        .login-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card pt-5" style="background-color:rgb(165, 8, 8); height: 70vh;">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center" >
                            <img src="https://th.bing.com/th/id/OIP.1a2ofVr-orNHCw-lCArGOgHaI1?rs=1&pid=ImgDetMain" alt="IMAGE" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                            <h5 class="font-semibold text-xl text-white text-center mt-4">MEET YOUR DOCTOR</h5>
                        </div>  
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card"style=" height: 70vh;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Login</h5>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-success btn-block mt-3">Login</button>
                            <a href="{{route('register')}}">Dont have an account?</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
