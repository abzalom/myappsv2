<?php

namespace App\Http\Controllers\Ranwal\Rkpd;

use App\Models\Opd;
use Illuminate\Http\Request;
use App\Imports\RanwalRenjaImport;
use App\Http\Controllers\Controller;
use App\Imports\RanwalRenjaAllImport;
use App\Http\Requests\Rkpd\Ranwal\NomenRanwalRenjaRequest;
use App\Http\Requests\Rkpd\Ranwal\SubkeluaranRanwalRenjaRequest;
use Maatwebsite\Excel\Facades\Excel;

class RanwalRkpdStoreController extends Controller
{
    public function ranwalrenjasubkegiatanstore(NomenRanwalRenjaRequest $request)
    {
        $opd = Opd::where('kode_opd', $request->opd)->first();
        $subkegiatan = $request->storenomenranwal();
        return redirect()->to('/ranwal/rkpd/opd/' . $opd->id)->with('pesan', 'Sub kegiatan ' . $subkegiatan->kode_subkegiatan . ' ' . $subkegiatan->uraian . ' berhasil ditambahkan');
    }

    public function ranwalrenjasubkegiatanupdate(NomenRanwalRenjaRequest $request)
    {
        $opd = Opd::where('kode_opd', $request->opd)->first();
        $subkegiatan = $request->udpatenomenranwal();
        return redirect()->to('/ranwal/rkpd/opd/' . $opd->id)->with('pesan', 'Subkegiatan ' . $subkegiatan->kode_subkegiatan . ' ' . $subkegiatan->uraian . ' berhasil diupdate!');
    }

    public function ranwalrenjasubkegiatandestroy(NomenRanwalRenjaRequest $request)
    {
        $request->destroynomenranwal();
        return back()->with('pesan', 'Sub Kegiatan berhasil dihapus');
    }

    public function ranwalrenjasubkegiatanrestore(NomenRanwalRenjaRequest $request)
    {
        $subkegiatan = $request->restorenomenranwal();
        return back()->with('pesan', 'Sub Kegiatan ' . $subkegiatan->kode_subkegiatan . ' ' . $subkegiatan->uraian . ' berhasil dikembalikan');
    }


    /**
     * ACTION REQUEST FOR SUB KELUARAN
     *
     * @param SubkeluaranRanwalRenjaRequest $request
     * @return void
     */
    public function ranwalrenjasubkeluaranstore(SubkeluaranRanwalRenjaRequest $request)
    {
        $opd = Opd::find($request->opd);
        $sisapagu = $request->checkpagu();
        if (!$sisapagu) {
            return redirect()->back()->withInput($request->input())->with('pesan', 'Jumlah anggaran melebihi batasan pagu');
        }
        $subkeluaran = $request->storesubkeluaran();
        return redirect()->to('/ranwal/rkpd/opd/' . $opd->id)->with('pesan', 'Subkeluaran ' . $subkeluaran->uraian . ' berhasil ditambahkan!');
    }

    public function ranwalrenjasubkeluaranudpate(SubkeluaranRanwalRenjaRequest $request)
    {
        $opd = Opd::find($request->opd);
        $sisapagu = $request->checkpaguupdate();
        if (!$sisapagu['value']) {
            return redirect()->back()->withInput($request->input())->with('pesan', 'Inputan anggaran Rp. ' . number_format($sisapagu['input'], 2, ',', '.') . ' melebihi batasan pagu yang hanya tersisa Rp. ' . number_format($sisapagu['sisa'], 2, ',', '.') . ' dari sumber dana ' . $sisapagu['sumberdana']);
        }
        $subkeluaran = $request->updatesubkeluaran();
        return redirect()->to('/ranwal/rkpd/opd/' . $opd->id)->with('pesan', 'Subkeluaran ' . $subkeluaran->uraian . ' berhasil diupdate!');
    }

    public function ranwalrenjasubkeluarandestroy(SubkeluaranRanwalRenjaRequest $request)
    {
        $request->destroysubkeluaran();
        return back()->with('pesan', 'Sub Keluaran berhasil dihapus');
    }

    public function ranwalrenjasubkeluaranrestore(SubkeluaranRanwalRenjaRequest $request)
    {
        $subkeluaran = $request->restoresubkeluaran();
        return back()->with('pesan', 'Sub Keluaran ' . $subkeluaran->uraian . ' berhasil dikembalikan');
    }

    /**
     * Upload Ranwal Renja OPD
     */

    public function ranwalrenjaopdupload(Request $request)
    {
        $import = Excel::import(new RanwalRenjaImport(Opd::find($request->idopd)), $request->file);
        return back()->with('pesan', 'data berhasil diupload');
    }

    public function ranwalrenjaopdallupload(Request $request)
    {
        $import = Excel::import(new RanwalRenjaAllImport, $request->file);
        return back()->with('pesan', 'data berhasil diupload');
    }
}
