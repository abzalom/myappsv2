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

    <div class="row">
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
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi pe-none me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">Sidebar</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link active" aria-current="page">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#home"></use>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#speedometer2"></use>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#table"></use>
                        </svg>
                        Orders
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#grid"></use>
                        </svg>
                        Products
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#people-circle"></use>
                        </svg>
                        Customers
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>mdo</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" style="">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="/asset/jquery.min.js"></script>
    <script src="/vendors/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>

</body>

</html>
