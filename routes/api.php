<?php

use App\Http\Controllers\Api\LoanController;
use App\Http\Controllers\Auth\ApiAuthController;
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

// Route::middleware(['auth:api'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->name('api')->group(function () {
    // our routes to be protected will go in here
    Route::post('/signout' , [ApiAuthController::class , 'signout'])->name('signout.api');
    
    Route::get('/user' , [ApiAuthController::class , 'retrieve_user'])->name('user.api');
    Route::put('/user/update' ,[ApiAuthController::class , 'update_user'])->name('user.api.update');

    Route::get('/loans' , [LoanController::class , 'index'])->name('user.loans');
    Route::get('/loan/show/{id}' , [LoanController::class , 'show'])->name('user.loan');
    Route::get('/bill/show/{id}' , [LoanController::class , 'get_bill'])->name('user.bill');
    Route::post('/loans/store' ,[LoanController::class , 'create_loan'])->name('user.loans.create');
});

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::get('/settings' , [ApiAuthController::class , 'settings'])->name('settings.api');
    Route::post('/login' , [ApiAuthController::class , 'login'])->name('login.api');
    Route::post('/register' , [ApiAuthController::class , 'register'])->name('register.api');
});