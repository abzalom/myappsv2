<?php

namespace App\Http\Controllers\Rpjmd\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rpjmd\SasaranRequest;
use Illuminate\Http\Request;

class RpjmdSasaranStoreController extends Controller
{
    public function storesasaran(SasaranRequest $request)
    {
        $request->store();
        return back()->with('pesan', 'Sasaran berhasil ditambahkan!');
    }

    public function updatesasaran(SasaranRequest $request)
    {
        $request->update();
        return back()->with('pesan', 'Sasaran berhasil diupdate!');
    }
}
