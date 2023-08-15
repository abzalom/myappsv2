<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class JadwalRkpd
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $tahapan): Response
    {
        $jadwal = DB::table('jadwal_rkpds')->where([
            'tahapan' => $tahapan,
            'tahun' => session()->get('tahun'),
            'deleted_at' => null,
        ])->get();
        if ($jadwal->count() == 0) {
            return redirect()->to('/')->with('pesan', 'Jadwal tahapan belum dibuat atau sudah terkunci!');
        }
        return $next($request);
    }
}
