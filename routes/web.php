<?php

use App\Http\Controllers\Admin\CompetencyController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Operator\CompetencyOperatorController;
use App\Http\Controllers\Supervisor\AssessmentChartController;
use App\Http\Controllers\Supervisor\CompetencySupervisorController;
use App\Http\Controllers\Supervisor\HomeController;
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
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/** Admin Routes */
// Route::middleware(['auth'])->group(function () {
//     Route::get('/admin/add-employee', [EmployeeController::class, 'create'])->name('employee.create');
// });
Route::get('/admin/home', function(){
    return view('layouts.admin.index');
})->name('admin.home');

Route::get('/admin/employee', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/admin/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::get('/admin/employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::post('/admin/employee', [EmployeeController::class, 'store'])->name('employee.store');
Route::put('/admin/employee/{id}', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('/admin/employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

Route::get('/admin/role', [RoleController::class, 'index'])->name('role.index');
Route::get('/admin/role/create', [RoleController::class, 'create'])->name('role.create');
Route::post('/admin/role', [RoleController::class, 'store'])->name('role.store');
Route::get('/admin/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
Route::put('/admin/role/{id}', [RoleController::class, 'update'])->name('role.update');
Route::delete('/admin/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

Route::get('/admin/team', [TeamController::class, 'index'])->name('team.index');
Route::get('/admin/team/create', [TeamController::class, 'create'])->name('team.create');
Route::post('/admin/team', [TeamController::class, 'store'])->name('team.store');
Route::get('/admin/team/{id}/edit', [TeamController::class, 'edit'])->name('team.edit');
Route::put('/admin/team/{id}', [TeamController::class, 'update'])->name('team.update');
Route::delete('/admin/team/{id}', [TeamController::class, 'destroy'])->name('team.destroy');

Route::get('/admin/slider', [SliderController::class, 'index'])->name('slider.index');
Route::get('/admin/slider/create', [SliderController::class, 'create'])->name('slider.create');
Route::post('/admin/slider', [SliderController::class, 'store'])->name('slider.store');
Route::get('/admin/slider/{id}/edit', [SliderController::class, 'edit'])->name('slider.edit');
Route::put('/admin/slider/{id}', [SliderController::class, 'update'])->name('slider.update');
Route::delete('/admin/slider/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');

Route::get('/admin/competency', [CompetencyController::class, 'index'])->name('competency.index');
Route::get('/admin/competency/create', [CompetencyController::class, 'create'])->name('competency.create');
Route::post('/admin/competency', [CompetencyController::class, 'store'])->name('competency.store');
Route::get('/admin/competency/{id}/edit', [CompetencyController::class, 'edit'])->name('competency.edit');
Route::put('/admin/competency/{id}', [CompetencyController::class, 'update'])->name('competency.update');
Route::delete('/admin/competency/{id}', [CompetencyController::class, 'destroy'])->name('competency.destroy');

Route::get('/supervisor/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/supervisor/competency-tools', [CompetencySupervisorController::class, 'index'])->name('competency-tools-spv.index');
Route::post('/supervisor/competency-tools', [CompetencySupervisorController::class, 'store'])->name('competency-tools-spv.store');
Route::get('/supervisor/competency-tools/getcategory', [CompetencySupervisorController::class, 'getCategoryByCompetency']);
Route::get('/supervisor/competency-tools/getsubcategory', [CompetencySupervisorController::class, 'getSubCategoryByCategory']);
Route::get('/supervisor/competency-tools/getquestion', [CompetencySupervisorController::class, 'getQuestionBySubCategory']);
Route::get('/supervisor/competency-tools/getidcompetency', [CompetencySupervisorController::class, 'getIdCompetency']);

Route::get('/supervisor/assessment-chart/personal', [AssessmentChartController::class, 'personal'])->name('chart-personal.personal');
Route::get('/supervisor/assessment-chart/team', [AssessmentChartController::class, 'team'])->name('chart-team.team');
Route::get('/supervisor/getradarteam', [AssessmentChartController::class, 'getDataRadarChartTeam']);
Route::get('/supervisor/getradarpersonal', [AssessmentChartController::class, 'getDataRadarChartPersonal']);

Route::get('/operator/competency-tools', [CompetencyOperatorController::class, 'index'])->name('competency-tools-op.index');
Route::post('/operator/competency-tools', [CompetencyOperatorController::class, 'store'])->name('competency-tools-op.store');
Route::get('/operator/competency-tools/getlesson', [CompetencyOperatorController::class, 'getLessonByCompetency']);
Route::get('/operator/competency-tools/getquestion', [CompetencyOperatorController::class, 'getQuestionByLesson']);
Route::get('/operator/competency-tools/getIdCompetency', [CompetencyOperatorController::class, 'getIdCompetency']);

require __DIR__.'/auth.php';

// Supervisor //
Route::get('/spv/coaching-mentoring', function(){
    return view('layouts.supervisor.mentoring.list');
});
Route::get('/spv/detail-mentoring', function(){
    return view('layouts.supervisor.mentoring.detail');
});
// Route::get('/spv/chart-personal', function(){
//     return view('layouts.supervisor.assessment-chart.personal');
// });
// Route::get('/spv/chart-team', function(){
//     return view('layouts.supervisor.assessment-chart.team');
// });
// End Supervisor //

