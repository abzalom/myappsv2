<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuCollection;
use App\Http\Resources\Resource\MenuResource;
use App\Http\Resources\Resource\SubMenuResource;
use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Http\Request;

class ConfigApiController extends Controller
{
    public function all_menu()
    {
        return MenuResource::collection(Menu::all());
    }

    public function one_menu(Request $request)
    {
        return new MenuResource(Menu::findOrFail($request->id));
    }

    public function all_submenu()
    {
        return SubMenuResource::collection(SubMenu::all());
    }
}
