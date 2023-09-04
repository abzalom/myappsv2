<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Tahun
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->get('tahun')) {
            if (auth()->user()->hasRole(['admin', 'bappeda'])) {
                return redirect()->to(route('config.tahun'))->with('pesan', 'Tahun anggaran belum dibuat');
            }
            return redirect()->to('/')->with('pesan', 'Tahun anggaran belum dibuat');
        }
        return $next($request);
    }
}
