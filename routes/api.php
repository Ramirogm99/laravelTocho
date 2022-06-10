<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('cors')->controller(WorkerController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('ordenes' , 'ordenes');
    Route::post('ordenesCompletas' , 'ordenesCompletas');
    Route::post('ordenTrabajo', 'ordenTrabajo');
    Route::post('valla', 'valla');
    Route::post('updateOrden', 'updateOrden');
    Route::post('updateValla', 'updateValla');
    Route::post('imagenValla', 'getImageValla');
    Route::post('completarVallaOrden', 'completarVallaOrden');
    Route::post('completarOrden', 'completarOrden');

});