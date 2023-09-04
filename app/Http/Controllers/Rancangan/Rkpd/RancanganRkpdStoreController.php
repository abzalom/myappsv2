<?php

namespace App\Http\Controllers\Rancangan\Rkpd;

use App\Models\Opd;
use Illuminate\Http\Request;
use App\Imports\RanwalRenjaImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RanwalRenjaAllImport;
use App\Http\Requests\Rkpd\Rancangan\NomenRancanganRenjaRequest;
use App\Http\Requests\Rkpd\Rancangan\SubkeluaranRancanganRenjaRequest;

class RancanganRkpdStoreController extends Controller
{
    public function rancanganrenjasubkegiatanstore(NomenRancanganRenjaRequest $request)
    {
        $opd = Opd::where('kode_opd', $request->opd)->first();
        $subkegiatan = $request->storenomenrancangan();
        return redirect()->to('/rancangan/rkpd/opd/' . $opd->id)->with('pesan', 'Sub kegiatan ' . $subkegiatan->kode_subkegiatan . ' ' . $subkegiatan->uraian . ' berhasil ditambahkan');
    }

    public function rancanganrenjasubkegiatanupdate(NomenRancanganRenjaRequest $request)
    {
        $opd = Opd::where('kode_opd', $request->opd)->first();
        $subkegiatan = $request->udpatenomenrancangan();
        return redirect()->to('/rancangan/rkpd/opd/' . $opd->id)->with('pesan', 'Subkegiatan ' . $subkegiatan->kode_subkegiatan . ' ' . $subkegiatan->uraian . ' berhasil diupdate!');
    }

    public function rancanganrenjasubkegiatandestroy(NomenRancanganRenjaRequest $request)
    {
        $request->destroynomenrancangan();
        return back()->with('pesan', 'Sub Kegiatan berhasil dihapus');
    }

    public function rancanganrenjasubkegiatanrestore(NomenRancanganRenjaRequest $request)
    {
        $subkegiatan = $request->restorenomenrancangan();
        return back()->with('pesan', 'Sub Kegiatan ' . $subkegiatan->kode_subkegiatan . ' ' . $subkegiatan->uraian . ' berhasil dikembalikan');
    }


    /**
     * ACTION REQUEST FOR SUB KELUARAN
     *
     * @param SubkeluaranRancanganRenjaRequest $request
     * @return void
     */
    public function rancanganrenjasubkeluaranstore(SubkeluaranRancanganRenjaRequest $request)
    {
        $opd = Opd::find($request->opd);
        $sisapagu = $request->checkpagu();
        if (!$sisapagu) {
            return redirect()->back()->withInput($request->input())->with('pesan', 'Jumlah anggaran melebihi batasan pagu');
        }
        $subkeluaran = $request->storesubkeluaran();
        return redirect()->to('/rancangan/rkpd/opd/' . $opd->id)->with('pesan', 'Subkeluaran ' . $subkeluaran->uraian . ' berhasil ditambahkan!');
    }

    public function rancanganrenjasubkeluaranudpate(SubkeluaranRancanganRenjaRequest $request)
    {
        $opd = Opd::find($request->opd);
        $sisapagu = $request->checkpaguupdate();
        if (!$sisapagu['value']) {
            return redirect()->back()->withInput($request->input())->with('pesan', 'Inputan anggaran Rp. ' . number_format($sisapagu['input'], 2, ',', '.') . ' melebihi batasan pagu yang hanya tersisa Rp. ' . number_format($sisapagu['sisa'], 2, ',', '.') . ' dari sumber dana ' . $sisapagu['sumberdana']);
        }
        $subkeluaran = $request->updatesubkeluaran();
        return redirect()->to('/rancangan/rkpd/opd/' . $opd->id)->with('pesan', 'Subkeluaran ' . $subkeluaran->uraian . ' berhasil diupdate!');
    }

    public function rancanganrenjasubkeluarandestroy(SubkeluaranRancanganRenjaRequest $request)
    {
        $request->destroysubkeluaran();
        return back()->with('pesan', 'Sub Keluaran berhasil dihapus');
    }

    public function rancanganrenjasubkeluaranrestore(SubkeluaranRancanganRenjaRequest $request)
    {
        $subkeluaran = $request->restoresubkeluaran();
        return back()->with('pesan', 'Sub Keluaran ' . $subkeluaran->uraian . ' berhasil dikembalikan');
    }

    /**
     * Upload Ranwal Renja OPD
     */

    public function rancanganrenjaopdupload(Request $request)
    {
        // $import = Excel::import(new RanwalRenjaImport(Opd::find($request->idopd)), $request->file);
        // return back()->with('pesan', 'data berhasil diupload');
    }

    public function rancanganrenjaopdallupload(Request $request)
    {
        // $import = Excel::import(new RanwalRenjaAllImport, $request->file);
        // return back()->with('pesan', 'data berhasil diupload');
    }
}
