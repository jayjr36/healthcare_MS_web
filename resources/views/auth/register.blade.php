<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional CSS styles can be added here */
        .register-container {
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
            <!-- First Card: Meet Your Doctor -->
            <div class="col-md-4">
                <div class="card pt-5" style="background-color:rgb(165, 8, 8); height: 70vh;">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center">
                            <img src="https://th.bing.com/th/id/OIP.1a2ofVr-orNHCw-lCArGOgHaI1?rs=1&pid=ImgDetMain"
                                alt="IMAGE" class="rounded-circle"
                                style="width: 150px; height: 150px; object-fit: cover;">
                            <h5 class="font-semibold text-xl text-white text-center mt-4">MEET YOUR DOCTOR</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card" style="height: 70vh;">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title text-center">Register</h5>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>
                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="form-group mt-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="terms" id="terms"
                                            required>
                                        <label class="form-check-label" for="terms">
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' =>
                                                    '<a target="_blank" href="' .
                                                    route('terms.show') .
                                                    '" class="text-decoration-none text-reset">' .
                                                    __('Terms of Service') .
                                                    '</a>',
                                                'privacy_policy' =>
                                                    '<a target="_blank" href="' .
                                                    route('policy.show') .
                                                    '" class="text-decoration-none text-reset">' .
                                                    __('Privacy Policy') .
                                                    '</a>',
                                            ]) !!}
                                        </label>
                                    </div>
                                </div>
                            @endif


                            <button type="submit" class="btn btn-success btn-block mt-3">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
