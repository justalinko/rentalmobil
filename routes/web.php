<?php

use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CRUD\ArmadaController;
use App\Http\Controllers\CRUD\OrderController;
use App\Http\Controllers\CRUD\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\Admin;

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

Route::get('/' , [DashboardController::class , 'index']);
Route::get('/book/{id}', [DashboardController::class, 'booking']);
Route::get('/about', [DashboardController::class, 'about']);
Route::get('/terms',[DashboardController::class, 'terms']);
Route::get('/privacy-policy',[DashboardController::class, 'privacy_policy']);
Route::get('/booking-check',[DashboardController::class, 'booking_check']);
Route::post('/booking-check',[BookController::class, 'Check']);

Route::get('/vehicles',[DashboardController::class, 'vehicles']);
Route::get('/contact', [DashboardController::class, 'contact']);
Route::get('/detail/{id}', [DashboardController::class, 'detail']);
Route::get('/lang/{lang}' , [DashboardController::class ,'switchLang']);
Route::post('/booking' , [BookController::class , 'doBooking']);
Route::post('/direct-booking', [BookController::class ,'directBook' ]);
Route::get('/i/{code}' , [BookController::class , 'invoice']);
Route::get('/confirm/{code}' , [BookController::class , 'confirm']);
Route::post('/confirm/{code}' , [BookController::class , 'confirmPost']);



Route::get('/login' , [AuthController::class , 'login'])->name('login');
Route::post('/login' , [AuthController::class , 'doLogin']);
Route::get('/logout' , [AuthController::class , 'logout'])->name('logout');

Route::group(['prefix' => '/admin', 'middleware' => 'admin'] , function(){

    Route::get('/' , [AdminController::class , 'index']);

    Route::get('/orders' , [OrderController::class , 'index']);
    Route::get('/orders/{id}/edit' , [OrderController::class , 'edit']);
    Route::post('/orders/{id}' , [OrderController::class , 'update']);
    Route::get('/orders/{id}/delete' , [OrderController::class , 'destroy']);
    Route::get('/orders/{id}/status' , [OrderController::class , 'changeStatus']);

    Route::get('/reports', [ReportController::class , 'index']);
    Route::get('/reports/filter' , [ReportController::class,'filterManager']);
    Route::get('/reports/monthly/{month}', [ReportController::class , 'monthly']);
    Route::get('/reports/yearly/{year}', [ReportController::class , 'yearly']);
    Route::get('/reports/daily/{date}', [ReportController::class , 'daily']);
    Route::get('/reports/export', [ReportController::class , 'export']);
    Route::get('/reports/weekly/{date}', [ReportController::class , 'weekly']);
    
    Route::get('/vehicles' , [ArmadaController::class , 'index']);
    Route::get('/vehicles/add' , [ArmadaController::class , 'create']);
    Route::post('/vehicles/add' , [ArmadaController::class , 'store']);
    Route::get('/vehicles/{id}/edit' , [ArmadaController::class , 'edit']);
    Route::post('/vehicles/{id}/edit' , [ArmadaController::class , 'update']);
    Route::get('/vehicles/{id}/delete' , [ArmadaController::class , 'destroy']);
    Route::get('/export' , [ExportController::class,'exportManager']);

    Route::get('/setting' , [AdminController::class , 'general']);
    Route::post('/setting' , [AdminController::class , 'generalUpdate']);

    Route::get('/payments', [AdminController::class , 'payment']);
    Route::get('/payments/{id}/delete' , [AdminController::class , 'payment_destroy']);
    Route::get('/payments/add', [AdminController::class , 'payment_create']);
    Route::post('/payments/add', [AdminController::class , 'payment_store']);


    Route::get('/users' , [UserController::class , 'index']);
    Route::get('/users/add' , [UserController::class , 'create']);
    Route::post('/users/add' , [UserController::class , 'store']);
    Route::get('/users/{id}/edit' , [UserController::class , 'edit']);
    Route::post('/users/{id}/edit' , [UserController::class , 'update']);
    Route::get('/users/{id}/delete' , [UserController::class , 'destroy']);
     
});

