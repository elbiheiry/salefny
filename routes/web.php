<?php

use App\Http\Controllers\AmountController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MonthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

//profile routes
Route::get('/profile' , [ProfileController::class , 'index'])->name('profile');
Route::put('/profile/update' , [ProfileController::class , 'update'])->name('profile.update');

//settings routes
Route::get('/settings' , [SettingController::class , 'index'])->name('settings');
Route::put('/settings/update' , [SettingController::class , 'update'])->name('settings.update');

//users routes
Route::prefix('users')->name('users.')->group(function (){
    Route::get('/' , [UserController::class , 'index'])->name('index');
    Route::post('/store' , [UserController::class , 'store'])->name('store');
    Route::get('/show/{id}' , [UserController::class , 'show'])->name('show');
    Route::get('/edit/{id}' , [UserController::class , 'edit'])->name('edit');
    Route::put('/update/{id}' , [UserController::class , 'update'])->name('update');
    Route::delete('/delete/{id}' , [UserController::class , 'destroy'])->name('delete');
});

//members routes
Route::prefix('members')->name('members.')->group(function (){
    Route::get('/' , [MemberController::class , 'index'])->name('index');
    Route::post('/store' , [MemberController::class , 'store'])->name('store');
    Route::get('/show/{id}' , [MemberController::class , 'show'])->name('show');
    Route::get('/edit/{id}' , [MemberController::class , 'edit'])->name('edit');
    Route::put('/update/{id}' , [MemberController::class , 'update'])->name('update');
    Route::delete('/delete/{id}' , [MemberController::class , 'destroy'])->name('delete');
});

//loans routes
Route::prefix('loans')->name('loans.')->group(function (){
    Route::get('/' , [LoanController::class , 'index'])->name('index');
    Route::post('/store' , [LoanController::class , 'store'])->name('store');
    Route::get('/show/{id}' , [LoanController::class , 'show'])->name('show');
    Route::post('/change-status/{id}' , [LoanController::class , 'change_status'])->name('status');

    Route::name('bills.')->prefix('bills')->group(function (){
        Route::get('/edit/{id}' , [LoanController::class , 'get_bill'])->name('edit');
        Route::put('/update/{id}' , [LoanController::class , 'update_bill'])->name('update');
    });
});

//amounts routes
Route::prefix('amounts')->name('amounts.')->group(function (){
    Route::get('/' , [AmountController::class , 'index'])->name('index');
    Route::post('/store' , [AmountController::class , 'store'])->name('store');
    Route::get('/edit/{id}' , [AmountController::class , 'edit'])->name('edit');
    Route::put('/update/{id}' , [AmountController::class , 'update'])->name('update');
    Route::delete('/delete/{id}' , [AmountController::class , 'destroy'])->name('delete');
});

//months routes
Route::prefix('months')->name('months.')->group(function (){
    Route::get('/' , [MonthController::class , 'index'])->name('index');
    Route::post('/store' , [MonthController::class , 'store'])->name('store');
    Route::get('/edit/{id}' , [MonthController::class , 'edit'])->name('edit');
    Route::put('/update/{id}' , [MonthController::class , 'update'])->name('update');
    Route::delete('/delete/{id}' , [MonthController::class , 'destroy'])->name('delete');
});

//bills routes
Route::prefix('bills')->name('bills.')->group(function (){
    Route::get('/' , [BillController::class , 'index'])->name('index');
    Route::get('/search' , [BillController::class , 'search'])->name('search');
});