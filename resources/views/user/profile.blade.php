<x-app-layout :apps="$apps">
    @if (session()->has('message'))
        <div class="row">
            <div class="col-8">
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="card col-3">
            <img src="/asset/img/no-img.png" class="card-img-top" alt="...">
            <div class="card-body">
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Username : {{ auth()->user()->username }}</li>
                <li class="list-group-item">@email : {{ auth()->user()->email }}</li>
            </ul>
        </div>
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form action="/user/profile/update" method="post">
                            @csrf
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="user-name">Name</span>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') ? old('name') : auth()->user()->name }}" aria-label="Name" aria-describedby="user-name">
                            </div>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="user-email">@email</span>
                                <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') ? old('email') : auth()->user()->email }}" aria-label="Email" aria-describedby="user-email">
                            </div>
                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="user-username">Username</span>
                                <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') ? old('username') : auth()->user()->username }}" aria-label="Username" aria-describedby="user-username">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="user-password">Password</span>
                                <input type="text" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="user-password">
                            </div>
                            <button class="btn btn-primary btn-block">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sccript')
</x-app-layout>
