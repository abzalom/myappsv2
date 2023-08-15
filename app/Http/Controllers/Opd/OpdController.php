<?php

namespace App\Http\Controllers\Opd;

use App\Http\Controllers\Controller;
use App\Models\A2Bidang;
use App\Models\Opd;
use App\Models\OpdTag;
use Illuminate\Http\Request;

class OpdController extends Controller
{
    public function opd()
    {
        $opds = Opd::with('tags')->withTrashed()->orderBy('kode_opd')->get();
        return view('management.opd.opd-man', [
            'apps' => [
                'title' => 'OPD',
                'desc' => 'Management Perangkat Daerah',
            ],
            'opds' => $opds,
        ]);
    }

    public function create()
    {
        return view('management.opd.opd-create', [
            'apps' => [
                'title' => 'OPD',
                'desc' => 'Management Perangkat Daerah',
            ],
            'bidangs' => A2Bidang::get(),
        ]);
    }

    function edit($id)
    {
        $id = decrypt($id);
        return view('management.opd.opd-edit', [
            'apps' => [
                'title' => 'OPD',
                'desc' => 'Management Perangkat Daerah',
            ],
            'opd' => Opd::find($id),
            'bidangs' => A2Bidang::get(),
        ]);
    }
}
