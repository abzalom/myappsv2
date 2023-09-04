<?php

namespace App\View\Components;

use Closure;
use App\Models\Menu;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class AppNavbar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // $menus = Menu::with([
        //     'submenu' => fn ($q) => $q->orderBy('nomor', 'asc'),
        // ])->orderBy('nomor', 'asc')->get();
        // $menus = collect(json_decode(Storage::disk('public')->get('/data/menus.json')));
        $menus = collect(json_decode(Storage::disk('public')->get('/data/menus_test.json')));
        return view('components.app-navbar', compact('menus'));
    }
}
