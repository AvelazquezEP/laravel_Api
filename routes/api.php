<?php

use App\Http\Controllers\activityContoller;
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

// API ROUTE: VERSION 1 (v1)
Route::prefix('/v1')->controller(activityContoller::class)->group(function () {
    Route::get('/activities', 'show')->name('activity.show');
    Route::get('/activities/{activity_id}', 'activity_by_id')->name('activity.activity_by_id');

    Route::post('/activities', 'store')->name('activity.store');
    Route::post('/activities/{activity_id}/items', 'store_lists')->name('activity.store_lists');

    Route::patch('/activities/{activity_id}', 'activity_update')->name('activity.update');
    Route::patch('/activities/{activity_id}/items/{item_id}', 'item_update')->name('activity.item_update');

    Route::delete('/activities/{activity_id}', 'activity_delete')->name('activity.delete');
    Route::delete('/activities/{activity_id}/items/{item_id}', 'item_delete')->name('activity.item_delete');
});
