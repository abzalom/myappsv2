<?php

namespace App\Http\Controllers\Perubahan\Rkpd;

ini_set('max_execution_time', 300);

use App\Models\Opd;
use Illuminate\Http\Request;
use App\Imports\RanwalRenjaImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PerubahanRenjaAllImport;
use App\Http\Requests\Rkpd\Perubahan\NomenPerubahanRenjaRequest;
use App\Http\Requests\Rkpd\Perubahan\SubkeluaranPerubahanRenjaRequest;

class PerubahanRkpdStoreController extends Controller
{
    public function perubahanrenjasubkegiatanstore(NomenPerubahanRenjaRequest $request)
    {
        $opd = Opd::where('kode_opd', $request->opd)->first();
        $subkegiatan = $request->storenomenperubahan();
        return redirect()->to('/perubahan/rkpd/opd/' . $opd->id)->with('pesan', 'Sub kegiatan ' . $subkegiatan->kode_subkegiatan . ' ' . $subkegiatan->uraian . ' berhasil ditambahkan');
    }

    public function perubahanrenjasubkegiatanupdate(NomenPerubahanRenjaRequest $request)
    {
        $opd = Opd::where('kode_opd', $request->opd)->first();
        $subkegiatan = $request->udpatenomenperubahan();
        return redirect()->to('/perubahan/rkpd/opd/' . $opd->id)->with('pesan', 'Subkegiatan ' . $subkegiatan->kode_subkegiatan . ' ' . $subkegiatan->uraian . ' berhasil diupdate!');
    }

    public function perubahanrenjasubkegiatandestroy(NomenPerubahanRenjaRequest $request)
    {
        $request->destroynomenperubahan();
        return back()->with('pesan', 'Sub Kegiatan berhasil dihapus');
    }

    public function perubahanrenjasubkegiatanrestore(NomenPerubahanRenjaRequest $request)
    {
        $subkegiatan = $request->restorenomenperubahan();
        return back()->with('pesan', 'Sub Kegiatan ' . $subkegiatan->kode_subkegiatan . ' ' . $subkegiatan->uraian . ' berhasil dikembalikan');
    }


    /**
     * ACTION REQUEST FOR SUB KELUARAN
     *
     * @param SubkeluaranPerubahanRenjaRequest $request
     * @return void
     */
    public function perubahanrenjasubkeluaranstore(SubkeluaranPerubahanRenjaRequest $request)
    {
        $opd = Opd::find($request->opd);
        $sisapagu = $request->checkpagu();
        if (!$sisapagu) {
            return redirect()->back()->withInput($request->input())->with('pesan', 'Jumlah anggaran melebihi batasan pagu');
        }
        $subkeluaran = $request->storesubkeluaran();
        return redirect()->to('/perubahan/rkpd/opd/' . $opd->id)->with('pesan', 'Subkeluaran ' . $subkeluaran->uraian . ' berhasil ditambahkan!');
    }

    public function perubahanrenjasubkeluaranudpate(SubkeluaranPerubahanRenjaRequest $request)
    {
        // return $request->all();
        $opd = Opd::find($request->opd);
        $sisapagu = $request->checkpaguupdate();
        if (!$sisapagu['value']) {
            return redirect()->back()->withInput($request->input())->with('pesan', 'Inputan anggaran Rp. ' . number_format($sisapagu['input'], 2, ',', '.') . ' melebihi batasan pagu dengan sisa anggaran Rp. ' . number_format($sisapagu['sisa'], 2, ',', '.') . ' dari sumber dana ' . $sisapagu['sumberdana']);
        }
        $subkeluaran = $request->updatesubkeluaran();
        return redirect()->to('/perubahan/rkpd/opd/' . $opd->id)->with('pesan', 'Subkeluaran ' . $subkeluaran->uraian . ' berhasil diupdate!');
    }

    public function perubahanrenjasubkeluarandestroy(SubkeluaranPerubahanRenjaRequest $request)
    {
        $request->destroysubkeluaran();
        return back()->with('pesan', 'Sub Keluaran berhasil dihapus');
    }

    public function perubahanrenjasubkeluaranrestore(SubkeluaranPerubahanRenjaRequest $request)
    {
        $subkeluaran = $request->restoresubkeluaran();
        return back()->with('pesan', 'Sub Keluaran ' . $subkeluaran->uraian . ' berhasil dikembalikan');
    }

    /**
     * Upload Ranwal Renja OPD
     */

    public function perubahanrenjaopdupload(Request $request)
    {
        // $import = Excel::import(new RanwalRenjaImport(Opd::find($request->idopd)), $request->file);
        // return back()->with('pesan', 'data berhasil diupload');
    }

    public function perubahanrenjaopdallupload(Request $request)
    {
        $import = Excel::import(new PerubahanRenjaAllImport, $request->file);
        return back()->with('pesan', 'data berhasil diupload');
    }
}
