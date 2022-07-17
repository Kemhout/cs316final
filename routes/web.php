<?php
  
use Illuminate\Support\Facades\Route;   
use Illuminate\Support\Facades\Auth;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AssignController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StudyPlanController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\StudyPlan;
use PhpParser\Node\Expr\Assign;

/*
|--------------------------------------------------------------------------
| Web Route
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
    //Route::resource('assignCourse', AssignCourse::class);
    Route::resource('academic_years', AcademicYearController::class);
    Route::resource('majors', MajorController::class);
    Route::resource('semesters', SemesterController::class);
    Route::resource('study_plans', StudyPlanController::class);
    Route::resource('assign', AssignController::class);
    Route::get("my-search", [CourseController::class, 'mySearch']);
    Route::get('list_study_plan_index',  [StudyPlanController::class, 'list_study_plan_index'])->name('study_plans.list_study_plan_index');
    Route::get('create_studys_plan',  [StudyPlanController::class, 'create_studys_plan'])->name('study_plans.create_studys_plan');
    Route::post('store_study_plan',  [StudyPlanController::class, 'store_study_plan'])->name('study_plans.store_study_plan');
    Route::delete('destroy_study_plan/{id}',  [StudyPlanController::class, 'destroy_study_plan'])->name('study_plans.destroy_study_plan');
    Route::get('edit_study_plan/{id}',  [StudyPlanController::class, 'edit_study_plan'])->name('study_plans.edit_study_plan');
    Route::post('edit_study_plan/{id}',  [StudyPlanController::class, 'edit_study_plan'])->name('study_plans.edit_study_plan');
    Route::get('assign_study_plan/{id}',  [StudyPlanController::class, 'assign_study_plan'])->name('study_plans.assign_study_plan');
    Route::post('assign_store_study_plan/{id}',  [StudyPlanController::class, 'assign_store_study_plan'])->name('study_plans.assign_store_study_plan');
    Route::get('create/{id}',  [StudyPlanController::class, 'create'])->name('study_plans.create');
});

Route::group(['middleware' => ['role:Student']], function () {
    Route::resource('roles', RoleController::class);
    Route::get('/export',  [RoleController::class, 'export'])->name('export');
});


Route::get('select2-autocomplete', [StudyPlanController::class, 'layout']);
Route::get('select2-autocomplete-ajax', [StudyPlanController::class, 'dataAjax']);
