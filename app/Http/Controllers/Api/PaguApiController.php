<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OpdPagu;
use App\Models\PaguRanwalOpd;
use Illuminate\Http\Request;

class PaguApiController extends Controller
{
    public function pagubyid(Request $request)
    {
        return PaguRanwalOpd::with('uraianpendapatan')->find($request->id)->toJson();
    }
}
