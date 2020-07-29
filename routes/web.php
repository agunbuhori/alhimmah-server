<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]);
Route::get('/auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/callback/{provider}', 'Auth\LoginController@handleProviderCallback');

Route::get('/', 'HomeController@index');
Route::get('/kelas', 'HomeController@kelas');
Route::get('/kelas/{code}', 'HomeController@index');

Route::group(['middleware' => ['auth', 'role:superadmin'], 'prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index');
    Route::get('/user', 'AdminController@user');
    Route::get('/classroom_member/{id}', 'AdminController@classroomMember');
    Route::get('/media', 'AdminController@mediaManager');
    Route::get('/member', 'AdminController@member');
    Route::get('/bank', 'AdminController@bank');
    Route::post('/upload', 'AdminController@upload');

    Route::resource('classroom', 'ClassroomController');
    Route::resource('course', 'CourseController');
    Route::resource('matery', 'MateryController');
    Route::resource('quiz', 'QuizController');
    Route::resource('member_profile', 'MemberProfileController');

    Route::group(['prefix' => 'data'], function () {
        Route::resource('user', 'UserController');
    });

    Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});


Route::get('/logout', 'Auth\LoginController@logout');