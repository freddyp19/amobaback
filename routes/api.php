<?php

use App\Http\Controllers\Api\V1\CalendarsApiController;
use App\Http\Controllers\Api\V1\RouteApiController;
use App\Http\Controllers\Api\V1\UserApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

# Ruta: api/Resto de la ruta
# las rutas de las apis, pueden estar en varias versiones
# logica detrabajo:

# 1.- (v) Días deshabilitados por calendario = depende de ROUTE_DATA
# 2.- (v) Días fuera de frecuencia = ROUTE_DATA
# 3.- (v) Días Reservados depende de USER_PLAN y de la RUTA
# 4.- (v) Día con servicio, ROUTE (external_id) = SERVICES (external_route_id)
# 5.- (v) Capacidad de la ruta full, es un equivante de esa fecha si tenemos 
#         los suficiente reservactiones para ese dia en esa ruta

Route::post('v1/loginapi', [UserApiController::class,"loginApi"])->name("loginApi");    

Route::middleware('auth:sanctum')->group(function () {
    Route::post('v1/routes', [RouteApiController::class,"rutesAll"])->name("rutesAll");
    Route::post('v1/routes/{year}', [RouteApiController::class,"ruteDataYear"])->name("ruteDataYear");
    Route::post('v1/route-data', [RouteApiController::class,"ruteDataID"])->name("route-data");
});
