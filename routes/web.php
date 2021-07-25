<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\LocationController;

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

Route::get('/', 'WelcomeController@index');
// Route::get('/lowstock', 'WelcomeController@lowStock');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    //Dashboard
    Route::get('/dashboard', 'WelcomeController@index');
    // Route::get('/dashboard/lowstock', 'DashboardController@lowStock');

    Route::patch('/checkins/set_completed/{checkin}', 'CheckInController@setCompleted');
    Route::patch('/checkouts/set_completed/{checkout}', 'CheckOutController@setCompleted');
    Route::patch('/checkouts/void/{checkout}', 'CheckOutController@voidCheckout');

    Route::patch('/returnReceive/setCompleted/{returnReceive}', 'ReturnReceiveController@setCompleted');
    Route::patch('/returnReissue/setCompleted/{returnReissue}', 'ReturnReissueController@setCompleted');
    
    Route::get('/toners/{toner}/stocks', 'TonerController@getStocksByToner');
    Route::get('/stocks/{stock}/remaining', 'StockController@getRemainingStock');

    Route::post('/toners/search', 'TonerController@search');
    Route::post('/locations/search', 'LocationController@search');
    Route::post('/suppliers/search', 'SupplierController@search');
    Route::post('/checkins/search', 'CheckInController@search');
    Route::post('/checkouts/search', 'CheckOutController@search');
    Route::post('/returnReceive/search', 'ReturnReceiveController@search');
    Route::post('/returnReissue/search', 'ReturnReissueController@search');

    Route::get('/checkouts/{checkout}/upload-delete', 'CheckoutController@fileDelete');
    Route::post('/checkouts/{checkout}/upload', 'CheckoutController@fileUpload');
    

    Route::post('/users/{user}/resetpassword', 'UserController@resetPassword');

    Route::resource('locations', LocationController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('toners', TonerController::class);
    Route::resource('checkins', CheckInController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('checkouts', CheckOutController::class);
    Route::resource('releaseitems', ReleaseItemController::class);
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('returnReceive', ReturnReceiveController::class);
    Route::resource('returnItem', ReturnItemController::class);
    Route::resource('returnReissue', ReturnReissueController::class);
    Route::resource('offTheRecord', OffTheRecordController::class);
    Route::resource('offTheRecordItem', OffTheRecordItemController::class);

    Route::get('/reports/master-list', 'ReportController@masterList');
    Route::get('/reports/stocks', 'ReportController@stocks');

    Route::get('/reports/checkins','ReportController@checkins');
    Route::get('/reports/checkins/{checkin}','ReportController@checkinsShow');
    Route::get('//reports/checkins/{checkin}/release','ReportController@checkinsShowRelease');
    Route::post('/reports/checkinSearch','ReportController@checkinsSearch');

    Route::get('/reports/checkouts','ReportController@checkouts');
    Route::get('/reports/checkouts/{checkout}','ReportController@checkoutsShow');
    Route::post('/reports/checkoutSearch','ReportController@checkoutsSearch');

    Route::get('/reports/returnReceive', 'ReportController@returnReceive');
    Route::get('/reports/returnReceive/{returnReceive}', 'ReportController@returnReceiveShow');
    Route::post('/reports/returnReceive/search', 'ReportController@returnReceiveSearch');
    Route::get('/reports/returnReissue', 'ReportController@returnReissue');
    Route::get('/reports/returnReissue/{returnReissue}', 'ReportController@returnReissueShow');
    Route::post('/reports/returnReissue/search', 'ReportController@returnReissueSearch');
});
