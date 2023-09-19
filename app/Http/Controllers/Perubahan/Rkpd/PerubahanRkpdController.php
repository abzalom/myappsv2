<?php

namespace App\Http\Controllers\Perubahan\Rkpd;

ini_set('max_execution_time', 300);

use App\Http\Controllers\Controller;
use App\Models\Opd;
use App\Models\PaguOpd\PaguPerubahanOpd;
use App\Models\Rkpd\Perubahan\Perubahan1Urusan;
use App\Models\Rkpd\Perubahan\Perubahan5Subkegiatan;
use App\Models\Rkpd\Perubahan\Perubahan6Subkeluaran;
use App\Models\User;
use Illuminate\Http\Request;

class PerubahanRkpdController extends Controller
{
    public function perubahan()
    {
        $user = User::with('pegawai')->find(auth()->user()->id);
        $opds = [];
        $jumlah_renja = '';
        $menjadi_jumlah_renja = '';
        $jumlah_pagu = '';
        if ($user->hasRole(['admin', 'bappeda'])) {
            $opds = Opd::with([
                'perubahansubkeluarans'
            ])
                ->withSum('paguperubahans', 'jumlah')
                ->withSum('paguperubahans', 'menjadi_jumlah')
                ->withSum('perubahansubkeluarans', 'anggaran')
                ->withSum('perubahansubkeluarans', 'menjadi_anggaran')
                ->orderBy('kode_opd')->get();
            $jumlah_renja = Perubahan6Subkeluaran::whereHas('opd')->sum('anggaran');
            $menjadi_jumlah_renja = Perubahan6Subkeluaran::whereHas('opd')->sum('menjadi_anggaran');
            $jumlah_pagu = PaguPerubahanOpd::whereHas('opd')->sum('jumlah');
        } else {
            $opds = Opd::with([
                'perubahansubkeluarans'
            ])
                ->withSum('paguperubahans', 'jumlah')
                ->withSum('paguperubahans', 'menjadi_jumlah')
                ->withSum('perubahansubkeluarans', 'anggaran')
                ->withSum('perubahansubkeluarans', 'menjadi_anggaran')
                ->orderBy('kode_opd')->where('kode_opd', $user->pegawai->opdpeg->kode_opd)->get();
            $jumlah_renja = Perubahan6Subkeluaran::where('kode_opd', $user->pegawai->opdpeg->kode_opd)->whereHas('opd')->sum('anggaran');
            $menjadi_jumlah_renja = Perubahan6Subkeluaran::where('kode_opd', $user->pegawai->opdpeg->kode_opd)->whereHas('opd')->sum('menjadi_anggaran');
            $jumlah_pagu = PaguPerubahanOpd::where('kode_opd', $user->pegawai->opdpeg->kode_opd)->whereHas('opd')->sum('jumlah');
        }
        return view('rkpd.perubahan.perubahan-renja-home', [
            'apps' => [
                'title' => 'Perubahan RKPD',
                'desc' => 'Perubahan RKPD Tahun Anggaran ' . session()->get('tahun'),
            ],
            'opds' => $opds,
            'jumlah_renja' => $jumlah_renja,
            'menjadi_jumlah_renja' => $menjadi_jumlah_renja,
            'jumlah_pagu' => $jumlah_pagu,
        ]);
    }

    public function perubahanrenja($id)
    {
        $opd = Opd::withSum('perubahansubkeluarans', 'anggaran')
            ->withSum('perubahansubkeluarans', 'menjadi_anggaran')
            ->withSum('paguperubahans', 'jumlah')
            ->withSum('paguperubahans', 'menjadi_jumlah')
            ->find($id);
        $infopagus = PaguPerubahanOpd::with([
            'subkeluarans',
            'menjadi_subkeluarans',
            'sumberdana',
        ])
            ->withSum([
                'subkeluarans' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)
            ], 'anggaran')
            ->withSum([
                'menjadi_subkeluarans' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)
            ], 'menjadi_anggaran')
            ->where('kode_opd', $opd->kode_opd)
            ->orderBy('kode_unik_sumberdana')
            ->get();
        // return $infopagus;
        $urusans = Perubahan1Urusan::with([
            'bidangs' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)->whereHas('programs'),
            'bidangs.programs' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)->whereHas('kegiatans'),
            'bidangs.programs.kegiatans' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)->whereHas('subkegiatans'),
            'bidangs.programs.kegiatans.subkegiatans' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)->withSum([
                'subkeluarans' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)
            ], 'anggaran')
                ->withSum([
                    'subkeluarans' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)
                ], 'menjadi_anggaran')
                ->withCount([
                    'subkeluarans' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)
                ]),
            'bidangs.programs.kegiatans.subkegiatans.subkeluarans' => fn ($q) => $q->where('kode_opd', $opd->kode_opd),
            'bidangs.programs.kegiatans.subkegiatans.subkeluarans.pagu' => fn ($q) => $q->where('kode_opd', $opd->kode_opd),
            'bidangs.programs.kegiatans.subkegiatans.subkeluarans.pagu.sumberdana',
        ])->where('kode_opd', $opd->kode_opd)->get();
        $user = User::with('pegawai')->find(auth()->user()->id);
        if (!$user->hasRole(['admin', 'bappeda'])) {
            if (auth()->user()->pegawai->opdpeg->kode_opd !== $opd->kode_opd) {
                return redirect()->to(route('rkpd.perubahan'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
            }
        }
        if (!$opd) {
            return redirect()->to(route('rkpd.perubahan'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
        }
        return view('rkpd.perubahan.perubahan-renja', [
            'apps' => [
                'title' => 'Perubahan Renja',
                'desc' => 'Perubahan RENJA ' . $opd->nama_opd . ' TAHUN ANGGARAN ' . tahun(),
            ],
            'infopagus' => $infopagus,
            'opd' => $opd,
            'urusans' => $urusans,
            'subkegdels' => Perubahan5Subkegiatan::onlyTrashed()->where('kode_opd', $opd->kode_opd)->get(),
            'subkeldels' => Perubahan6Subkeluaran::with([
                'subkegiatan' => fn ($q) => $q->withTrashed()
            ])->onlyTrashed()->where('kode_opd', $opd->kode_opd)->get(),
        ]);
    }

    /**
     * Sub Kegiatan
     */
    public function perubahanrenjasubkegiatan($id)
    {
        if (!lockRkpd('perubahan', session()->get('tahun'))) {
            return redirect()->to('/perubahan/rkpd/opd/' . $id)->with('pesan', 'Maaf, sepertinya telah terjadi kesalahan!');
        }
        $opd = Opd::find($id);
        $user = User::with('pegawai')->find(auth()->user()->id);
        if (!$user->hasRole(['admin', 'bappeda'])) {
            if (auth()->user()->pegawai->opdpeg->kode_opd !== $opd->kode_opd) {
                return redirect()->to(route('rkpd.perubahan'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
            }
        }
        if (!$user->can('input-renja')) {
            return abort(403);
        }
        if (!$opd) {
            return redirect()->to(route('rkpd.perubahan'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
        }
        return view('rkpd.perubahan.perubahan-renja-input-subkegiatan', [
            'apps' => [
                'title' => 'Perubahan Renja',
                'desc' => 'Input Sub Kegiatan Renja ' . str($opd->nama_opd)->title() . ' Tahun Anggaran ' . tahun(),
            ],
            'opd' => $opd,
            'rutin' => substr($opd->kode_opd, 0, 4),
        ]);
    }

    public function perubahanrenjasubkegiatanedit($opd, $idsub)
    {
        $opd = Opd::find($opd);
        if (!lockRkpd('perubahan', session()->get('tahun'))) {
            return redirect()->to('/perubahan/rkpd/opd/' . $opd->id)->with('pesan', 'Maaf, sepertinya telah terjadi kesalahan!');
        }
        $user = User::with('pegawai')->find(auth()->user()->id);
        if (!$user->hasRole(['admin', 'bappeda'])) {
            if (auth()->user()->pegawai->opdpeg->kode_opd !== $opd->kode_opd) {
                return redirect()->to(route('rkpd.perubahan'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
            }
        }
        if (!$user->can('input-renja')) {
            return abort(403);
        }
        if (!$opd) {
            return redirect()->to(route('rkpd.perubahan'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
        }
        $subkegiatan = Perubahan5Subkegiatan::find($idsub);
        return view('rkpd.perubahan.perubahan-renja-edit-subkegiatan', [
            'apps' => [
                'title' => 'Perubahan Renja',
                'desc' => 'Edit Sub Kegiatan ' . $subkegiatan->kode_subkegiatan . ' ' . $subkegiatan->uraian . ' Pada Renja ' . str($opd->nama_opd)->title(),
            ],
            'opd' => $opd,
            'subkegiatan' => $subkegiatan,
        ]);
    }

    /**
     * Sub Keluaran
     */

    public function perubahanrenjasubkeluaran($opd, $idsub)
    {
        $opd = Opd::find($opd);
        if (!lockRkpd('perubahan', session()->get('tahun'))) {
            return redirect()->to('/perubahan/rkpd/opd/' . $opd->id)->with('pesan', 'Maaf, sepertinya telah terjadi kesalahan!');
        }
        $user = User::with('pegawai')->find(auth()->user()->id);
        if (!$user->hasRole(['admin', 'bappeda'])) {
            if (auth()->user()->pegawai->opdpeg->kode_opd !== $opd->kode_opd) {
                return redirect()->to(route('rkpd.perubahan'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
            }
        }
        if (!$user->can('input-renja')) {
            return abort(403);
        }
        if (!$opd) {
            return redirect()->to(route('rkpd.perubahan'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
        }
        $subkegiatan = Perubahan5Subkegiatan::find($idsub);
        return view('rkpd.perubahan.perubahan-renja-input-subkeluaran', [
            'apps' => [
                'title' => 'Perubahan Renja',
                'desc' => 'Input Sub Keluaran pada Sub Kegiatan ' . $subkegiatan->kode_subkegiatan . ' ' . $subkegiatan->uraian . ' Pada Renja ' . str($opd->nama_opd)->title(),
            ],
            'opd' => $opd,
            'subkegiatan' => $subkegiatan,
        ]);
    }

    public function perubahanrenjasubkeluaranedit($opd, $idsubkeg, $idsubkel)
    {
        $opd = Opd::find($opd);
        if (!lockRkpd('perubahan', session()->get('tahun'))) {
            return redirect()->to('/perubahan/rkpd/opd/' . $opd->id)->with('pesan', 'Maaf, sepertinya telah terjadi kesalahan!');
        }
        $user = User::with('pegawai')->find(auth()->user()->id);
        if (!$user->hasRole(['admin', 'bappeda'])) {
            if (auth()->user()->pegawai->opdpeg->kode_opd !== $opd->kode_opd) {
                return redirect()->to(route('rkpd.perubahan'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
            }
        }
        if (!$user->can('input-renja')) {
            return abort(403);
        }
        if (!$opd) {
            return redirect()->to(route('rkpd.perubahan'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
        }
        $subkegiatan = Perubahan5Subkegiatan::find($idsubkeg);
        $subkeluaran = Perubahan6Subkeluaran::find($idsubkel);
        return view('rkpd.perubahan.perubahan-renja-edit-subkeluaran', [
            'apps' => [
                'title' => 'Perubahan Renja',
                'desc' => 'Edit Sub Keluaran ' . $subkeluaran->uraian . ' Pada Renja ' . str($opd->nama_opd)->title(),
            ],
            'opd' => $opd,
            'subkegiatan' => $subkegiatan,
            'subkeluaran' => $subkeluaran,
        ]);
    }

    public function perubahancetak(Request $request)
    {
        if ($request->_token !== $request->session()->token()) {
            abort(404);
        }
    }
}
