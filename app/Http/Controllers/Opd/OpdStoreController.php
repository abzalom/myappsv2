<?php

namespace App\Http\Controllers\Opd;

use App\Models\Opd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Management\OpdRequest;
use App\Models\A2Bidang;
use App\Models\OpdTag;

class OpdStoreController extends Controller
{


    public function store(OpdRequest $request)
    {
        $bidangs = collect([]);
        if ($request->bidang1) {
            $bidangs->push($request->bidang1);
        }
        if ($request->bidang2) {
            $bidangs->push($request->bidang2);
        }
        if ($request->bidang3) {
            $bidangs->push($request->bidang3);
        }

        $kode_bidang = "";
        if ($bidangs->unique()->count() == 1) {
            $kode_bidang = $bidangs->unique()->values()[0] . '.0.00.0.00';
        }
        if ($bidangs->unique()->count() == 2) {
            $kode_bidang = $bidangs->unique()->values()[0] . '.' . $bidangs->unique()->values()[1] . '.0.00';
        }
        if ($bidangs->unique()->count() == 3) {
            $kode_bidang = $bidangs->unique()->values()[0] . '.' . $bidangs->unique()->values()[1] . '.' . $bidangs->unique()->values()[2];
        }

        $perangkat = Opd::where(['kode_bidang' => $kode_bidang, 'tahun' => tahun()])->get();
        $nomor = '';
        if (strlen($perangkat->count()) <= 1) {
            if ($perangkat->count() == 9) {
                $nomor = $perangkat->count() + 1 . '.0000';
            } else {
                $nomor = '0' . $perangkat->count() + 1 . '.0000';
            }
        }
        if (strlen($perangkat->count()) > 1) {
            $nomor = $perangkat->count() + 1 . '.0000';
        }
        $kode_opd = $kode_bidang . '.' . $nomor;
        $opd = $request->storeopd($kode_bidang, $nomor, $kode_opd);
        $request->storetag($opd, $bidangs->unique()->values()->toArray());
        return redirect()->to(route('opd'))->with('pesan', 'Perangkat daerah ' . str($opd->nama_opd)->upper() . ' berhasil ditambahkan');
    }

    function update(OpdRequest $request, $id)
    {
        $id = decrypt($id);
        $bidangs = collect([]);
        if ($request->bidang1) {
            $bidangs->push($request->bidang1);
        }
        if ($request->bidang2) {
            $bidangs->push($request->bidang2);
        }
        if ($request->bidang3) {
            $bidangs->push($request->bidang3);
        }

        $kode_bidang = "";
        if ($bidangs->unique()->count() == 1) {
            $kode_bidang = $bidangs->unique()->values()[0] . '.0.00.0.00';
        }
        if ($bidangs->unique()->count() == 2) {
            $kode_bidang = $bidangs->unique()->values()[0] . '.' . $bidangs->unique()->values()[1] . '.0.00';
        }
        if ($bidangs->unique()->count() == 3) {
            $kode_bidang = $bidangs->unique()->values()[0] . '.' . $bidangs->unique()->values()[1] . '.' . $bidangs->unique()->values()[2];
        }

        $opd = Opd::find($id);
        $kode_opd = $kode_bidang . '.' . $opd->nomor;
        $opd->tags()->delete();

        $opd->kode_bidang = $kode_bidang;
        $opd->kode_opd = $kode_opd;
        $opd->nama_opd = $request->opd;
        $opd->save();

        foreach ($bidangs->unique()->values()->toArray() as $bidang) {
            $getBidang = A2Bidang::where('kode_bidang', $bidang)->first();
            OpdTag::create([
                'kode_opd' => $opd->kode_opd,
                'kode_urusan' => $getBidang->kode_urusan,
                'kode_bidang' => $getBidang->kode_bidang,
                'tahun' => $opd->tahun,
            ]);
        }
        return redirect()->to(route('opd'))->with('pesan', 'Perangkat daerah ' . $opd->nama_opd . ' berhasil diupdate');
    }

    public function destroy(Request $request)
    {
        $opd = Opd::find($request->id);
        $nama_opd = $opd->nama_opd;
        $opd->delete();
        return redirect()->to(route('opd'))->with('pesan', 'Perangkat daerah ' . $nama_opd . ' berhasil dikunci');
    }

    public function restore(Request $request)
    {
        $opd = Opd::onlyTrashed()->find($request->id);
        $nama_opd = $opd->nama_opd;
        $opd->restore();
        return redirect()->to(route('opd'))->with('pesan', 'Perangkat daerah ' . $nama_opd . ' berhasil diaktifkan kembali');
    }
}
