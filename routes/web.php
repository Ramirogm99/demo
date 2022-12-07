<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\UsersController;
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
Route::get('/', function () {
    return view('auth.login');
});
Route::middleware("auth")->controller(UsersController::class)->prefix('users')->group(function () {
    Route::get('/' , 'indexAdmin');
    Route::get('delete/{id}' , 'deleteUser');
    Route::get('edit/{id}' , 'editUser');
    Route::post('update/{id}' , 'saveEdit');
    Route::get('add' , 'create');
    Route::post('save' , 'createUser');
    
});
Route::middleware("auth")->controller(EventosController::class)->prefix('event')->group(function () {
    Route::get('/' , 'index');
    Route::get('delete/{id}' , 'deleteEvent');
    Route::post('update/{id}' , 'saveEdit');
    Route::post('save' , 'createEvent');
    Route::get('ajaxEvent/{id}' , 'eventAjax');
    
});
Route::middleware("auth")->controller(CalendarController::class)->prefix('home')->group(function () {
    Route::get('/' , 'index');
});
Route::middleware("auth")->controller(CalendarController::class)->prefix('calendar')->group(function () {
    Route::get('crudDate','createDate');
});

Auth::routes();