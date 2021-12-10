<?php

use App\Http\Controllers\Api\Admin\FeedbackController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\FileUploadController;
use App\Http\Controllers\Api\User\WorklogController as UserWorklogController;
use App\Http\Controllers\Api\Worklog\WorklogController;
use App\Http\Middleware\UserIsAdmin;
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

Route::prefix('v1')->group(function(){
    Route::post('/login', [LoginController::class, 'store']);
    Route::middleware('auth:sanctum')->group(function(){
        Route::apiResource('users.worklogs', UserWorklogController::class)->only('index');
        Route::apiResource('worklogs', WorklogController::class);
        Route::apiResource('worklogs.feedbacks', FeedbackController::class)
            ->middleware(UserIsAdmin::class)
            ->shallow();
        Route::post('file-upload', FileUploadController::class);
    });
});
