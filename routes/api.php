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

Route::apiResources([
    'clients' => 'ClientController',
    'enterprises' => 'EnterpriseController',
    'establishment_types' => 'EstablishmentTypeController',
    'establishments' => 'EstablishmentController',
    'establishment_evaluations' => 'EstablishmentEvaluationController',
    'indicators' => 'IndicatorController',
    'indicator_groups' => 'IndicatorGroupController',
    'surveys' => 'SurveyController',
    'users' => 'UserController'
]);

