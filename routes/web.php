<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [
    HomeController::class, 'index'
])->name('home')->middleware('auth');


Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder')->middleware('auth');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template')->middleware('auth');

Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template')->middleware('auth');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate')->middleware('auth');

Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback')->middleware('auth');

Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('io_generator_builder_generate_from_file')->middleware('auth');




Route::resource('users', App\Http\Controllers\UserController::class)->middleware('auth');

Route::resource('permissions', App\Http\Controllers\PermissionsController::class)
    ->only(['index', 'edit', 'update'])->middleware('auth');

Route::resource('roles', App\Http\Controllers\RolesController::class)->middleware('auth');

Route::resource('roles-assignment', App\Http\Controllers\RolesAssignmentController::class)
    ->only(['index', 'edit', 'update'])->middleware('auth');


Route::resource('activityLogs', App\Http\Controllers\ActivityLogController::class)->middleware('auth');



//pwa

Route::get('offline', function () {    
    return view('vendor/laravelpwa/offline');
})->middleware('auth');





Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');

Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');

Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('io_generator_builder_generate_from_file');





Route::resource('notifications', App\Http\Controllers\NotificationController::class)->middleware('auth');


Route::resource('applicants', App\Http\Controllers\ApplicantController::class)->middleware('auth');

Route::get('new_application', [App\Http\Controllers\ApplicantController::class, 'apply'])->name('applicants.apply');

Route::get('applicants_dashboard', [App\Http\Controllers\ApplicantController::class, 'dashboard'])->name('applicants.dashboard')->middleware('auth');

Route::get('applicants_edit/{id}', [App\Http\Controllers\ApplicantController::class, 'applicationEdit'])->name('application.edit')->middleware('auth');

Route::get('applicants_details/{id}', [App\Http\Controllers\ApplicantController::class, 'applicationShow'])->name('application.show')->middleware('auth');

Route::post('applicants_final_submission/{id}', [App\Http\Controllers\ApplicantController::class, 'finalSubmission'])->name('applicants.final_submission')->middleware('auth');

Route::post('new_application', [App\Http\Controllers\ApplicantController::class, 'applicationStore'])->name('applicants.application_store');

Route::post('applicants_directors', [App\Http\Controllers\ApplicantController::class, 'applicationDirectorStore'])->name('application.directors');

Route::get('applicants_director_edit/{id}/{parent_id}', [App\Http\Controllers\ApplicantController::class, 'applicationDirectorEdit'])->name('application_director.edit')->middleware('auth');

Route::post('applicants_directors_destroy/{id}/{parent_id}', [App\Http\Controllers\ApplicantController::class, 'applicationDirectorDestroy'])->name('applicant_director_destroy');

Route::patch('applicants_director_edit/{id}/{parent_id}', [App\Http\Controllers\ApplicantController::class, 'applicationDirectorUpdate'])->name('applicants_director_update');


Route::resource('broadcasts', App\Http\Controllers\BroadcastController::class)->middleware('auth');


Route::resource('licenseChecklists', App\Http\Controllers\LicenseChecklistController::class)->middleware('auth');


Route::resource('licenseTypes', App\Http\Controllers\LicenseTypeController::class)->middleware('auth');


// Route::resource('mailBoxes', App\Http\Controllers\MailBoxController::class)->middleware('auth');


Route::resource('operators', App\Http\Controllers\OperatorController::class)->middleware('auth');

Route::get('operators_monitoring', [App\Http\Controllers\OperatorController::class, 'domainMonitoring'])->name('domainMonitoring')->middleware('auth');


Route::get('operators_dashboard', [App\Http\Controllers\OperatorController::class, 'dashboard'])->name('operators.dashboard')->middleware('auth');


Route::resource('operatorGames', App\Http\Controllers\OperatorGameController::class)->middleware('auth');


Route::resource('operatorLicenses', App\Http\Controllers\OperatorLicenseController::class)->middleware('auth');


Route::resource('operatorSchemes', App\Http\Controllers\OperatorSchemeController::class)->middleware('auth');


Route::resource('operatorTypes', App\Http\Controllers\OperatorTypeController::class)->middleware('auth');


Route::resource('settings', App\Http\Controllers\SettingController::class)->middleware('auth');


Route::resource('states', App\Http\Controllers\StateController::class)->middleware('auth');


// Route::resource('tickets', App\Http\Controllers\TicketController::class)->middleware('auth');


// Route::resource('ticketTypes', App\Http\Controllers\TicketTypeController::class)->middleware('auth');


// Route::resource('comments', App\Http\Controllers\CommentController::class)->middleware('auth');


Route::resource('operatorDirectors', App\Http\Controllers\OperatorDirectorController::class)->middleware('auth');


Route::resource('monitoringLogs', App\Http\Controllers\MonitoringLogController::class)->middleware('auth');


Route::resource('gamesPlayed', App\Http\Controllers\GamesPlayedController::class)->middleware('auth');
