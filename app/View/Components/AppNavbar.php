<?php

namespace App\View\Components;

use App\Models\Menu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

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
        $menus = Menu::with([
            'submenu' => fn ($q) => $q->orderBy('nomor', 'asc'),
        ])->orderBy('nomor', 'asc')->get();
        return view('components.app-navbar', compact('menus'));
    }
}
