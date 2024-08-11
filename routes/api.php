<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TopNewsApiController;
use App\Http\Controllers\API\TransactionController;

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

//API Folder
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::post('/transactions', [TransactionController::class, 'store']);
});

//API Folder
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/push/get', [TopNewsApiController::class, 'index']);
    Route::get('/push/get/{count}', [TopNewsApiController::class, 'custom_list']); 
});



//login endpoint
Route::post('/server', function (Request $request) {

    $credentials = [
        'email' => $request->input('server_name'),
        'password' => $request->input('server_pas')
    ];

    if (Auth::attempt($credentials)) {

        $user = \App\Models\User::find(Auth::user()->id);
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json(['token' => $token], 200);
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
});
