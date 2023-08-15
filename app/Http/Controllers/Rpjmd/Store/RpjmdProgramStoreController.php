<?php

namespace App\Http\Controllers\Rpjmd\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rpjmd\ProgramRequest;
use Illuminate\Http\Request;

class RpjmdProgramStoreController extends Controller
{
    public function storeprogram(ProgramRequest $request)
    {
        $request->store();
        return back()->with('pesan', 'Program berhasil ditambahkan!');
    }

    function destoryprogram(ProgramRequest $request)
    {
        $request->destroy();
        return back()->with('pesan', 'Program berhasil dihapus!');
    }
}
