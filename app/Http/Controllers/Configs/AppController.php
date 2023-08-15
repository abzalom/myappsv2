<?php

namespace App\Http\Controllers\Configs;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AppController extends Controller
{
    public function menu(Request $request)
    {
        $menus = Menu::withTrashed()->with(
            [
                'submenu' => fn ($q) => $q->withTrashed()->orderBy('nomor', 'asc')
            ]
        )->orderBy('nomor', 'asc')->get();
        $editsubmenu = null;
        $editmenu = null;
        if ($request->submenu) {
            $editsubmenu = SubMenu::withTrashed()->find($request->submenu);
        }
        if ($request->id) {
            $editmenu = Menu::withTrashed()->find($request->id);
        }
        // return $editsubmenu->menu;
        return view('config.config-menu', [
            'apps' => [
                'title' => 'Config | Menu',
                'desc' => 'Pengaturan Menu',
            ],
            'roles' => Role::get(),
            'menus' => $menus,
            'editmenu' => $editmenu,
            'editsubmenu' => $editsubmenu,
        ]);
    }

    public function tahun()
    {
        $tahuns = DB::table('tahuns')->orderBy('tahun')->get();
        return view('config.config-tahun', [
            'apps' => [
                'title' => 'Config | Tahun',
                'desc' => 'Pengaturan Tahun',
            ],
            'tahuns' => $tahuns,
        ]);
    }
}
