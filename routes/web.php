<?php

use App\Http\Controllers\Admin\CompetencyController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TeamController;
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

Route::get('/admin/employee', [EmployeeController::class, 'create'])->name('employee.create');



Route::get('/admin/home', function(){
    return view('layouts.admin.index');
});

Route::get('/admin/list-employee', function(){
    return view('layouts.admin.employee.list');
});
// Route::get('/admin/add-employee', function(){
//     return view('layouts.admin.employee.add');
// });
Route::get('/admin/edit-employee', function(){
    return view('layouts.admin.employee.edit');
});

require __DIR__.'/auth.php';
// End Admin //

// Supervisor //
Route::get('/spv/home', function(){
    return view('layouts.supervisor.index');
});
Route::get('/spv/coaching-mentoring', function(){
    return view('layouts.supervisor.mentoring.list');
});
Route::get('/spv/detail-mentoring', function(){
    return view('layouts.supervisor.mentoring.detail');
});
Route::get('/spv/sistem-proteksi', function(){
    return view('layouts.supervisor.competency.content');
});
Route::get('/spv/chart-personal', function(){
    return view('layouts.supervisor.assessment-chart.personal');
});
Route::get('/spv/chart-team', function(){
    return view('layouts.supervisor.assessment-chart.team');
});
// End Supervisor //

// Operator //
Route::get('/operator/sistem-proteksi', function(){
    return view('layouts.operator.competency.content');
});
// End Operator //
