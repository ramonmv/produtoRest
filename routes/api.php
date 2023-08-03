<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\API\V1\AuthController;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\V1\CategoryController;

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


Route::apiResources([
    'products' => ProductController::class,
    'categories' => CategoryController::class,
]);

// Route::group('auth:api')->
// Route::group(['prefix' => 'V1', 'namespace' => 'App\Http\Controllers\API\V1' ], function() { 
// Route::group(['namespace' => 'App\Http\Controllers\API\V1' ], function() { 
//     Route::apiResource('products', ProductController::class);
//     // Route::apiResource('user', AuthController::class);
// });

// Route::prefix('categoria')->controller(CategoryController::class)->group(function () {
//     Route::post('register', 'register');
//     Route::get('list', 'list');
//     Route::post('delete', 'delete');
//     // Route::post('logout', 'logout');
//     // Route::post('refresh', 'refresh');
// });

Route::prefix('user')->controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});


Route::post('/maia', function () {
    
    return response()->json([
        'data' => 'ramonmaia',
    ], 200);
});