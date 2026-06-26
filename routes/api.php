<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;

/*
|--------------------------------------------------------------------------
| API Routes - SOLINVORD
|--------------------------------------------------------------------------
|
| Rutas para el sistema SOLINVORD.
| Prefijo base: /api
|
*/

// Recursos de Material
Route::post('/materiales', [MaterialController::class, 'store']);
Route::put('/materiales/{codigo}', [MaterialController::class, 'update']);
Route::get('/materiales', [MaterialController::class, 'index']);
