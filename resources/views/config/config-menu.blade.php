<x-app-layout :apps="$apps">

    <div class="row">
        <div class="col-lg-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="card-header bg-info">
                            Create Menu
                        </div>
                        <div class="card-body">
                            <form action="{{ $editmenu !== null ? '/config/app/menu/update' : '/config/app/menu' }}" method="post">
                                @csrf
                                <div class="mb-2">
                                    <label for="menusNomor" class="form-label">Nomor Menu</label>
                                    <input type="text" name="nomor" value="{{ old('nomor') ? old('nomor') : ($editmenu !== null ? $editmenu->nomor : '') }}" class="form-control" id="menusNomor" placeholder="Nomor Menu">
                                    @error('nomor')
                                        <small class="text-danger fw-bold fst-italic">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="menus" class="form-label">Menu</label>
                                    <input type="text" name="menuname" value="{{ old('menuname') ? old('menuname') : ($editmenu !== null ? $editmenu->name : '') }}" class="form-control" id="menus" placeholder="Nama menu">
                                    @error('menuname')
                                        <small class="text-danger fw-bold fst-italic">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="menusRoles" class="form-label">Roles</label>
                                    <select name="menuroles[]" class="form-control select2-multiple" id="menusRoles" data-placeholder="Role" multiple>
                                        @foreach ($roles as $role1)
                                            @php
                                                $selected = '';
                                                if ($editmenu !== null) {
                                                    foreach ($editmenu->roles as $menuroleedit) {
                                                        if ($role1->name == $menuroleedit) {
                                                            $selected = 'selected';
                                                        }
                                                    }
                                                }
                                            @endphp
                                            <option value="{{ $role1->name }}" {{ $selected }}>{{ $role1->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('menuroles')
                                        <small class="text-danger fw-bold fst-italic">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="menuscurrent" class="form-label">Current</label>
                                    <input type="text" name="menuscurrent" value="{{ old('menuscurrent') ? old('menuscurrent') : ($editmenu !== null ? $editmenu->current : '') }}" class="form-control" id="menuscurrent" placeholder="Current active">
                                    @error('menuscurrent')
                                        <small class="text-danger fw-bold fst-italic">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="menuslink" class="form-label">Menu Link</label>
                                    <input type="text" name="menulink" value="{{ old('menulink') ? old('menulink') : ($editmenu !== null ? $editmenu->link : '') }}" class="form-control" id="menuslink" placeholder="Contoh : home/profile">
                                    @error('menulink')
                                        <small class="text-danger fw-bold fst-italic">{{ $message }}</small>
                                    @enderror
                                </div>
                                @if ($editmenu !== null)
                                    <input type="hidden" name="menuid" value="{{ $editmenu->id }}">
                                    <button type="submit" id="updatemenu" class="btn btn-primary btn-block w-100">Update</button>
                                @else
                                    <button type="submit" id="savemenu" class="btn btn-primary btn-block w-100">Save</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="card-header bg-warning">
                            Create Sub Menu
                        </div>
                        <div class="card-body">
                            <form action="{{ $editsubmenu !== null ? '/config/app/submenu/update' : '/config/app/submenu' }}" method="post">
                                @csrf
                                <div class="mb-2">
                                    <label for="submenunomor" class="form-label">Nomor Sub Menu</label>
                                    <input type="text" name="nomor" value="{{ old('nomor') ? old('nomor') : ($editsubmenu !== null ? $editsubmenu->nomor : '') }}" class="form-control" id="submenunomor" placeholder="Nomor Sub Menu">
                                    @error('nomor')
                                        <small class="text-danger fw-bold fst-italic">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="mb-2 col-sm-12">
                                        <label for="parentmenu" class="form-label">Parent Menu</label>
                                        <select name="submenuparent" class="form-control select2-single" id="parentmenu" data-placeholder="Parent Menu">
                                            <option value="">Pilih...</option>
                                            @foreach ($menus as $parent)
                                                <option value="{{ $parent->id }}" {{ $editsubmenu !== null ? ($editsubmenu->menu_id == $parent->id ? 'selected' : '') : '' }}>{{ $parent->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('submenuparent')
                                            <small class="text-danger fw-bold fst-italic">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-2 col-sm-12">
                                        <label for="submenuroles" class="form-label">Sub Menu Roles</label>
                                        <select name="submenuroles[]" class="form-control select2-multiple" id="submenuroles" data-placeholder="Role" multiple>
                                            @foreach ($roles as $role2)
                                                @php
                                                    $selected = '';
                                                    if ($editsubmenu !== null) {
                                                        foreach ($editsubmenu->roles as $subroleedit) {
                                                            if ($role2->name == $subroleedit) {
                                                                $selected = 'selected';
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                <option value="{{ $role2->name }}" {{ $selected }}>{{ $role2->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('submenuroles')
                                            <small class="text-danger fw-bold fst-italic">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="submenuname" class="form-label">Sub Menu Name</label>
                                    <input type="text" name="submenuname" value="{{ old('submenuname') ? old('submenuname') : ($editsubmenu !== null ? $editsubmenu->sub_name : '') }}" class="form-control" id="submenuname" placeholder="Nama sub menu">
                                    @error('submenuname')
                                        <small class="text-danger fw-bold fst-italic">{{ $message }}</small>
                                    @enderror
                                </div>
                                <label for="submenuslink" class="form-label">Sub Menu Link</label>
                                <div class="input-group mb-0">
                                    <span class="input-group-text" id="submenulink-addon1">
                                        @if ($editsubmenu !== null)
                                            <input type="hidden" name="submenuid" value="{{ $editsubmenu->id }}">
                                            http://myapps.com{{ $editsubmenu->menu->link }}
                                        @else
                                            http://myapps.com
                                        @endif
                                    </span>
                                    <input type="text" name="submenuslink" value="{{ old('submenulink') ? old('submenulink') : ($editsubmenu !== null ? $editsubmenu->sub_link : '') }}" class="form-control" placeholder="path" aria-label="Username" aria-describedby="submenulink-addon1">
                                </div>
                                <div class="mb-3">
                                    @error('submenuslink')
                                        <small class="text-danger fw-bold fst-italic">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" id="savemenu" class="btn btn-primary btn-block w-100">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    Menus
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered table-striped table-hover datatables-config">
                        <thead class="table-info">
                            <tr>
                                <th>Menu</th>
                                <th>Sub Menu</th>
                                <th>Link</th>
                                <th>Role</th>
                                <th>Current</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                @if ($menu->submenu->count() == 0)
                                    <tr>
                                        <td>{{ $menu->nomor . '. ' . $menu->name }}
                                            <a href="?id={{ $menu->id }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                            @if (!$menu->deleted_at)
                                                <form class="d-inline-flex" action="/config/app/menu/destroy" method="post">
                                                    @csrf
                                                    <input type="hidden" name="menuid" value="{{ $menu->id }}">
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-lock"></i></button>
                                                </form>
                                            @else
                                                <form class="d-inline-flex" action="/config/app/menu/restore" method="post">
                                                    @csrf
                                                    <input type="hidden" name="menuid" value="{{ $menu->id }}">
                                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa-solid fa-lock-open"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                        <td></td>
                                        <td>{{ $menu->link }}</td>
                                        <td>
                                            @foreach ($menu->roles as $menurole)
                                                <span class="badge text-bg-primary">
                                                    {{ $menurole }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>{{ $menu->current }}</td>
                                        <td>
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($menu->submenu as $submenu)
                                    <tr>
                                        <td>
                                            {{ $menu->nomor . '. ' . $menu->name }}
                                            <a href="?id={{ $menu->id }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                        </td>
                                        <td>{{ $submenu->nomor . '. ' . $submenu->sub_name }}</td>
                                        <td>{{ $submenu->sub_link }}</td>
                                        <td>
                                            @foreach ($submenu->roles as $submenurole)
                                                <span class="badge text-bg-primary">
                                                    {{ $submenurole }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>{{ $menu->current }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                @if (!$submenu->deleted_at)
                                                    <a href="?submenu={{ $submenu->id }}" class="btn btn-info btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <form action="/config/app/submenu/destroy" method="post">
                                                        @csrf
                                                        <input type="hidden" name="submenu" value="{{ $submenu->id }}">
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-lock"></i></button>
                                                    </form>
                                                @else
                                                    <form action="/config/app/submenu/restore" method="post">
                                                        @csrf
                                                        <input type="hidden" name="submenu" value="{{ $submenu->id }}">
                                                        <button type="submit" class="btn btn-secondary btn-sm"><i class="fa-solid fa-lock-open"></i></button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('sccript')
    <script src="/asset/js/config.js"></script>

</x-app-layout>
