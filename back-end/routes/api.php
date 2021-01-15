<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmployeesController;
use App\Http\Controllers\Api\BankHoursController;
use App\Http\Controllers\Api\CompaniesController;
use App\Http\Controllers\Api\HolidaysController;
use App\Http\Controllers\Api\RegisterPointsController;
use App\Http\Controllers\Api\SyndicatesController;
use App\Http\Controllers\Api\TimeTablesController;
use \App\Http\Controllers\Api\AuthController;
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


Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register']);

//Rotas protegida pela api passport, acesso via token
Route::middleware( 'auth:api' )->group( function () {
    Route::resource( 'bank-hour', BankHoursController::class );
    Route::resource( 'company', CompaniesController::class );
    Route::resource( 'employee', EmployeesController::class );
    Route::resource( 'holiday', HolidaysController::class );
    Route::resource( 'register-point', RegisterPointsController::class );
    Route::resource( 'syndicate', SyndicatesController::class );
    Route::resource( 'time-table', TimeTablesController::class );
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('getuser', [AuthController::class, 'getUser']);
} );
