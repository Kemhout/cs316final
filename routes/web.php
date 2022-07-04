<?php
  
use Illuminate\Support\Facades\Route;   
use Illuminate\Support\Facades\Auth;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Auth\LoginController;
  
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
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/logout',  [LoginController::class, 'logout']);

Route::group(['middleware' => ['role:Admin']], function () {
    //Route::resource('roles', RoleController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('users', UserController::class);
});

Route::group(['middleware' => ['role:Student']], function () {
    Route::resource('roles', RoleController::class);
});