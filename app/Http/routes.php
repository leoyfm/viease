<?php

/*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
*/


Route::get('/', function () {

    return view('welcome');
});

Route::any('/api', 'ServerController@server');
Route::any('/api/upload', 'ServerController@upload');

Route::any('/qiniu', 'QinNiuController@test');

/**
 * videos
 */
$vedio = [
    'prefix' => 'video',
    'namespace' => 'Video',
//    'middleware' => 'activity.auth'

];
Route::group( $vedio, function(){

    Route::controller('/', 'VideoController');

});

/**
 * activities
 */

$activity = [
    'prefix' => 'activities',
    'namespace' => 'Activity',
    'middleware' => 'activity.auth'

];

Route::get('/subscribe', function () {

    return activity_view('subscribe');
});

Route::group( $activity, function(){

    Route::get('/nianhuo/callback', 'NianHuoController@callback');
    Route::get('/nianhuo/uploadurl', 'NianHuoController@uploadUrl');
    Route::group(['prefix'=>'nianhuo'], function(){
        Route::get('/', 'NianHuoController@index');
        Route::get('join', 'NianHuoController@join');
        Route::post('join', 'NianHuoController@join');
        Route::get('content/{id}', 'NianHuoController@content');
        Route::get('most', 'NianHuoController@most');
        Route::get('vote/{id}', 'NianHuoController@vote');
        Route::post('addticket/{id}', 'NianHuoController@addTicket');
        Route::any('test', 'NianHuoController@test');
        Route::get('ticket/{id}', 'NianHuoController@showTicket');

        //test
        Route::get('/index1', 'NianHuoController@index1');
    });

});

/*
    * Admin
 */
$admin = [
            'prefix' => 'admin',
            'namespace' => 'Admin',
            'middleware' => 'admin',
         ];

Route::group($admin, function () {
    Route::get('/', 'AccountController@getManage');
    Route::controller('account', 'AccountController');
    Route::controller('auth', 'AuthController');

    Route::group(['middleware' => 'account'], function () {
        Route::controllers([
            'user' => 'UserController',
            'fan' => 'FanController',
            'fan-group' => 'FanGroupController',
            'menu' => 'MenuController',
            'material' => 'MaterialController',
            'staff' => 'StaffController',
            'message' => 'MessageController',
            'reply' => 'ReplyController',
            'upload' => 'UploadController',
            'hongbao' => 'HongBaoController',
        ]);
    });
});
