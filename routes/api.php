<?php

use App\Http\Controllers\Api\APIController;
use App\Http\Controllers\SubscriptionController;
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

Route::group(['prefix' =>  'auth' , 'middleware'=> ['allow.cors' ]], function () {
    Route::post('/token', [App\Http\Controllers\API\AuthController::class, 'token']);

    Route::get('/refresh', [App\Http\Controllers\API\AuthController::class, 'refresh']);
});

Route::group(['prefix' => '/' , 'middleware'=>['auth:api' , 'throttle:3600,3' , 'allow.cors'   ]], function () {

    Route::get('/profile/{id}', [APIController::class, 'getProfile']);

    Route::post('/profile', [APIController::class, 'storeProfile']);

    Route::group(['prefix' => '/circles'], function () {

        Route::get('/', [APIController::class, 'getCircles']);

        Route::get('/{id}', [APIController::class, 'getCircle']);

        Route::get('/{id}/comments', [APIController::class, 'getCircleComments']);
    });






    Route::get('/notifications', [APIController::class, 'getNotifications']);

    Route::get('/questions', [APIController::class, 'getQuestions']);


    Route::get('/contacts', [APIController::class, 'getContacts']);

    Route::post('/feedback', [APIController::class, 'store_feedback']);

    Route::get('/group', [APIController::class, 'getGroup']);

    Route::get('/upcoming_dates', [APIController::class, 'getUpcomingDates']);

    Route::get('/messages', [APIController::class, 'getMessages']);

    Route::post('/read_messages', [APIController::class, 'readMessages']);

    Route::post('/remove_contact', [APIController::class, 'remove_contact']);

    Route::post('/report_contact', [APIController::class, 'report_contact']);

    Route::post('/update_event', [APIController::class, 'update_event']);

    Route::get('/delete_account', [APIController::class, 'delete_account']);

    Route::post('/change_date', [APIController::class, 'store_booking_date']);

    Route::get('/reset_submission', [APIController::class, 'reset']);

    Route::post('/send-message', [APIController::class, 'sendMessage']);

});