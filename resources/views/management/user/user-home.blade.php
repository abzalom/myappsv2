<x-app-layout :apps="$apps">

    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-header {{ $edit ? 'bg-primary' : 'bg-secondary' }} text-white">
                    <span class="card-title">{{ $edit ? 'Edit User' : 'Tambah User' }}</span>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        @csrf
                        <input type="hidden" name="aksi" value="{{ $edit ? 'update' : 'create' }}">
                        @if ($edit)
                            <input type="hidden" name="id" value="{{ encrypt($edit->id) }}">
                        @endif
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Nama</label>
                            <input type="text" name="name" value="{{ old('name') ? old('name') : ($edit ? $edit->name : '') }}" class="form-control" id="nameInput" placeholder="Nama">
                            @error('name')
                                <small class="text-danger fst-italic">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="usernameInput" class="form-label">Username</label>
                            <input type="text" name="username" value="{{ old('username') ? old('username') : ($edit ? $edit->username : '') }}" class="form-control" id="usernameInput" placeholder="Username">
                            @error('username')
                                <small class="text-danger fst-italic">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="emailInput" class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') ? old('email') : ($edit ? $edit->email : '') }}" class="form-control" id="emailInput" placeholder="name@example.com">
                            @error('email')
                                <small class="text-danger fst-italic">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Roles</label>
                            <select name="roles[]" class="form-select select2-multiple" data-placeholder="Roles" multiple>
                                @foreach ($roles as $role)
                                    @if (old('roles'))
                                        @if (in_array($role->name, old('roles')))
                                            <option value="{{ $role->name }}" selected>{{ $role->name }}</option>
                                        @else
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endif
                                    @else
                                        @if ($edit)
                                            @if (in_array($role->name, $edit->getRoleNames()->toArray()))
                                                <option value="{{ $role->name }}" selected>{{ $role->name }}</option>
                                            @else
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endif
                                        @else
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            @if ($edit)
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                                </div>
                                <div class="col-6">
                                    <a href="/user/setting/users" class="btn btn-secondary w-100">Batal</a>
                                </div>
                            @else
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Data Users</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped datatables" style="width: 100%">
                            <thead class="align-middle text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Roles</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->pegawai ? $user->pegawai->phone : '' }}</td>
                                        <td>
                                            @foreach ($user->getRoleNames() as $role)
                                                @php
                                                    $color = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];
                                                @endphp
                                                <span class="badge text-bg-{{ $color[array_rand($color, 2)[1]] }}">{{ $role }}</span>
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @if (!$user->deleted_at)
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <form action="/user/setting/users/reset" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ encrypt($user->id) }}">
                                                        <button type="submit" class="btn btn-sm btn-warning btn-group-form-first" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Reset password : {{ $user->username }}"><i class="fa-solid fa-arrow-rotate-left"></i></button>
                                                    </form>
                                                    <a href="?edit={{ encrypt($user->id) }}" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit user : {{ $user->username }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <form action="/user/setting/users/lock" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ encrypt($user->id) }}">
                                                        <button type="submit" class="btn btn-sm btn-danger btn-group-form-last" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Kunci user : {{ $user->username }}"><i class="fa-solid fa-user-lock"></i></button>
                                                    </form>
                                                </div>
                                            @else
                                                <form action="/user/setting/users/unlock" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ encrypt($user->id) }}">
                                                    <button type="submit" class="btn btn-sm btn-danger btn-group-form-last" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Aktifkan kembali user : {{ $user->username }}"><i class="fa-solid fa-lock-open"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sccript')
</x-app-layout>
