<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->name('cmsapi.')->group(function () {

    Route::apiResources([
        'users' => 'UserController',
        'enterprises' => 'EnterpriseController',
        'clients' => 'ClientController',
        'establishment_types' => 'EstablishmentTypeController',
        'establishments' => 'EstablishmentController',
        'establishment_evaluations' => 'EstablishmentEvaluationController',
        'indicators' => 'IndicatorController',
        'indicator_groups' => 'IndicatorGroupController',
        'surveys' => 'SurveyController'
    ]);
    Route::get('/list/clients', 'ClientController@getAll');
    Route::get('/list/establishment/types', 'EstablishmentTypeController@getAll');
    Route::get('/list/enterprises', 'EnterpriseController@getAll');
});
