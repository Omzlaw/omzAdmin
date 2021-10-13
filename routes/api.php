<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});










Route::resource('activity_logs', App\Http\Controllers\API\ActivityLogAPIController::class);




Route::resource('applicants', App\Http\Controllers\API\ApplicantAPIController::class);


Route::resource('broadcasts', App\Http\Controllers\API\BroadcastAPIController::class);


Route::resource('license_checklists', App\Http\Controllers\API\LicenseChecklistAPIController::class);


Route::resource('license_types', App\Http\Controllers\API\LicenseTypeAPIController::class);


// Route::resource('mail_boxes', App\Http\Controllers\API\MailBoxAPIController::class);


Route::resource('operators', App\Http\Controllers\API\OperatorAPIController::class);


Route::resource('operator_games', App\Http\Controllers\API\OperatorGameAPIController::class);


Route::resource('operator_licenses', App\Http\Controllers\API\OperatorLicenseAPIController::class);


Route::resource('operator_schemes', App\Http\Controllers\API\OperatorSchemeAPIController::class);


Route::resource('operator_types', App\Http\Controllers\API\OperatorTypeAPIController::class);


Route::resource('settings', App\Http\Controllers\API\SettingAPIController::class);


Route::resource('states', App\Http\Controllers\API\StateAPIController::class);


// Route::resource('tickets', App\Http\Controllers\API\TicketAPIController::class);


// Route::resource('ticket_types', App\Http\Controllers\API\TicketTypeAPIController::class);


// Route::resource('comments', App\Http\Controllers\API\CommentAPIController::class);


Route::resource('operator_directors', App\Http\Controllers\API\OperatorDirectorAPIController::class);


Route::resource('monitoring_logs', App\Http\Controllers\API\MonitoringLogAPIController::class);


Route::resource('games_played', App\Http\Controllers\API\GamesPlayedAPIController::class);
