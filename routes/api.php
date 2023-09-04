<?php

use App\Http\Controllers\Api\ConfigApiController;
use App\Http\Controllers\Api\NomensApiController;
use App\Http\Controllers\Api\OpdApiController;
use App\Http\Controllers\Api\PaguApiController;
use App\Http\Controllers\Api\PendapatanApiController;
use App\Http\Controllers\Api\RekeningApiController;
use App\Http\Controllers\Api\RolesAndPermissionsApiController;
use App\Http\Controllers\Api\RpjmdApiController;
use App\Http\Controllers\Api\RpjmdSelectApiController;
use App\Http\Controllers\Api\SumberdanaApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/api/user', function (Request $request) {
    return $request->user();
});

Route::get('/api/nomen/urusan', [NomensApiController::class, 'urusan']);

Route::middleware('auth')->group(function () {
    Route::post('/api/menus', [ConfigApiController::class, 'all_menu'])
        ->middleware('role:admin');

    Route::post('/api/menu/find', [ConfigApiController::class, 'one_menu'])
        ->middleware('role:admin');

    Route::post('/api/submenus', [ConfigApiController::class, 'all_submenu'])
        ->middleware('role:admin');


    /**
     * API RPJMD
     */
    Route::post('/api/rpjmd/periode', [RpjmdApiController::class, 'periode'])
        ->middleware('role:admin|bappeda');

    Route::post('/api/rpjmd/visi', [RpjmdApiController::class, 'visi'])
        ->middleware('role:admin|bappeda');

    Route::post('/api/rpjmd/misi', [RpjmdApiController::class, 'misi'])
        ->middleware('role:admin|bappeda');

    Route::post('/api/rpjmd/tujuan', [RpjmdApiController::class, 'tujuan'])
        ->middleware('role:admin|bappeda');

    Route::post('/api/rpjmd/sasaran', [RpjmdApiController::class, 'sasaran'])
        ->middleware('role:admin|bappeda');

    Route::post('/api/rpjmd/indikator', [RpjmdApiController::class, 'indikator'])
        ->middleware('role:admin|bappeda');

    Route::post('/api/rpjmd/program', [RpjmdApiController::class, 'program'])
        ->middleware('role:admin|bappeda');


    /**
     * API NOMENKLATUR KEPMENDAGRI 050-5889 TAHUN 2022
     */
    // Route::post('/api/nomen/urusan', [NomensApiController::class, 'urusan'])
    //     ->middleware('role:admin|bappeda|eselon-2a|eselon-2b|eselon-3a|eselon-3b|eselon-4a|eselon-4b');

    Route::post('/api/nomen/bidang', [NomensApiController::class, 'bidang'])
        ->middleware('role:admin|bappeda|eselon-2a|eselon-2b|eselon-3a|eselon-3b|eselon-4a|eselon-4b');

    Route::post('/api/nomen/program', [NomensApiController::class, 'program'])
        ->middleware('role:admin|bappeda|eselon-2a|eselon-2b|eselon-3a|eselon-3b|eselon-4a|eselon-4b');

    Route::post('/api/nomen/kegiatan', [NomensApiController::class, 'kegiatan'])
        ->middleware('role:admin|bappeda|eselon-2a|eselon-2b|eselon-3a|eselon-3b|eselon-4a|eselon-4b');

    Route::post('/api/nomen/subkegiatan', [NomensApiController::class, 'subkegiatan'])
        ->middleware('role:admin|bappeda|eselon-2a|eselon-2b|eselon-3a|eselon-3b|eselon-4a|eselon-4b');


    /**
     * API NOMENKLATUR BY KODE PARENT
     */
    Route::post('/api/nomen/program/parent/bidang', [NomensApiController::class, 'programbidang'])
        ->middleware('role:admin|bappeda|eselon-2a|eselon-2b|eselon-3a|eselon-3b|eselon-4a|eselon-4b|eselon-5a');

    Route::post('/api/nomen/kegiatan/parent/program', [NomensApiController::class, 'kegiatanprogram'])
        ->middleware('role:admin|bappeda|eselon-2a|eselon-2b|eselon-3a|eselon-3b|eselon-4a|eselon-4b|eselon-5a');

    Route::post('/api/nomen/subkegiatan/parent/kegiatan', [NomensApiController::class, 'subkegiatankegiatan'])
        ->middleware('role:admin|bappeda|eselon-2a|eselon-2b|eselon-3a|eselon-3b|eselon-4a|eselon-4b|eselon-5a');


    /**
     * API NOMENKLATUR BY ID
     */
    Route::post('/api/nomen/subkegiatan/by/id', [NomensApiController::class, 'subkegiatanid'])
        ->middleware('role:admin|bappeda|eselon-2a|eselon-2b|eselon-3a|eselon-3b|eselon-4a|eselon-4b|eselon-5a');


    /**
     * API Rekening
     */
    Route::post('/api/rekening/pendapatan/search', [RekeningApiController::class, 'searchPendapatan'])->middleware('role:admin|bappeda');
    Route::post('/api/rekening/pendapatan/uraian/search', [RekeningApiController::class, 'searchUraian'])->middleware('role:admin|bappeda');
    Route::post('/api/rekening/pendapatan/uraian/id', [RekeningApiController::class, 'byidUraian'])->middleware('role:admin|bappeda');

    /**
     * API Pagu OPD
     */
    Route::post('/api/pagu/byid', [PaguApiController::class, 'pagubyid'])->middleware('role:admin|bappeda');

    /**
     * SELECT ELEMENT API
     */
    Route::get('/api/element/rpjmd/program/by/indikator', [RpjmdSelectApiController::class, 'programbyindikator'])->middleware('role:admin|bappeda');

    /**
     * API OPD
     */
    Route::post('/api/opd/all', [OpdApiController::class, 'opdall'])->middleware('role:admin|bappeda');
    Route::post('/api/opd/kode', [OpdApiController::class, 'opdbykode'])->middleware('role:admin|bappeda');

    /**
     * API Sumber Pendanaan
     */
    Route::post('/api/sumberdanaranwal/search', [SumberdanaApiController::class, 'searchSumberdanaRanwal'])->middleware('role:admin|bappeda');
    Route::post('/api/sumberdanaranwal/id', [SumberdanaApiController::class, 'idSumberdanaRanwal'])->middleware('role:admin|bappeda');
    Route::post('/api/sumberdanarancangan/search', [SumberdanaApiController::class, 'searchSumberdanRancangan'])->middleware('role:admin|bappeda');
    Route::post('/api/sumberdanarancangan/id', [SumberdanaApiController::class, 'idSumberdanaRancangan'])->middleware('role:admin|bappeda');
});
