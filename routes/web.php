<?php

use App\Http\Controllers\AdminController;
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