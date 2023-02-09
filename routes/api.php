<?php

use App\Http\Controllers\Api\BusinessController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/* ====================================================== BUSINESS ==================================================== */

Route::prefix('business')->group(function () {
    Route::get('search/{term}/{category}/{sort_by}/{locale}/{radius}', [BusinessController::class, 'Search']);
    Route::post('store', [BusinessController::class, 'Store']);
    Route::put('update', [BusinessController::class, 'Update']);
    Route::delete('delete', [BusinessController::class, 'Delete']);
});
/* ====================================================== END BUSINESS ==================================================== */