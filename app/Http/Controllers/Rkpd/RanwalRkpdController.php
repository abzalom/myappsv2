<?php

namespace App\Http\Controllers\Rkpd;

use App\Http\Controllers\Controller;
use App\Models\Opd;
use App\Models\Rkpd\Ranwal\Ranwal1Urusan;
use App\Models\Rkpd\Ranwal\Ranwal5Subkegiatan;
use App\Models\Rkpd\Ranwal\Ranwal6Subkeluaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RanwalRkpdController extends Controller
{
    public function ranwal()
    {
        // return session()->all();
        // return session()->put('tahun', tahun());
        $user = User::with('pegawai')->find(auth()->user()->id);
        $opds = [];
        if ($user->hasRole(['admin', 'bappeda'])) {
            $opds = Opd::withSum('pagus', 'jumlah')->withSum('ranwalsubkeluarans', 'anggaran')->orderBy('kode_opd')->get();
        } else {
            $opds = Opd::withSum('pagus', 'jumlah')->withSum('ranwalsubkeluarans', 'anggaran')->orderBy('kode_opd')->where('kode_opd', $user->pegawai->opdpeg->kode_opd)->get();
        }
        // return $opds;
        return view('rkpd.ranwal.ranwal-home', [
            'apps' => [
                'title' => 'Ranwal RKPD',
                'desc' => 'Rancangan Awal RKPD Tahun Anggaran ' . session()->get('tahun'),
            ],
            'opds' => $opds,
        ]);
    }

    public function ranwalrenja($id)
    {
        // return countdownRkpd('ranwal', session()->get('tahun'));
        $opd = Opd::with([
            'pagus' => fn ($q) => $q->withSum('subkeluarans', 'anggaran')
        ])
            ->withSum('ranwalsubkeluarans', 'anggaran')
            ->withSum('pagus', 'jumlah')
            ->find($id);
        // $urusans = Ranwal1Urusan::where('kode_opd', $opd->kode_opd)->get();
        // Cache::clear('nomens');
        $urusans = Cache::get('nomens');
        if (!$urusans) {
            $urusans = Ranwal1Urusan::with([
                'bidangs' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)->whereHas('programs'),
                'bidangs.programs' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)->whereHas('kegiatans'),
                'bidangs.programs.kegiatans' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)->whereHas('subkegiatans'),
                'bidangs.programs.kegiatans.subkegiatans' => fn ($q) => $q->where('kode_opd', $opd->kode_opd)->withSum('subkeluarans', 'anggaran')->withCount('subkeluarans'),
                'bidangs.programs.kegiatans.subkegiatans.subkeluarans' => fn ($q) => $q->where('kode_opd', $opd->kode_opd),
                'bidangs.programs.kegiatans.subkegiatans.subkeluarans.pagu' => fn ($q) => $q->where('kode_opd', $opd->kode_opd),
                'bidangs.programs.kegiatans.subkegiatans.subkeluarans.pagu.uraianpendapatan',
            ])->where('kode_opd', $opd->kode_opd)->get();
            // Cache::put('nomens', $urusans, 60 * 60 * 5);
        }
        // return $opd;
        // return $urusans;
        // dump($urusans);
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
            'opd' => $opd,
            'urusans' => $urusans,
            'subkegdels' => Ranwal5Subkegiatan::onlyTrashed()->where('kode_opd', $opd->kode_opd)->get(),
            'subkeldels' => Ranwal6Subkeluaran::with([
                'subkegiatan' => fn ($q) => $q->onlyTrashed()
            ])->onlyTrashed()->where('kode_opd', $opd->kode_opd)->get(),
        ]);
    }

    public function ranwalrenjasubkegiatan($id)
    {
        if (!lockRkpd('ranwal', session()->get('tahun'))) {
            return redirect()->to('/rkpd/ranwal/opd/' . $id)->with('pesan', 'Maaf, sepertinya telah terjadi kesalahan!');
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
