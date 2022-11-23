<?php

use App\Http\Controllers\Admin\CompetencyController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\MonitoringProgressController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Operator\CompetencyOperatorController;
use App\Http\Controllers\Operator\CompetencyScoreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Supervisor\AssessmentChartController;
use App\Http\Controllers\Supervisor\CoachingMentoringController;
use App\Http\Controllers\Supervisor\CompetencySupervisorController;
use App\Http\Controllers\SupervisorSenior\CoachingMentoringController as SupervisorSeniorCoachingMentoringController;
use Illuminate\Http\Request;
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
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// force logout routes, temporary for debugging
Route::get('/force/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return view('login');
});

Route::get('/edit-profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/edit-profile/{id}/update', [ProfileController::class, 'update'])->name('profile.update');

Route::group(['middleware' => ['role:admin']], function () {
    Route::prefix('admin')->group(function () {
        //home route
        Route::get('/home', [HomeController::class, 'IndexAdmin'])->name('admin.index');

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

        // monitoring chart route
        Route::prefix('progress-chart')->group(function () {
            Route::get('/', [MonitoringProgressController::class, 'index'])->name('progress-chart.index');
            Route::get('/getdataprogress', [MonitoringProgressController::class, 'getDataProgress']);
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

        // question routes
        Route::prefix('question')->group(function () {
            Route::get('/', [QuestionController::class, 'index'])->name('question.index');
            Route::post('store', [QuestionController::class, 'store'])->name('question.store');
        });
    });
});

Route::group(['middleware' => ['role:supervisor senior']], function () {
    // Supervisor routes
    Route::prefix('supervisor-senior')->group(function () {
        Route::get('/home', [HomeController::class, 'IndexSupervisorSenior'])->name('spv.senior.index');
        Route::get('coaching-mentoring/', [SupervisorSeniorCoachingMentoringController::class, 'index'])->name('spv.senior.coaching.list');
        Route::get('coaching-mentoring/show/{id}', [SupervisorSeniorCoachingMentoringController::class, 'show'])->name('spv.senior.coaching.show');
        Route::get('coaching-mentoring/getevaluation', [SupervisorSeniorCoachingMentoringController::class, 'getEvaluation']);
        Route::get('coaching-mentoring/getcompetencyid', [SupervisorSeniorCoachingMentoringController::class, 'getCompetencyId']);
        Route::get('coaching-mentoring/getnote', [SupervisorSeniorCoachingMentoringController::class, 'getNote']);
        Route::post('coaching-mentoring/postresult', [SupervisorSeniorCoachingMentoringController::class, 'postResult'])->name('spv.senior.coaching.storeresult');
        Route::post('coaching-mentoring/postdescription', [SupervisorSeniorCoachingMentoringController::class, 'postDescription'])->name('spv.senior.coaching.storedescription');
        Route::post('coaching-mentoring/savenote', [SupervisorSeniorCoachingMentoringController::class, 'saveNote'])->name('spv.senior.coaching.savenote');

        Route::get('assessment-chart/personal', [AssessmentChartController::class, 'personal'])->name('chart-personal-spvs.personal');
        Route::get('assessment-chart/team', [AssessmentChartController::class, 'team'])->name('chart-team-spvs.team');
        Route::get('assessment-chart/getradarteam', [AssessmentChartController::class, 'getDataRadarChartTeam']);
        Route::get('assessment-chart/getradarpersonal', [AssessmentChartController::class, 'getDataRadarChartPersonal']);
    });
});

Route::group(['middleware' => ['role:supervisor']], function () {
    // Supervisor routes
    Route::prefix('supervisor')->group(function () {
        Route::get('/home', [HomeController::class, 'IndexSupervisor'])->name('spv.index');

        Route::get('coaching-mentoring/', [CoachingMentoringController::class, 'index'])->name('spv.coaching.index');
        Route::get('coaching-mentoring/show/{id}', [CoachingMentoringController::class, 'show'])->name('spv.coaching.show');
        Route::get('coaching-mentoring/evaluation/{id}', [CoachingMentoringController::class, 'showEvaluation'])->name('spv.coaching.evaluation');
        Route::post('coaching-mentoring/evaluation/store', [CoachingMentoringController::class, 'saveEvaluation'])->name('spv.coaching.store');
        Route::post('coaching-mentoring/evaluation/savenote', [CoachingMentoringController::class, 'store'])->name('spv.coaching.savenote');

        Route::get('competency-tools', [CompetencySupervisorController::class, 'index'])->name('competency-tools-spv.index');
        Route::post('competency-tools/store', [CompetencySupervisorController::class, 'store'])->name('competency-tools-spv.store');
        Route::get('competency-tools/getcategory', [CompetencySupervisorController::class, 'getCategory']);
        Route::get('competency-tools/getsubcategory', [CompetencySupervisorController::class, 'getSubCategory']);
        Route::get('competency-tools/getquestion', [CompetencySupervisorController::class, 'getQuestion']);
        Route::get('competency-tools/getimage', [CompetencySupervisorController::class, 'getImage']);
        Route::get('competency-tools/getanswer', [CompetencySupervisorController::class, 'getAnswer']);
        Route::get('competency-tools/getidcompetency', [CompetencySupervisorController::class, 'getIdCompetency']);

        Route::get('assessment-chart/personal', [AssessmentChartController::class, 'personal'])->name('chart-personal.personal');
        Route::get('assessment-chart/team', [AssessmentChartController::class, 'team'])->name('chart-team.team');
        Route::get('assessment-chart/getradarteam', [AssessmentChartController::class, 'getDataRadarChartTeam']);
        Route::get('assessment-chart/getradarpersonal', [AssessmentChartController::class, 'getDataRadarChartPersonal']);
    });
});

Route::group(['middleware' => ['role:Operator GT RSG|Supervisor Operator|Senior Operator|Ahli Muda Operator|Operator Senior Control Room']], function () {
    // operator routes
    Route::prefix('operator')->group(function () {
        Route::get('/home', [HomeController::class, 'IndexOperator'])->name('op.index');

        Route::get('/competency-score', [CompetencyScoreController::class, 'index'])->name('competency-score.index');

        // Competency Route
        Route::get('competency-tools', [CompetencyOperatorController::class, 'index'])->name('competency-tools-op.index');
        Route::post('competency-tools/store', [CompetencyOperatorController::class, 'store'])->name('competency-tools-op.store');
        Route::get('competency-tools/getcategory', [CompetencyOperatorController::class, 'getCategory']);
        Route::get('competency-tools/getsubcategory', [CompetencyOperatorController::class, 'getSubCategory']);
        Route::get('competency-tools/getquestion', [CompetencyOperatorController::class, 'getQuestion']);
        Route::get('competency-tools/getimage', [CompetencyOperatorController::class, 'getImage']);
        Route::get('competency-tools/getanswer', [CompetencyOperatorController::class, 'getAnswer']);
        Route::get('competency-tools/getid', [CompetencyOperatorController::class, 'getIdCompetency']);
    });
});

require __DIR__ . '/auth.php';

