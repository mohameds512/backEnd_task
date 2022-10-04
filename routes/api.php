<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaignController;

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
// Route::get('/campaigns', [CampaignController::class, 'index']);

Route::prefix('/campaigns')->group(function(){
    Route::get('/', [CampaignController::class, 'index']);
    Route::post('/store', [CampaignController::class, 'store']);
    Route::get('/edit/{id}', [CampaignController::class, 'edit']);
    Route::put('/update/{id}', [CampaignController::class, 'update']);
    Route::delete('/delete/{id}', [CampaignController::class, 'destroy']);
});
