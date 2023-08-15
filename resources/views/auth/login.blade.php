<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyApps</title>
    <link href="/vendors/bootstrap-5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-4 mx-auto" style="margin-top: 10%">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('auth.login') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                                    @error('username')
                                        <small class="text-danger fw-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Passowrd">
                                    @error('password')
                                        <small class="text-danger fw-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-check mb-3">
                                    <input name="remember" name="remember" class="form-check-input" type="checkbox" id="remember">
                                    <label class="form-check-label" for="remember">
                                        Remember me
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/vendors/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
