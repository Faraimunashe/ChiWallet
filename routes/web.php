<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::get('/change-password', 'App\Http\Controllers\ChangePasswordController@index');
    Route::post('/change-password', 'App\Http\Controllers\ChangePasswordController@store')->name('change.password');

    Route::get('/send-money', function () {
        return view('user.sendmoney');
    })->name('user-send-money');

    Route::get('/confirm-receiver', function () {
        return view('user.confirm-receiver');
    })->name('user-confirm-receiver');

    Route::get('/success-sent', function () {
        return view('user.successfully-sent');
    })->name('user-success-sent');

    Route::group(['middleware' => ['auth', 'role:user']], function () {
        Route::post('/save/personal-info', 'App\Http\Controllers\user\AccountController@add')->name('user-add-info');

        Route::get('/user/send-money', 'App\Http\Controllers\user\SendMoneyController@index')->name('user-disp-sendmoney');
        Route::post('/user/send', 'App\Http\Controllers\user\SendMoneyController@send')->name('user-send-money');
        Route::post('/user/send-money/confirm', 'App\Http\Controllers\user\SendMoneyController@confirm')->name('user-confirm-sendmoney');

        Route::get('/user/deposit-money', 'App\Http\Controllers\user\DepositController@index')->name('user-deposit');
        Route::post('/user/deposit', 'App\Http\Controllers\user\DepositController@deposit')->name('user-deposit-money');

        Route::get('/user/statement', 'App\Http\Controllers\user\StatementController@index')->name('user-statement');
        Route::get('/user/download/statement', 'App\Http\Controllers\user\StatementController@download')->name('user-download-statement');
    });
});

require __DIR__ . '/auth.php';
