<?php

use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\RoleController;
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
    return view('lo
    gin');
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
Route::get('/admin/list-competency', function(){
    return view('layouts.admin.utilities.competency.list');
});
Route::get('/admin/add-competency', function(){
    return view('layouts.admin.utilities.competency.add');
});
Route::get('/admin/edit-competency', function(){
    return view('layouts.admin.utilities.competency.edit');
});

Route::get('/admin/list-slider', function(){
    return view('layouts.admin.utilities.slider.list');
});
Route::get('/admin/add-slider', function(){
    return view('layouts.admin.utilities.slider.add');
});
Route::get('/admin/edit-slider', function(){
    return view('layouts.admin.utilities.slider.edit');
});

// Route::get('/admin/list-team', function(){
//     return view('layouts.admin.team.list');
// });
// Route::get('/admin/add-team', function(){
//     return view('layouts.admin.team.add');
// });
// Route::get('/admin/edit-team', function(){
//     return view('layouts.admin.team.edit');
// });

// Route::get('/admin/list-role', function(){
//     return view('layouts.admin.role.list');
// });
// Route::get('/admin/add-role', function(){
//     return view('layouts.admin.role.add');
// });
// Route::get('/admin/edit-role', function(){
//     return view('layouts.admin.role.edit');
// });

Route::get('/admin/progress-chart', function(){
    return view('layouts.admin.monitoring-chart.progress-chart');
});
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