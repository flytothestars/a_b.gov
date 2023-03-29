<?php

use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\API\BusinessController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\System\ArtisanController;

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
//
Route::get('/setLocale/{locale}', [HelperController::class, 'setLocale'])->name('setLocale');

Route::post('/password/reset-confirm', [ResetPasswordController::class, 'validateToken'])->name('password.validateToken');

Auth::routes();

Route::prefix('art')->group(function () {
    Route::get('migrate_install', [ArtisanController::class, 'migrate_install']);
    Route::get('migrate', [ArtisanController::class, 'migrate']);
    Route::get('clear_cache', [ArtisanController::class, 'clearCache']);
    Route::get('route_clear', [ArtisanController::class, 'routeClear']);
    Route::get('cache', [ArtisanController::class, 'cache']);
    Route::get('storage_link', [ArtisanController::class, 'storageLink']);
    Route::get('schedule', [ArtisanController::class, 'schedule']);
    Route::get('csrf_token', [ArtisanController::class, 'showToken']);
    Route::get('refresh_media', [ArtisanController::class, 'refreshMedia']);
    Route::get('generate_thumbnails', [ArtisanController::class, 'generateMediaThumbnails']);
});

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/главная', [\App\Http\Controllers\HomeController::class, 'index'])->name('home.another');
Route::get('/about', [\App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/docs', [\App\Http\Controllers\HomeController::class, 'docs'])->name('docs');
Route::get('/download/{type?}/{file?}/', [\App\Http\Controllers\HomeController::class, 'download'])->name('download');

/** news */
Route::get('/news_list/{news_category_code?}', [\App\Http\Controllers\NewsController::class, 'index'])->name('news_list');
Route::get('/news/{news_code}', [\App\Http\Controllers\NewsController::class, 'show'])->name('news');

/** services */
Route::get('/services/list/{types_appeal?}/{service_groups?}', [\App\Http\Controllers\ServiceController::class, 'services'])->name('services');
Route::get('/services/detail/{service_type?}', [\App\Http\Controllers\ServiceController::class, 'servicesDetail'])->name('service.detail');
Route::get('/businessAutomation', [\App\Http\Controllers\ServiceController::class, 'businessAutomation'])->name('business.automation');
Route::get('/permittingDocuments', [\App\Http\Controllers\HomeController::class, 'permittingDocuments'])->name('permittingDocuments');
// Route::get('/financingPrograms/{types_appeal?}/', [\App\Http\Controllers\ServiceController::class, 'financingPrograms'])->name('financingPrograms');
Route::get('/financingPrograms/detail/{types_appeal}/', [\App\Http\Controllers\ServiceController::class, 'financingProgramsDetail'])->name('financingPrograms.detail');
Route::get('/freeEducation/{types_appeal?}/', [\App\Http\Controllers\ServiceController::class, 'freeEducation'])->name('freeEducation');
Route::get('/freeEducation/detail/{code}/', [\App\Http\Controllers\ServiceController::class, 'detail'])->name('freeEducation.detail');
Route::get('/servicesForBeginnerEntrepreneur', [\App\Http\Controllers\HomeController::class, 'servicesForBeginnerEntrepreneur'])->name('servicesForBeginnerEntrepreneur');
Route::get('/servicesInfrastructure', [\App\Http\Controllers\HomeController::class, 'servicesInfrastructure'])->name('servicesInfrastructure');
Route::get('/servicesForEntrepreneur', [\App\Http\Controllers\HomeController::class, 'servicesForEntrepreneur'])->name('servicesForEntrepreneur');
Route::get('/businessPlanPreparation', [\App\Http\Controllers\HomeController::class, 'businessPlanPreparation'])->name('businessPlanPreparation');
Route::get('/startBusiness', [\App\Http\Controllers\HomeController::class, 'startBusiness'])->name('startBusiness');
Route::get('/banks/{action_type?}/', [\App\Http\Controllers\ServiceController::class, 'banks'])->name('banks');
Route::get('/banks/detail/{action_type?}/{bank?}/', [\App\Http\Controllers\ServiceController::class, 'bankDetail'])->name('bankDetail');
Route::get('/industrial-enterprise',[\App\Http\Controllers\ServiceController::class, 'industrialEnterprise'])->name('industrialEnterprise');
Route::get('/service_finance_ip_too',[\App\Http\Controllers\ServiceController::class, 'service_finance_ip_too'])->name('service_finance_ip_too');
Route::get('/service_customs_duty',[\App\Http\Controllers\ServiceController::class, 'customsDutyService'])->name('customs_duty_service');

/** search in web */
Route::get('/search', [\App\Http\Controllers\HomeController::class, 'searchService'])->name('search');

Route::get('/online-business-risk-check', [\App\Http\Controllers\ServiceController::class, 'onlineCheckingBusinessRisk'])->name('online.checkingBusinessForRisk');
Route::get('/online-business-risk-check/checking/{bin_iin}', [\App\Http\Controllers\ServiceController::class, 'checkingBusinessRisk'])->name('checkingBusinessForRisk');

Route::get('/testEmail', [\App\Http\Controllers\HomeController::class, 'testEmail'])->name('testEmail');

Route::middleware('auth')->group(function () {
    Route::get('/services/{service_groups_id}/form', [\App\Http\Controllers\HomeController::class, 'servicesForm'])->name('services.form');
    Route::post('/services/{service_groups_id}/form', [\App\Http\Controllers\HomeController::class, 'servicesFormSubmit'])->name('services.form.submit');
});

/** user */
Route::prefix('profile')->middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/info', [\App\Http\Controllers\ProfileController::class, 'info'])->name('profile.info');
    Route::post('/store', [\App\Http\Controllers\ProfileController::class, 'store'])->name('profile.store');
    Route::get('password_change', [\App\Http\Controllers\Auth\ChangePasswordController::class, 'index'])->name('password.change.index');
    Route::post('password_change', [\App\Http\Controllers\Auth\ChangePasswordController::class, 'store'])->name('password.change.store');
});

Route::get('/showServiceComplete', [\App\Http\Controllers\HomeController::class, 'showServiceComplete'])->name('showServiceComplete');

Route::get('admin/{vue_capture?}', function () {
    return view('admin.index');
})->where('vue_capture', '[\/\w\.-]*');

//request routes

Route::prefix('appeals')->middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\AppealController::class, 'index'])->name('appeals.index');
    Route::get('/create', [\App\Http\Controllers\AppealController::class, 'create'])->name('appeals.create');
    Route::post('/store', [\App\Http\Controllers\AppealController::class, 'store'])->name('appeals.store');
    Route::get('/show/{appeals_code}', [\App\Http\Controllers\AppealController::class, 'show'])->name('appeals.show');
    Route::get('/edit/{appeals_code}', [\App\Http\Controllers\AppealController::class, 'edit'])->name('appeals.edit');
    Route::post('/update/{appeals_code}', [\App\Http\Controllers\AppealController::class, 'update'])->name('appeals.update');
    Route::get('/delete/{appeals_code}', [\App\Http\Controllers\AppealController::class, 'delete'])->name('appeals.delete');
    Route::get('/send/{appeals_code}', [\App\Http\Controllers\AppealController::class, 'send'])->name('appeals.send');
    Route::get('/exportUserAppeals', [\App\Http\Controllers\AppealController::class, 'exportUserAppeals']);
    Route::get('/exportAppeals', [\App\Http\Controllers\AppealController::class, 'exportAppeals']);
});
Route::middleware(['auth', 'role:Administrator'])->group(function () {
    Route::get('delete-users-all', [BusinessController::class, 'deleteAccountAll']);
    Route::get('create-users-all', [BusinessController::class, 'createAccount']);
    Route::get('check-users-all/{id}', [BusinessController::class, 'checkAccountBusiness']);
//    Route::get('/appeals/exportToExcel2', [App\Http\Controllers\API\Admin\UserController::class, 'exportToExcel2']);
});

Route::get('/survey', [SurveyController::class, 'index'])->name('financingForm');
Route::get('/survey/{iin?}', [SurveyController::class, 'byIin'])->name('financingFormIin');
Route::get('/testIntegration', [\App\Http\Controllers\IntegrationController::class, 'testIntegration']);
Route::get('/checkDuplicate/{file}/{count}', [\App\Http\Controllers\IntegrationController::class, 'checkDuplicate']);
Route::get('/getHistory', [\App\Http\Controllers\IntegrationController::class, 'getHistory']);
Route::get('/mioGetStatus', [\App\Http\Controllers\IntegrationController::class, 'mioGetStatus']);
Route::get('/uploadFileTest/{file}/{count}', [\App\Http\Controllers\IntegrationController::class, 'uploadFile']);
Route::get('/uploadFileBusEn/{file}/{count}', [\App\Http\Controllers\IntegrationController::class, 'uploadFileBusEn']);
Route::get('/uploadFileUpdate/{file}/{count}', [\App\Http\Controllers\IntegrationController::class, 'uploadFileUpdate']);
Route::get('/uploadFileUpdateCreate/{file}/{count}', [\App\Http\Controllers\IntegrationController::class, 'uploadFileUpdateCreate']);
Route::get('/upload-bus-contact', [IntegrationController::class, 'uploadBusContacts']);
Route::get('/upload-file', [FileUploadController::class, 'createForm']);
Route::get('/upload-file-delete/{file}', [FileUploadController::class, 'uploadFileDelete']);
Route::post('/upload-file', [FileUploadController::class, 'fileUploadBus'])->name('fileUpload');
Route::get('/testAppealIntegration', [\App\Http\Controllers\IntegrationController::class, 'testAppealUpdateIntegration']);
Route::get('/testOrganisationIntegration', [\App\Http\Controllers\IntegrationController::class, 'testOrganisationIntegration']);
Route::get('/testBusinessIntegration', [\App\Http\Controllers\IntegrationController::class, 'testBusinessIntegration']);
Route::get('/testCamundaConnection', [\App\Http\Controllers\HomeController::class, 'testCamundaService']);
Route::middleware('auth')->group(function () {
    Route::get('/testOne/{id}', [\App\Repositories\AppealRepository::class, 'test_one']);
    Route::get('/delete-distributor', [\App\Repositories\AppealRepository::class, 'deleteDistributor']);
    Route::get('/testTwo/{$isn}', [\App\Repositories\AppealRepository::class, 'test_two']);
    Route::get('/test-three', [\App\Repositories\AppealRepository::class, 'testThree']);
    Route::get('/get-distributor', [\App\Repositories\AppealRepository::class, 'getDistributor']);
    Route::get('/extra-divide', [\App\Repositories\AppealRepository::class, 'extraDivide']);
    Route::get('/extra-divide-distributor/{isn}/{count}', [\App\Repositories\AppealRepository::class, 'extraDivideDistributor']);
});
Route::get('admin/{vue_capture?}', function () {
    return view('admin.index');
})->where('vue_capture', '[\/\w\.-]*');