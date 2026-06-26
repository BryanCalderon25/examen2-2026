<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;

// Endpoint Israel: Listar materiales con categorías
Route::get('/materiales', [MaterialController::class, 'index']);

// En el documento debes indicar esta URL para el llamado: /api/materiales
Route::post('/materiales', [MaterialController::class, 'store']);

// Endpoint Bryan: Actualizar un material
// URL para el llamado: /api/materiales/{material}
Route::put('/materiales/{material}', [MaterialController::class, 'update']);
