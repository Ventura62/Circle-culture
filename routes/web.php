<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
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

Auth::routes();

Route::group(['prefix' => '/'], function () {

    Route::get('/google',[App\Http\Controllers\HomeController::class, 'google_auth'])->name('google.authenticate');

    Route::get('/google/callback',[App\Http\Controllers\HomeController::class, 'callback'])->name('google.callback');

    Route::get('/test', [App\Http\Controllers\HomeController::class, 'test']);

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');

//    Route::get('/start', [App\Http\Controllers\HomeController::class, 'start'])->name('start');
//
//    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile')->middleware('auth');
//
//    Route::get('/notifications', [App\Http\Controllers\HomeController::class, 'notifications'])->name('notifications')->middleware('auth');
//
//    Route::post('/profile_store', [App\Http\Controllers\HomeController::class, 'store_profile'])->name('profile.store')->middleware('auth');
//
//    Route::get('/feedback', [App\Http\Controllers\HomeController::class, 'feedback'])->name('feedback')->middleware('auth');
//
//    Route::post('/store_feedback', [App\Http\Controllers\HomeController::class, 'store_feedback'])->name('feedback.store')->middleware('auth');
//
//    Route::get('/my-group', [App\Http\Controllers\HomeController::class, 'group'])->name('group')->middleware('auth');
//
//    Route::get('/chat', [App\Http\Controllers\HomeController::class, 'chat'])->name('chat')->middleware('auth');
//
//    Route::get('/remove_contact/{id}', [App\Http\Controllers\HomeController::class, 'remove_contact'])->name('contact.remove')->middleware('auth');
//
//    Route::post('/report_contact', [App\Http\Controllers\HomeController::class, 'report_contact'])->name('contact.report')->middleware('auth');
//
//    Route::get('/update_event/{id}/{status}', [App\Http\Controllers\HomeController::class, 'update_event'])->name('event.update')->middleware('auth');
//
//    Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
//
//    Route::post('/save_answers', [App\Http\Controllers\HomeController::class, 'save_answers'])->name('answers.store');
//
//    Route::get('/delete_account', [HomeController::class, 'delete_account'])->name('account.delete')->middleware('auth');
//
//    Route::post('/change_date', [App\Http\Controllers\HomeController::class, 'store_booking_date'])->name('submission.update_date');
//
//    Route::get('/change_date', [App\Http\Controllers\HomeController::class, 'change_date'])->name('change_date');
//
//    Route::post('/submit', [App\Http\Controllers\SubmissionController::class, 'store'])->name('submission.store');
//
//    Route::get('/reset_submission', [App\Http\Controllers\SubmissionController::class, 'reset'])->name('submission.reset');
//
//    Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send')->middleware('auth');
//
//
//    Route::group(['prefix' => 'subscription' ,'middleware'=> ['auth']], function () {
//        Route::get('/view', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscription');
//
//        Route::post('/book', [App\Http\Controllers\SubscriptionController::class, 'book'])->name('book');
//
//        Route::post('/pay', [App\Http\Controllers\SubscriptionController::class, 'pay'])->name('pay');
//
//        Route::get('/plan', [App\Http\Controllers\SubscriptionController::class, 'plan'])->name('plan');
//
//        Route::post('/charge', [App\Http\Controllers\SubscriptionController::class, 'charge'])->name('charge');
//
//        Route::get('/callback' , [\App\Http\Controllers\SubscriptionController::class , 'callback'])->name('callback');
//
//        Route::get('/refund' , [\App\Http\Controllers\SubscriptionController::class , 'refundPayment'])->name('refund');
//
//        Route::get('/subscribe/{plan_id}/{flow}', [App\Http\Controllers\SubscriptionController::class, 'subscribe_stripe'])->name('subscribe');
//    });

});


Route::group(['prefix' => '/dashboard', 'middleware'=> ['auth']], function () {

    Route::get('/' , [\App\Http\Controllers\HomeController::class , 'dashboard'])->name('dashboard');

    Route::group(['prefix' => '/submissions'], function () {

        Route::get('/', [App\Http\Controllers\SubmissionController::class, 'index'])->name('submissions');

        Route::get('/export', [App\Http\Controllers\SubmissionController::class, 'export'])->name('submissions.export');

        Route::get('delete/{id}', [App\Http\Controllers\SubmissionController::class, 'destroy'])->name('submission.delete');
    });


    Route::group(['prefix' => '/circles'], function () {

        Route::get('/', [App\Http\Controllers\CircleController::class, 'index'])->name('circles');

        Route::post('/store', [App\Http\Controllers\CircleController::class, 'store'])->name('circle.store');

        Route::get('delete/{id}', [App\Http\Controllers\CircleController::class, 'destroy'])->name('circle.delete');
    });

    Route::group(['prefix' => '/questions'], function () {

        Route::get('/', [App\Http\Controllers\QuestionController::class, 'index'])->name('questions');

        Route::post('/store', [App\Http\Controllers\QuestionController::class, 'store'])->name('question.store');

        Route::post('/sort', [App\Http\Controllers\QuestionController::class, 'sort'])->name('sort');

        Route::get('delete/{id}', [App\Http\Controllers\QuestionController::class, 'destroy'])->name('question.delete');
    });

    Route::group(['prefix' => '/events'], function () {

        Route::get('/', [App\Http\Controllers\EventController::class, 'index'])->name('events');

        Route::get('/{id}', [App\Http\Controllers\EventController::class, 'show'])->name('event.show');

        Route::get('/activate/{id}', [App\Http\Controllers\EventController::class, 'activate'])->name('event.activate');

        Route::get('/export/{id}', [App\Http\Controllers\EventController::class, 'export'])->name('feedback.export');

        Route::post('/store', [App\Http\Controllers\EventController::class, 'store'])->name('event.store');

        Route::get('delete/{id}', [App\Http\Controllers\EventController::class, 'destroy'])->name('event.delete');
    });

    Route::group(['prefix' => '/groups'], function () {

        Route::get('/', [App\Http\Controllers\GroupController::class, 'index'])->name('groups');

        Route::post('/store', [App\Http\Controllers\GroupController::class, 'store'])->name('group.store');

        Route::post('/import', [App\Http\Controllers\GroupController::class, 'import'])->name('group.import');

        Route::get('/export', [App\Http\Controllers\GroupController::class, 'export'])->name('group.export');

        Route::get('delete/{id}', [App\Http\Controllers\GroupController::class, 'destroy'])->name('group.delete');
    });

    Route::group(['prefix' => '/restaurants'], function () {

        Route::get('/', [App\Http\Controllers\ResturantController::class, 'index'])->name('restaurants');

        Route::post('/store', [App\Http\Controllers\ResturantController::class, 'store'])->name('restaurant.store');

        Route::get('delete/{id}', [App\Http\Controllers\ResturantController::class, 'destroy'])->name('restaurant.delete');
    });
    
    Route::group(['prefix' => '/upcoming_dates'], function () {

        Route::get('/', [App\Http\Controllers\UpcomingDateController::class, 'index'])->name('upcoming_dates');

        Route::post('/store', [App\Http\Controllers\UpcomingDateController::class, 'store'])->name('upcoming_date.store');

        Route::get('delete/{id}', [App\Http\Controllers\UpcomingDateController::class, 'destroy'])->name('upcoming_date.delete');
    });

    Route::group(['prefix' => '/contact_reports'], function () {

        Route::get('/', [App\Http\Controllers\ContactReportController::class, 'index'])->name('contact_reports');
    });

});
