<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Templates</title>
    <link href="/vendors/bootstrap-5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="/vendors/select2/dist/css/select2.min.css" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css"> --}}
    <link rel="stylesheet" type="text/css" href="/vendors/select2-bootstrap5/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" type="text/css" href="/vendors/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="/vendors/datatables/RowGroup-1.2.0/css/rowGroup.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/vendors/fontawesome/css/all.css" />
    <link rel="stylesheet" type="text/css" href="/asset/css/style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/template">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav me-auto mb-2 mb-lg-0 nav-pills">
                    @foreach ($menus as $menu)
                        @if (count($menu->submenu) == 0)
                            <li class="nav-item">
                                <a class="nav-link  {{ request()->is($menu->current) ? 'active' : '' }}" aria-current="page" href="{{ $menu->link }}">{{ $menu->name }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="/template" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $menu->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach ($menu->submenu as $submenu)
                                        <li><a class="dropdown-item" href="{{ $menu->link . $submenu->sub_link }}">{{ $submenu->sub_name }}</a></li>
                                        {{-- <li><a class="dropdown-item" href="/template">Another action</a></li> --}}
                                    @endforeach
                                    {{-- <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li class="nav-item dropdown"><a class="dropdown-item" href="/template">Something else here &raquo;</a></li> --}}
                                </ul>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <script type="text/javascript" src="/asset/jquery.min.js"></script>
    <script src="/vendors/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>

</body>

</html>
