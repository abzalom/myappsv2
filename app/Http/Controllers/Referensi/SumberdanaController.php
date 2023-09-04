<?php

namespace App\Http\Controllers\Referensi;

use App\Http\Controllers\Controller;
use App\Models\SumberDana;
use Illuminate\Http\Request;

class SumberdanaController extends Controller
{
    public function sumberdana()
    {
        return view('referensi.sumberdana.sumberdana', [
            'apps' => [
                'title' => 'Referensi',
                'desc' => 'REFERENSI SUMBER PENDANAAN',
            ],
            'sumberdanas' => SumberDana::get()
        ]);
    }
}
