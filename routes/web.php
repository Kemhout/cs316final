<?php
  
use Illuminate\Support\Facades\Route;   
use Illuminate\Support\Facades\Auth;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AssignCourse;
  
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
  
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/logout',  [LoginController::class, 'logout']);

Route::group(['middleware' => ['role:Admin']], function () {
    //Route::resource('roles', RoleController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('users', UserController::class);
    Route::resource('assignCourse', AssignCourse::class);
    Route::resource('academic_years', AcademicYearController::class);
    Route::resource('majors', MajorController::class);
    Route::resource('semesters', SemesterController::class);
    //Route::get('/users',  [UserController::class, 'index'])->name('users.index');
});

Route::group(['middleware' => ['role:Student']], function () {
    Route::resource('roles', RoleController::class);
    Route::get('/export',  [RoleController::class, 'export'])->name('export');
});


//Route::get('/',  [RoleController::class, 'index'])->name('export');;
