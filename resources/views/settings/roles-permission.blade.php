<x-app-layout :apps="$apps">

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Card Title</span>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-4">
                            <form class="mb-3" action="{{ $edit ? '/setting/roles/update' : '/setting/roles/save' }}" method="post">
                                @csrf
                                @if ($edit)
                                    <input type="hidden" name="role_sebelum" value="{{ $edit->name }}">
                                @endif
                                <div class="mb-3">
                                    <label for="roleNameInput" class="form-label">Role Name</label>
                                    <input type="text" name="role" value="{{ $edit ? $edit->name : old('name') }}" class="form-control" id="roleNameInput" placeholder="Role Name">
                                    @error('role')
                                        <small class="text-danger fst-italic"><i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="permissionInput" class="form-label">Permissions</label>
                                    <select name="permission[]" class="form-select" id="permissionInput" data-placeholder="Pilih..." multiple>
                                        @foreach ($permissions as $permis)
                                            @php
                                                $selected = '';
                                                if ($edit) {
                                                    foreach ($edit->permissions as $value) {
                                                        if ($permis->name == $value->name) {
                                                            $selected = 'selected';
                                                        }
                                                    }
                                                }
                                            @endphp
                                            <option value="{{ $permis->name }}" {{ $selected }}>{{ $permis->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($edit)
                                    <button type="submit" class="btn btn-outline-primary">Update</button>
                                    <a href="/setting/roles" class="btn btn-outline-secondary">Batal</a>
                                @else
                                    <button type="submit" class="btn btn-outline-primary">Simpan</button>
                                @endif
                            </form>
                        </div>

                        <div class="col-8">
                            <table class="table table-bordered">
                                <thead class="table-info">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Role Name</th>
                                        <th scope="col">Permission</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($roles as $role)
                                        <tr>
                                            <th scope="row">{{ $no++ }}</th>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @foreach ($role->permissions as $permission)
                                                    @php
                                                        $color = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];
                                                    @endphp
                                                    <span class="badge rounded-pill text-bg-{{ $color[array_rand($color, 2)[1]] }}">{{ $permission->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="container">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="?edit={{ $role->name }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-edit"></i></a>
                                                        <form class="inline" action="/setting/roles/destory" method="post">
                                                            @csrf
                                                            <input type="hidden" name="role" value="{{ $role->name }}">
                                                            <button type="submit" class="btn btn-sm btn-danger btn-group-form-last"><i class="fa-solid fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
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
    </div>
    </div>

    <script src="/asset/js/role_permission.js"></script>
    @include('sccript')
</x-app-layout>
