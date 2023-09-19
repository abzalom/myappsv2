<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyApps</title>
    <link href="/vendors/bootstrap-5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/vendors/fontawesome/css/all.css" />
</head>

<body style="background-color: #f7f7f7">

    <div class="container">
        <div class="row">
            <div class="col-4 mx-auto mb-5" style="margin-top: 10%">
                @if (session()->has('pesan'))
                    <div class="alert alert-info">{{ session()->get('pesan') }}</div>
                @endif
                <div class="card shadow border-secondary">
                    <div class="card-header">
                        {{-- <div class="card-title text-center mt-2"><i class="fa-solid fa-user-lock fa-2xl"></i></div> --}}
                        <div class="card-title text-center mt-2">
                            <img src="/asset/img/logokab.png" class="rounded mx-auto d-block w-25" alt="logo kab. mamberamo raya">
                        </div>
                        <div class="card-title text-center fw-bold">Login Myapps</div>
                    </div>
                    <form action="{{ route('auth.login') }}" method="post">
                        <div class="card-body">
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
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input name="remember" name="remember" class="form-check-input" type="checkbox" id="remember">
                                        <label class="form-check-label" for="remember">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="/asset/jquery.min.js"></script>
    <script src="/vendors/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendors/fontawesome/js/all.js') }}"></script>
</body>

</html>
