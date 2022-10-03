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
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/home', function(){
    return view('layouts.admin.index');
});

Route::get('/admin/list-employee', function(){
    return view('layouts.admin.employee.list');
});
Route::get('/admin/add-employee', function(){
    return view('layouts.admin.employee.add');
});
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

Route::get('/admin/list-team', function(){
    return view('layouts.admin.team.list');
});
Route::get('/admin/add-team', function(){
    return view('layouts.admin.team.add');
});
Route::get('/admin/edit-team', function(){
    return view('layouts.admin.team.edit');
});

Route::get('/admin/list-role', function(){
    return view('layouts.admin.role.list');
});
Route::get('/admin/add-role', function(){
    return view('layouts.admin.role.add');
});
Route::get('/admin/edit-role', function(){
    return view('layouts.admin.role.edit');
});

Route::get('/admin/progress-chart', function(){
    return view('layouts.admin.monitoring-chart.progress-chart');
});
// End Admin //

// Supervisor //
Route::get('/spv/home', function(){
    return view('layouts.supervisor.index');
});
Route::get('/spv/sistem-proteksi', function(){
    return view('layouts.supervisor.competency.content');
});
// End Supervisor //
