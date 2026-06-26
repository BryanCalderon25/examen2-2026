<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;

// En el documento debes indicar esta URL para el llamado: /api/materiales
Route::post('/materiales', [MaterialController::class, 'store']);
