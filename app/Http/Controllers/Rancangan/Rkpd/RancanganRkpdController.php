<?php

namespace App\Http\Controllers\Rancangan\Rkpd;

use App\Models\Opd;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PaguRancanganOpd;
use App\Http\Controllers\Controller;
use App\Models\Rkpd\Rancangan\Rancangan1Urusan;
use App\Models\Rkpd\Rancangan\Rancangan5Subkegiatan;
use App\Models\Rkpd\Rancangan\Rancangan6Subkeluaran;

class RancanganRkpdController extends Controller
{
    public function rancangan()
    {
        $user = User::with('pegawai')->find(auth()->user()->id);
        $opds = [];
        if ($user->hasRole(['admin', 'bappeda'])) {
            $opds = Opd::withSum('pagurancangans', 'jumlah')->withSum('rancangansubkeluarans', 'anggaran')->orderBy('kode_opd')->get();
        } else {
            $opds = Opd::withSum('pagurancangans', 'jumlah')->withSum('rancangansubkeluarans', 'anggaran')->orderBy('kode_opd')->where('kode_opd', $user->pegawai->opdpeg->kode_opd)->get();
        }
        return view('rkpd.rancangan.rancangan-home', [
            'apps' => [
                'title' => 'Rancangan RKPD',
                'desc' => 'Rancangan RKPD Tahun Anggaran ' . session()->get('tahun'),
            ],
            'opds' => $opds,
            'jumlah_renja' => Rancangan6Subkeluaran::sum('anggaran'),
            'jumlah_pagu' => PaguRancanganOpd::sum('jumlah'),
        ]);
    }

    public function rancanganrenja($id)
    {
        $opd = Opd::withSum('rancangansubkeluarans', 'anggaran')
            ->withSum('pagurancangans', 'jumlah')
            ->find($id);
        $infopagus = PaguRancanganOpd::with([
            'subkeluarans',
            'sumberdana',
        ])
            ->withSum([
                'subkeluarans' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)
            ], 'anggaran')
            ->where('kode_opd', $opd->kode_opd)
            ->orderBy('kode_unik_sumberdana')
            ->get();
        // return $infopagus;
        $urusans = Rancangan1Urusan::with([
            'bidangs' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)->whereHas('programs'),
            'bidangs.programs' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)->whereHas('kegiatans'),
            'bidangs.programs.kegiatans' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)->whereHas('subkegiatans'),
            'bidangs.programs.kegiatans.subkegiatans' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)->withSum('subkeluarans', 'anggaran')->withCount('subkeluarans'),
            'bidangs.programs.kegiatans.subkegiatans.subkeluarans' => fn ($q) => $q->where('kode_opd', $opd->kode_opd),
            'bidangs.programs.kegiatans.subkegiatans.subkeluarans.pagu' => fn ($q) => $q->where('kode_opd', $opd->kode_opd),
            'bidangs.programs.kegiatans.subkegiatans.subkeluarans.pagu.sumberdana',
        ])->where('kode_opd', $opd->kode_opd)->get();
        $user = User::with('pegawai')->find(auth()->user()->id);
        if (!$user->hasRole(['admin', 'bappeda'])) {
            if (auth()->user()->pegawai->opdpeg->kode_opd !== $opd->kode_opd) {
                return redirect()->to(route('rkpd.rancangan'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
            }
        }
        if (!$opd) {
            return redirect()->to(route('rkpd.rancangan'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
        }
        return view('rkpd.rancangan.rancangan-renja', [
            'apps' => [
                'title' => 'Rancangan Renja',
                'desc' => 'RANCANGAN RENJA ' . $opd->nama_opd . ' TAHUN ANGGARAN ' . tahun(),
            ],
            'infopagus' => $infopagus,
            'opd' => $opd,
            'urusans' => $urusans,
            'subkegdels' => Rancangan5Subkegiatan::onlyTrashed()->where('kode_opd', $opd->kode_opd)->get(),
            'subkeldels' => Rancangan6Subkeluaran::with([
                'subkegiatan' => fn ($q) => $q->withTrashed()
            ])->onlyTrashed()->where('kode_opd', $opd->kode_opd)->get(),
        ]);
    }

    public function rancanganrenjasubkegiatan($id)
    {
        if (!lockRkpd('rancangan', session()->get('tahun'))) {
            return redirect()->to('/rancangan/rkpd/opd/' . $id)->with('pesan', 'Maaf, sepertinya telah terjadi kesalahan!');
        }
        $opd = Opd::find($id);
        $user = User::with('pegawai')->find(auth()->user()->id);
        if (!$user->hasRole(['admin', 'bappeda'])) {
            if (auth()->user()->pegawai->opdpeg->kode_opd !== $opd->kode_opd) {
                return redirect()->to(route('rkpd.rancangan'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
            }
        }
        if (!$user->can('input renja')) {
            return abort(403);
        }
        if (!$opd) {
            return redirect()->to(route('rkpd.rancangan'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
        }
        return view('rkpd.rancangan.rancangan-renja-input-subkegiatan', [
            'apps' => [
                'title' => 'Rancangan Renja',
                'desc' => 'Input Sub Kegiatan Renja ' . str($opd->nama_opd)->title() . ' Tahun Anggaran ' . tahun(),
            ],
            'opd' => $opd,
            'rutin' => substr($opd->kode_opd, 0, 4),
        ]);
    }

    public function rancanganrenjasubkegiatanedit($opd, $idsub)
    {
        $opd = Opd::find($opd);
        $user = User::with('pegawai')->find(auth()->user()->id);
        if (!$user->hasRole(['admin', 'bappeda'])) {
            if (auth()->user()->pegawai->opdpeg->kode_opd !== $opd->kode_opd) {
                return redirect()->to(route('rkpd.rancangan'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
            }
        }
        if (!$user->can('input renja')) {
            return abort(403);
        }
        if (!$opd) {
            return redirect()->to(route('rkpd.rancangan'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
        }
        $subkegiatan = Rancangan5Subkegiatan::find($idsub);
        return view('rkpd.rancangan.rancangan-renja-edit-subkegiatan', [
            'apps' => [
                'title' => 'Rancangan Renja',
                'desc' => 'Edit Sub Kegiatan ' . $subkegiatan->kode_subkegiatan . ' ' . $subkegiatan->uraian . ' Pada Renja ' . str($opd->nama_opd)->title(),
            ],
            'opd' => $opd,
            'subkegiatan' => $subkegiatan,
        ]);
    }

    public function rancanganrenjasubkeluaran($opd, $idsub)
    {
        $opd = Opd::find($opd);
        if (!$opd) {
            return redirect()->to(route('rkpd.rancangan'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
        }
        $subkegiatan = Rancangan5Subkegiatan::find($idsub);
        return view('rkpd.rancangan.rancangan-renja-input-subkeluaran', [
            'apps' => [
                'title' => 'Rancangan Renja',
                'desc' => 'Input Sub Keluaran pada Sub Kegiatan ' . $subkegiatan->kode_subkegiatan . ' ' . $subkegiatan->uraian . ' Pada Renja ' . str($opd->nama_opd)->title(),
            ],
            'opd' => $opd,
            'subkegiatan' => $subkegiatan,
        ]);
    }

    public function rancanganrenjasubkeluaranedit($opd, $idsubkeg, $idsubkel)
    {
        $opd = Opd::find($opd);
        if (!$opd) {
            return redirect()->to(route('rkpd.rancangan'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
        }
        $subkegiatan = Rancangan5Subkegiatan::find($idsubkeg);
        $subkeluaran = Rancangan6Subkeluaran::find($idsubkel);
        return view('rkpd.rancangan.rancangan-renja-edit-subkeluaran', [
            'apps' => [
                'title' => 'Rancangan Renja',
                'desc' => 'Edit Sub Keluaran ' . $subkeluaran->uraian . ' Pada Renja ' . str($opd->nama_opd)->title(),
            ],
            'opd' => $opd,
            'subkegiatan' => $subkegiatan,
            'subkeluaran' => $subkeluaran,
        ]);
    }
}
