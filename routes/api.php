<?php

use App\Http\Controllers\API\Admin\NewsController;
use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\GovernmentProgramsReports\ReportsHeadController;
use App\Http\Controllers\API\BusinessController;
use App\Http\Controllers\API\Report\ReportCityController;
use App\Http\Controllers\API\Report\ReportController;
use App\Http\Controllers\API\Report\ReportRegionController;
use App\Http\Controllers\API\Report\ReportTypeController;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\AppealsController;
use App\Http\Controllers\API\UserReport\UserReportController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

//test push
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


//Route::middleware(['auth:api','role:Administrator'])->name('api.')->prefix("admin")->group(function() {
//    Route::apiResource('users', UserController::class);
//});
//
//Route::middleware(['auth:api','role:Administrator','scope:Administrator'])->name('api.')->group(function() {
//    Route::apiResource('projects.tags', TagController::class);
//});
//
Route::post('/survey/send-application', [SurveyController::class, 'sendApplication'])->name('api.msb.sendApplication');

Route::middleware(['auth:api', 'role:Administrator'])->name('api.')->prefix("admin")->group(function () {
    Route::apiResource('users', UserController::class);
//    Route::get('/appeals/exportToExcel2', [App\Http\Controllers\API\Admin\UserController::class, 'exportToExcel2']);
});
Route::middleware(['auth:api', 'role:Administrator|PressSecretary'])->name('api.')->prefix("admin")->group(function () {
    Route::get('news', [NewsController::class, 'index'])->name('api.admin.news.list');
    Route::get('news/{id}', [NewsController::class, 'show'])->name('api.admin.news.get');
    Route::post('news/{id}', [NewsController::class, 'update'])->name('api.admin.news.update');
    Route::post('news', [NewsController::class, 'store'])->name('api.admin.news.update');

    Route::post('news-image-store', [NewsController::class, 'storeImage'])->name('api.admin.news.store-image');
});

Route::middleware([])->name('api.')->prefix("reports")->group(function () {
    Route::get('types', [ReportTypeController::class, 'getReportTypes'])->name('reports.types');
    Route::get('citiesList', [ReportTypeController::class, 'citiesList']);
    Route::post('city-ratios', [ReportCityController::class, 'fetchReportTypeRatioList']);
    Route::post('update-city-ratios', [ReportCityController::class, 'updateCityRatios']);
    Route::get('districts-list/{city_id}', [ReportRegionController::class, 'getDistrictsListByCity']);
    Route::post('district-ratios', [ReportRegionController::class, 'fetchReportRatioList']);
    Route::post('update-region-ratios', [ReportRegionController::class, 'updateDistrictRatios']);
    Route::post('investment-report', [ReportController::class, 'investmentReport']);
    Route::post('industry-report', [ReportController::class, 'industryReport']);
    Route::post('trade-report', [ReportController::class, 'tradeReport']);
    Route::post('prt-report', [ReportController::class, 'prtReport']);
    Route::post('report-business-stat', [ReportController::class, 'businessStatReport']);
    Route::post('users-report', [ UserReportController::class, 'getUserReport'])->name('users.report');
});

Route::name('api.login')->post('login', [LoginController::class, 'login']);

Route::apiResource('/appeals', AppealsController::class)->only('index');
Route::get('business/{id}/contacts', [BusinessController::class, 'businessContacts']);
Route::get('business/{id}/photos', [BusinessController::class, 'businessPhotos']);
Route::get('business/{id}/activityType', [BusinessController::class, 'businessActivity']);
Route::get('business/{id}', [BusinessController::class, 'business']);
Route::get('businessList', [BusinessController::class, 'businessList']);
Route::get('/appeals/{id}/history/', [AppealsController::class, 'history'])
    ->name('appeals.history');
Route::get('/appeals/{id}/historyAll/', [AppealsController::class, 'historyAll']);
Route::get('reportBusiness', [BusinessController::class, 'reportBusiness']);
Route::get('reportStatByDistrict', [BusinessController::class, 'reportStatByDistrict']);
Route::post('reportBusiness/appeals-report', [BusinessController::class, 'appealsReport']);

Route::name('api.camunda')->prefix('camunda')->group(function () {
    Route::get('/bpmn_diagram_xml', [\App\Http\Controllers\API\Camunda\CamundaController::class, 'getBpmnDiagramXml']);
    Route::get('/bpmn_history/{id}', [\App\Http\Controllers\API\Camunda\CamundaController::class, 'getBpmnHistory']);
});

Route::middleware(['auth:api', 'role:UPIHead'])->name('api.upihead.')->prefix("upiHead")->group(function () {
    Route::get('/appeals/indexByAuthUser', [App\Http\Controllers\API\UPIHead\AppealController::class, 'indexByAuthUser'])
        ->name('appeals.indexByAuthUser');

    Route::get('/appeals/exportToExcel', [App\Http\Controllers\API\UPIHead\AppealController::class, 'exportToExcel']);
    Route::apiResource('appeals', App\Http\Controllers\API\UPIHead\AppealController::class)
        ->only('index', 'show', 'update');
});

Route::middleware(['auth:api', 'role:Head'])->name('api.head.')->prefix("head")->group(function () {
    Route::get('/appeals/indexByAuthUser', [App\Http\Controllers\API\Head\AppealController::class, 'indexByAuthUser'])
        ->name('appeals.indexByAuthUser');

    Route::get('/appeals/exportToExcelByAuthUser', [App\Http\Controllers\API\Head\AppealController::class, 'exportToExcelByAuthUser']);
    Route::get('/appeals/exportToExcel', [App\Http\Controllers\API\Head\AppealController::class, 'exportToExcel']);
    Route::apiResource('appeals', App\Http\Controllers\API\Head\AppealController::class)
        ->only('index', 'show', 'update');

    Route::post('appeals/{id}/reassign-distributor', [\App\Http\Controllers\API\Head\AppealController::class, 'reassignDistributor'])
        ->name('appeals.reassign-distributor');
    Route::post('appeals/reassign-distributor', [\App\Http\Controllers\API\Head\AppealController::class, 'reassignDistributorMultiple'])
        ->name('appeals.reassign-distributor-multiple');
    //    Route::get('/appeals/exportToExcel2', [App\Http\Controllers\API\Head\AppealController::class, 'exportToExcel2']);
});

Route::middleware(['auth:api', 'role:IEManager'])->name('api.iemanager.')->prefix("iemanager")->group(function () {
    Route::get('/appeals/indexByAuthUser', [App\Http\Controllers\API\IEManager\IEApplicationsController::class, 'indexByAuthUser'])
        ->name('appeals.indexByAuthUser');
        Route::put('/appeals/{id}/access/', [App\Http\Controllers\API\IEManager\IEApplicationsController::class, 'access']);
        Route::put('/appeals/{id}/reject/', [App\Http\Controllers\API\IEManager\IEApplicationsController::class, 'reject']);
        
    Route::get('/appeals/exportToExcelByAuthUser', [App\Http\Controllers\API\IEManager\IEApplicationsController::class, 'exportToExcelByAuthUser']);
    Route::get('/appeals/exportToExcel', [App\Http\Controllers\API\IEManager\IEApplicationsController::class, 'exportToExcel']);
    Route::apiResource('appeals', App\Http\Controllers\API\IEManager\IEApplicationsController::class)
        ->only('index', 'show', 'update');

    Route::post('appeals/{id}/reassign-distributor', [\App\Http\Controllers\API\IEManager\IEApplicationsController::class, 'reassignDistributor'])
        ->name('appeals.reassign-distributor');
    Route::post('appeals/reassign-distributor', [\App\Http\Controllers\API\IEManager\IEApplicationsController::class, 'reassignDistributorMultiple'])
        ->name('appeals.reassign-distributor-multiple');
    //    Route::get('/appeals/exportToExcel2', [App\Http\Controllers\API\Head\AppealController::class, 'exportToExcel2']);
});

Route::middleware(['auth:api', 'role:Distributor'])->name('api.distributor.')->prefix("distributor")->group(function () {
    Route::get('/appeals/indexByAuthUser', [App\Http\Controllers\API\Distributor\AppealController::class, 'indexByAuthUser'])
        ->name('appeals.indexByAuthUser');
    Route::put('/appeals/{id}/getToWork/', [App\Http\Controllers\API\Distributor\AppealController::class, 'getToWork'])
        ->name('appeals.getToWork');
    Route::put('/appeals/{id}/cantContact/', [App\Http\Controllers\API\Distributor\AppealController::class, 'cantContact'])
        ->name('appeals.cantContact');
    Route::put('/appeals/{id}/byProduct/', [App\Http\Controllers\API\Distributor\AppealController::class, 'byProduct']);
    Route::put('/appeals/{id}/notByProduct/', [App\Http\Controllers\API\Distributor\AppealController::class, 'notByProduct']);
    Route::put('/appeals/{id}/requiresClarification/', [App\Http\Controllers\API\Distributor\AppealController::class, 'requiresClarification']);
    Route::put('/appeals/{id}/backToWork/', [App\Http\Controllers\API\Distributor\AppealController::class, 'backToWork'])
        ->name('appeals.backToWork');
    Route::put('/appeals/{id}/assignExecutor/', [App\Http\Controllers\API\Distributor\AppealController::class, 'assignExecutor'])
        ->name('appeals.assignExecutor');
    Route::put('/appeals/{id}/assignCoExecutor/', [App\Http\Controllers\API\Distributor\AppealController::class, 'assignCoExecutor'])
        ->name('appeals.assignCoExecutor');
    Route::put('/appeals/{id}/assignCurator/', [App\Http\Controllers\API\Distributor\AppealController::class, 'assignCurator'])
        ->name('appeals.assignCurator');
    Route::post('/appeals/{id}/complete/', [App\Http\Controllers\API\Distributor\AppealController::class, 'complete'])
        ->name('appeals.complete');
    Route::post('/appeals/{id}/reject/', [App\Http\Controllers\API\Distributor\AppealController::class, 'reject'])
        ->name('appeals.reject');
    Route::post('/appeals/{id}/documents/attach', [App\Http\Controllers\API\Distributor\AppealController::class, 'attachDocuments'])
        ->name('appeals.documents.attach.');
    Route::post('/appeals/edit-category', function () {
        return response(['test' => 'ok']);
    })
        ->name('appeals.edit-category');
    Route::post('/appeals/{id}/edit-category', [App\Http\Controllers\API\Distributor\AppealController::class, 'editCategory'])
        ->name('appeals.edit-category');

    Route::get('/appeals/exportToExcelByAuthUser', [App\Http\Controllers\API\Distributor\AppealController::class, 'exportToExcelByAuthUser']);
    Route::get('/appeals/exportToExcel', [App\Http\Controllers\API\Distributor\AppealController::class, 'exportToExcel']);
    Route::apiResource('appeals', App\Http\Controllers\API\Distributor\AppealController::class)
        ->only('index', 'show', 'update');

    Route::post('parent-appeals/create', [App\Http\Controllers\API\Distributor\ParentAppealController::class, 'createByParent'])
        ->name('parent-appeals.create');
    Route::get('businessList', [BusinessController::class, 'distributorBusinessList'])
        ->name('distributor.business.list');
    Route::get('business/{id}', [BusinessController::class, 'distributorBusiness'])
        ->name('distributor.business.id');
    Route::post('business/create-account', [BusinessController::class, 'createBusinessAccount'])
        ->name('distributor.business.account.create');
    Route::post('business/{id}/no-appeals', [BusinessController::class, 'noAppeal'])
        ->name('distributor.business.no-appeals');
    Route::post('business/{id}/sent-to-correction', [BusinessController::class, 'sendToCorrection'])
        ->name('distributor.business.sent-to-correction');
    Route::post('create-business-appeal', [\App\Http\Controllers\API\Distributor\ParentAppealController::class, 'createByBusiness'])
        ->name('distributor.create-business-appeal');
});

Route::middleware(['auth:api', 'role:DivisionCurator'])->name('api.divisionCurator.')->prefix("divisionCurator")->group(function () {
    Route::get('/appeals/indexByAuthUser', [App\Http\Controllers\API\DivisionCurator\AppealController::class, 'indexByAuthUser'])
        ->name('appeals.indexByAuthUser');
    Route::put('/appeals/{id}/complete/', [App\Http\Controllers\API\DivisionCurator\AppealController::class, 'complete'])
        ->name('appeals.complete');
    Route::put('/appeals/{id}/backToWork/', [App\Http\Controllers\API\DivisionCurator\AppealController::class, 'backToWork'])
        ->name('appeals.backToWork');

    Route::apiResource('appeals', App\Http\Controllers\API\DivisionCurator\AppealController::class)
        ->only('index', 'show', 'update');

    Route::get('/appeals/exportToExcelByAuthUser', [App\Http\Controllers\API\DivisionCurator\AppealController::class, 'exportToExcelByAuthUser']);
    Route::get('/appeals/exportToExcel', [App\Http\Controllers\API\DivisionCurator\AppealController::class, 'exportToExcel']);
});

Route::middleware(['auth:api', 'role:CoExecutor'])->name('api.coexecutor.')->prefix("coexecutor")->group(function () {
    Route::get('/appeals/indexByAuthUser/', [App\Http\Controllers\API\CoExecutor\AppealController::class, 'indexByAuthUser'])
        ->name('appeals.indexByAuthUser');
    Route::post('/appeals/{id}/complete/', [App\Http\Controllers\API\CoExecutor\AppealController::class, 'complete'])
        ->name('appeals.complete');
    Route::post('/appeals/{id}/reject/', [App\Http\Controllers\API\CoExecutor\AppealController::class, 'reject'])
        ->name('appeals.reject');
    Route::post('/appeals/{id}/documents/attach', [App\Http\Controllers\API\Distributor\AppealController::class, 'attachDocuments'])
        ->name('appeals.documents.attach.');

    Route::get('/appeals/exportToExcelByAuthUser', [App\Http\Controllers\API\CoExecutor\AppealController::class, 'exportToExcelByAuthUser']);
    Route::get('/appeals/exportToExcel', [App\Http\Controllers\API\CoExecutor\AppealController::class, 'exportToExcel']);
    Route::apiResource('appeals', App\Http\Controllers\API\CoExecutor\AppealController::class)
        ->only('index', 'show');
});

Route::middleware(['auth:api', 'role:Manager'])->name('api.executor.')->prefix("executor")->group(function () {
    Route::get('/appeals/indexByAuthUser/', [App\Http\Controllers\API\Executor\AppealController::class, 'indexByAuthUser'])
        ->name('appeals.indexByAuthUser');
    Route::put('/appeals/{id}/getToWork/', [App\Http\Controllers\API\Executor\AppealController::class, 'getToWork'])
        ->name('appeals.getToWork');
    Route::put('/appeals/{id}/assignCoExecutor/', [App\Http\Controllers\API\Executor\AppealController::class, 'assignCoExecutor'])
        ->name('appeals.assignCoExecutor');
    Route::post('/appeals/{id}/complete/', [App\Http\Controllers\API\Executor\AppealController::class, 'complete'])
        ->name('appeals.complete');
    Route::put('/appeals/{id}/reject/', [App\Http\Controllers\API\Executor\AppealController::class, 'reject'])
        ->name('appeals.reject');
    Route::post('/appeals/{id}/documents/attach', [App\Http\Controllers\API\Distributor\AppealController::class, 'attachDocuments'])
        ->name('appeals.documents.attach.');
    Route::put('/appeals/{id}/cantContact/', [App\Http\Controllers\API\Executor\AppealController::class, 'cantContact'])
        ->name('appeals.cantContact');
    Route::put('/appeals/{id}/byProduct/', [App\Http\Controllers\API\Executor\AppealController::class, 'byProduct']);
    Route::put('/appeals/{id}/notByProduct/', [App\Http\Controllers\API\Executor\AppealController::class, 'notByProduct']);
    Route::put('/appeals/{id}/requiresClarification/', [App\Http\Controllers\API\Executor\AppealController::class, 'requiresClarification']);
    Route::put('/appeals/{id}/backToWork/', [App\Http\Controllers\API\Executor\AppealController::class, 'backToWork'])
        ->name('appeals.backToWork');
    Route::post('/appeals/{id}/edit-category', [App\Http\Controllers\API\Executor\AppealController::class, 'editCategory'])
        ->name('appeals.edit-category');

    Route::get('/appeals/exportToExcelByAuthUser', [App\Http\Controllers\API\Executor\AppealController::class, 'exportToExcelByAuthUser']);
    Route::get('/appeals/exportToExcel', [App\Http\Controllers\API\Executor\AppealController::class, 'exportToExcel']);
    Route::apiResource('appeals', App\Http\Controllers\API\Executor\AppealController::class)
        ->only('index', 'show');
});

Route::middleware(['auth:api', 'role:Administrator'])->name('api.executor.')->prefix("admin")->group(function () {
    Route::get('/appeals/exportToExcel2', [App\Http\Controllers\API\Executor\AppealController::class, 'exportToExcel2']);
    Route::get('/appeals/exportToExcel3', [App\Http\Controllers\API\Executor\AppealController::class, 'exportToExcelContact']);
});

Route::middleware(['auth:api', 'role:UpiCurator|Administrator'])->name('api.upiCurator.government.reports.')->prefix('government-reports')->group(function () {
    Route::post('list', [ReportsHeadController::class, 'getReportsList'])->name('list');
    Route::post('import', [ReportsHeadController::class, 'importReport'])->name('list');
    Route::post('re-import', [ReportsHeadController::class, 'reImportReport'])->name('list');
    Route::post('get-report-rows', [ReportsHeadController::class, 'getReportRows'])->name('list');
    Route::post('update-report-row', [ReportsHeadController::class, 'updateReportRow'])->name('list');
    Route::get('get-report-row/{report_id}/{id}', [ReportsHeadController::class, 'getReportRow'])->name('list');
    Route::get('get-report/{report_id}', [ReportsHeadController::class, 'getReport'])->name('list');
    Route::post('create-report', [ReportsHeadController::class, 'createReport'])->name('list');
    Route::get('get-common-ratios/{id}', [ReportsHeadController::class, 'getCommonReportRatios'])->name('list');
    Route::post('update-common-ratios/{id}', [ReportsHeadController::class, 'updateCommonReportRatios'])->name('list');
});

Route::middleware(['auth:api', 'role:UpiCurator'])->name('api.upiCurator.')->prefix("upiCurator")->group(function () {
    Route::get('/appeals/indexByAuthUser', [App\Http\Controllers\API\UpiCurator\AppealController::class, 'indexByAuthUser'])
        ->name('appeals.indexByAuthUser');
    Route::put('/appeals/{id}/backToWork/', [App\Http\Controllers\API\UpiCurator\AppealController::class, 'backToWork'])
        ->name('appeals.backToWork');
    Route::put('/appeals/{id}/assignExecutor/', [App\Http\Controllers\API\UpiCurator\AppealController::class, 'assignExecutor'])
        ->name('appeals.assignExecutor');
    Route::put('/appeals/{id}/complete/', [App\Http\Controllers\API\UpiCurator\AppealController::class, 'complete'])
        ->name('appeals.complete');
    Route::post('/appeals/{id}/reject/', [App\Http\Controllers\API\UpiCurator\AppealController::class, 'reject'])
        ->name('appeals.reject');
    Route::post('appeals/{id}/reassign-distributor', [\App\Http\Controllers\API\Head\AppealController::class, 'reassignDistributor']);
    Route::post('appeals/reassign-distributor', [\App\Http\Controllers\API\Head\AppealController::class, 'reassignDistributorMultiple'])
    ->name('appeals.reassign-distributor-multiple');

    Route::get('/appeals/exportToExcelByAuthUser', [App\Http\Controllers\API\UpiCurator\AppealController::class, 'exportToExcelByAuthUser']);
    Route::get('/appeals/exportToExcel', [App\Http\Controllers\API\UpiCurator\AppealController::class, 'exportToExcel']);
    Route::apiResource('appeals', App\Http\Controllers\API\UpiCurator\AppealController::class)
        ->only('index', 'show', 'update');
});

Route::middleware(['auth:api', 'role:DistrictCurator'])->name('api.districtCurator.')->prefix("districtCurator")->group(function () {
    Route::get('/appeals/indexByAuthUser', [App\Http\Controllers\API\DistrictCurator\AppealController::class, 'indexByAuthUser'])
        ->name('appeals.indexByAuthUser');
    Route::put('/appeals/{id}/assignCoExecutor/', [App\Http\Controllers\API\DistrictCurator\AppealController::class, 'assignCoExecutor'])
        ->name('appeals.assignCoExecutor');

    Route::put('/appeals/{id}/complete/', [App\Http\Controllers\API\DistrictCurator\AppealController::class, 'complete'])
        ->name('appeals.complete');
    Route::post('/appeals/{id}/reject/', [App\Http\Controllers\API\DistrictCurator\AppealController::class, 'reject'])
        ->name('appeals.reject');


    Route::apiResource('appeals', App\Http\Controllers\API\DistrictCurator\AppealController::class)
        ->only('index', 'show', 'update');
});

Route::middleware(['auth:api'])->name('api.dictionary')->prefix('dictionary')->group(function () {
    Route::get('user/executorList', [App\Http\Controllers\API\Dictionary\UserController::class, 'executorList']);
    Route::get('user/distributorList', [App\Http\Controllers\API\Dictionary\UserController::class, 'distributorList']);
    Route::get('user/executorUPIList', [App\Http\Controllers\API\Dictionary\UserController::class, 'executorUPIList']);
    Route::get('user/coExecutorList/{department_id}', [App\Http\Controllers\API\Dictionary\UserController::class, 'coExecutorList']);
    Route::get('user/coExecutorList/', [App\Http\Controllers\API\Dictionary\UserController::class, 'coExecutorList']);
    Route::get('user/upiCuratorList', [App\Http\Controllers\API\Dictionary\UserController::class, 'upiCuratorList']);
    Route::get('user/districtCuratorList', [App\Http\Controllers\API\Dictionary\UserController::class, 'districtCuratorList']);

    Route::apiResource('district', App\Http\Controllers\API\Dictionary\DistrictController::class)
        ->only('index');
    Route::apiResource('appealStatus', App\Http\Controllers\API\Dictionary\AppealStatusController::class)
        ->only('index');
    Route::apiResource('appealCategory', App\Http\Controllers\API\Dictionary\AppealCategoryController::class)
        ->only('index');
    Route::apiResource('appealSource', App\Http\Controllers\API\Dictionary\AppealSourceController::class)
        ->only('index');
    Route::apiResource('serviceGroup', App\Http\Controllers\API\Dictionary\ServiceGroupController::class)
        ->only('index');
    Route::apiResource('industries', App\Http\Controllers\API\Dictionary\IndustryController::class)
        ->only('index');
    Route::apiResource('appealResultTypes', App\Http\Controllers\API\Dictionary\AppealResultTypeController::class)
        ->only('index');
    Route::get('appealResultTypesAll', [App\Http\Controllers\API\Dictionary\AppealResultTypeController::class, 'all']);
    Route::apiResource('roles', App\Http\Controllers\API\Dictionary\RoleController::class)->only('index');
    Route::apiResource('departments', App\Http\Controllers\API\Dictionary\DepartmentController::class)->only('index');
    Route::get('news-categories', [NewsController::class, 'categories']);
    Route::get('businessStatuses', [BusinessController::class, 'businessStatusList']);
});



Route::name('api.integration')->middleware(['auth:api', 'role:MIOIntegration'])->prefix('integration')->group(function () {
    Route::apiResource('business', App\Http\Controllers\API\Integration\BusinessController::class)->only(['update']);
    Route::apiResource('organization', App\Http\Controllers\API\Integration\OrganizationController::class)->only(['update']);
    Route::apiResource('business_contacts', App\Http\Controllers\API\Integration\BusinessContactController::class)->only(['update', 'destroy']);
    Route::apiResource('business_photo', App\Http\Controllers\API\Integration\BusinessPhotoController::class)->only(['update', 'destroy']);
    Route::apiResource('appeals', App\Http\Controllers\API\Integration\AppealController::class)->only(['update']);
});

Route::name('api.integration')->middleware(['auth:api', 'role:MSBIntegration|MIOIntegration'])->prefix('integration')->group(function () {
    Route::apiResource('business', App\Http\Controllers\API\Integration\BusinessController::class)->only(['store']);
    Route::apiResource('organization', App\Http\Controllers\API\Integration\OrganizationController::class)->only(['store']);
    Route::apiResource('business_contacts', App\Http\Controllers\API\Integration\BusinessContactController::class)->only(['store']);
    Route::apiResource('business_photo', App\Http\Controllers\API\Integration\BusinessPhotoController::class)->only(['store']);
    Route::apiResource('appeals', App\Http\Controllers\API\Integration\AppealController::class)->only(['store']);

    Route::post('activity_type/type', [App\Http\Controllers\API\Integration\ActivityTypeController::class, 'createActivityType']);
    Route::post('activity_type/section', [App\Http\Controllers\API\Integration\ActivityTypeController::class, 'createActivitySection']);
    Route::post('activity_type/group', [App\Http\Controllers\API\Integration\ActivityTypeController::class, 'createActivityGroup']);
    Route::post('activity_type/class', [App\Http\Controllers\API\Integration\ActivityTypeController::class, 'createActivityClass']);
    Route::post('activity_type/subclass', [App\Http\Controllers\API\Integration\ActivityTypeController::class, 'createActivitySubClass']);

    Route::get('dictionary/source_type', [App\Http\Controllers\API\Integration\DictionaryController::class, 'sourceType']);
    Route::get('dictionary/appeal_result_type', [App\Http\Controllers\API\Integration\DictionaryController::class, 'appealResultType']);
});

Route::get('importDKBGuarantee', [\App\Http\Controllers\API\GovernmentProgramsReports\ReportsHeadController::class, 'importDKBGuarantee']);

Route::name('api.camunda')->middleware(['auth:api', 'role:Administrator'])->prefix('camunda')->group(function () {
    Route::get('client_settings', [\App\Http\Controllers\API\Camunda\CamundaController::class, 'getClientSettings']);
    Route::put('client_settings', [\App\Http\Controllers\API\Camunda\CamundaController::class, 'setClientSettings']);


    Route::get('test_start/{id}', [\App\Http\Controllers\API\Camunda\CamundaController::class, 'testStart']);
});

Route::name('api.telegram')->prefix('telegram')->group(function () {
    Route::post('phone-exists', [\App\Http\Controllers\API\Telegram\AuthController::class, 'isUserPhoneExists']);
    Route::post('id-exists', [\App\Http\Controllers\API\Telegram\AuthController::class, 'isUserTelegramIdExists']);
    Route::post('create-account', [\App\Http\Controllers\API\Telegram\AuthController::class, 'createUserAccount']);
    Route::post('fill-profile', [\App\Http\Controllers\API\Telegram\TelegramController::class, 'fillProfile']);
    Route::post('create-appeal', [\App\Http\Controllers\API\Telegram\TelegramController::class, 'createAppeal']);
    Route::post('active-appeal-list', [\App\Http\Controllers\API\Telegram\TelegramController::class, 'activeAppealList']);
    Route::post('appeal-info', [\App\Http\Controllers\API\Telegram\TelegramController::class, 'appealInfo']);
});

Route::name('api.camunda')->middleware(['auth:api'])->prefix('camunda')->group(function () {
    Route::get('getAvailableTask', [\App\Http\Controllers\API\Camunda\CamundaController::class, 'getAvailableTask'])->name('camunda.getAvailableTask');
});

Route::post('camunda/webhook/{secretKey}', [\App\Http\Controllers\API\Camunda\CamundaController::class, 'webHook'])->name('camunda.webHook');
