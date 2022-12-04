<?php

use App\Http\Controllers\Api\AssessmentChartController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CoachingMentoringAdminController;
use App\Http\Controllers\Api\CoachingMentoringSupervisorSeniorController;
use \App\Http\Controllers\Api\CoachingMentoringSupervisorController;
use App\Http\Controllers\Api\CompetencyOperatorController;
use App\Http\Controllers\Api\CompetencyScoreOperatorController;
use App\Http\Controllers\Api\CompetencyScoreSupervisorController;
use App\Http\Controllers\Api\CompetencySupervisorController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\MonitoringProgressController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\QuestionUploadController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\AssessmentChartSupervisorSeniorController;
use App\Http\Controllers\Api\Utilities\CompetencyController;
use App\Http\Controllers\Api\Utilities\SliderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication Routes
Route::prefix('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::post('logout', 'logout');
    });
});

// Profile Users
Route::prefix('user/profile')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('update/{user_hash}', 'update');
    });
});

// Home All Roles Routes
Route::prefix('home')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/indexsupervisor', 'IndexSupervisor');
        Route::get('/indexoperator', 'IndexOperator');
        Route::get('/getradaroperator', 'getRadar');
        Route::get('/indexadmin', 'IndexAdmin');
        Route::get('/indexsupervisorsenior', 'IndexSupervisorSenior');
    });
});

// Role : Admin
    // employee routes
    Route::prefix('employee')->group(function () {
        Route::controller(EmployeeController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/show/{user_hash}', 'show');
            Route::post('/store', 'store');
            Route::post('update/{user_hash}', 'update');
            Route::post('delete/{user_hash}', 'delete');
        });
    });

    // Roles Routes
    Route::prefix('role')->group(function () {
        Route::controller(RoleController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{id}', 'show');
            Route::post('/update/{id}', 'update');
            Route::post('/delete/{id}', 'delete');
        });
    });

    // Team Routes
    Route::prefix('team')->group(function () {
        Route::controller(TeamController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{id}', 'show');
            Route::post('/update/{id}', 'update');
            Route::post('/delete/{id}', 'delete');
        });
    });

    // Coaching Mentoring Admin Routes
    Route::prefix('coachingmentoring-admin')->group(function () {
        Route::controller(CoachingMentoringAdminController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/show/{id}', 'show');
            Route::get('/getquestionspv', 'getQuestionSpv');
            Route::get('/getanswerspv', 'getAnswerSpv');
            Route::get('/getquestionop', 'getQuestionOp');
            Route::get('/getanswerop', 'getAnswerOp');
            Route::get('/getevaluation', 'getEvaluation');
            Route::get('/getcomment', 'getComment');
            Route::post('/postcomment', 'postComment');
            Route::post('/saveevaluation', 'saveEvaluation');
        });
    });

    // Organization Admin Routes
    Route::prefix('organization')->group(function () {
        Route::controller(OrganizationController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/getteam', 'getTeam');
            Route::get('/getradar', 'getRadar');
            Route::post('/moveemployee', 'moveEmployee');
        });
    });

    // Monitoring Progress Chart Admin Routes
    Route::prefix('monitoring-chart')->group(function () {
        Route::controller(MonitoringProgressController::class)->group(function () {
            Route::get('/', 'getDataProgress');
        });
    });

    // Slider Routes
    Route::prefix('slide')->group(function () {
        Route::controller(SliderController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{id}', 'show');
            Route::post('/update/{id}', 'update');
            Route::post('/delete/{id}', 'delete');
        });
    });

    // Competency Routes
    Route::prefix('competency')->group(function () {
        Route::controller(CompetencyController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{id}', 'show');
            Route::post('/update/{id}', 'update');
            Route::post('/delete/{id}', 'delete');
        });
    });

    // Upload Question Admin Routes
    Route::prefix('upload-question')->group(function () {
        Route::controller(QuestionUploadController::class)->group(function () {
            Route::post('/', 'uploadQuestion');
        });
    });
// End Role : Admin

// Role : Operator

    // Competency Operator Routes
    Route::prefix('competency-op')->group(function () {
        Route::controller(CompetencyOperatorController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/submitanswer', 'store');
            Route::post('/publishanswer', 'publish');
            Route::get('/getcategory', 'getCategory');
            Route::get('/getsubcategory', 'getSubCategory');
            Route::get('/getquestion', 'getQuestion');
            Route::get('/getidcompetency', 'getIdCompetency');
            Route::get('/getanswer', 'getAnswer');
            Route::get('/getimage', 'getImage');
        });
    });

    // Competency Score Operator Routes
    Route::prefix('competencyscore-op')->group(function () {
        Route::controller(CompetencyScoreOperatorController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/show/{id}', 'show');
            Route::get('/getevaluation', 'getEvaluation');
            Route::get('/getcomment', 'getComment');
            Route::post('/postcomment', 'postComment');
        });
    });

// End Role : Operator

// Role : Supervisor

    // Competency Supervisor Routes
    Route::prefix('competency-spv')->group(function () {
        Route::controller(CompetencySupervisorController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/submitanswer', 'submitAnswer');
            Route::post('/publishanswer', 'publishAnswer');
            Route::get('/getcategory', 'getCategory');
            Route::get('/getsubcategory', 'getSubCategory');
            Route::get('/getquestion', 'getQuestion');
            Route::get('/getanswer', 'getAnswer');
            Route::get('/getimage', 'getImage');
            Route::get('/getidcompetency', 'getIdCompetency');
        });
    });

    // Coaching Mentoring Supervisor Routes
    Route::prefix('coachingmentoring-spv')->group(function () {
        Route::controller(CoachingMentoringSupervisorController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/show/{id}', 'show');
            Route::get('/getquestion', 'getQuestion');
            Route::get('/getanswer', 'getAnswer');
            Route::get('/getcomment', 'getComment');
            Route::post('/postcomment', 'postComment');
            Route::post('/saveevaluation', 'saveEvaluation');
            Route::get('/getcompetencyid', 'getCompetencyId');
            Route::get('/getevaluation', 'getEvaluation');
        });
    });

    // Competency Score Supervisor Routes
    Route::prefix('competencyscore-spv')->group(function () {
        Route::controller(CompetencyScoreSupervisorController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/show/{id}', 'show');
            Route::get('/getevaluation', 'getEvaluation');
            Route::get('/getcomment', 'getComment');
            Route::post('/postcomment', 'postComment');
        });
    });

    // Assessment Chart Supervisor Routes
    Route::prefix('assessment-chart-spv')->group(function () {
        Route::controller(AssessmentChartController::class)->group(function () {
            Route::get('/getoperator', 'getNameOp');
            Route::get('/getchartteam', 'getDataRadarChartTeam');
            Route::get('/getchartpersonal', 'getDataRadarChartPersonal');
        });
    });

// End Role : Supervisor

// Role : Supervisor Senior

    // Coaching Mentoring Supervisor Routes
    Route::prefix('coachingmentoring-spvsenior')->group(function () {
        Route::controller(CoachingMentoringSupervisorSeniorController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/show/{id}', 'show');
            Route::get('/getcategory', 'getCategory');
            Route::get('/getquestion', 'getQuestion');
            Route::get('/getanswer', 'getAnswer');
            Route::get('/getcomment', 'getComment');
            Route::get('/getEvaluation', 'getEvaluation');
            Route::post('/postcomment', 'postComment');
            Route::post('/saveevaluation', 'saveEvaluation');
        });
    });

    // Assessment Chart Supervisor Routes
    Route::prefix('assessment-chart-spvsenior')->group(function () {
        Route::controller(AssessmentChartSupervisorSeniorController::class)->group(function () {
            Route::get('/getsupervisor', 'getNameSpv');
            Route::get('/getchartteam', 'getDataRadarChartTeam');
        });
    });
// End Role : Supervisor Senior
