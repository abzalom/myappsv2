<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Resources\PangkatCollection;
use App\Http\Resources\PejabatSekdaCollection;
use App\Models\PangkatPegawai;
use App\Models\PejabatSekda;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PejabatSekdaController extends Controller
{
    public function index(Request $request)
    {
        $edit = false;
        if ($request->edit) {
            $edit = new PejabatSekdaCollection(PejabatSekda::find($request->edit));
        }
        // return $edit;
        return view('management.pejabat.pejabat-sekda', [
            'apps' => [
                'title' => 'Pejabat Sekda',
                'desc' => 'Management Pejabat Sekda',
            ],
            'pangkats' => json_decode(PangkatCollection::collection(PangkatPegawai::where('golongan', 4)->get())->toJson()),
            'sekdas' => json_decode(PejabatSekdaCollection::collection(PejabatSekda::get())->toJson()),
            'edit' => $edit,
        ]);
    }

    function store(Request $request)
    {
        $data = $request->validate(
            [
                'nama' => 'required',
                'nip' => 'required|numeric|digits:16',
                'pangkat' => 'required|numeric',
                'tahun' => 'required|numeric|date_format:Y|digits:4',
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong!',
                'nip.required' => 'NIP tidak boleh kosong!',
                'nip.numeric' => 'NIP hanya boleh berupa nomor/angka!',
                'nip.digits' => 'NIP harus 16 digit!',
                'pangkat.required' => 'Pangkat tidak boleh kosong!',
                'pangkat.numeric' => 'Value pangkat tidak benar!',
                'tahun.required' => 'Tahun tidak boleh kosong!',
                'tahun.numeric' => 'Tahun hanya boleh berupa nomor/angka!',
                'tahun.date_format' => 'Format tahun tidak benar!',
                'tahun.digits' => 'Tahun harus 4 digit!',
            ]
        );
        $sekda = PejabatSekda::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'pangkat_pegawai_id' => $request->pangkat,
            'tahun' => $request->tahun,
        ]);
        return back()->with('pesan', 'Pejabat Sekda ' . $sekda->nama . ' Berhasil ditambahkan');
    }

    public function update(Request $request)
    {
        $sekda = PejabatSekda::find($request->id);
        $sekda->nama = $request->nama;
        $sekda->nip = $request->nip;
        $sekda->pangkat_pegawai_id = $request->pangkat;
        $sekda->tahun = $request->tahun;
        $sekda->save();
        return redirect()->to(route('man.pejabat.sekda'))->with('pesan', 'Pejabat Sekda ' . $sekda->nama . ' Berhasil diupadate');
    }

    public function delete(Request $request)
    {
        $sekda = PejabatSekda::find($request->id);
        return $request->all();
    }

    public function active(Request $request)
    {
        PejabatSekda::where('active', true)->update(['active' => false]);
        $sekda = PejabatSekda::find($request->sekda);
        $sekda->active = true;
        $sekda->save();
        return back()->with('pesan', 'Status sekda ' . str($sekda->nama)->upper() . ' berhasil di aktifkan');
    }
}
