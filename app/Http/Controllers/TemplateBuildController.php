<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemplateBuildController extends Controller
{
    public function buildTemplate()
    {
        $menus = collect(json_decode(Storage::disk('public')->get('/data/menus.json')));
        return view('template', [
            'menus' => $menus,
        ]);
    }

    public function testRequest()
    {
        return request()->is('request');
    }
}
