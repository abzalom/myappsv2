<?php

namespace App\Http\Controllers\Configs;

use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AppStoreController extends Controller
{

    public function menustore(Request $request)
    {
        $request->validate(
            [
                'menuname' => 'required|unique:menus,name',
                'menuroles' => 'required',
                'menuscurrent' => 'required',
                'menulink' => 'unique:menus,link',
            ],
            [
                'menuname.required' => 'Nama menu tidak boleh kosong!',
                'menuname.unique' => 'Nama menu sudah ada!',
                'menuroles.required' => 'Role harus di pilih!',
                'menuscurrent.required' => 'Role harus di pilih!',
                // 'menulink.required' => 'Link menu tidak boleh kosong!',
                'menulink.unique' => 'Link menu sudah ada!',
            ]
        );

        $roles = '';

        foreach ($request->menuroles as $role) {
            $roles .= $role . ',';
        }

        // return $request->menuscurrent;
        $current = $request->menuscurrent;
        if (substr($request->menuscurrent, 0, 1) !== '/') {
            $current =  '/' . $request->menuscurrent;
        }

        $data = [
            'name' => $request->menuname,
            'roles' => $roles,
            'link' => $request->menulink ? str($request->menulink)->lower() : '#',
            'current' => str($current)->lower(),
        ];

        $menu = Menu::create($data);

        $menu->nomor = $menu->id;
        $menu->save();

        return back()->with('pesan', 'Menu berhasil di tambahkan!');
    }

    function menuupdate(Request $request)
    {
        $menu = Menu::withTrashed()->with('submenu')->find($request->menuid);
        $roles = '';
        foreach ($request->menuroles as $role) {
            $roles .= $role . ',';
        }
        $menu->current =  $request->menuscurrent;
        if (!$menu->submenu->count()) {
            if (substr($request->menuscurrent, 0, 1) == '/') {
                $menu->current =  str(substr($request->menuscurrent, 1, strlen($request->menuscurrent) - 1))->lower();
            }
        } else {
            $menu->current = $menu->current;
        }
        if ($request->nomor !== $menu->nomor) {
            $menu->nomor = $request->nomor;
        }
        $menu->name = $request->menuname;
        $menu->link = str($request->menulink)->lower() ?: '#';
        $menu->roles = $roles;
        $menu->save();
        return to_route('config.app.menu')->with('pesan', 'Menu ' . $menu->name . ' berhasil di update!');
    }

    function menudestroy(Request $request)
    {
        $menu = Menu::find($request->menuid);
        $menu->delete();
        return back()->with('pesan', 'Menu berhasil di kunci!');
    }

    function menurestore(Request $request)
    {
        $menu = Menu::onlyTrashed()->find($request->menuid);
        $menu->restore();
        return back()->with('pesan', 'Menu berhasil di buka!');
    }

    public function submenustore(Request $request)
    {
        $request->validate(
            [
                'submenuparent' => 'required',
                'submenuroles' => 'required',
                'submenuname' => 'required|unique:sub_menus,sub_name',
                'submenuslink' => 'required|unique:sub_menus,sub_link',
            ],
            [
                'submenuparent.required' => 'Parent menu belum di pilih!',
                'submenuroles.required' => 'Role menu belum di pilih!',
                'submenuname.required' => 'Nama sub menu  tidak boleh kosong!',
                'submenuslink.required' => 'Link sub menu tidak boleh kosong!',
                'submenuname.unique' => 'Nama sub menu  sudah ada!',
                'submenuslink.unique' => 'Link sub menu sudah ada!',
            ]
        );

        $roles = '';

        foreach ($request->submenuroles as $role) {
            $roles .= $role . ',';
        }

        $sublink = $request->submenuslink;
        if (substr($request->submenuslink, 0, 1) !== '/') {
            $sublink =  '/' . $request->submenuslink;
        }

        $data = [
            'menu_id' => $request->submenuparent,
            'sub_name' => $request->submenuname,
            'sub_link' => str($sublink)->lower(),
            'roles' => $roles,
        ];

        $submenu = SubMenu::create($data);
        $submenu->nomor = $submenu->id;
        $submenu->save();
        return back()->with('pesan', 'Sub Menu berhasil di tambahkan!');
    }

    function submenuupdate(Request $request)
    {
        $submenu = SubMenu::find($request->submenuid);
        $roles = '';
        foreach ($request->submenuroles as $role) {
            $roles .= $role . ',';
        }
        $sublink = $request->submenuslink;
        if (substr($request->submenuslink, 0, 1) !== '/') {
            $sublink =  '/' . $request->submenuslink;
        }
        if ($request->nomor !== $submenu->nomor) {
            $submenu->nomor = $request->nomor;
        }
        $submenu->menu_id = $request->submenuparent;
        $submenu->sub_name = $request->submenuname;
        $submenu->sub_link = str($sublink)->lower();
        $submenu->roles = $roles;
        $submenu->save();
        return to_route('config.app.menu')->with('pesan', 'Sub Menu ' . $submenu->sub_name . ' berhasil di update!');
    }

    function submenudestroy(Request $request)
    {
        SubMenu::find($request->submenu)->delete();
        return back()->with('pesan', 'Sub Menu berhasil di kunci!');
    }

    function submenurestore(Request $request)
    {
        $submenu = SubMenu::onlyTrashed()->find($request->submenu);
        $submenu->restore();
        // dump($submenu->getAttributes());
        return back()->with('pesan', 'Sub Menu berhasil di buka!');
    }

    function tahunstore(Request $request)
    {
        $request->validate(
            [
                'tahun' => 'required|numeric|digits:4|unique:tahuns,tahun',
            ],
            [
                'tahun.required' => 'Tahun tidak boleh kosong!',
                'tahun.numeric' => 'Tahun hanya boleh berupa anggka!',
                'tahun.digits' => 'Tahun hanya boleh berjumlah 4 digit, contoh: ' . date('Y') . '!',
                'tahun.unique' => 'Tahun sudah ada!',
            ],
        );

        $tahun = DB::table('tahuns');
        $tahun = $tahun->insert([
            'tahun' => $request->tahun,
            'active' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('pesan', 'Tahun berhasil ditambahkan!');
    }

    function tahunupdate(Request $request)
    {
        $tahun = DB::table('tahuns');
        $tahun->update(
            [
                'active' => false
            ]
        );
        $update = $tahun->where('id', $request->id);
        $update->update([
            'active' => true
        ]);

        $settahun = $tahun->where('id', $request->id)->first();
        session()->put('tahun', $settahun->tahun);
        return back()->with('pesan', 'Tahun berhasil diupdate!');
    }
}
