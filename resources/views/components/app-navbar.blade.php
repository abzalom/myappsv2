<div class="mb-5">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">MyApps</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav me-auto mb-2 mb-lg-0 nav-pills">

                    @foreach ($menus as $menu)
                        @foreach ($menu->roles as $role)
                            @role(trim($role))
                                @if (count($menu->submenu) == 0)
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is($menu->current) ? 'active' : '' }}" aria-current="page" href="{{ $menu->link }}">{{ $menu->name }}</a>
                                    </li>
                                @else
                                    <li class="nav-item dropdown">
                                        <a class="nav-link {{ request()->is($menu->current) ? 'active' : '' }} dropdown-toggle" href="{{ $menu->link }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ $menu->name }}
                                        </a>
                                        <ul class="dropdown-menu">
                                            @foreach ($menu->submenu as $sub)
                                                @foreach ($sub->roles as $subrole)
                                                    @role(trim($subrole))
                                                        <li><a class="dropdown-item" href="{{ $menu->link . $sub->sub_link }}">{{ $sub->sub_name }}</a></li>
                                                    @endrole
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endrole
                        @endforeach
                    @endforeach

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->username }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                            @if (auth()->user()->hasRole(['admin']))
                                <li><a class="dropdown-item" href="/setting/roles">Roles & Permissions</a></li>
                                <li><a class="dropdown-item" href="/setting/users">Users</a></li>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                {{-- <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> --}}
            </div>
        </div>
    </nav>
</div>
