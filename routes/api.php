<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\PersonController;
use App\Http\Controllers\API\AppointmentController;

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

Route::middleware('auth:api')->get('/token/revoke', function (Request $request) {
    DB::table('oauth_access_tokens')
        ->where('user_id', $request->user()->id)
        ->update([
            'revoked' => true
        ]);
    return response()->json('DONE');
});

Route::prefix('person')->group(function () {
    Route::get('/',[ PersonController::class, 'getAll']);
    Route::post('/',[ PersonController::class, 'create']);
    Route::delete('/{id}',[ PersonController::class, 'delete']);
    Route::get('/{id}',[ PersonController::class, 'get']);
    Route::put('/{id}',[ PersonController::class, 'update']);
});

Route::prefix('appointment')->group(function () {
    Route::get('/',[ AppointmentController::class, 'getAll']);
    Route::post('/',[ AppointmentController::class, 'create']);
    Route::delete('/{id}',[ AppointmentController::class, 'delete']);
    Route::get('/{id}',[ AppointmentController::class, 'get']);
    Route::put('/{id}',[ AppointmentController::class, 'update']);
});


