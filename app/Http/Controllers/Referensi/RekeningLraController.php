<?php

namespace App\Http\Controllers\Referensi;

use App\Http\Controllers\Controller;
use App\Models\C1AkunLra;
use App\Models\C2KelompokLra;
use App\Models\C3JenisLra;
use App\Models\C4ObjekLra;
use App\Models\C5RincianLra;
use Illuminate\Http\Request;

class RekeningLraController extends Controller
{
    public function akun()
    {
        return view('referensi.rekening.2-lra', [
            'apps' => [
                'title' => 'Referensi',
                'desc' => 'REFERENSI REKENING NERACA',
            ],
            'akuns' => C1AkunLra::get(),
        ]);
    }


    public function kelompok(Request $request)
    {
        $akun = C1AkunLra::find($request->id);
        // return $akun;
        foreach ($akun->kelompoks as $kelompok) {
            echo '<li class="list-group-item">';
            echo '<div class="row align-items-center mb-2">';
            echo '<div class="col-1" style="width: 4%">';
            echo '<button class="btn btn-secondary btn-sm kelompok" type="button" value="' . $kelompok->id . '" data-bs-toggle="collapse" data-bs-target="#kelompok' . $kelompok->id . '" aria-expanded="false" aria-controls="kelompok' . $kelompok->id . '"><i class="fa-solid fa-plus-square fa-lg"></i></button>';
            echo '</div>';
            echo '<div class="col-11">';
            echo '<div class="row">';
            echo '<div class="col-12">';
            echo $kelompok->kode_unik_kelompok . ' - ' . $kelompok->uraian;
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<ul class="list-group list-group-flush collapse" style="margin-left: 2%" id="kelompok' . $kelompok->id . '">';
            echo '</ul>';
            echo '</li>';
        }
    }

    public function jenis(Request $request)
    {
        $kelompok = C2KelompokLra::find($request->id);
        foreach ($kelompok->jenises as $jenis) {
            echo '<li class="list-group-item">';
            echo '<div class="row align-items-center mb-2">';
            echo '<div class="col-1" style="width: 4%">';
            echo '<button class="btn btn-warning btn-sm jenis" type="button" value="' . $jenis->id . '" data-bs-toggle="collapse" data-bs-target="#jenis' . $jenis->id . '" aria-expanded="false" aria-controls="jenis' . $jenis->id . '"><i class="fa-solid fa-plus-square fa-lg"></i></button>';
            echo '</div>';
            echo '<div class="col-11">';
            echo '<div class="row">';
            echo '<div class="col-12">';
            echo $jenis->kode_unik_jenis . ' - ' . $jenis->uraian;
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<ul class="list-group list-group-flush collapse" style="margin-left: 2%" id="jenis' . $jenis->id . '">';
            echo '</ul>';
            echo '</li>';
        }
    }

    public function objek(Request $request)
    {
        $jenis = C3JenisLra::find($request->id);
        foreach ($jenis->objeks as $objek) {
            echo '<li class="list-group-item">';
            echo '<div class="row align-items-center mb-2">';
            echo '<div class="col-1" style="width: 4%">';
            echo '<button class="btn btn-success btn-sm objek" type="button" value="' . $objek->id . '" data-bs-toggle="collapse" data-bs-target="#objek' . $objek->id . '" aria-expanded="false" aria-controls="objek' . $objek->id . '"><i class="fa-solid fa-plus-square fa-lg"></i></button>';
            echo '</div>';
            echo '<div class="col-11">';
            echo '<div class="row">';
            echo '<div class="col-12">';
            echo $objek->kode_unik_objek . ' - ' . $objek->uraian;
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<ul class="list-group list-group-flush collapse" style="margin-left: 2%" id="objek' . $objek->id . '">';
            echo '</ul>';
            echo '</li>';
        }
    }

    public function rincian(Request $request)
    {
        $objek = C4ObjekLra::find($request->id);
        foreach ($objek->rincians as $rincian) {
            echo '<li class="list-group-item">';
            echo '<div class="row align-items-center mb-2">';
            echo '<div class="col-1" style="width: 4%">';
            echo '<button class="btn btn-info btn-sm rincian" type="button" value="' . $rincian->id . '" data-bs-toggle="collapse" data-bs-target="#rincian' . $rincian->id . '" aria-expanded="false" aria-controls="rincian' . $rincian->id . '"><i class="fa-solid fa-plus-square fa-lg"></i></button>';
            echo '</div>';
            echo '<div class="col-11">';
            echo '<div class="row">';
            echo '<div class="col-12">';
            echo $rincian->kode_unik_rincian . ' - ' . $rincian->uraian;
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<ul class="list-group list-group-flush collapse" style="margin-left: 2%" id="rincian' . $rincian->id . '">';
            echo '</ul>';
            echo '</li>';
        }
    }

    public function subrincian(Request $request)
    {
        $rincian = C5RincianLra::find($request->id);
        foreach ($rincian->subrincians as $subrincian) {
            echo '<li class="list-group-item">';
            echo '<div class="row align-items-center mb-2">';
            echo '<div class="col-1" style="width: 4%">';
            // echo '<button class="btn btn-warning btn-sm subrincian" type="button" value="' . $subrincian->id . '" data-bs-toggle="collapse" data-bs-target="#subrincian' . $subrincian->id . '" aria-expanded="false" aria-controls="subrincian' . $subrincian->id . '"><i class="fa-solid fa-plus-square fa-lg"></i></button>';
            echo '</div>';
            echo '<div class="col-11">';
            echo '<div class="row">';
            echo '<div class="col-10">';
            echo '<a href="#copy" onclick="copyToClipboard(\'ambil_' . $subrincian->kode_unik_subrincian . '\')"><i class="far fa-copy fa-lg"></i></a> ' . '<span id="ambil_' . $subrincian->kode_unik_subrincian . '">' . $subrincian->kode_unik_subrincian . '</span>' . ' - ' . $subrincian->uraian;
            echo '</div>';
            echo '<div class="col-2">';
            echo $subrincian->kategori_ssh . ' - ' . $subrincian->kode_kategori_ssh;
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<ul class="list-group list-group-flush collapse" style="margin-left: 2%" id="subrincian' . $subrincian->id . '">';
            echo '</ul>';
            echo '</li>';
        }
    }
}
