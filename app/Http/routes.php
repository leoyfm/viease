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

Route::get('/subscribe/{id}', function ($id) {

    if( $id )
        return activity_view('subscribe.'.$id);

    return activity_view('subscribe.default');

});

Route::get('/nianhuo/winner', 'Activity\NianHuoController@winner');


Route::controller('shake', 'Activity\ShakeController');


//Route::controller('activities', 'Activity\ActivityController');
//Route::get('activities/{id}', 'Activity\ActivityController@init');
Route::group( $activity, function(){


    Route::get('/{id}', 'ActivityController@init');

    Route::get('/nianhuo/callback', 'NianHuoController@callback');
    Route::get('/nianhuo/uploadurl', 'NianHuoController@uploadUrl');

    Route::get('/team/callback', 'TeamController@callback');
    Route::get('/team/uploadurl', 'TeamController@uploadUrl');

    Route::get('/liuyi/callback', 'LiuYiController@callback');
    Route::get('/liuyi/uploadurl', 'LiuYiController@uploadUrl');

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

    //六一
    Route::group(['prefix' => 'liuyi'], function(){

        Route::get('/index', 'LiuYiController@index');
        Route::get('join', 'LiuYiController@join');
        Route::post('join', 'LiuYiController@join');
        Route::post('addticket/{id}', 'LiuYiController@addTicket');
        Route::get('vote/{id}', 'LiuYiController@vote');

        Route::get('content/{id}', 'LiuYiController@content');
        Route::get('most', 'LiuYiController@most');
    });

    Route::controller('shake', 'ShakeController');

    Route::get('index', function () {

        return activity_view('team.index');
    });

    //端午节
    Route::group(['prefix' => 'dwj'], function(){

        Route::get('index', 'DwjController@index');
        Route::post('submit', 'DwjController@submit');

        Route::get('test', 'DwjController@test');

        Route::get('most', 'DwjController@most');
    });

    Route::controller('shake', 'ShakeController');

    Route::get('index', function () {

        return activity_view('team.index');
    });

//    Route::group([ 'prefix' => 'shake'], function(){
//
//        Route::controller('auth', 'AuthController');
//
//        Route::get('/', 'ShakeController@index');
//
//        Route::get('/shake', 'ShakeController@index');
//    });



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
            'activity' => 'ActivityController',
        ]);
    });
});
