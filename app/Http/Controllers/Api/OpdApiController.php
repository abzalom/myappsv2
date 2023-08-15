<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Opd;
use Illuminate\Http\Request;

class OpdApiController extends Controller
{
    public function opdall()
    {
        return Opd::get()->toJson();
    }

    public function opdbykode(Request $request)
    {
        return Opd::where('kode_opd', $request->kode_opd)->first();
    }
}
