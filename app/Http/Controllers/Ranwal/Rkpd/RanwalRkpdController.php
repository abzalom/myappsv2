<?php

namespace App\Http\Controllers\Ranwal\Rkpd;

use App\Models\Opd;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PaguRanwalOpd;
use App\Http\Controllers\Controller;
use App\Models\Rkpd\Ranwal\Ranwal1Urusan;
use App\Models\Rkpd\Ranwal\Ranwal5Subkegiatan;
use App\Models\Rkpd\Ranwal\Ranwal6Subkeluaran;

class RanwalRkpdController extends Controller
{
    public function ranwal()
    {
        $user = User::with('pegawai')->find(auth()->user()->id);
        $opds = [];
        if ($user->hasRole(['admin', 'bappeda'])) {
            $opds = Opd::withSum('paguranwals', 'jumlah')->withSum('ranwalsubkeluarans', 'anggaran')->orderBy('kode_opd')->get();
        } else {
            $opds = Opd::withSum('paguranwals', 'jumlah')->withSum('ranwalsubkeluarans', 'anggaran')->orderBy('kode_opd')->where('kode_opd', $user->pegawai->opdpeg->kode_opd)->get();
        }
        return view('rkpd.ranwal.ranwal-home', [
            'apps' => [
                'title' => 'Ranwal RKPD',
                'desc' => 'Rancangan Awal RKPD Tahun Anggaran ' . session()->get('tahun'),
            ],
            'opds' => $opds,
            'jumlah_renja' => Ranwal6Subkeluaran::sum('anggaran'),
            'jumlah_pagu' => PaguRanwalOpd::sum('jumlah'),
        ]);
    }

    public function ranwalrenja($id)
    {
        $opd = Opd::withSum('ranwalsubkeluarans', 'anggaran')
            ->withSum('paguranwals', 'jumlah')
            ->find($id);
        $infopagus = PaguRanwalOpd::with([
            'subkeluarans',
            'sumberdana',
        ])
            ->withSum([
                'subkeluarans' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)
            ], 'anggaran')
            ->where('kode_opd', $opd->kode_opd)
            ->orderBy('kode_unik_sumberdana')
            ->get();
        $urusans = Ranwal1Urusan::with([
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
                return redirect()->to(route('rkpd.ranwal'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
            }
        }
        if (!$opd) {
            return redirect()->to(route('rkpd.ranwal'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
        }
        return view('rkpd.ranwal.ranwal-renja', [
            'apps' => [
                'title' => 'Ranwal Renja',
                'desc' => 'RANCANGAN AWAL RENJA ' . $opd->nama_opd . ' TAHUN ANGGARAN ' . tahun(),
            ],
            'infopagus' => $infopagus,
            'opd' => $opd,
            'urusans' => $urusans,
            'subkegdels' => Ranwal5Subkegiatan::onlyTrashed()->where('kode_opd', $opd->kode_opd)->get(),
            'subkeldels' => Ranwal6Subkeluaran::with([
                'subkegiatan' => fn ($q) => $q->withTrashed()
            ])->onlyTrashed()->where('kode_opd', $opd->kode_opd)->get(),
        ]);
    }

    public function ranwalrenjasubkegiatan($id)
    {
        if (!lockRkpd('ranwal', session()->get('tahun'))) {
            return redirect()->to('/ranwal/rkpd/opd/' . $id)->with('pesan', 'Maaf, sepertinya telah terjadi kesalahan!');
        }
        $opd = Opd::find($id);
        $user = User::with('pegawai')->find(auth()->user()->id);
        if (!$user->hasRole(['admin', 'bappeda'])) {
            if (auth()->user()->pegawai->opdpeg->kode_opd !== $opd->kode_opd) {
                return redirect()->to(route('rkpd.ranwal'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
            }
        }
        if (!$user->can('input renja')) {
            return abort(403);
        }
        if (!$opd) {
            return redirect()->to(route('rkpd.ranwal'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
        }
        return view('rkpd.ranwal.ranwal-renja-input-subkegiatan', [
            'apps' => [
                'title' => 'Ranwal Renja',
                'desc' => 'Input Sub Kegiatan Renja ' . str($opd->nama_opd)->title() . ' Tahun Anggaran ' . tahun(),
            ],
            'opd' => $opd,
            'rutin' => substr($opd->kode_opd, 0, 4),
        ]);
    }

    public function ranwalrenjasubkegiatanedit($opd, $idsub)
    {
        $opd = Opd::find($opd);
        $user = User::with('pegawai')->find(auth()->user()->id);
        if (!$user->hasRole(['admin', 'bappeda'])) {
            if (auth()->user()->pegawai->opdpeg->kode_opd !== $opd->kode_opd) {
                return redirect()->to(route('rkpd.ranwal'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
            }
        }
        if (!$user->can('input renja')) {
            return abort(403);
        }
        if (!$opd) {
            return redirect()->to(route('rkpd.ranwal'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
        }
        $subkegiatan = Ranwal5Subkegiatan::find($idsub);
        return view('rkpd.ranwal.ranwal-renja-edit-subkegiatan', [
            'apps' => [
                'title' => 'Ranwal Renja',
                'desc' => 'Edit Sub Kegiatan ' . $subkegiatan->kode_subkegiatan . ' ' . $subkegiatan->uraian . ' Pada Renja ' . str($opd->nama_opd)->title(),
            ],
            'opd' => $opd,
            'subkegiatan' => $subkegiatan,
        ]);
    }

    public function ranwalrenjasubkeluaran($opd, $idsub)
    {
        $opd = Opd::find($opd);
        if (!$opd) {
            return redirect()->to(route('rkpd.ranwal'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
        }
        $subkegiatan = Ranwal5Subkegiatan::find($idsub);
        return view('rkpd.ranwal.ranwal-renja-input-subkeluaran', [
            'apps' => [
                'title' => 'Ranwal Renja',
                'desc' => 'Input Sub Keluaran pada Sub Kegiatan ' . $subkegiatan->kode_subkegiatan . ' ' . $subkegiatan->uraian . ' Pada Renja ' . str($opd->nama_opd)->title(),
            ],
            'opd' => $opd,
            'subkegiatan' => $subkegiatan,
        ]);
    }

    public function ranwalrenjasubkeluaranedit($opd, $idsubkeg, $idsubkel)
    {
        $opd = Opd::find($opd);
        if (!$opd) {
            return redirect()->to(route('rkpd.ranwal'))->with('pesan', 'Perangkat Daerah tidak ditemukan!');
        }
        $subkegiatan = Ranwal5Subkegiatan::find($idsubkeg);
        $subkeluaran = Ranwal6Subkeluaran::find($idsubkel);
        return view('rkpd.ranwal.ranwal-renja-edit-subkeluaran', [
            'apps' => [
                'title' => 'Ranwal Renja',
                'desc' => 'Edit Sub Keluaran ' . $subkeluaran->uraian . ' Pada Renja ' . str($opd->nama_opd)->title(),
            ],
            'opd' => $opd,
            'subkegiatan' => $subkegiatan,
            'subkeluaran' => $subkeluaran,
        ]);
    }
}
