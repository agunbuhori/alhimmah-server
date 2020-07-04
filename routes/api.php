<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
Route::post('/login', 'API\AuthController@login');
Route::get('/auth/{provider}', 'Auth\LoginController@redirectToProvider');

Route::group(['namespace' => 'API', 'middleware' => 'auth:api'], function () {
    Route::get('/user', 'AuthController@user');
    Route::post('/logout', 'AuthController@logout');
    
    Route::get('/profile', 'MemberController@profile');
    Route::get('/classrooms', 'MemberController@classrooms');
    Route::get('/courses', 'MemberController@courses');
    Route::get('/quizzes', 'MemberController@quizzes');
    Route::get('/materies', 'MemberController@materies');
    Route::get('/stream/{id}', 'MemberController@stream');
    Route::put('/read/{id}', 'MemberController@read');
    Route::get('/quiz/{id}', 'MemberController@quiz');
    Route::post('/quizzes/{id}', 'MemberController@getQuizzes');
    Route::put('/start_quiz/{id}', 'MemberController@startQuiz');
    Route::post('/answer/{id}', 'MemberController@answer');
    Route::put('/update_profile', 'MemberController@updateProfile');
    Route::put('/update_user', 'MemberController@updateUser');
    Route::get('/ranks', 'MemberController@ranks');
    Route::post('/start_class', 'MemberController@startClass');

    Route::post('/register_classroom', 'MemberController@registerClassroom');

    Route::get('/countries', function () {
        return DB::table('countries')->get();
    });

    Route::get('/provinces', function () {
        return DB::table('wilayah')->whereRaw('LENGTH(kode) = 2')->get();
    });
    
    Route::get('/cities', function () {
        return DB::table('wilayah')
        ->whereRaw('LEFT(kode, 2) = :kode', [':kode' => request()->get('kode')])
        ->whereRaw('LENGTH(kode) = 5')
        ->get();
    });

});