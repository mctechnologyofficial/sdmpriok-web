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

Route::get('/admin/home', function () {
    return view('layouts.admin.index');
})->name('admin.home');

Route::group(['middleware' => ['role:admin']], function () {
    Route::prefix('admin')->group(function () {

        // employee routes
        Route::prefix('employee')->group(function () {
            Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
            Route::get('create', [EmployeeController::class, 'create'])->name('employee.create');
            Route::get('{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
            Route::post('store', [EmployeeController::class, 'store'])->name('employee.store');
            Route::put('{id}/update', [EmployeeController::class, 'update'])->name('employee.update');
            Route::delete('{id}/delete', [EmployeeController::class, 'destroy'])->name('employee.destroy');
        });

        // Roles routes
        Route::prefix('role')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('role.index');
            Route::get('create', [RoleController::class, 'create'])->name('role.create');
            Route::post('store', [RoleController::class, 'store'])->name('role.store');
            Route::get('{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
            Route::put('{id}/update', [RoleController::class, 'update'])->name('role.update');
            Route::delete('{id}/delete', [RoleController::class, 'destroy'])->name('role.destroy');
        });

        // team routes
        Route::prefix('team')->group(function () {
            Route::get('/', [TeamController::class, 'index'])->name('team.index');
            Route::get('create', [TeamController::class, 'create'])->name('team.create');
            Route::post('store', [TeamController::class, 'store'])->name('team.store');
            Route::get('{id}/edit', [TeamController::class, 'edit'])->name('team.edit');
            Route::put('{id}/update', [TeamController::class, 'update'])->name('team.update');
            Route::delete('{id}/delete', [TeamController::class, 'destroy'])->name('team.destroy');
        });

        // sliders routes
        Route::prefix('slider')->group(function () {

            Route::get('/', [SliderController::class, 'index'])->name('slider.index');
            Route::get('create', [SliderController::class, 'create'])->name('slider.create');
            Route::post('store', [SliderController::class, 'store'])->name('slider.store');
            Route::get('{id}/edit', [SliderController::class, 'edit'])->name('slider.edit');
            Route::put('{id}/update', [SliderController::class, 'update'])->name('slider.update');
            Route::delete('{id}/delete', [SliderController::class, 'destroy'])->name('slider.destroy');
        });

        // competency routes
        Route::prefix('competency')->group(function () {
            Route::get('/', [CompetencyController::class, 'index'])->name('competency.index');
            Route::get('create', [CompetencyController::class, 'create'])->name('competency.create');
            Route::post('store', [CompetencyController::class, 'store'])->name('competency.store');
            Route::get('{id}/edit', [CompetencyController::class, 'edit'])->name('competency.edit');
            Route::put('{id}/update', [CompetencyController::class, 'update'])->name('competency.update');
            Route::delete('{id}/delete', [CompetencyController::class, 'destroy'])->name('competency.destroy');
        });
    });
});

Route::group(['middleware' => ['role:supervisor']], function () {
    // Supervisor routes
    Route::prefix('supervisor')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('spv.index');
        Route::get('competency-tools', [CompetencySupervisorController::class, 'index'])->name('competency-tools-spv.index');
        Route::post('competency-tools/store', [CompetencySupervisorController::class, 'store'])->name('competency-tools-spv.store');
        Route::get('competency-tools/getcategory', [CompetencySupervisorController::class, 'getCategoryByCompetency']);
        Route::get('competency-tools/getsubcategory', [CompetencySupervisorController::class, 'getSubCategoryByCategory']);
        Route::get('competency-tools/getquestion', [CompetencySupervisorController::class, 'getQuestionBySubCategory']);
        Route::get('/supervisor/competency-tools/getidcompetency', [CompetencySupervisorController::class, 'getIdCompetency']);

        Route::get('assessment-chart/personal', [AssessmentChartController::class, 'personal'])->name('chart-personal.personal');
        Route::get('assessment-chart/team', [AssessmentChartController::class, 'team'])->name('chart-team.team');
        Route::get('assessment-chart/getradarteam', [AssessmentChartController::class, 'getDataRadarChartTeam']);
        Route::get('assessment-chart/getradarpersonal', [AssessmentChartController::class, 'getDataRadarChartPersonal']);
    });
});

Route::group(['middleware' => ['role:operator']], function () {
    // operator routes
    Route::prefix('operator')->group(function () {
        Route::get('competency-tools', [CompetencyOperatorController::class, 'index'])->name('competency-tools-op.index');
        Route::post('competency-tools/store', [CompetencyOperatorController::class, 'store'])->name('competency-tools-op.store');
        Route::get('competency-tools/getlesson', [CompetencyOperatorController::class, 'getLessonByCompetency']);
        Route::get('competency-tools/getquestion', [CompetencyOperatorController::class, 'getQuestionByLesson']);
        Route::get('competency-tools/getIdCompetency', [CompetencyOperatorController::class, 'getIdCompetency']);
    });
});

require __DIR__ . '/auth.php';

Route::get('/spv/coaching-mentoring', function () {
    return view('layouts.supervisor.mentoring.list');
});
Route::get('/spv/detail-mentoring', function () {
    return view('layouts.supervisor.mentoring.detail');
});

