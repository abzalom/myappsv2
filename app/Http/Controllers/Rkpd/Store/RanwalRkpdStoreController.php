<?php

namespace App\Http\Controllers\Rkpd\Store;

use App\Models\Opd;
use Illuminate\Http\Request;
use App\Imports\RanwalRenjaImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Validators\ValidationException;
use App\Http\Requests\Rkpd\Ranwal\NomenRanwalRenjaRequest;
use App\Http\Requests\Rkpd\Ranwal\SubkeluaranRanwalRenjaRequest;

class RanwalRkpdStoreController extends Controller
{
    public function ranwalrenjasubkegiatanstore(NomenRanwalRenjaRequest $request)
    {
        $opd = Opd::where('kode_opd', $request->opd)->first();
        $subkegiatan = $request->storenomenranwal();
        Cache::clear('nomens');
        // return $subkegiatan;
        return redirect()->to('/rkpd/ranwal/opd/' . $opd->id)->with('pesan', 'Sub kegiatan ' . $subkegiatan->kode_subkegiatan . ' ' . $subkegiatan->uraian . ' berhasil ditambahkan');
    }

    public function ranwalrenjasubkegiatanupdate(NomenRanwalRenjaRequest $request)
    {
        $opd = Opd::where('kode_opd', $request->opd)->first();
        $subkegiatan = $request->udpatenomenranwal();
        // return $subkegiatan;
        Cache::clear('nomens');
        return redirect()->to('/rkpd/ranwal/opd/' . $opd->id)->with('pesan', 'Subkegiatan ' . $subkegiatan->kode_subkegiatan . ' ' . $subkegiatan->uraian . ' berhasil diupdate!');
    }

    public function ranwalrenjasubkegiatandestroy(NomenRanwalRenjaRequest $request)
    {
        $request->destroynomenranwal();
        Cache::clear('nomens');
        return back()->with('pesan', 'Sub Kegiatan berhasil dihapus');
    }

    public function ranwalrenjasubkegiatanrestore(NomenRanwalRenjaRequest $request)
    {
        $subkegiatan = $request->restorenomenranwal();
        Cache::clear('nomens');
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
        Cache::clear('nomens');
        return redirect()->to('/rkpd/ranwal/opd/' . $opd->id)->with('pesan', 'Subkeluaran ' . $subkeluaran->uraian . ' berhasil ditambahkan!');
    }

    public function ranwalrenjasubkeluaranudpate(SubkeluaranRanwalRenjaRequest $request)
    {
        $opd = Opd::find($request->opd);
        $sisapagu = $request->checkpaguupdate();
        if (!$sisapagu['value']) {
            return redirect()->back()->withInput($request->input())->with('pesan', 'Inputan anggaran Rp. ' . number_format($sisapagu['input'], 2, ',', '.') . ' melebihi batasan pagu yang hanya tersisa Rp. ' . number_format($sisapagu['sisa'], 2, ',', '.') . ' dari sumber dana ' . $sisapagu['sumberdana']);
        }
        $subkeluaran = $request->updatesubkeluaran();
        Cache::clear('nomens');
        return redirect()->to('/rkpd/ranwal/opd/' . $opd->id)->with('pesan', 'Subkeluaran ' . $subkeluaran->uraian . ' berhasil diupdate!');
    }

    public function ranwalrenjasubkeluarandestroy(SubkeluaranRanwalRenjaRequest $request)
    {
        $request->destroysubkeluaran();
        Cache::clear('nomens');
        return back()->with('pesan', 'Sub Keluaran berhasil dihapus');
    }

    public function ranwalrenjasubkeluaranrestore(SubkeluaranRanwalRenjaRequest $request)
    {
        $subkeluaran = $request->restoresubkeluaran();
        Cache::clear('nomens');
        return back()->with('pesan', 'Sub Keluaran ' . $subkeluaran->uraian . ' berhasil dikembalikan');
    }

    /**
     * Upload Ranwal Renja OPD
     */

    public function ranwalrenjaupload(Request $request)
    {
        Cache::clear('nomens');
        $import = Excel::import(new RanwalRenjaImport(Opd::find($request->idopd)), $request->file);
        return back()->with('pesan', 'data berhasil diupload');
    }
}
