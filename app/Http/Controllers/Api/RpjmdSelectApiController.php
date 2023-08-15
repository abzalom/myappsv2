<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\A3Program;
use App\Models\RpjmdIndikator;
use App\Models\RpjmdProgram;
use Illuminate\Http\Request;

class RpjmdSelectApiController extends Controller
{
    function programbyindikator(Request $request)
    {
        if ($request->indikator) {
            $data = RpjmdIndikator::with([
                'programs',
                'programs.nomen',
            ])->find($request->indikator);
            $a3program = A3Program::get();
            $results = [];
            foreach ($a3program as $nomen) {
                foreach ($data->programs as $rpjmdprog) {
                    dump($nomen->toArray());
                    if ($nomen->kode_program !== $rpjmdprog->kode_program) {
                        continue 2;
                    }
                }
            }
        }
    }
}
