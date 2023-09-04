<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 - Forbidden</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body style="background-color: #8f8f8f">

    <div class="container">
        <div class="row">
            <div class="card col-lg-6 mx-auto" style="margin-top: 10%">
                <div class="card-body">
                    <h1 class="text-center">403 - FORBIDDEN</h1>
                    <h3 class="text-center">ANDA TIDAK MEMILIKI HAK AKSES!</h3>
                    <h4 class="text-center">SILAHKAN HUBUNGI ADMIN!</h4>
                    <h5 class="text-center">
                        <a href="{{ url()->previous() }}">Kembali</a>
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
